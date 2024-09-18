<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexFund</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="page-loader">
	<div class="spinner">NexFund</div>
	<div class="txt">Efficient Fund Management for NGOs.</div>
</div>

<div class="login-bg">
    <div class="area" >
        <!-- background effect -->
        <ul class="circles">
                <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li>        
        </ul>
        <!-- background effect -->

        <div class="login-form">
        <h3 class="text-center mb-4">Login</h3>
        <form id="loginForm" method="POST">
            <div class="mb-4">
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address">
            </div>
            <div class="mb-4">
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
            </div>
            <div class="mb-3">Dont have an account? <a href="signup.php">Signup</a></label>
            </div>
           
            <button type="submit" class="btn btn-submit mb-4" name="submit">Login</button>
            <p>By giving your information, you agree to our <b>Terms & Conditions</b> and <b>Privacy Policy</b>.</p>
        </form>
    </div>
    </div>

   
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
    $(window).on('load',function(){
	setTimeout(function(){ // allowing 3 secs to fade out loader
	$('.page-loader').fadeOut('slow');
	},1000);
});
</script>  

<script>
    $('#loginForm').on('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way

        let formData = {
            email: $('#email').val().trim(),
            password: $('#password').val().trim()
        };

        // Basic frontend validation
        if (formData.email === "") {
            alert("Please enter your email address");
            return;
        }
        if (formData.password === "") {
            alert("Please enter your password");
            return;
        }

        // Send the login request via AJAX
        $.ajax({
            url: 'api/login.php', // Your API endpoint
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function (response) {
                if (response.status === 200) {
                    // Login successful, check the user type for redirection
                    alert('Login successful! Welcome, ' + response.user_name);

                    // Redirect based on user type
                    switch (response.user_type) {
                        case 'Admin':
                            window.location.href = "admin/home.php"; // Admin dashboard
                            break;
                        case 'Trust':
                            window.location.href = "user/home.php"; // Trust dashboard
                            break;
                        case 'NGO':
                            window.location.href = "ngo/home.php"; // NGO dashboard
                            break;
                        default:
                            alert('Unknown user type. Please contact support.');
                    }
                } else if (response.status === 401) {
                    // Invalid email or password
                    alert('UnAuthorized ' + response.message);
                } else {
                    // Any other error message
                    alert('Error: ' + response.message);
                }
            },
            error: function (xhr, status, error) {
                // If there's a server-side error or network issue
                alert('An error occurred: ' + error);
            }
        });
    });
</script>

</body>
</html>