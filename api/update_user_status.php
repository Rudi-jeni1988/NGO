<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

include "../dbconfig.php";

try {
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);

    // Validate request method
    $RequestMethod = $_SERVER["REQUEST_METHOD"];
    if ($RequestMethod !== "POST") {
        throw new Exception('Method Not Allowed', 405);
    }

    // Validate and extract required parameters
    if (!isset($json_data['id']) || !isset($json_data['status'])) {
        throw new Exception('Invalid input: Missing required fields (id or status)', 400);
    }

    $user_id = $json_data['id'];
    $status = $json_data['status']; // Should be either "approve" or "reject"

    // Prepare status value based on input
    if ($status === "approve") {
        $new_status = 1; // Example for approved status
    } elseif ($status === "reject") {
        $new_status = 2; // Example for rejected status
    } else {
        throw new Exception('Invalid status value', 400);
    }

    // Update the user status in the database
    $UpdateUserQuery = "UPDATE login SET admin_status = ? WHERE id = ?";
    $stmt = $conn->prepare($UpdateUserQuery);
    $stmt->bind_param("ii", $new_status, $user_id);

    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            $Data = [
                'status' => 200,
                'message' => 'User status updated successfully'
            ];
            echo json_encode($Data);
        } else {
            throw new Exception('User not found or status unchanged', 404);
        }
    } else {
        throw new Exception('Failed to update user status', 500);
    }
} catch (Exception $e) {
    $status = $e->getCode() ? $e->getCode() : 500;
    $message = $e->getMessage();

    $Data = [
        'status' => $status,
        'message' => $message
    ];
    header("HTTP/1.0 $status " . getStatusCodeMessage($status));
    echo json_encode($Data);
}

function getStatusCodeMessage($status) {
    $codes = [
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error'
    ];
    return isset($codes[$status]) ? $codes[$status] : 'Unknown Status';
}
?>
