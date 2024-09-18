<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KRP</title>
    <link rel="icon" type="image/x-icon" href="../Image/LOGO.png">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <style>
        .table>:not(:first-child) {
            border-top: 0;
        }
        .noPrint {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<body>
    <?php include('parent-header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="noPrint pe-0 mt-4">
                <a href="#" class="float-end text-end btn btn-submit" onclick="downloadPDF()">
                    <i class="fa fa-download" aria-hidden="true"></i> Download
                </a>
            </div>
        </div>
        <div class="row">
            <div class="receipt-main col-md-12">
                <div class="row">
                    <div class="receipt-header row">
                        <div class="col-md-12">
                            <div class="receipt-left">
                                <img class="img-responsive" alt="logo" src="../Image/LOGO.png" style="width: 71px;">
                                <span class="invoice-name">KRP Matric Hr.Sec.School</span>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="line-h2">&nbsp; School Fees Receipt &nbsp;</h2>
                <div id="studentDetails" class="row">
                    <!-- Student details will be populated here -->
                </div>
                <div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fees Detail</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="feesTableBody">
                            <!-- Data will be populated here by JavaScript -->
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="receipt-header receipt-header-mid receipt-footer mb-0">
                        <div class="col-sm-8 col-md-8 text-left">
                            <div class="receipt-right">
                                <h6 style="color: rgb(140, 140, 140);">This is a computer generated invoice no signature required.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-2 bg-blue fs-14">
        <div class="container">
            <span>&copy; Copyright - 2024.</span>
        </div>
    </footer>
    <div class="bottom-footer">
        <div class="container">
            <ul>
                <li><a href="student-profile.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                <li><a href="calendar.php" class="mob-home"><i class="fa fa-home"></i></a></li>
                <li><a href="parent-payment-page.php"><i class="fa fa-file-text" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'invoicebk.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        let paidFees = JSON.parse(response.paid_fees);
                        let feesTableBody = $('#feesTableBody');
                        let totalAmount = 0;

                        $.each(paidFees, function(feeType, amount) {
                            feesTableBody.append(
                                '<tr>' +
                                '<td class="col-md-9">' + feeType + '</td>' +
                                '<td class="col-md-3"><i class="fa fa-inr"></i> ' + amount + '/-</td>' +
                                '</tr>'
                            );
                            totalAmount += amount;
                        });

                        feesTableBody.append(
                            '<tr>' +
                            '<td class="text-right"><h2><strong>Total: </strong></h2></td>' +
                            '<td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> ' + totalAmount + '/-</strong></h2></td>' +
                            '</tr>'
                        );

                        $('#studentDetails').html(
                            '<div class="col-sm-8 col-md-8 text-start">' +
                            '<div class="receipt-right">' +
                            '<h5>' + response.student_name + '</h5>' +
                            '<p>' + response.city + '</p>' +
                            '<p>' + response.contact_number + '</p>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-sm-4 col-md-4">' +
                            '<div class="receipt-left">' +
                            '<h3>Transaction No: <span>' + response.transaction_id + '</span></h3>' +
                            // '<h3>Date: <span>' + response.fees_paid_on + '</span></h3>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                    alert('An error occurred while fetching the fees data.');
                }
            });
        });

        async function downloadPDF() {
            const { jsPDF } = window.jspdf;

            // Get the content of the element to be converted to PDF
            const content = document.querySelector('.receipt-main');

            // Use html2canvas to convert the content to a canvas
            const canvas = await html2canvas(content);

            // Get the image data from the canvas
            const imgData = canvas.toDataURL('image/png');

            // Create a new jsPDF instance
            const pdf = new jsPDF('p', 'pt', 'a4');

            // Calculate the width and height of the image in the PDF
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

            // Add the image to the PDF
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);

            // Save the PDF
            pdf.save('receipt.pdf');
        }
    </script>
</body>
</html>
