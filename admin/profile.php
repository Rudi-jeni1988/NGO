<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NexFund</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <link href="../css/font-awesome.css" rel="stylesheet" type="text/css" />
  <link href="../css/main.css" rel="stylesheet">

</head>

<body class="fund-page">

  <?php include('header.php'); ?>

  <main class="main">

    <section class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="profile-card">
        <div class="avatar">
          <img src="../img/profile.png" id="profile-img" alt="Profile Picture" width="100">
        </div>
        <div class="info ms-3">
          <p><i class="fa fa-user" aria-hidden="true"></i>
            <span><strong class="w-100 d-block mb-2">Name:</strong> <span id="profile-name"></span></span>
          </p>

          <p><i class="fa fa-building" aria-hidden="true"></i>
            <span><strong class="w-100 d-block mb-2">UIN Number:</strong> <span id="profile-uin"></span></span>
          </p>

          <p><i class="fa fa-phone" aria-hidden="true"></i>
            <span><strong class="w-100 d-block mb-2">Phone no.:</strong> <span id="profile-phone"></span></span>
          </p>

          <p><i class="fa fa-envelope" aria-hidden="true"></i>
            <span><strong class="w-100 d-block mb-2">E-Mail:</strong> <span id="profile-email"></span></span>
          </p>
        </div>
      </div>
    </section>

  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container copyright text-center mt-4">
      <p>&copy; <span>Copyright</span> <strong class="px-1 sitename">NexFund</strong><span>All Rights Reserved</span></p>
    </div>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>

  <script>
    fetch('../api/user_profile.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 200 && data.data.length > 0) {
          const user = data.data[0];
          document.getElementById('profile-name').innerText = user.organization_name;
          document.getElementById('profile-uin').innerText = user.uin;
          document.getElementById('profile-phone').innerText = user.mobno; // Assuming 'uin' is the phone number
          document.getElementById('profile-email').innerText = user.user_email;
          let imgPath = '../img/' + user.pro_img; // Prepend the path
          document.getElementById('profile-img').src = imgPath;
        } else {
          alert("User profile not found.");
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
  </script>

</body>

</html>