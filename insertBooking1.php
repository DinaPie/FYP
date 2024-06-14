<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include 'db.php'; // Ensure this file sets up $conn correctly

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Convert the values to appropriate types
        $adult = (int) $_POST['adult'];
        $child = (int) $_POST['child'];
        $infant = (int) $_POST['infant'];
        $price = (double) $_POST['price'];
        $duration = (int) $_POST['duration'];
        $username = $_POST['username'];
        $startDateInput = $_POST['startDate'];
        $package = $_POST['packageID'];

        // Calculate the total quantity
        $quantity = $adult + $child + $infant;
        $totPrice = $quantity * $price;
        $duration -= 1;

        // Get the current date
        $bookingDate = date('Y-m-d');

        // Calculate end date
        $startDate = new DateTime($startDateInput);
        $startDateFormatted = $startDate->format('Y-m-d'); // Get formatted start date
        $startDate->modify('+' . $duration . ' days');
        $endDate = $startDate->format('Y-m-d');

        // Prepare and execute the query using prepared statements
        $query = "INSERT INTO booking (quantity, startDate, endDate, username, totPrice, package, bookingDate) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($conn, $query);
        if ($statement) {
            // Bind parameters: quantity (int), startDate (string), endDate (string), username (string), totPrice (double)
            mysqli_stmt_bind_param($statement, 'issssds', $quantity, $startDateFormatted, $endDate, $username, $totPrice, $package, $bookingDate);
            $result = mysqli_stmt_execute($statement);

            if ($result) {
                $bookingID = mysqli_insert_id($conn);
                session_start();
                $_SESSION['bookingID'] = $bookingID;
                
                // Redirect to booking2.php with a success flag
                header("Location: booking2.php");
                exit();
            } else {
                echo "Error executing query: " . mysqli_stmt_error($statement);
            }

            // Close the statement
            mysqli_stmt_close($statement);
        } else {
            echo "Error preparing query: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>