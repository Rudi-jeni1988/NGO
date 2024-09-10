<?php
session_start();
include('dbconfig.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email']; 
    $password = $_POST['password'];

    // echo $username;

    // Query to check the user credentials
    $sql = "SELECT * FROM register WHERE email = '$email' AND password = '$password'"; 
    // echo $password;
    $result = $conn->query($sql); 

    if($result->num_rows == 1){ 
        // Start a session and store user info
        $_SESSION["loggedin"] = true;
        $userinfo = $result->fetch_assoc(); 
        $_SESSION['userid'] = $userinfo['id']; 
        
        if($userinfo['designation'] == 'Admin') {
            header("Location: ./admin/home.php");
        }
        elseif($userinfo['designation'] == 'Ngo'){
            header("Location: home.php");
        }
        elseif($userinfo['designation'] == 'User'){
            header("Location: home.php");
        } else {
            // Default redirection if designation doesn't match any expected value
            header("Location: index.php");
        }
        exit();  // Important to stop further execution after the redirect
    } else {
        // This block will execute if the credentials are incorrect
        echo "Invalid username or password";
    }
}

$conn->close();
?>
