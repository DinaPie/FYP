<?php
    include 'db.php';

    // Define the base URL
    $baseUrl = "http://localhost/fyp/package_details.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Start session
        session_start();

        // Sanitize user input
        $username = $_POST['username'];
        $packageID = $_POST['packageID'];
        $action = $_POST['action'];

        // Check if username exists in the clients table
        $stmt = $conn->prepare("SELECT COUNT(*) FROM clients WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_exists);
        $stmt->fetch();
        $stmt->close();

        if ($user_exists > 0) {
            if ($action === 'add' || $action === 'remove') {
                // Prepare and execute query
                $stmt = null;
                if ($action === 'add') {
                    $stmt = $conn->prepare("INSERT INTO wishlists (packageID, username) VALUES (?, ?)");
                } elseif ($action === 'remove') {
                    $stmt = $conn->prepare("DELETE FROM wishlists WHERE packageID = ? AND username = ?");
                }
                
                $stmt->bind_param("ss", $packageID, $username);
                if ($stmt->execute()) {
                    // Set success message
                    $_SESSION['alert'] = ($action === 'add') ? "Added to wishlist." : "Removed from wishlist.";
                } else {
                    // Set error message
                    error_log("Error executing query: " . $stmt->error);
                    $_SESSION['alert'] = "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                // Invalid action
                error_log("Invalid action: $action");
                $_SESSION['alert'] = "Invalid action.";
            }
        } else {
            // Username does not exist
            error_log("Username does not exist: $username");
            $_SESSION['alert'] = "Invalid username.";
        }

        // Redirect to the package details page
        $fullUrl = $baseUrl . "?packageID=" . urlencode($packageID);
        header("Location: " . $fullUrl);
        exit();
    } else {
        // Invalid request method
        error_log("Invalid request method.");
        $_SESSION['alert'] = "Invalid request method.";
        header("Location: " . $baseUrl); // Redirect to appropriate page
        exit();
    }
?>
