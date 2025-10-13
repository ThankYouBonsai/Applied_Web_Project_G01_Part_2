<?php
session_start();
include ("header.inc");
require_once 'settings_manage.php';
$dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to find the user by username
    $stmt = $dbconn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // If the user is found and the password matches, start a session
        $_SESSION['username'] = $username;
        header('Location: manage.php'); // Redirect to the admin page
    } else {
        echo 'Invalid credentials';
    }
}
?>

<form method="POST" action="">
    <label for="username">Username</label>
    <input type="text" name="username" required>
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <input type="submit" value="Login">
</form>
include ("footer.inc");
?>
