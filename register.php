<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'db.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username or phone number already exists
    $checkQuery = "SELECT * FROM clients WHERE username = '$username' OR phone = '$phone'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Check which field is causing the conflict
        $row = mysqli_fetch_assoc($checkResult);
        if ($row['username'] === $username) {
            session_start();
            $_SESSION['alert'] = "Username already exists. Please choose another username.";
            header("location: index.php");
            exit();
        } elseif ($row['phone'] === $phone) {
            session_start();
            $_SESSION['alert'] = "The phone number provided is already associated with an account. Please log in.";
            header("location: index.php");
            exit();
        }
    } else {
        // Username and phone do not exist, proceed with the insertion
        $query = "INSERT INTO clients (username, phone, password) VALUES ('$username', '$phone', '$password')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            session_start();
            $_SESSION['alert'] = "Registration successful!";
            // Redirect to index.php with a success flag
            header("Location: index.php?signup=success");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
?>