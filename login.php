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

        // Establishing the database connection using mysqli
        $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
        
        // Check if the connection is successful
        if (!$dbconn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // If the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Prepare and execute query to find user by username
            $stmt = mysqli_prepare($dbconn, "SELECT * FROM users WHERE username = ?");
            mysqli_stmt_bind_param($stmt, 's', $username); // 's' indicates the parameter is a string
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Fetch the user data from the result
            $user = mysqli_fetch_assoc($result);

            // Check if the user is found and the password is correct
            if ($user && password_verify($password, $user['password'])) {
                // If login is successful, store session data and redirect to manage.php
                $_SESSION['username'] = $username;
                header('Location: manage.php');
                exit(); // Make sure the script stops executing after the redirect
            } else {
                echo 'Invalid credentials';
            }
        }
        ?>

        <!-- Login Form -->
        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" name="username" required>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <input type="submit" value="Login">
        </form>

        <?php include ("footer.inc"); ?>
    </main>
</body>
</html>
