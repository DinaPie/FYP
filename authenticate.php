<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'db.php';

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM clients WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                // Set a session variable to indicate successful login
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['alert'] = "Login successful!";
                header("location: homepage.php");
                exit();
            } else {
                // Set a session variable to indicate invalid password
                session_start();
                $_SESSION['alert'] = "Invalid password!";
                header("location: index.php");
                exit();
            }
        } else {
            // Set a session variable to indicate username does not exist
            session_start();
            $_SESSION['alert'] = "Username does not exist. Please sign up.";
            header("location: index.php");
            exit();
        }
        mysqli_close($conn);
    }
?>
