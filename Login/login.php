<?php
    session_start();

    $error = '';

    if (isset($_SESSION['error_message'])) {
        $error = $_SESSION['error_message'];
        unset($_SESSION['error_message']); 
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        $error_to_set = "The e-mail address or password is incorrect";

        if (!empty($email) && !empty($password)) {
            
            $db = mysqli_connect("localhost", "root", "", "casino");
            
            $stmt = $db->prepare("SELECT id, email, password, name, balance FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id, $db_email, $db_password, $db_name, $db_balance);
            $stmt->fetch();
            
            
            if ($id && password_verify($password, $db_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $db_name;
                $_SESSION['user_email'] = $db_email;
                
                $stmt->close();
                $db->close();
                
                header('Location: ../home.php'); 
                exit(); 
            } 
            $stmt->close();
            $db->close(); 
        }
        $_SESSION['error_message'] = $error_to_set;
        header('Location: login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="../Styles/authentication.css">
</head>
<body>
    <main class="main-container">
        <div class="header-row">
            <a href="../home.php" class="backButton"><</a>
            <h1>Sign In</h1>
            <div class="hiddenButton">></div>
        </div>
        <form action="login.php" method="POST" onsubmit="return validData(event)">
            
            <div class="inputContainer">
                <label for="email">E-mail</label><br>
                <input type="text" id="email" name="email" placeholder="Enter your e-mail" >
                <?php
                    if (!empty($error)) {
                        echo '<p>' . htmlspecialchars($error) . '</p>';
                    }
                ?>
            </div>
            <div class="inputContainerButton">
                <label for="password">Password</label><br>
                <div class="insideButton">
                    <input type="password" id="password" name="password" placeholder="Enter your password" >
                    <button type="button" id="hide-show" name="hide-show"><img src="../Files/hide.png" id="hide-show-img"></button>
                </div>
                <?php
                    if (!empty($error)) {
                        echo '<p>' . htmlspecialchars($error) . '</p>';
                    }
                ?>
            </div>
            <div class="inputContainerSubmit">
                <input type="submit" value="Send" class="font">
            </div>
        </form>
        <a href="../Register/register.php">Sign Up</a>
    </main>
    <script src="../Scripts/password.js"></script>
</body>
</html>