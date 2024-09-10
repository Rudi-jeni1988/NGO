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
        <form action="login-detail.php" method="POST">
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
</body>
</html>