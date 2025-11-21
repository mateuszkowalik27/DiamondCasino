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

header('Content-Type: application/json');

$betAmount = $_POST['betAmount'] ?? 0;
$betNumber = $_POST['betNumber'] ?? null;
$betColor = $_POST['color-choice'] ?? 'undefined';

$wheel = [
    0 => "green", 1 => "red", 2 => "black", 3 => "red", 4 => "black", 5 => "red",
    6 => "black", 7 => "red", 8 => "black", 9 => "red", 10 => "black", 11 => "black",
    12 => "red", 13 => "black", 14 => "red", 15 => "black", 16 => "red", 17 => "black",
    18 => "red", 19 => "red", 20 => "black", 21 => "red", 22 => "black", 23 => "red",
    24 => "black", 25 => "red", 26 => "black", 27 => "red", 28 => "black", 29 => "black",
    30 => "red", 31 => "black", 32 => "red", 33 => "black", 34 => "red", 35 => "black",
    36 => "red"
];

$winning_number = random_int(0, 36);
$winning_color = $wheel[$winning_number];


// Bet on Color
if ($is_logged_in && $betColor != 'undefined') {
    if ($winning_color === 'black' || $winning_color === 'red') {
        if ($betColor === $winning_color) {
            $userbalance += $betAmount;
            $querybalance = "UPDATE users SET balance = $userbalance WHERE email = '$useremail'";
            mysqli_query($db, $querybalance);
        } else {
            $userbalance -= $betAmount;
            $querybalance = "UPDATE users SET balance = $userbalance WHERE email = '$useremail'";
            mysqli_query($db, $querybalance);
        }
    }
    elseif ($winning_color === 'green') {
        if ($betColor === $winning_color) {
            $userbalance += $betAmount * 35;
            $querybalance = "UPDATE users SET balance = $userbalance WHERE email = '$useremail'";
            mysqli_query($db, $querybalance);
        } else {
            $userbalance -= $betAmount;
            $querybalance = "UPDATE users SET balance = $userbalance WHERE email = '$useremail'";
            mysqli_query($db, $querybalance);
        }
    }
}
// Bet on Number
elseif ($is_logged_in && $betNumber != null) {
    sleep(10);
    if ($betNumber == $winning_number) {
        $betAmount = $betAmount * 35;
        $userbalance = $userbalance + $betAmount;
        $querybalance = "UPDATE users SET balance = $userbalance WHERE email = '$useremail'";
    } else {
        $userbalance -= $betAmount;
        $querybalance = "UPDATE users SET balance = $userbalance WHERE email = '$useremail'";
    }
}

$result_data = [
    'number' => $winning_number,
    'color'  => $winning_color,
    'balance' => $userbalance
];

echo json_encode($result_data);
?>