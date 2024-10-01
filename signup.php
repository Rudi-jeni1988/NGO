<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexFund</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="login-bg">
        <div class="area">
            <!-- background effect -->
            <ul class="circles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <!-- background effect -->

            <div class="signup-form">
                <h3 class="text-center mb-4">Signup</h3>
                <form id="signupForm" method="POST">

                    <div class="mb-4">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-4">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address">
                    </div>

                    <div class="mb-4">
                        <select id="role" name="role" placeholder="Role" class="form-control">
                            <option value="#" selected=""> Role </option>
                            <!-- <option value="Admin">Admin</option> -->
                            <option value="NGO">NGO</option>
                            <option value="Trust">Trust</option>
                        </select>
                        <span class="custom-arrow"></span>
                    </div>

                    <div class="mb-4">
                        <input type="text" class="form-control" name="uin" id="uin" placeholder="Enter Unique Identification Number (UIN)">
                    </div>

                    <div class="mb-4">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter the password">
                    </div>

                    <div class="mb-4">
                        <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm your password">
                    </div>

                    <button type="submit" class="btn btn-submit mb-4" id="signupBtn">Signup</button>
                    <p>By giving your information, you agree to our <b>Terms & Conditions</b> and <b>Privacy Policy</b>.</p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $('#signupForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            let formData = {
                name: $('#name').val().trim(),
                uin: $('#uin').val().trim(),
                email: $('#email').val().trim(),
                role: $('#role').val().trim(),
                password: $('#password').val().trim(),
                cpassword: $('#cpassword').val().trim()
            };

            // Frontend validation
            if (formData.name === "" || formData.uin === "" || formData.email === "" || formData.role === "#" || formData.password === "" || formData.cpassword === "") {
                alert('All fields are required!');
                return;
            }
            

            if (!validateEmail(formData.email)) {
                alert('Please enter a valid email address!');
                return;
            }

            if (formData.password !== formData.cpassword) {
                alert('Passwords do not match!');
                return;
            }

            $.ajax({
                url: 'api/signup.php',
                method: 'POST',
                data: JSON.stringify(formData), // Send data as JSON
                contentType: 'application/json',
                success: function(response) {
                    if (response.status === 201) {
                        alert('Signup successful!');
                        sendNotification(formData); // Call notification function after successful signup
                        window.location.href = "index.php"; // Redirect to login page on success
                    } else {
                        alert('Error: ' + response.message); // Display API-specific error message
                    }
                },
                error: function(xhr, status, error) {
                    try {
                        let response = JSON.parse(xhr.responseText);
                        if (response.message) {
                            alert('Error: ' + response.message);
                        } else {
                            alert('An unexpected error occurred.');
                        }
                    } catch (e) {
                        alert('An error occurred: ' + error);
                    }
                }
            });
        });

        // Email validation function
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Function to send notification after successful signup
        function sendNotification(formData){
            const notificationData = {
                title: "New User Registered",
                content: `New ${formData.role} user named as ${formData.name} has been logged in with UIN Number: ${formData.uin}`,
                userid: 11
                // userid: formData.uin // Assuming UIN is used as user ID
            };

            $.ajax({
                url: 'api/notification.php',
                method: 'POST',
                data: JSON.stringify(notificationData), // Send notification data as JSON
                contentType: 'application/json',
                success: function(response) {
                    if (response.status === 201) {
                        console.log('Notification sent successfully!');
                    } else {
                        console.log('Notification failed: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    try {
                        let response = JSON.parse(xhr.responseText);
                        if (response.message) {
                            console.log('Error: ' + response.message);
                        } else {
                            console.log('An unexpected error occurred.');
                        }
                    } catch (e) {
                        console.log('An error occurred: ' + error);
                    }
                }
            });
        }

    </script>




</body>

</html>