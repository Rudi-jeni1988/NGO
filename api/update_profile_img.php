<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

include "../dbconfig.php"; // Include your database connection

try {

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception('Invalid Request Method', 405);
    }

    if (isset($_POST['trust_id'])) {
        $trust_id = $_POST['trust_id'];
    } elseif (isset($_SESSION["id"])) {
        $trust_id = $_SESSION["id"];
    } else {
        throw new Exception('Trust ID not provided', 400);
    }


    // Initialize file variables
    $document_name = null;
    $upload_dir = "../img/";

    if (isset($_FILES['image_name']) && $_FILES['image_name']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES['image_name']['tmp_name'];
        $file_name = $_FILES['image_name']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_extensions = ['pdf', 'jpg', 'png', 'jpeg'];
        if (!in_array($file_ext, $allowed_extensions)) {
            throw new Exception('Invalid file type. Only PDF, JPG, PNG are allowed.', 400);
        }

        // Save file in the directory
        $new_file_name = uniqid() . "." . $file_ext;
        $dest_path = $upload_dir . $new_file_name;
        if (!move_uploaded_file($file_tmp_path, $dest_path)) {
            throw new Exception('File upload failed', 500);
        }

        // Set document name for DB
        $document_name = $new_file_name;
    }

    // Validate required fields
    if (empty($trust_id) || empty($file_name)) {
        throw new Exception('Missing required fields', 400);
    }

    $sql = "UPDATE login SET profile_name = ?, added_date = NOW() WHERE id = ?";
    if (!$stmt = $conn->prepare($sql)) {
        throw new Exception('Failed to prepare update query: ' . $conn->error, 500);
    }

    $stmt->bind_param('si', $document_name, $trust_id);

    if ($stmt->execute()) {
        $response = [
            'status' => 200,
            'message' => 'Image updated successfully',
        ];
        echo json_encode($response);
    } else {
        throw new Exception('Failed to execute update query: ' . $stmt->error, 500);
    }
} catch (Exception $e) {

    $response = [
        'status' => $e->getCode() ?: 500,
        'message' => $e->getMessage()
    ];
    echo json_encode($response);
}
