<?php
include 'db.php';

if (isset($_GET['username'])) {
    if (isset($_GET['packageID'])) {
        $id = intval($_GET['packageID']);
    
        $sql = "DELETE FROM wishlists WHERE packageID = ? AND username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            session_start();
            $_SESSION['alert'] = "Package remove successfully!";
            header("location: wishlist.php");
            exit();
        } else {
            echo "Error deleting package: " . $conn->error;
        }
    
        $stmt->close();
    } else {
        echo "No ID provided";
    }
} else {
    echo "No username provided";
}

$conn->close();
?>
