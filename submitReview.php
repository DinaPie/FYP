<?php
    include 'db.php';
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted rating and message
        $rating = $_POST['rating'];
        $message = $_POST['message'];
        $username = $_POST['username'];
        $bookingID = $_POST['bookingID'];

        if (empty($rating) || !is_numeric($rating) || $rating < 1 || $rating > 5) {
            // Handle invalid rating
            session_start();
            $_SESSION['alert'] = "Invalid rating";
            header("location: review.php");
            exit();
        }
        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO reviews (username, bookingID, rating, message) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siis", $username, $bookingID, $rating, $message);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Data inserted successfully
            session_start();
            $_SESSION['alert'] = "Review submitted successfully";
            header("location: past_booking.php");
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
        header("Location: review.php");
        exit;
    }
?>
