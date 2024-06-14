<?php
    include 'db.php';
    session_start();

    if (!isset($_SESSION['bookingID'])) {
        // Redirect to an error page or handle the situation appropriately
        header("Location: error.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $conn->real_escape_string($_POST['fullName']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $ic = $conn->real_escape_string($_POST['ic']);
        $passport = $conn->real_escape_string($_POST['passport']);
        $address = $conn->real_escape_string($_POST['address']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $bookingID = $_SESSION['bookingID'];
        
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO participants (bookingID, fullName, gender, ic, passport, address, email, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $bookingID, $fullName, $gender, $ic, $passport, $address, $email, $phone);
        
        if ($stmt->execute()) {
            $_SESSION['alert'] = "Participant added successfully!";
            header("Location: payment.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Close connection
    $conn->close();
?>
