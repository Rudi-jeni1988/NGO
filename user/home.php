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
</head>

<body class="index-page">

 <?php include('header.php'); ?>

  <main class="main">

    <section class="hero section">
      
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1>Welcome to <span>NexFund</span></h1>
          <p>NGO Registration and Quarterly Fund Release Management<br></p>
          
        </div>
      </div>

    </section>


    <section class="about section">

      <div class="container">

        <div class="row">

          <div class="col-lg-8 content">
                <div class="row">
                    <h3>Registration Status</h3>
                    <ul>
                        <li>First NGO’s Registration <span class="text-danger">Rejected</span></li>
                        <li>Second NGO’s Registration <span class="text-warning">Pending</span></li>
                        <li>Third NGO’s Registration <span class="text-success">Approved</span></li>
                    </ul>
                </div>
                <div class="row">
                    <h3>Fund Release Status</h3>
                    <ul>
                        <li>Child Welfare Fund <span><a href="" class="text-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Rejected</a></span></li>
                        <li>Women Welfare Fund <span><a href="" class="text-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Pending</a></span></li>
                        <li>Prevention Fund <span><a href="" class="text-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Approved</a></span></li>
                    </ul>
                </div>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">NGO Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-danger">Rejected</td>
                              </tr>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-warning">Pending</td>
                              </tr>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-success">Approved</td>
                              </tr>
                            </tbody>
                        </table>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable  modal-xl">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">NGO Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-danger">Rejected</td>
                              </tr>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-warning">Pending</td>
                              </tr>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-success">Approved</td>
                              </tr>
                            </tbody>
                        </table>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">NGO Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-danger">Rejected</td>
                              </tr>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-warning">Pending</td>
                              </tr>
                              <tr>
                                <td>ABC Company</td>
                                <td>5000.00</td>
                                <td>15/7/2022, 02:55 PM</td>
                                <td class="text-success">Approved</td>
                              </tr>
                            </tbody>
                        </table>
                      </div>
                      
                    </div>
                  </div>
                </div>
                
          </div>

          <div class="col-lg-4 ps-4">
                <div class="row">
                    <h3>Quick Access</h3>
                    <div class="quick-access">
                        <h4>Complete your profile</h4>
                        <p>You're just a step behind</p>
                        <p><a href="">Add a profile picture</a></p>
                        <p><a href="">Add bio</a></p>
                        <p class="mb-0"><a href=""><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></p>
                    </div>
                    <div class="quick-access">
                        <h4>Raise a fund</h4>
                        <p><a href="">Insufficient funds?</a></p>
                        <p><a href="">Create a fund request now</a></p>
                        <p class="mb-0"><a href=""><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a></p>
                    </div>
                    <div class="quick-access">
                        <h4>Track request</h4>
                        <p><a href="">Track the status of your request</a></p>
                        <p><a href="">Create a new re-request</a></p>
                        <p class="mb-0"><a href=""><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></p>
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