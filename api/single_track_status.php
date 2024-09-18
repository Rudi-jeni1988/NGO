<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

include "../dbconfig.php";

try {
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);

    // Validate request method
    $RequestMethod = $_SERVER["REQUEST_METHOD"];
    if ($RequestMethod !== "POST") {
        throw new Exception($RequestMethod . ' Method Not Allowed', 405);
    }

    // Validate and extract required parameters
    if (!isset($json_data['tid'])) {
        throw new Exception('Invalid input: Missing required fields (tid)', 400);
    }

    $tid = $json_data['tid'];

    

    // Query for joining trust_proposal and login tables
    $query = "SELECT tp.*, ngo.name AS ngo_name, trust.name AS trust_name FROM trust_proposal tp INNER JOIN login ngo ON tp.ngo_name = ngo.id INNER JOIN login trust ON tp.trust_name = trust.id WHERE tid=$tid; ";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        throw new Exception('Database query failed', 500);
    }

    if (mysqli_num_rows($result) > 0) {
        $records = [];

        // Fetch all records
        while ($record = mysqli_fetch_assoc($result)) {
            $records[] = [
                'trust_proposal_id' => $record['tid'],  // trust_proposal id
                'trust_name' => $record['trust_name'],
                'ngo_name' => $record['ngo_name'],     // from trust_proposal
                'ngo_uin' => $record['ngo_uin'],       // from trust_proposal
                'ngo_status' => $record['ngo_status'],
                'authorized_name' => $record['authorized_name'], // from trust_proposal
                'purpose' => $record['purpose'],       // from trust_proposal
                'amount' => $record['amount'],         // from trust_proposal
                'quarter' => $record['quarter'],       // from trust_proposal
                'budget_proposal' => $record['budget_proposal'], // from trust_proposal
                'outcome' => $record['outcome'],       // from trust_proposal
                'document_name' => $record['document_name'], // from trust_proposal
                'bank_name' => $record['bank_name'],   // from trust_proposal
                'account_no' => $record['account_no'], // from trust_proposal
                'ifsc' => $record['ifsc'],             // from trust_proposal
                'account_type' => $record['account_type'], // from trust_proposal
                'date' => $record['date']       // from trust_proposal
            
            ];
        }

        // Return the data as JSON
        $Data = [
            'status' => 200,
            'message' => 'Success',
            'data' => $records
        ];

        header("HTTP/1.0 200 Success");
        echo json_encode($Data);
    } else {
        // No records found
        $Data = [
            'status' => 404,
            'message' => 'No records found'
        ];
        echo json_encode($Data);
    }

} catch (Exception $e) {
    // Handle exceptions and return error messages
    $status = $e->getCode() ? $e->getCode() : 500;
    $message = $e->getMessage();

    $Data = [
        'status' => $status,
        'message' => $message
    ];
    header("HTTP/1.0 $status " . getStatusCodeMessage($status));
    echo json_encode($Data);
}

// Function to return status code messages
function getStatusCodeMessage($status)
{
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
