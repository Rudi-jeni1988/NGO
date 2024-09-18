<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Database connection
include "../dbconfig.php";

try {
    // Check if file is uploaded
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('File upload error.');
    }


    // For mobile
    if (isset($_POST['trust_id'])) {
        $trust_id = $_POST['trust_id'];
    }
    // For web
    elseif (isset($_SESSION["id"])) {
        $trust_id = $_SESSION["id"];
    }

    // Ensure the trust_id is provided
    if (empty($trust_id)) {
        throw new Exception('Trust ID is required.');
    }

    // File properties
    $file = $_FILES['file'];
    $file_name = basename($file['name']);
    $file_tmp = $file['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf']; // Define allowed file types

    // Check if the file type is allowed
    if (!in_array($file_ext, $allowed_ext)) {
        throw new Exception('Invalid file type. Only JPG, PNG, and PDF allowed.');
    }

    // Define the upload directory and file path
    $upload_dir = "../progressdoc/";
    $new_file_name = uniqid() . "." . $file_ext; // Generate a unique name for the file
    $file_path = $upload_dir . $new_file_name;

    // Move the file to the target directory
    if (!move_uploaded_file($file_tmp, $file_path)) {
        throw new Exception('Failed to move uploaded file.');
    }

    // Prepare SQL query to insert the file info into the database
    $stmt = $conn->prepare("INSERT INTO progress_documents (trust_id, file_name, date_added) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $trust_id, $new_file_name);

    // Execute the query
    if (!$stmt->execute()) {
        throw new Exception('Failed to save file info in the database.');
    }

    // Return success response
    $response = ['status' => true, 'msg' => 'File uploaded and saved successfully.'];
    echo json_encode($response);

} catch (Exception $e) {
    // Return error response
    $response = ['status' => false, 'msg' => $e->getMessage()];
    echo json_encode($response);
}

// Close the connection
$conn->close();
?>
