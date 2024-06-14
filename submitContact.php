<?php
    include 'db.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Data inserted successfully
            session_start();
            $_SESSION['alert'] = "Message sent successfully";
            header("location: contact.php");
            exit();
        } else {
            // Error inserting data
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        // If the form is not submitted, redirect to the form page
        header("Location: contact.php");
        exit;
    }
?>
