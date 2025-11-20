<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
   <link rel="stylesheet" href="../Styles/authentication.css">
</head>
<body>
    <?php
        session_start();

        $error = '';

        if (isset($_SESSION['error_message'])) {
            $error = $_SESSION['error_message'];
            unset($_SESSION['error_message']);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $db = mysqli_connect("localhost", "root", "", "casino");

            $name = trim($_POST['name']);
            $surname = trim($_POST['surname']);
            $dateBirth = $_POST['dateBirth'];
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            $safeName = mysqli_real_escape_string($db, $name);
            $safeSurname = mysqli_real_escape_string($db, $surname);
            $safeDateBith = mysqli_real_escape_string($db, $dateBirth);
            $safeEmail = mysqli_real_escape_string($db, $email);
            $safePassword = mysqli_real_escape_string($db, $passwordHash);

            $check_query_email = "SELECT email FROM users WHERE email = '$safeEmail' LIMIT 1;";
            $check_result_email = mysqli_query($db, $check_query_email);

            $check_query_password = "SELECT password FROM users WHERE password = '$safePassword' LIMIT 1;";
            $check_result_password = mysqli_query($db, $check_query_password);

            if (mysqli_num_rows($check_result_email) > 0 || mysqli_num_rows($check_result_password) > 0) {
                $_SESSION['error_message'] = "Email address or password you provided already exists.";
                header("Location: " . $_SERVER['PHP_SELF']); 
                exit();
            }
            else {
                $insert_query = "INSERT INTO users (name, surname, date_birth, email, password) VALUES ('$safeName', '$safeSurname', '$safeDateBith', '$safeEmail', '$safePassword');";
                $result = mysqli_query($db, $insert_query);
                if ($result) {
                    header("Location: success.html");
                    exit();
                } else {
                    $_SESSION['error_message'] = "An error occurred while registering in the database.";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }
            }
            mysqli_close($db);
        }

    ?>
    <main class="main-container">
        <div class="header-row">
            <a href="../home.php" class="backButton"><</a>
            <h1>Sign Up</h1>
            <div class="hiddenButton">></div>
        </div>
        <form action="" method="POST" onsubmit="return validData(event)">
            <div class="inputContainer">
                <label for="name">Name</label><br>
                <input type="text" id="name" name="name" placeholder="Enter your name" >
                <p id="nameError"></p>
            </div>
            <div class="inputContainer">
                <label for="surname">Surname</label><br>
                <input type="text" id="surname" name="surname" placeholder="Enter your surname" >
                <p id="surnameError"></p>
            </div>
            <div class="inputContainer">
                <label for="dateBirth">Date Birth</label><br>
                <input type="text" id="dateBirth" name="dateBirth" placeholder="DD-MM-YY" maxlength="10" >
                <p id="dateBirthError"></p>
            </div>
            <div class="inputContainer">
                <label for="email">E-mail</label><br>
                <input type="text" id="email" name="email" placeholder="Enter your e-mail" >
                <p id="emailError"></p>
                <?php
                    if ($error) {
                        echo '<p>' . $error . '</p>';
                    }
                ?>
            </div>
            <div class="inputContainerButton">
                <label for="password">Password</label><br>
                <div class="insideButton">
                    <input type="password" id="password" name="password" placeholder="Enter your password" >
                    <button type="button" id="hide-show" name="hide-show"><img src="../Files/hide.png" id="hide-show-img"></button>
                </div>
                <p id="passwordError"></p>
                <?php
                    if ($error) {
                        echo '<p>' . $error . '</p>';
                    }
                ?>
            </div>
            <div class="inputContainerSubmit">
                <input type="submit" value="Send" class="font">
            </div>
        </form>
        <a href="../Login/login.php">Sign In</a>
    </main>
    <script src="../Scripts/dateBirth.js"></script>
    <script src="../Scripts/password.js"></script>
    <script src="../Scripts/validData.js"></script>
</body>
</html>