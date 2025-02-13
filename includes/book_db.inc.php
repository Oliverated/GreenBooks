<?php
require_once "db.inc.php"; // Ensure this file correctly establishes a database connection

$target_dir = "../asset/images/book-imgs/";

// Check if a file was uploaded
if (isset($_FILES["fileToUpload"]) && !empty($_FILES["fileToUpload"]["name"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validate image file
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000000) {
        die("Sorry, your file is too large.");
    }

    // Allow only specific file formats
    $allowed_extensions = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_extensions)) {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // Attempt to move uploaded file
    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        die("Sorry, there was an error uploading your file.");
    } else {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    }

    // Store image name in variable
    $img_name = htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));

} else {
    header("Location: ../admin/book_man.php?msg=No file uploaded"); 
}

$Title = isset($_POST['title']) ? htmlspecialchars(trim($_POST['title'])) : null;
$Author = isset($_POST['author']) ? htmlspecialchars(trim($_POST['author'])) : null;
$Price = isset($_POST['price']) ? htmlspecialchars(trim($_POST['price'])) : null;
// $Stock = isset($_POST['stock']) ? htmlspecialchars(trim($_POST['stock'])) : null;


if (!$Title || !$Author || !$Price) {
    die("Error: All fields are required.");
}
// Prepare and execute SQL statement
$stmt = $conn->prepare("INSERT INTO books (title, author, price, image) VALUES ( ?, ?, ?, ?)");
if ($stmt === false) {
    die("Error in SQL query: " . $conn->error);
} else{

}

$stmt->bind_param("ssss", $Title, $Author, $Price, $img_name);

if ($stmt->execute()) {
    echo "Book added successfully!";
    header("Location: ../admin/book_man.php?smsg=book added successfully"); 
} else {
    header("Location: ../admin/book_man.php?msg=something went wrong"); 
}

$stmt->close();
$conn->close();
?>
