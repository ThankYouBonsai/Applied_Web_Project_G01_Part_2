<html lang="en">
    <head>

        <meta charset="UTF-8">

        <!-- Responsive Web Design -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- HTML Page Description for SEO -->
        <meta name="description" content="Main landing page for MelonBall, a game development company specializing in tropical, relaxing, immersive games.">

        <!-- Keywords for SEO -->
        <meta name="keywords" content="Melonball, tropical, relaxing, immersive, games">

        <!-- Author Information -->
        <meta name="author" content="Jonah, James, Kia and Duc">

        <!-- Link to external CSS File -->
        <link rel="stylesheet" href="styles/stylessheet.css">

        <!-- Title of Web Page-->
        <title>MelonBall - Play Easy. Drift Far.</title>
        <!-- Embedded CSS for right panel text styling -->
        <style>
          .index_rightpanel h2 {
            color: #ffffff;
          }

          .index_rightpanel p {
            color: #ffffff;
            font-weight: lighter;
          }

          .index_rightpanel a {
            color: #ffffff;
            text-decoration: none;
          }

          .index_rightpanel a:hover {
            text-decoration: underline;
            text-decoration-color: rgb(103, 147, 161);
          }
        </style>
    </head>
    <body>
        <!-- php Header with navigation menu-->
        <?php include 'header.inc'; ?>

        <main>
            <?php
            session_start();
            require_once 'settings.php';

            $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

            // Check for connection failure
            if (!$dbconn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Check if user is logged in
            if (!isset($_SESSION['username'])) {
                header('Location: login.php');
                exit();
            }

            // Handle different actions based on GET/POST parameters
            $action = $_GET['action'] ?? '';
            $job_reference = $_POST['job_reference'] ?? '';
            $first_name = $_POST['first_name'] ?? '';
            $last_name = $_POST['last_name'] ?? '';
            $eoi_status = $_POST['eoi_status'] ?? '';
            $sort_by = $_POST['sort_by'] ?? 'job_reference'; // Default sorting field

            // Function to list all EOIs
            function listAllEOIs($dbconn, $sort_by) {
                $query = "SELECT * FROM EOIs ORDER BY $sort_by";
                return mysqli_query($dbconn, $query);
            }

            // Function to list EOIs by job reference
            function listByJobReference($dbconn, $job_reference) {
                $query = "SELECT * FROM EOIs WHERE job_reference LIKE ?";
                $stmt = mysqli_prepare($dbconn, $query);
                mysqli_stmt_bind_param($stmt, 's', $job_reference);
                mysqli_stmt_execute($stmt);
                return mysqli_stmt_get_result($stmt);
            }

            // Function to list EOIs by applicant name
            function listByApplicantName($dbconn, $first_name, $last_name) {
                $query = "SELECT * FROM EOIs WHERE applicant_first_name LIKE ? AND applicant_last_name LIKE ?";
                $stmt = mysqli_prepare($dbconn, $query);
                mysqli_stmt_bind_param($stmt, 'ss', $first_name, $last_name);
                mysqli_stmt_execute($stmt);
                return mysqli_stmt_get_result($stmt);
            }

            // Function to delete all EOIs by job reference
            function deleteEOIsByJobReference($dbconn, $job_reference) {
                $query = "DELETE FROM EOIs WHERE job_reference = ?";
                $stmt = mysqli_prepare($dbconn, $query);
                mysqli_stmt_bind_param($stmt, 's', $job_reference);
                return mysqli_stmt_execute($stmt);
            }

            // Function to change EOI status
            function changeEOIStatus($dbconn, $id, $eoi_status) {
                $query = "UPDATE EOIs SET eoi_status = ? WHERE id = ?";
                $stmt = mysqli_prepare($dbconn, $query);
                mysqli_stmt_bind_param($stmt, 'si', $eoi_status, $id);
                return mysqli_stmt_execute($stmt);
            }

            // Handle specific actions
            if ($action == 'list_all') {
                $result = listAllEOIs($dbconn, $sort_by);
            } elseif ($action == 'list_by_job_reference') {
                $result = listByJobReference($dbconn, $job_reference);
            } elseif ($action == 'list_by_name') {
                $result = listByApplicantName($dbconn, $first_name, $last_name);
            } elseif ($action == 'delete_by_job_reference') {
                $delete_success = deleteEOIsByJobReference($dbconn, $job_reference);
            } elseif ($action == 'change_status') {
                $id = $_POST['id'];
                $status = $_POST['status'];
                $status_changed = changeEOIStatus($dbconn, $id, $status);
            }

            // Include header
            include 'header.inc';
            ?>

            <main>
                <h2>Manage EOIs</h2>

                <!-- Form to list EOIs by job reference -->
                <form method="POST" action="?action=list_by_job_reference">
                    <label for="job_reference">Job Reference:</label>
                    <input type="text" name="job_reference" required>
                    <input type="submit" value="List EOIs by Job Reference">
                </form>

                <!-- Form to list EOIs by applicant name -->
                <form method="POST" action="?action=list_by_name">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name">
                    <input type="submit" value="List EOIs by Applicant Name">
                </form>

                <!-- Form to delete all EOIs by job reference -->
                <form method="POST" action="?action=delete_by_job_reference">
                    <label for="job_reference">Job Reference:</label>
                    <input type="text" name="job_reference" required>
                    <input type="submit" value="Delete EOIs by Job Reference">
                </form>

                <!-- Form to change the status of an EOI -->
                <form method="POST" action="?action=change_status">
                    <label for="id">EOI ID:</label>
                    <input type="text" name="id" required>
                    <label for="status">Status:</label>
                    <input type="text" name="status" required>
                    <input type="submit" value="Change EOI Status">
                </form>

                <!-- Sort EOIs -->
                <form method="POST" action="?action=list_all">
                    <label for="sort_by">Sort by:</label>
                    <select name="sort_by">
                        <option value="job_reference">Job Reference</option>
                        <option value="applicant_first_name">First Name</option>
                        <option value="applicant_last_name">Last Name</option>
                    </select>
                    <input type="submit" value="Sort Results">
                </form>

                <!-- Display EOIs -->
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Job Reference</th>
                        <th>Applicant First Name</th>
                        <th>Applicant Last Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    if (isset($result)) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['job_reference'] . "</td>";
                            echo "<td>" . $row['applicant_first_name'] . "</td>";
                            echo "<td>" . $row['applicant_last_name'] . "</td>";
                            echo "<td>" . $row['eoi_status'] . "</td>";
                            echo "<td><a href='?action=change_status&id=" . $row['id'] . "'>Change Status</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </main>

            <?php
            // Include footer
            include 'footer.inc';
            ?>

        </main>
    </body>
</html>