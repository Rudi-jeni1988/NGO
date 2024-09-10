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
<div class="login-bg">
    <div class="area">
    <!-- background effect -->
    <ul class="circles">
                <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li> <li></li>        
    </ul>
    <!-- background effect -->

    <div class="signup-form">
        <h3 class="text-center mb-4">Signup</h3>
        <form action="signup-detail.php" method="POST">
        <div class="mb-4">
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
            </div>
            <div class="mb-4">
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address">
            </div>
            
            <div class="mb-4">
                <select id="designation" name="designation" placeholder="Role"  class="form-control">
                    <option value="#" selected=""> Role </option>
                    <option value="Admin">Admin</option>
                    <option value="Ngo">NGO</option>
                    <option value="User">User</option>
                </select>
                <span class="custom-arrow"></span>

            </div>
            <div class="mb-4">
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter the password">
            </div>
            <div class="mb-4">
                <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm your password">
            </div>
           
            <button type="submit" class="btn btn-submit mb-4" name="submit">Signup</button>
            <p>By giving your information, you agree to our <b>Terms & Conditions</b> and <b>Privacy Policy</b>.</p>
        </form>
    </div>
    </div>
</div>



</body>
</html>