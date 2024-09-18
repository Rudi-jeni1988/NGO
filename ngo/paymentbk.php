<?php

include "../dbconfig.php";

$ngoid = $_SESSION["id"];

// Capture data from POST request
$data = [ 
    'payment_id' => $_POST['razorpay_payment_id'],
    'amount' => $_POST['totalAmount'],
    'tp_id' => $_POST['product_id'],
    'trust_id' => $_POST['trust_id']
];

// Define the SQL query to insert data into the fundtransfer table
$sql = "INSERT INTO fundtransfer (ngo_id, trust_id, tp_id, payment_id, amount) VALUES (?, ?, ?, ?, ?)";

// Prepare the statement
if ($stmt = $conn->prepare($sql)) {
    // Bind the parameters and execute the query
    $stmt->bind_param("sssss", $ngoid, $data['trust_id'], $data['tp_id'], $data['payment_id'], $data['amount']);

    if ($stmt->execute()) {
        // If data insertion is successful, update the trust_proposal table
        $update_sql = "UPDATE trust_proposal SET payment_status = 1 WHERE tid = ?";
        if ($update_stmt = $conn->prepare($update_sql)) {
            // Bind the trust proposal ID
            $update_stmt->bind_param("s", $data['tp_id']);

            // Execute the update query
            if ($update_stmt->execute()) {
                $arr = array('msg' => 'Payment successfully credited and status updated', 'status' => true);
                echo json_encode($arr);
            } else {
                $arr = array('msg' => 'Payment credited but unable to update payment status', 'status' => false);
                echo json_encode($arr);
            }

            // Close the update statement
            $update_stmt->close();
        } else {
            $arr = array('msg' => 'Error preparing statement for payment status update: ' . $conn->error, 'status' => false);
            echo json_encode($arr);
        }
    } else {
        $arr = array('msg' => 'Error: Unable to insert data into the database', 'status' => false);
        echo json_encode($arr);
    }

    // Close the statement
    $stmt->close();
} else {
    // If statement preparation fails, output the error
    $arr = array('msg' => 'Error: ' . $conn->error, 'status' => false);
    echo json_encode($arr);
}

// Close the database connection
$conn->close();
?>
