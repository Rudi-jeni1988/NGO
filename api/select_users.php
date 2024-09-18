<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

include "../dbconfig.php";

try {
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);

    $RequestMethod = $_SERVER["REQUEST_METHOD"];

    if ($RequestMethod !== "POST") {
        throw new Exception($RequestMethod . ' Method Not Allowed', 405);
    }

    // Query to check all users with admin_status = 0
    $CheckUserQuery = "SELECT * FROM login WHERE admin_status = 0";
    $CheckUserQueryResults = mysqli_query($conn, $CheckUserQuery);

    if (!$CheckUserQueryResults) {
        throw new Exception('Database query failed', 500);
    }

    if (mysqli_num_rows($CheckUserQueryResults) > 0) {
        $records = []; // Array to hold all the results

        // Fetch all rows
        while ($record = mysqli_fetch_assoc($CheckUserQueryResults)) {
            $records[] = [
                'user_id' => $record["id"],
                'organization_name' => $record["name"],
                'user_email' => $record["email"],
                'role' => $record['role'],
                'uin' => $record["uin"],
                'admin_status' => $record['admin_status'],
                'date' => $record["added_date"]
            ];
        }

        // Return all records in the response
        $Data = [
            'status' => 200,
            'message' => 'Success',
            'data' => $records
        ];

        header("HTTP/1.0 200 Success");
        echo json_encode($Data);
    } else {
        // No rows found
        $Data = [
            'status' => 404,
            'message' => 'No records found'
        ];
        echo json_encode($Data);
    }
} catch (Exception $e) {
    $status = $e->getCode() ? $e->getCode() : 500; // Default to 500 if no code is set
    $message = $e->getMessage();

    $Data = [
        'status' => $status,
        'message' => $message
    ];
    header("HTTP/1.0 $status " . getStatusCodeMessage($status));
    echo json_encode($Data);
}

function getStatusCodeMessage($status)
{
    $codes = [
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Invalid Email And Password',
        403 => 'Forbidden: Admin Approval Required',
        405 => 'Method Not Allowed',
        500 => 'Internal Server Error'
    ];
    return isset($codes[$status]) ? $codes[$status] : 'Unknown Status';
}

?>