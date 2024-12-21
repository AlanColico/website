<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Handle file upload
    $filePath = null;
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads";
        // Create directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $filePath = $targetDir . basename($_FILES['fileUpload']['name']);
        if (!move_uploaded_file($_FILES['fileUpload']['tmp_name'], $filePath)) {
            die("Error uploading file.");
        }
    }

    // Insert announcement into the database
    $query = "INSERT INTO announcements (title, description, file_path, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $title, $description, $filePath);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: web.php");
            exit;
        } else {
            die("Error inserting announcement: " . mysqli_error($conn));
        }
    } else {
        die("Error preparing statement: " . mysqli_error($conn));
    }
}
?>
