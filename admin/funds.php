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
              <h3 class="mt-5">Fund Request</h3>

              <div class="row fund-list">
                <!-- Fund items will be appended here via AJAX -->
      
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
                        <input readonly type="text" id="ngo_name" class="form-control" placeholder="Enter NGO Name">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">NGO Registration Number</label>
                        <input readonly type="text" id="ngo_registration_number" class="form-control" placeholder="Enter the Legal Registration Number">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Authorized Representative Name</label>
                        <input readonly type="text" id="authorized_representative" class="form-control" placeholder="Phone number for correspondence.">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Contact Information</label>
                        <input readonly type="text" id="contact_information" class="form-control" placeholder="Name of the person authorized">
                      </div>
                      <h5>Trust Details</h5>
                      <div class="mb-3">
                        <label class="form-label">Purpose of the Trust</label>
                        <input readonly type="text" id="purpose" class="form-control" placeholder="Specify the purpose">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Amount Requested</label>
                        <input readonly type="text" id="amount_requested" class="form-control" placeholder="The exact amount of funds being requested.">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Quarter</label>
                        <input readonly type="text" id="quarter" class="form-control" placeholder="Q1, Q2, Q3, Q4">
                      </div>
                      <h5>Budget Proposal</h5>
                      <div class="mb-3">
                        <label class="form-label">Detailed Budget Breakdown</label>
                        <textarea readonly id="budget_breakdown" class="form-control"></textarea>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Projected Outcomes</label>
                        <input type="text" readonly id="projected_outcomes" class="form-control" placeholder="Expected outcome">
                      </div>
                      <h5>Bank Details Confirmation</h5>
                      <div class="mb-3">
                        <label class="form-label">Bank Name and Branch</label>
                        <input type="text" readonly id="bank_name" class="form-control" placeholder="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Account Number</label>
                        <input type="text" readonly id="account_number" class="form-control" placeholder="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">IFSC Number</label>
                        <input type="text" readonly id="ifsc_number" class="form-control" placeholder="">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Account Type</label>
                        <input type="text" readonly id="account_type" class="form-control" placeholder="">
                      </div>

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

  <!-- All Fund List -->
  <script>
    $(document).ready(function() {
      // AJAX request to fetch the fund list
      $.ajax({
        url: '../api/admin_fundlist.php', // The API endpoint
        type: 'POST',
        dataType: 'json',
        success: function(response) {
          if (response.status === 200) {
            const fundContainer = $('.fund-list');
            fundContainer.empty(); // Clear the container before appending new data

            // Loop through each fund record
            response.data.forEach(function(item) {
              const formattedDate = new Date(item.date).toLocaleDateString(); // Format date

              // Create the HTML structure for each fund
              const fundItem = `
                    <div class="col-lg-6">
                        <ul>
                            <li>
                                <p><b>${item.ngo_name}</b> 
                                   <a href="#" class="float-end view-details-btn" data-id="${item.trust_proposal_id}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">View</a>
                                </p>
                                <p>${item.amount.toLocaleString()}</p>
                                <p>${formattedDate}</p>
                                <p>${item.trust_name}</p>
                               
                                 
                                <br>
                            </li>
                        </ul>
                    </div>`;

              // Append each fund item to the container
              fundContainer.append(fundItem);
            });
          } else {
            // Handle no records found case
            $('.fund-list').html('<p>No funds found</p>');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          $('.fund-list').html('<p>There was an error loading the data.</p>');
        }
      });
    });
  </script>

  <!-- Individual Fund Details -->
  <script>
    $(document).on('click', '.view-details-btn', function() {
      const proposalId = $(this).data('id'); // Get the ID from the clicked button

      $.ajax({
        url: '../api/getTrustProposalDetails.php', // API to fetch details
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify({
          trust_proposal_id: proposalId
        }),
        success: function(response) {
          if (response.status === 200) {
            const data = response.data;

            // Populate the modal fields with fetched data
            $('#ngo_name').val(data.ngo_name);
            $('#ngo_registration_number').val(data.ngo_uin);
            $('#authorized_representative').val(data.authorized_representative);
            $('#contact_information').val(data.contact_information);
            $('#purpose').val(data.purpose);
            $('#amount_requested').val(data.amount);
            $('#quarter').val(data.quarter);
            $('#budget_breakdown').val(data.budget_proposal);
            $('#projected_outcomes').val(data.projected_outcomes);
            $('#bank_name').val(data.bank_name);
            $('#account_number').val(data.account_number);
            $('#ifsc_number').val(data.ifsc_code);
            $('#account_type').val(data.account_type);

            // Show the modal (in case it is not triggered)
            $('#staticBackdrop').modal('show');
          } else {
            alert('No data found for this proposal');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          alert('An error occurred while fetching data');
        }
      });
    });
  </script>
  
 

</body>

</html>