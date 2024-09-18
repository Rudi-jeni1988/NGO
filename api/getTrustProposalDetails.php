<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

include "../dbconfig.php";

try {
    $data = file_get_contents('php://input');
    $json_data = json_decode($data, true);

    $RequestMethod = $_SERVER["REQUEST_METHOD"];

    if ($RequestMethod !== "POST") {
        throw new Exception($RequestMethod . ' Method Not Allowed', 405);
    }

    // Get the trust_proposal_id from request
    if (isset($json_data['trust_proposal_id'])) {
        $trust_proposal_id = $json_data['trust_proposal_id'];
    } else {
        throw new Exception('Missing trust_proposal_id in request', 400);
    }

    // Query to fetch details based on the trust_proposal_id
    $query = "SELECT tp.*, ngo.name AS ngo_name, trust.name AS trust_name 
              FROM trust_proposal tp 
              INNER JOIN login ngo ON tp.ngo_name = ngo.id 
              INNER JOIN login trust ON tp.trust_name = trust.id 
              WHERE tp.tid = $trust_proposal_id AND tp.ngo_status = 1";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        throw new Exception('Database query failed', 500);
    }

    if (mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);

        $Data = [
            'status' => 200,
            'message' => 'Success',
            'data' => [
                'trust_proposal_id' => $record['tid'],
                'trust_name' => $record['trust_name'],
                'ngo_name' => $record['ngo_name'],
                'ngo_uin' => $record['ngo_uin'],
                'authorized_representative' => $record['authorized_name'],  // Assuming you have this field
                'contact_information' => $record['ngo_number'],         // Assuming this exists
                'purpose' => $record['purpose'],
                'amount' => $record['amount'],
                'quarter' => $record['quarter'],
                'budget_proposal' => $record['budget_proposal'],                // Assuming you have this field
                'projected_outcomes' => $record['outcome'],          // Assuming you have this field
                'bank_name' => $record['bank_name'],                            // Assuming these fields exist
                'account_number' => $record['account_no'],
                'ifsc_code' => $record['ifsc'],
                'account_type' => $record['account_type']
            ]
        ];

        header("HTTP/1.0 200 Success");
        echo json_encode($Data);
    } else {
        $Data = [
            'status' => 404,
            'message' => 'No records found'
        ];
        echo json_encode($Data);
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
