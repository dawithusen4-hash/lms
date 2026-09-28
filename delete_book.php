<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize input

    // Delete book
    $delete = mysqli_query($conn, "DELETE FROM books WHERE book_id = $id");

    if ($delete) {
        // Redirect with success message
        header("Location: manage_book.php?deleted=1");
        exit();
    } else {
        echo "Error deleting book: " . mysqli_error($conn);
    }
} else {
    // Redirect if no id
    header("Location: manage_book.php");
    exit();
}
?>
