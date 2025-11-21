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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roulette</title>
    <link rel="stylesheet" href="../Styles/header.css">
    <link rel="stylesheet" href="../Styles/roulette.css">
    <link rel="stylesheet" href="../Styles/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <div class="home-icon">
                        <a href="../home.php">
                            <img src="../Files/DiamondCasinoLogo.png" alt="DiamondCasino">
                        </a>
                    </div>
                </div>
                <div class="col user">
                    <?php if ($is_logged_in): ?>
                        <div class="userContainer">
                            <img src="Files/Profile.png" alt="">
                            <div class="userData">
                                <p>Hello, <?php echo htmlspecialchars($username); ?>!</p>
                                <p><?php echo htmlspecialchars($useremail); ?></p>
                                <p id="balance">Balance: <?php echo htmlspecialchars($userbalance); ?> $</p>
                                <p class="item"><a href="../Login/logout.php">Log Out</a></p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="loginButton"><a href="../Login/login.php">Sign In</a></div>
                        <div class="registerButton"><a href="../Register/register.php">Sign Up</a></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <div class="roulette-table">
        <div class="roulette">
            <h1>Roulette</h1>
            <div class="roulette-container">
                <div class="wrap">
                    <div class="controller"></div>
                </div>
            </div>
        </div>
        
        <script src="../Scripts/rouletteAnimation.js"></script>
        <form id="myForm" method="POST" action="rouletteBackEnd.php"> 
            <button type="button" id="sendButton">SPIN</button>
            <div class="bet-options-container">
                <div class="bet-option">
                    <label for="betAmount">Place your Bet</label><br>
                    <input type="number" name="betAmount">
                </div>
                <div class="bet-option">
                    <label for="betNumber">Choose Number</label><br>
                    <input type="number" min="0" max="36" name="betNumber" step="1">
                </div>
                <div class="bet-option">
                    <label for="betColor">Choose Color</label><br>
                    <div class="color-picker">
                        <input type="radio" id="color-green" name="color-choice" value="green" checked>
                        <label for="color-green" class="color-option">Green</label>

                        <input type="radio" id="color-black" name="color-choice" value="black">
                        <label for="color-black" class="color-option">Black</label>

                        <input type="radio" id="color-red" name="color-choice" value="red">
                        <label for="color-red" class="color-option">Red</label>
                    </div>
                </div>
            </div>
        </form>

        <div id="bets-container"></div>
        
        <script src="../Scripts/rouletteResult.js"></script>
    </div>
    <footer>
        <p>Copyright © 2025 Mateusz Kowalik</p>
    </footer>
</body>
</html>