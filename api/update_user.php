<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

include "../dbconfig.php"; // Include your database connection

try {
    // Ensure the request method is POST
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception('Invalid Request Method', 405);
    }

    // Determine trust_id from POST or SESSION
    if (isset($_POST['trust_id'])) {
        $trust_id = $_POST['trust_id'];
    } elseif (isset($_SESSION["id"])) {
        $trust_id = $_SESSION["id"];
    } else {
        throw new Exception('Trust ID not provided', 400);
    }

    // Collect input fields
    $trust_name = $_POST['trust_name'] ?? null;
    $trust_uin = $_POST['trust_uin'] ?? null;
    $mob_no = $_POST['mob_no'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $bank_name = $_POST['bank_name'] ?? null;
    $account_no = $_POST['account_no'] ?? null;
    $ifsc = $_POST['ifsc'] ?? null;
    $account_type = $_POST['account_type'] ?? null;

    // Validate required fields
    if (empty($trust_name) || empty($trust_uin) || empty($mob_no) || empty($email) || empty($password)) {
        throw new Exception('Missing required fields', 400);
    }

    // Initialize file variables
    $document_name = null;
    $upload_dir = "../img/";

    // Check if a new image is uploaded
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
    } else {
        // If no new file is uploaded, retain the old document name
        $sql = "SELECT profile_name FROM login WHERE id = ?";
        if (!$stmt = $conn->prepare($sql)) {
            throw new Exception('Failed to prepare query: ' . $conn->error, 500);
        }
        $stmt->bind_param("i", $trust_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $document_name = $row['profile_name']; // Retain previous document name
        } else {
            throw new Exception('Trust ID not found', 404);
        }
    }

    // Prepare the SQL query for update
    $sql = "UPDATE login SET name = ?, uin = ?, mobno = ?, email = ?, password = ?, bank_name = ?, account_no = ?, ifsc = ?, account_type = ?, profile_name = ?, added_date = NOW() WHERE id = ?";
    if (!$stmt = $conn->prepare($sql)) {
        throw new Exception('Failed to prepare update query: ' . $conn->error, 500);
    }

    // Bind parameters
    $stmt->bind_param(
        'ssssssssssi',
        $trust_name, $trust_uin, $mob_no, $email, $password, $bank_name, $account_no, $ifsc, $account_type,
        $document_name, $trust_id
    );

    // Execute the query
    if ($stmt->execute()) {
        $response = [
            'status' => 200,
            'message' => 'Proposal updated successfully',
        ];
        echo json_encode($response);
    } else {
        throw new Exception('Failed to execute update query: ' . $stmt->error, 500);
    }

} catch (Exception $e) {
    // Send error response
    $response = [
        'status' => $e->getCode() ?: 500,
        'message' => $e->getMessage()
    ];
    echo json_encode($response);
}
?>
