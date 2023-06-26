<?php

session_start(); // Start the session

$admins = array(
    'admin1' => 'admin1p'
);

$users = array(
    'A123' => 'A123p',
    'B123' => 'B123p',
    'C123' => 'C123p',
    'D123' => 'D123p',
    'E123' => 'E123p'
);

function validatePassword($username, $password) {
    global $admins, $users;
    
    if (array_key_exists($username, $admins) && $password === $admins[$username]) {
        return 'admin';
    } elseif (array_key_exists($username, $users) && $password === $users[$username]) {
        return 'user';
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = validatePassword($username, $password);
    
    if ($userType === 'admin') {
        // Set session for admin authentication
        $_SESSION['username'] = $username;
        $_SESSION['userType'] = 'admin';

        // Redirect to index.php
        header('Location: index.php');
        exit();
    } elseif ($userType === 'user') {
        // Set session for user authentication
        $_SESSION['username'] = $username;
        $_SESSION['userType'] = 'user';

        // Redirect to user_index.php
        header('Location: user_index.php');
        exit();
    } else {
        $errorMessage = 'Invalid username or password.';
        header('Location: login.php?error=' . urlencode($errorMessage));
        exit();
    }
}
?>
