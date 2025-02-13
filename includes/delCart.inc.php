<?php
require_once "../includes/db.inc.php"; // Include database connection

if (isset($_GET['id'])) {
    // Get the cart ID from the URL and ensure it's an integer
    $cart_id = intval($_GET['id']);

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM cart WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cart_id); 

    if ($stmt->execute()) {
        // Redirect to cart page after deletion
        header("Location: ../users/cart.php");
        exit();
    } else {
        echo "Error deleting book from cart: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid cart ID.";
}
?>
