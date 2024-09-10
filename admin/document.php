<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NexFund</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/font-awesome.css" rel="stylesheet" type="text/css"/>
      <!-- Main CSS File -->
    <link href="../css/main.css" rel="stylesheet">
    <style>
        .about h3 {
            margin-top: 50px;
            margin-bottom: 20px;
        }
        .quick-access h4{
            font-size: 20px;
            font-weight: 600;
        }
    </style>
</head>

<body class="fund-page">

 <?php include('header.php'); ?>

  <main class="main">

    <section class="about section pt-4">

      <div class="container">

        <div class="row">

        <div class="col-lg-12 content admin-cont" style="min-height:100vh;">
          <div class="row">
              <div class="col-lg-12">
                  <h3 class="mt-5">Upload Document</h3>
                  <ul>
                      <li>
                        <p><b>First NGO’s Registration</b> <span class="open-btn float-end"><a href="fund-doc.pdf" class="text-white" target="_blank">View</a></span></p>
                        <p>BC14578963F</p>
                        <p>12 Sept 1996</p>
                        <p>Trust & Foundation</p>
                        <p class="float-end text-end "><a href="" class="btn btn-danger me-2">Reject</a><a href="" class="btn btn-success">Approve</a></p>
                      </li>
                      <li>
                        <p><b>Second NGO’s Registration</b> <span class="open-btn float-end">View</span></p>
                        <p>BC14578963F</p>
                        <p>12 Sept 1996</p>
                        <p>Trust & Foundation</p>
                        <p class="float-end text-end "><a href="" class="btn btn-danger me-2">Reject</a><a href="" class="btn btn-success">Approve</a></p>
                      </li>
                      <li>
                        <p><b>Third NGO’s Registration</b> </p>
                        <p>BC14578963F</p>
                        <p>12 Sept 1996</p>
                        <p>Trust & Foundation</p>
                        <p class="float-end text-end "><a href="" class="btn btn-danger me-2">Reject</a><a href="" class="btn btn-success">Approve</a></p>
                      </li>
                  </ul>
              </div>
             
          </div>
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
  <!-- Main JS File -->
  <script src="../js/main.js"></script>
<script>
    const realFileBtn = document.getElementById("real-file");
    const customBtn = document.getElementById("custom-button");
    const customTxt = document.getElementById("custom-text");

    customBtn.addEventListener("click", function() {
    realFileBtn.click();
    });

    realFileBtn.addEventListener("change", function() {
    if (realFileBtn.value) {
        customTxt.innerHTML = realFileBtn.value.match(
        /[\/\\]([\w\d\s\.\-\(\)]+)$/
        )[1];
    } else {
        customTxt.innerHTML = "No file chosen, yet.";
    }
    });

</script>
</body>

</html>