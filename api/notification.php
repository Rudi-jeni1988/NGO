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

        $requiredFields = ['title', 'content', 'userid'];

        $missingFields = [];

        // Check for missing fields
        foreach ($requiredFields as $field) {
            if (!isset($json_data[$field]) || empty($json_data[$field])) {
                $missingFields[] = $field;  // Add the missing field to the array
            }
        }

        // If there are missing fields, throw an exception
        if (!empty($missingFields)) {
            $missingFieldsStr = implode(', ', $missingFields);
            throw new Exception('Missing required field(s): ' . $missingFieldsStr, 400);
        }

        $platform = 'web';

        // using web and api raw json
        $title = isset($json_data['title']) ? addslashes(trim($json_data['title'])) : null;
        $content = isset($json_data['content']) ? addslashes(trim($json_data['content'])) : null;
        $userid = isset($json_data['userid']) ? addslashes(trim($json_data['userid'])) : null;
     
        $InsertUserQuery = "INSERT INTO notification (title, content, addedon, userid) VALUES ('$title', '$content', NOW(), '$userid')";
        if (!mysqli_query($conn, $InsertUserQuery)) {
            throw new Exception('Error registering user: ' . mysqli_error($conn), 500);
        }

        // Success response
        $Data = [
            'status' => 201,
            'message' => 'Notification sent'
        ];
        header("HTTP/1.0 201 Created");
        echo json_encode($Data);
    } catch (Exception $e) {
        // Handle all errors in the catch block
        $Data = [
            'status' => $e->getCode() ?: 500,
            'message' => $e->getMessage()
        ];
        header("HTTP/1.0 " . ($e->getCode() ?: 500) . " Error");
        echo json_encode($Data);
    }
?>