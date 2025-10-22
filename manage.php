<?php
// manage.php — cleaned syntax & stable session handling

// --- Session & Output Buffer ---
if (session_status() === PHP_SESSION_NONE) { session_start(); }
ob_start();

// --- Logout ---
// Use manage.php?action=logout to log out.
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
    exit;
}

// --- Auth Guard (show login if not authenticated) ---
if (empty($_SESSION['username'])) {
    $login_error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $login_error = 'Please enter both username and password.';
        } else {
            require_once __DIR__ . '/settings.php'; // expects $host, $user, $pwd, $sql_db

            $dbconn = @mysqli_connect($host ?? null, $user ?? null, $pwd ?? null, $sql_db ?? null);
            if (!$dbconn) {
                $login_error = 'Database connection failed: ' . htmlspecialchars(mysqli_connect_error());
            } else {
                $sql = 'SELECT username, password FROM users WHERE username = ? LIMIT 1';
                if ($stmt = mysqli_prepare($dbconn, $sql)) {
                    mysqli_stmt_bind_param($stmt, 's', $username);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    if ($res && ($row = mysqli_fetch_assoc($res))) {
                        $stored = $row['password'];
                        // Allow either plain text (teaching/demo) or hashed
                        $ok = false;
                        if (password_get_info($stored)['algo']) {
                            $ok = password_verify($password, $stored);
                        } else {
                            $ok = hash_equals($stored, $password);
                        }
                        if ($ok) {
                            session_regenerate_id(true);
                            $_SESSION['username'] = $username;
                            header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?'));
                            exit;
                        } else {
                            $login_error = 'Invalid username or password.';
                        }
                    } else {
                        $login_error = 'Invalid username or password.';
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $login_error = 'Could not prepare login statement.';
                }
                mysqli_close($dbconn);
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <style>
            body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; margin: 0; background: #f6f7fb; }
            main { max-width: 460px; margin: 72px auto; padding: 24px; background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
            h1 { margin: 0 0 16px; font-size: 22px; }
            label { display:block; margin:12px 0 6px; font-weight:600; }
            input[type="text"], input[type="password"] { width:100%; padding:10px 12px; border:1px solid #d9dee8; border-radius:8px; box-sizing:border-box; }
            .btn { margin-top:16px; width:100%; padding:10px 12px; border:0; border-radius:8px; background:#0b5fff; color:white; font-weight:600; cursor:pointer; }
            .btn:hover { background:#0a52da; }
            .error { background:#ffe8e8; color:#8a1f1f; padding:10px 12px; border:1px solid #ffc7c7; border-radius:8px; margin-bottom:12px; }
            .hint { margin-top:16px; color:#667085; font-size:13px; }
            code { background:#f0f3fa; padding:2px 6px; border-radius:6px; }
        </style>
    </head>
    <body>
        <main>
            <h1>Sign in</h1>
            <?php if (!empty($login_error)): ?>
                <div class="error"><?php echo htmlspecialchars($login_error); ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" autofocus required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" class="btn" value="Login">
            </form>
            <p class="hint">
                Tip: Ensure your <code>users</code> table has a test account (e.g. admin/admin) or a hashed password created via <code>password_hash()</code>.
            </p>
        </main>
    </body>
    </html>
    <?php
    exit;
}

// --- Authenticated area below ---

// Include header / nav
include_once __DIR__ . '/header.inc';

// Database connection for management actions
require_once __DIR__ . '/settings.php';
$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
if (!$dbconn) {
    // Render a simple error and stop (still valid HTML because header.inc likely opened the HTML doc already)
    echo '<main><h2>Database Error</h2><p>' . htmlspecialchars(mysqli_connect_error()) . '</p></main>';
    include __DIR__ . '/footer.inc';
    exit;
}

// Handle actions
$action        = $_GET['action'] ?? '';
$job_reference = trim($_POST['job_reference'] ?? '');
$first_name    = trim($_POST['first_name'] ?? '');
$last_name     = trim($_POST['last_name'] ?? '');
$id            = isset($_POST['id']) ? (int)$_POST['id'] : null;
$new_status    = trim($_POST['status'] ?? '');
$sort_by       = $_POST['sort_by'] ?? 'job_reference_number';
$flash         = '';

// Sort whitelist
$sortable = [
    'job_reference_number' => 'job_reference_number',
    'first_name'           => 'first_name',
    'last_name'            => 'last_name',
    'status'               => 'status',
    'eoi_id'               => 'eoi_id',
];
$sort_col = $sortable[$sort_by] ?? 'job_reference_number';

// Helper functions (prepared statements)
function listAllEOIs($dbconn, $sort_col) {
    $sql = "SELECT eoi_id AS id, job_reference_number, first_name, last_name, status FROM eoi ORDER BY $sort_col";
    return mysqli_query($dbconn, $sql);
}

function listByJobReference($dbconn, $job_reference) {
    $sql = "SELECT eoi_id AS id, job_reference_number, first_name, last_name, status
            FROM eoi
            WHERE job_reference_number LIKE ?
            ORDER BY eoi_id";
    $stmt = mysqli_prepare($dbconn, $sql);
    $like = "%" . $job_reference . "%";
    mysqli_stmt_bind_param($stmt, 's', $like);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function listByApplicantName($dbconn, $first_name, $last_name) {
    $clauses = [];
    $params = [];
    $types  = '';

    if ($first_name !== '') { $clauses[] = "first_name LIKE ?"; $params[] = "%".$first_name."%"; $types .= 's'; }
    if ($last_name  !== '') { $clauses[] = "last_name  LIKE ?"; $params[] = "%".$last_name."%";  $types .= 's'; }

    if (!$clauses) { return false; }

    $where = implode(" AND ", $clauses);
    $sql = "SELECT eoi_id AS id, job_reference_number, first_name, last_name, status
            FROM eoi
            WHERE $where
            ORDER BY eoi_id";
    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

function deleteEOIsByJobReference($dbconn, $job_reference) {
    $sql = "DELETE FROM eoi WHERE job_reference_number = ?";
    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $job_reference);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

function changeEOIStatus($dbconn, $id, $new_status) {
    $sql = "UPDATE eoi SET status = ? WHERE eoi_id = ?";
    $stmt = mysqli_prepare($dbconn, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $new_status, $id);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_affected_rows($stmt);
}

// Decide what to run
$result = null;
if ($action === 'list_all') {
    $result = listAllEOIs($dbconn, $sort_col);
} elseif ($action === 'list_by_job_reference') {
    $result = listByJobReference($dbconn, $job_reference);
} elseif ($action === 'list_by_name') {
    $result = listByApplicantName($dbconn, $first_name, $last_name);
} elseif ($action === 'delete_by_job_reference') {
    if ($job_reference === '') {
        $flash = 'Please enter a Job Reference to delete.';
    } else {
        $deleted = deleteEOIsByJobReference($dbconn, $job_reference);
        $flash = $deleted . " record(s) deleted for job reference " . htmlspecialchars($job_reference) . ".";
        $result = listAllEOIs($dbconn, $sort_col);
    }
} elseif ($action === 'change_status' && $id && $new_status !== '') {
    $changed = changeEOIStatus($dbconn, $id, $new_status);
    $flash = $changed ? "EOI #$id status updated to " . htmlspecialchars($new_status) . "."
                      : "No changes made for EOI #$id.";
    $result = listAllEOIs($dbconn, $sort_col);
}

// --- Render management UI ---
?>
<main>
    <h2>Manage EOIs</h2>

    <!-- List by Job Reference -->
    <form method="POST" action="?action=list_by_job_reference" style="margin-bottom:12px;">
        <label for="job_reference">Job Reference:</label>
        <input type="text" name="job_reference" id="job_reference" required>
        <input type="submit" value="List EOIs by Job Reference">
    </form>

    <!-- List by Applicant Name -->
    <form method="POST" action="?action=list_by_name" style="margin-bottom:12px;">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name">
        <input type="submit" value="List EOIs by Applicant Name">
    </form>

    <!-- Delete by Job Reference -->
    <form method="POST" action="?action=delete_by_job_reference" style="margin-bottom:12px;">
        <label for="job_reference_del">Job Reference:</label>
        <input type="text" name="job_reference" id="job_reference_del" required>
        <input type="submit" value="Delete EOIs by Job Reference">
    </form>

    <!-- Change EOI Status -->
    <form method="POST" action="?action=change_status" style="margin-bottom:12px;">
        <label for="id">EOI ID:</label>
        <input type="number" name="id" id="id" required>
        <label for="status">Status:</label>
        <input type="text" name="status" id="status" required>
        <input type="submit" value="Change EOI Status">
    </form>

    <!-- Sort EOIs (Display All) -->
    <form method="POST" action="?action=list_all" style="margin-bottom:12px;">
        <label for="sort_by">Sort by:</label>
        <select name="sort_by" id="sort_by">
            <option value="job_reference_number">Job Reference</option>
            <option value="first_name">First Name</option>
            <option value="last_name">Last Name</option>
            <option value="status">Status</option>
            <option value="eoi_id">EOI ID</option>
        </select>
        <input type="submit" value="Display All (Sorted)">
    </form>

    <?php if (!empty($flash)): ?>
        <p style="padding:8px; background:#fff8c4; border:1px solid #f0e68c; border-radius:6px;">
            <?php echo $flash; ?>
        </p>
    <?php endif; ?>

    <?php if ($result): ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Job Reference</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Status</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['job_reference_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php elseif ($action): ?>
        <p>No results found.</p>
    <?php endif; ?>

</main>
<?php
// Footer & close
include __DIR__ . '/footer.inc';
mysqli_close($dbconn);
?>
