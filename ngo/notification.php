
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NexFund</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <link href="../css/font-awesome.css" rel="stylesheet" type="text/css" />
  <!-- Main CSS File -->
  <link href="../css/main.css" rel="stylesheet">
  <style>
    .scroll-container {
      height: 100vh;
      overflow: hidden;
      position: relative;
    }

    .scroll-content {
      position: absolute;
      top: 100%;
      animation: scrollUp 10s linear infinite;
      width: 50%;

    }

    @keyframes scrollUp {
      0% {
        top: 100%;
      }

      100% {
        top: -100%;
      }
    }

    .scroll-container:hover .scroll-content {
      animation-play-state: paused;
    }
  </style>
</head>

<body class="fund-page">

  <?php include('header.php'); ?>

  <main class="main">

    <section class="about section">

      <div class="container">

        <div class="row">

          <div class="col-lg-12 content ngo-cont mt-5" style="min-height:100vh;">
            <div class="row">

              <div class="col-lg-12">
                <div class="scroll-container">
                  <div class="scroll-content">
                    <ul>
                      <li>
                        <p><b>New Fund Request</b><span class="float-end">30 mins</span></p>
                        <p>User123 Has Requested Fund Of Rs.10,000.</p>
                      </li>
                      <li>
                        <p><b>New Fund Request</b><span class="float-end">30 mins</span></p>
                        <p>User123 Has Requested Fund Of Rs.10,000.</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

            </div>


            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">First NGO Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <h5>NGO Details</h5>
                      <div class="mb-3">
                        <label class="form-label">NGO Name</label>
                        <input type="text" class="form-control" placeholder="Enter NGO Name">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">NGO Registration Number</label>
                        <input type="text" class="form-control" placeholder="Enter the Legal Registration Number">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Authorized Representative Name</label>
                        <input type="text" class="form-control" placeholder="Phone number for correspondence.">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Contact Information</label>
                        <input type="text" class="form-control" placeholder="Name of the person authorized">
                      </div>
                      <h5>Trust Details</h5>
                      <div class="mb-3">
                        <label class="form-label">Purpose of the Trust</label>
                        <input type="text" class="form-control" placeholder="Specify the purpose">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Amount Requested</label>
                        <input type="text" class="form-control" placeholder="The exact amount of funds being requested.">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Quarter</label>
                        <input type="text" class="form-control" placeholder="Q1, Q2, Q3, Q4">
                      </div>
                      <h5>Budget Proposal</h5>
                      <div class="mb-3">
                        <label class="form-label">Detailed Budget Breakdown</label>
                        <textarea name="" id="" class="form-control"></textarea>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Projected Outcomes</label>
                        <input type="text" class="form-control" placeholder="ecpectd outcome">
                      </div>
                      <h5>Bank details confirmation</h5>
                      <div class="mb-3">
                        <label class="form-label">Bank Name and Branch</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Account Number</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">IFSC Number</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Account Type</label>
                        <input type="text" class="form-control" placeholder="">
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>

                </div>
              </div>
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

</body>


</html>