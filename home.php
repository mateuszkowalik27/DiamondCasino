<?php
    session_start();

    $is_logged_in = isset($_SESSION['user_id']); 
    $username = $is_logged_in ? $_SESSION['user_name'] : null;
    $useremail = $is_logged_in ? $_SESSION['user_email'] : null;
    if ($is_logged_in){
        $db = mysqli_connect("localhost", "root", "", "casino");
        $query = "SELECT balance FROM users WHERE email = '$useremail'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $userbalance = $row['balance'];
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diamond Casino</title>
    <link rel="stylesheet" href="Styles/header.css">
    <link rel="stylesheet" href="Styles/mainHome.css">
    <link rel="stylesheet" href="Styles/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <a class="home-icon" href="home.php">
                        <img src="Files/DiamondCasinoLogo.png" alt="DiamondCasino">
                    </a>
                </div>
                <div class="col user">
                    <?php if ($is_logged_in): ?>
                        <div class="userContainer">
                            <img src="Files/Profile.png" alt="Profile">
                            <div class="userData">
                                <p>Hello, <?php echo htmlspecialchars($username); ?>!</p>
                                <p><?php echo htmlspecialchars($useremail); ?></p>
                                <p>Balance: <?php echo htmlspecialchars($userbalance); ?> $</p>
                                <p class="item"><a href="Login/logout.php">Log Out</a></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="loginButton"><a href="Login/login.php">Sign In</a></div>
                        <div class="registerButton"><a href="Register/register.php">Sign Up</a></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="div1">
            <a href="Roulette/roulette.php"><img src="Files/roulette.jpg" alt=""></a>
        </div>
        <div class="div2"><img src="Files/roulette.jpg" alt=""></div>
        <div class="div3"><img src="Files/roulette.jpg" alt=""></div>
        <div class="div1">
            <a href="Roulette/roulette.php"><img src="Files/roulette.jpg" alt=""></a>
        </div>
        <div class="div2"><img src="Files/roulette.jpg" alt=""></div>
        <div class="div3"><img src="Files/roulette.jpg" alt=""></div>
    </main>
    <footer>
        <p>Copyright © 2025 Mateusz Kowalik</p>
    </footer>
</body>
</html>