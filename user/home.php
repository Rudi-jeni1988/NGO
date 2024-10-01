<?php
include('../dbconfig.php');
?>
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
    h6.text-light {
      color: #808181 !important;
    }
  </style>
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
              <ul id="ngo-status-list">
                <!-- NGO registration status will be displayed here -->
              </ul>
            </div>

            <div class="row">
              <h3>Fund Release Status</h3>
              <ul id="fund-status-list">
                <!-- Fund registration status will be displayed here -->
              </ul>
            </div>

            <!-- Single Fund Status Model -->
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
                          <th scope="col">Authorized Name</th>
                          <th scope="col">Amount</th>
                          <th scope="col">Date & Time</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <!-- Here the API for Single Track Status will be displayed -->
                          <td>ABC Company</td>
                          <td>Aakash</td>
                          <td>5000.00</td>
                          <td>15/7/2022, 02:55 PM</td>
                          <td class="text-danger">Rejected</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
            </div>
            <!-- End Single Fund Status Model -->

          </div>

          <div class="col-lg-4 ps-4">
            <div class="row">
              <h3>Quick Access</h3>
              <div class="quick-access">
                <h4>Complete your profile</h4>
                <p>You're just a step behind</p>
                <p><a href="" data-bs-toggle="modal" data-bs-target="#addbioinfo">Change profile picture </a> <i class="fa fa-solid fa-plus"></i></p>
                <p><a href="" data-bs-toggle="modal" data-bs-target="#addbioinfo1">Add bio </a> <i class="fa fa-solid fa-plus"></i></p>
                <p class="mb-0"><a href=""><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></p>
              </div>
              <div class="quick-access">
                <h4>Raise a fund</h4>
                <p>Insufficient funds?</p>
                <p><a href="" data-bs-toggle="modal" data-bs-target="#newfundrequest">Create a fund request now</a> <i class="fa fa-solid fa-plus"></i></p>
                <p class="mb-0"><a href=""><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </a></p>
              </div>
              <div class="quick-access">
                <h4>Track request</h4>
                <p><a href="#" id="trackStatus" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Track the status of your request</a> <i class="fa fa-solid fa-spinner"></i></p>

                <p class="mb-0"><a href=""><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a></p>
              </div>
            </div>
          </div>

          <!--All Track List Modal Structure -->
          <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel1">Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <h6 class="text-light">Available Fund</h6>
                        <p><b>10,000.00</b></p>
                      </div>
                      <div class="col-md-6">
                        <h6 class="text-light">Used Fund</h6>
                        <p><b>5,000.00</b></p>
                      </div>
                    </div>
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">NGO</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody id="statusTableBody">
                      <!-- Data from API will be inserted here -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- End Model -->

        </div>

      </div>
    </section>

    <!-- Model to Create new fund registration form  -->
    <div class="modal fade" id="newfundrequest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newfundLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newfundLabel">Create New Fund Request</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="proposalForm" enctype="multipart/form-data">
              <h5>NGO Details</h5>
              <div class="mb-3">
                <label class="form-label">NGO Name</label>
                <select class="form-control" name="ngo_name" id="ngoNameSelect">
                  <option>Select NGO Name</option>
                  <?php
                  // Fetch NGO names from the database
                  $query = "SELECT * FROM login WHERE role='NGO' AND admin_status=1";
                  $result = $conn->query($query);
                  while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label">NGO Registration Number</label>
                <input type="text" name="ngo_uin" class="form-control" placeholder="Unique Identification Number">
              </div>

              <div class="mb-3">
                <label class="form-label">Authorized Representative Name</label>
                <input type="text" name="authorized_name" class="form-control" placeholder="Phone number for correspondence.">
              </div>
              <h5>Trust Details</h5>
              <div class="mb-3">
                <label class="form-label">Purpose of the Trust</label>
                <input type="text" name="purpose" id="purpose" class="form-control" placeholder="Specify the purpose">
              </div>
              <div class="mb-3">
                <label class="form-label">Amount Requested</label>
                <input type="text" name="amount" class="form-control" placeholder="The exact amount of funds being requested.">
              </div>
              <div class="mb-3">
                <label class="form-label">Quarter</label>
                <input type="text" name="quarter" class="form-control" placeholder="Q1, Q2, Q3, Q4">
              </div>
              <div class="mb-3">
                <label class="form-label">Contact Information</label>
                <input type="text" name="ngo_number" class="form-control" placeholder="Conatct Number of the person authorized">
              </div>
              <h5>Budget Proposal</h5>
              <div class="mb-3">
                <label class="form-label">Detailed Budget Breakdown</label>
                <textarea name="budget_proposal" id="" class="form-control"></textarea>
              </div>
              <div class="mb-3">
                <label class="form-label">Projected Outcomes</label>
                <input type="text" name="outcome" class="form-control" placeholder="Expected outcome">
              </div>
              <h5>Documents</h5>
              <div class="mb-3">
                <label class="form-label">Proposal Document</label>
                <input type="file" name="document_name" class="form-control" placeholder="Expected outcome">
              </div>
              <h5>Bank details confirmation</h5>
              <div class="mb-3">
                <label class="form-label">Bank Name and Branch</label>
                <input type="text" name="bank_name" class="form-control" placeholder="">
              </div>
              <div class="mb-3">
                <label class="form-label">Account Number</label>
                <input type="text" name="account_no" class="form-control" placeholder="">
              </div>
              <div class="mb-3">
                <label class="form-label">IFSC Number</label>
                <input type="text" name="ifsc" class="form-control" placeholder="">
              </div>
              <div class="mb-3">
                <label class="form-label">Account Type</label>
                <input type="text" name="account_type" class="form-control" placeholder="">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Model -->

    <!-- Model to ADD Image Info  -->
    <div class="modal fade" id="addbioinfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addbioinfoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addbioinfoLabel">Add Trust Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addimgForm" enctype="multipart/form-data">
              <h5>Upload Image</h5>

              <div class="mb-3">
                <!-- <label class="form-label">Trust Image</label> -->
                <input type="file" name="image_name" class="form-control" placeholder="Expected outcome">
              </div>

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Model -->

    <!-- Model to ADD/Update BIO Info  -->
    <div class="modal fade" id="addbioinfo1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addbioinfo1Label" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addbioinfo1Label">Add/Update Trust Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addbioForm" enctype="multipart/form-data">
              <h5>Trust Details</h5>
              <?php
              // Fetch Trust Details from the database
              $user_id = $_SESSION["id"];
              $query = "SELECT * FROM login WHERE id=$user_id";
              $result = $conn->query($query);
              while ($row = $result->fetch_assoc()) {
                $trust_name = $row['name'];
                $uin = $row['uin'];
                $mob_no = $row['mobno'];
                $email = $row['email'];
                $password = $row['password'];
              }
              ?>

              <div class="mb-3">
                <label class="form-label">Trust Name</label>
                <input type="text" name="trust_name" value="<?php echo $trust_name; ?>" class="form-control" placeholder="Trust Name">
              </div>

              <div class="mb-3">
                <label class="form-label">Unique Identity Number</label>
                <input type="text" name="trust_uin" class="form-control" value="<?php echo $uin; ?>" placeholder="Unique Identification Number">
              </div>

              <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" name="mob_no" value="<?php echo $mob_no; ?>" class="form-control" placeholder="Moile Number">
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email Address">
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="text" name="password" value="<?php echo $password; ?>" class="form-control" placeholder="Password">
              </div>
              <h5>Trust Image</h5>
              <div class="mb-3">
                <label class="form-label">Add Image</label>
                <input type="file" name="image_name" class="form-control" placeholder="Expected outcome">
              </div>
              <h5>Bank details confirmation</h5>
              <div class="mb-3">
                <label class="form-label">Bank Name and Branch</label>
                <input type="text" name="bank_name" class="form-control" placeholder="">
              </div>
              <div class="mb-3">
                <label class="form-label">Account Number</label>
                <input type="text" name="account_no" class="form-control" placeholder="">
              </div>
              <div class="mb-3">
                <label class="form-label">IFSC Number</label>
                <input type="text" name="ifsc" class="form-control" placeholder="">
              </div>
              <div class="mb-3">
                <label class="form-label">Account Type</label>
                <input type="text" name="account_type" class="form-control" placeholder="">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End Model -->

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

  <!-- User submit new Proposal Insert Query -->
  <script>
    $(document).ready(function() {
      $('#proposalForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        // Prepare data for the notification
        let NotiData = {
          trust_name: "<?= $_SESSION['name'] ?>",
          user_id: $('#ngoNameSelect').val().trim(), 
          purpose: $('#purpose').val().trim(), 
        };

        // Collect form data (including the file)
        var formData = new FormData(this);

        // Submit the proposal form using AJAX
        $.ajax({
          url: '../api/submit_proposal.php', // API endpoint for form submission
          method: 'POST',
          data: formData,
          contentType: false, // Required for file uploads
          processData: false, // Required for file uploads
          success: function(response) {
            // Check if the API responded with success
            if (response.status === 200) {
              alert(response.message); // Notify user of success

              // Send notification only after the form is successfully submitted
              sendNotification(NotiData);

              // Optionally reload the page to reset form
              location.reload();
            } else {
              // Handle any errors returned by the API
              alert('Error: ' + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Something went wrong during the proposal submission.');
          }
        });
      });
    });

    // Function to send a notification after successful form submission
    function sendNotification(NotiData) {
      // Prepare notification data for API call
      const notificationData = {
        title: "New Fund Request",
        content: `Trust ${NotiData.trust_name} has requested a new fund for ${NotiData.purpose}.`,
        userid: NotiData.user_id // Assuming UIN is used as user ID
      };

      // Send the notification using AJAX
      $.ajax({
        url: '../api/notification.php', // API endpoint for sending notifications
        method: 'POST',
        data: JSON.stringify(notificationData), // Send data as JSON
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



  <!-- user update profile img submit -->
  <script>
    $(document).ready(function() {
      $('#addimgForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = new FormData(this); // Collect form data, including the file

        $.ajax({
          url: '../api/update_profile_img.php', // API URL
          method: 'POST',
          data: formData,
          contentType: false, // Required for file uploads
          processData: false, // Required for file uploads
          success: function(response) {
            console.log(response);
            if (response.status === 200) {
              alert(response.message);
              location.reload();
            } else {
              alert('Error: ' + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Something went wrong.');
          }
        });
      });
    });
  </script>

  <!-- user submit there BIO Info -->
  <script>
    $(document).ready(function() {
      $('#addbioForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var formData = new FormData(this); // Collect form data, including the file

        $.ajax({
          url: '../api/update_user.php', // API URL
          method: 'POST',
          data: formData,
          contentType: false, // Required for file uploads
          processData: false, // Required for file uploads
          success: function(response) {
            console.log(response);
            if (response.status === 200) {
              alert(response.message);
              location.reload();
            } else {
              alert('Error: ' + response.message);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Something went wrong.');
          }
        });
      });
    });
  </script>

  <!-- Home screen NGO status Select Query -->
  <script>
    $(document).ready(function() {
      $.ajax({
        url: '../api/ngo_status.php', // API endpoint
        type: 'POST',
        contentType: 'application/json',
        success: function(response) {
          if (response.status === 200) {
            let ngoList = '';

            // Iterate through the list of NGOs
            response.data.forEach(function(ngo) {
              let statusText = '';
              let statusClass = '';

              // Determine the status text and color based on `admin_status`
              switch (ngo.admin_status) {
                case '0':
                  statusText = 'Pending';
                  statusClass = 'text-warning';
                  break;
                case '1':
                  statusText = 'Approved';
                  statusClass = 'text-success';
                  break;
                case '2':
                  statusText = 'Rejected';
                  statusClass = 'text-danger';
                  break;
                default:
                  statusText = 'Unknown';
                  statusClass = 'text-muted';
              }

              // Build the list item for each NGO
              ngoList += `<li>${ngo.organization_name} <span class="${statusClass}">${statusText}</span></li>`;
            });

            // Append the NGO list to the HTML
            $('#ngo-status-list').html(ngoList);
          } else {
            // Handle the case when no records are found
            $('#ngo-status-list').html('<li>No NGO records found.</li>');
          }
        },
        error: function(xhr, status, error) {
          // Handle any errors that occur during the request
          console.error('Error:', error);
          $('#ngo-status-list').html('<li>There was an error fetching the NGO status. Please try again later.</li>');
        }
      });
    });
  </script>

  <!-- Home screen Trust Proposal status Select Query -->
  <script>
    $(document).ready(function() {
      // This will load fund statuses when the page is ready
      $.ajax({
        url: '../api/trust_proposal_status.php', // API endpoint
        type: 'POST',
        contentType: 'application/json',
        success: function(response) {
          if (response.status === 200) {
            let statusList = '';

            // Iterate through the list of fund status entries
            response.data.forEach(function(status) {
              let statusText = '';
              let statusClass = '';

              // Determine the status text and color based on `ngo_status`
              switch (status.ngo_status) {
                case '0': // Pending
                  statusText = 'Pending';
                  statusClass = 'text-warning';
                  break;
                case '1': // Approved
                  statusText = 'Accepted';
                  statusClass = 'text-success';
                  break;
                case '2': // Rejected
                  statusText = 'Rejected';
                  statusClass = 'text-danger';
                  break;
                default:
                  statusText = 'Unknown';
                  statusClass = 'text-muted';
              }

              // Build the list item for each status, and include the tid in the anchor tag's data attribute
              statusList += `
              <li>
                ${status.purpose} 
                <span>
                  <a href="#" class="${statusClass}" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-tid="${status.trust_proposal_id}">${statusText}</a>
                </span>
              </li>`;
            });

            // Append the status list to the HTML
            $('#fund-status-list').html(statusList);

            // Attach event handler to open the modal and fetch data for the selected tid
            $('#fund-status-list').on('click', 'a', function(event) {
              event.preventDefault(); // Prevent default link behavior
              let tid = $(this).data('tid'); // Get the tid from the data attribute

              // Call the function to load the modal content with the specific tid
              loadTrackStatusModal(tid);
            });

          } else {
            // Handle the case when no records are found
            $('#fund-status-list').html('<li>No fund status records found.</li>');
          }
        },
        error: function(xhr, status, error) {
          // Handle any errors that occur during the request
          console.error('Error:', error);
          $('#fund-status-list').html('<li>There was an error fetching the fund status. Please try again later.</li>');
        }
      });

      // Function to load modal content based on the selected tid
      function loadTrackStatusModal(tid) {
        $.ajax({
          url: '../api/single_track_status.php', // API endpoint for detailed status
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            tid: tid
          }), // Send the tid as part of the request body
          success: function(response) {
            if (response.status === 200) {
              let tableBody = '';

              // Iterate through each item in the response data
              response.data.forEach(function(trackStatus) {
                let statusClass = '';

                // Set status class based on trackStatus
                switch (trackStatus.ngo_status) {
                  case '0': // Pending
                    statusClass = 'text-warning';
                    statusname = 'Pending';
                    break;
                  case '1': // Approved
                    statusClass = 'text-success';
                    statusname = 'Approved';
                    break;
                  case '2': // Rejected
                    statusClass = 'text-danger';
                    statusname = 'Rejected';
                    break;
                  default:
                    statusClass = 'text-muted';
                    statusname = 'Undefined';
                }

                // Format date and time
                let dateTime = new Date(trackStatus.date).toLocaleString();

                // Append rows with the fetched data
                tableBody += `
                <tr>
                  <td>${trackStatus.ngo_name}</td>
                  <td>${trackStatus.authorized_name}
                  <td>${trackStatus.amount}</td>
                  <td>${dateTime}</td>
                  <td class="${statusClass}">${statusname}</td>
                </tr>`;
              });

              // Insert the generated table rows into the modal's table body
              $('.modal-body tbody').html(tableBody);
            } else {
              $('.modal-body tbody').html('<tr><td colspan="4">No records found.</td></tr>');
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
            $('.modal-body tbody').html('<tr><td colspan="4">There was an error fetching the data. Please try again later.</td></tr>');
          }
        });
      }

    });
  </script>

  <!-- All Status Track Select Query -->
  <script>
    // When the "Track the status of your request" link is clicked
    $('#trackStatus').on('click', function() {
      // Make an AJAX request to fetch the trust proposal status
      $.ajax({
        url: '../api/trust_proposal_status.php', // Replace with the correct API endpoint
        type: 'POST', // Assuming you're using POST method
        contentType: 'application/json',
        success: function(response) {
          if (response.status === 200) {
            let tableBody = '';

            // Loop through the API response data
            response.data.forEach(function(item) {
              let statusClass = '';

              // Apply different classes for status
              switch (item.ngo_status) {
                case '0': // Pending
                  statusClass = 'text-warning';
                  statusname = 'Pending';
                  break;
                case '1': // Approved
                  statusClass = 'text-success';
                  statusname = 'Approved';
                  break;
                case '2': // Rejected
                  statusClass = 'text-danger';
                  statusname = 'Rejected';
                  break;
                default:
                  statusClass = 'text-muted';
                  statusname = 'Unknown';
              }

              // Format date and time
              let dateTime = new Date(item.date).toLocaleString();

              // Append the rows dynamically
              tableBody += `
                        <tr>
                            <td>${item.ngo_name}</td>
                            <td>${item.amount}</td>
                            <td>${dateTime}</td>
                            <td class="${statusClass}">${statusname}</td>
                        </tr>`;
            });

            // Insert the rows into the table body inside the modal
            $('#statusTableBody').html(tableBody);
          } else {
            $('#statusTableBody').html('<tr><td colspan="4">No records found.</td></tr>');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          $('#statusTableBody').html('<tr><td colspan="4">There was an error fetching the data.</td></tr>');
        }
      });
    });
  </script>




</body>

</html>