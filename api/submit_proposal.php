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

    // For mobile
    if (isset($json_data['trust_id'])) {
        $trust_name = $json_data['trust_id'];
    }
    // For web
    elseif (isset($_SESSION["id"])) {
        $trust_name = $_SESSION["id"];
    }
    
    $ngo_name = isset($_POST['ngo_name']) ? $_POST['ngo_name'] : null;
    $ngo_uin = isset($_POST['ngo_uin']) ? $_POST['ngo_uin'] : null;
    $authorized_name = isset($_POST['authorized_name']) ? $_POST['authorized_name'] : null;
    $ngo_number = isset($_POST['ngo_number']) ? $_POST['ngo_number'] : null;
    $purpose = isset($_POST['purpose']) ? $_POST['purpose'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $quarter = isset($_POST['quarter']) ? $_POST['quarter'] : null;
    $budget_proposal = isset($_POST['budget_proposal']) ? $_POST['budget_proposal'] : null;
    $outcome = isset($_POST['outcome']) ? $_POST['outcome'] : null;
    $bank_name = isset($_POST['bank_name']) ? $_POST['bank_name'] : null;
    $account_no = isset($_POST['account_no']) ? $_POST['account_no'] : null;
    $ifsc = isset($_POST['ifsc']) ? $_POST['ifsc'] : null;
    $account_type = isset($_POST['account_type']) ? $_POST['account_type'] : null;
    $ngo_status = "0"; // Default status for newly submitted proposals

    // Validate required fields
    if (empty($ngo_name) || empty($ngo_uin) || empty($authorized_name) || empty($ngo_number) || empty($purpose) || empty($amount)) {
        throw new Exception('Missing required fields', 400);
    }

    // Handle file upload
    $document_name = null;
    $upload_dir = "../proposal/";
    if (isset($_FILES['document_name']) && $_FILES['document_name']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES['document_name']['tmp_name'];
        $file_name = $_FILES['document_name']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Validate file type
        $allowed_extensions = ['pdf', 'jpg', 'png', 'jpeg'];
        if (!in_array($file_ext, $allowed_extensions)) {
            throw new Exception('Invalid file type. Only PDF, JPG, PNG are allowed.', 400);
        }

        // Save file in the proposal directory
        $new_file_name = uniqid() . "." . $file_ext;
        $dest_path = $upload_dir . $new_file_name;
        if (!move_uploaded_file($file_tmp_path, $dest_path)) {
            throw new Exception('File upload failed', 500);
        }

        // Set document name for DB
        $document_name = $new_file_name;
    }

    // Prepare the SQL query
    $sql = "INSERT INTO trust_proposal (trust_name, ngo_name, ngo_uin, authorized_name, ngo_number, purpose, amount, quarter, budget_proposal, outcome, document_name, bank_name, account_no, ifsc, account_type, ngo_status, date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        'ssssssssssssssss', $trust_name, $ngo_name, $ngo_uin, $authorized_name, $ngo_number, $purpose, $amount, $quarter, $budget_proposal, $outcome,
        $document_name, $bank_name, $account_no, $ifsc, $account_type, $ngo_status
    );

    // Execute the query
    if ($stmt->execute()) {
        $response = [
            'status' => 200,
            'message' => 'Proposal submitted successfully',
        ];
        echo json_encode($response);
    } else {
        throw new Exception('Database query failed', 500);
    }

} catch (Exception $e) {
    $status = $e->getCode() ? $e->getCode() : 500;
    $message = $e->getMessage();

    $response = [
        'status' => $status,
        'message' => $message
    ];
    echo json_encode($response);
}
?>
