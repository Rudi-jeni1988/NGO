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
</head>

<body class="fund-page">

  <?php include('header.php'); ?>

  <main class="main">

    <section class="about section">

      <div class="container">

        <div class="row">

          <div class="col-lg-12 content ngo-cont mt-5" style="min-height:100vh;">
            <div class="row">

              <div class="col-lg-6">
                <h3 class="mt-5">Pending Funds</h3>
                <ul class="pending-funds">
                  <!-- AJAX will populate the pending funds list here -->
                </ul>
              </div>


              <div class="col-lg-6">
                <h3 class="mt-5">Rejected Funds</h3>
                <ul class="rejected-funds">
                  <!-- Rejected funds will be populated here via AJAX -->
                </ul>
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

  <!-- Pending Proposal -->
  <script>
    $(document).ready(function() {
      $.ajax({
        url: '../api/ngo_proposal_status.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
          if (response.status === 200) {
            // Clear the existing list
            const pendingFundsContainer = $('.pending-funds');
            pendingFundsContainer.empty();

            // Iterate over the response data
            response.data.forEach(function(item) {
              // Create a new list item with the fetched data
              const listItem = `
                        <li>
                            <p><b>${item.ngo_name}</b> <span class="open-btn float-end"><a href="../proposal/${item.doc_name}" class="text-white" target="_blank">Open</a></span></p>
                            <p>${item.ngo_uin}</p>
                            <p>${new Date(item.date).toLocaleDateString()}</p>
                            <p>${item.trust_name}</p>
                            <p class="float-end text-end">
                                <a href="#" class="btn btn-danger me-2 reject-btn" data-id="${item.trust_proposal_id}" data-trustid="${item.trustId}" data-ngoname="${item.ngo_name}" data-purpose="${item.purpose}">Reject</a>
                                <a href="#" class="btn btn-success approve-btn" data-id="${item.trust_proposal_id}" data-trustid="${item.trustId}" data-ngoname="${item.ngo_name}" data-purpose="${item.purpose}">Approve</a>
                            </p><br>
                        </li>`;

              // Append the newly created list item to the pending funds container
              pendingFundsContainer.append(listItem);

              // Using function Handle Approve button click
              $('.approve-btn').on('click', function(event) {
                event.preventDefault();
                let userId = $(this).data('id');
                let trustId = $(this).data('trustid');
                let ngo_name = $(this).data('ngoname');
                let purpose = $(this).data('purpose');
                updateProposalStatus(userId, "approve", trustId, ngo_name, purpose);
              });

              // Using function Handle Reject button click 
              $('.reject-btn').on('click', function(event) {
                event.preventDefault();
                let userId = $(this).data('id');
                let trustId = $(this).data('trustid');
                let ngo_name = $(this).data('ngoname');
                let purpose = $(this).data('purpose');
                updateProposalStatus(userId, "reject", trustId, ngo_name, purpose);
              });

            });
          } else {
            // If no records are found, display a message
            $('.pending-funds').html('<li>No pending funds found.</li>');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          $('.pending-funds').html('<li>There was an error loading the data.</li>');
        }
      });
    });
  </script>

  <!-- Update Proposal Status -->
  <script>
    function updateProposalStatus(userId, action, trustId, ngo_name, purpose) {
      $.ajax({
        url: '../api/update_proposal_status.php', // Change to your API URL
        method: 'POST',
        data: JSON.stringify({
          id: userId,
          status: action,
          trustId: trustId,
          ngo_name: ngo_name,
          purpose: purpose
        }),

        contentType: 'application/json',

        success: function(response) {
          if (response.status === 200) {
            alert(response.message); // Success message
            sendNotification({
              status: action,
              trustId: trustId,
              ngo_name: ngo_name,
              purpose: purpose
            });

            location.reload(); // Reload the page to reflect changes
          } else {
            alert(response.message); // Error or failure message
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          alert('Something went wrong while updating user status.');
        }
      });
    }
    
    // Function to send a notification after successful form submission
    function sendNotification(data) {
      // Prepare notification data for API call
      const notificationData = {
        title: "Fund Request Status",
        content: `The Fund Requested for  ${data.purpose} to ${data.ngo_name} has Been ${data.status} .`,
        userid: data.trustId
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

  <!--All Rejected Proposal -->
  <script>
    $(document).ready(function() {
      // AJAX request to fetch rejected funds
      $.ajax({
        url: '../api/rejected_funds.php', // API endpoint for fetching rejected proposals
        type: 'POST',
        dataType: 'json',
        success: function(response) {
          if (response.status === 200) {
            // Clear the existing list
            const rejectedFundsContainer = $('.rejected-funds');
            rejectedFundsContainer.empty();

            // Loop through each rejected fund
            response.data.forEach(function(item) {
              const listItem = `
                        <li>
                            <p><b>${item.ngo_name}</b></p>
                            <p>${item.amount}</p>
                            <p>${new Date(item.date).toLocaleDateString()}</p>
                            <p>${item.trust_name}</p>
                            <p class="float-end text-end">
                                <a href="../proposal/${item.doc_name}" target="_blank" class="btn open-btn me-2">View</a>
                            </p><br>
                        </li>`;

              // Append the rejected fund item to the list
              rejectedFundsContainer.append(listItem);
            });
          } else {
            // Display a message if no rejected funds are found
            $('.rejected-funds').html('<li>No rejected funds found.</li>');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          $('.rejected-funds').html('<li>There was an error loading the data.</li>');
        }
      });
    });
  </script>

</body>

</html>