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
            include ("header.inc");
            require_once 'settings.php';
            $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
            
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Query to find the user by username
                    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
                    $stmt->execute(['username' => $username]);
                    $user = $stmt->fetch();

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
                <?php
                include ("footer.inc");
                ?>
        </main>
    </body>
</html>