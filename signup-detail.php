<?php
include('dbconfig.php');

// Check if the form is submitted
if(isset($_POST['submit'])){
    $username = $_POST['name'];  // Form field 'username' 
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
    // Echo the username to confirm the variable is set
    echo $username;

    // Insert data into the 'register' table (use 'name' instead of 'username')
    $stmt = $conn->prepare("INSERT INTO register (name, email, designation, password,cpassword) VALUES (?, ?, ?, ?,?)");
    $stmt->bind_param("sssss", $username, $email, $designation, $password,$cpassword);
    $stmt->execute();
    
    if($stmt){
        echo "Successfully added";
        header("Location:index.php");
    } else {
        echo "Error occurred: " . $conn->error;
    }
} 
else {
    echo "Form not submitted";
}
?>
