<?php
  /*** Assume database is empty on 1st load***/
  $message = '<tr><td colspan="3">Database Empty! Please Upload a CSV file.</td></tr>';
  /*** Load Table form Database ***/
  try
  {
    /*** connect to database ***/
    /*** mysql hostname ***/
    $mysql_hostname = 'localhost';

    /*** mysql username ***/
    $mysql_username = 'root';

    /*** mysql password ***/
    $mysql_password = '';

    /*** database name ***/
    $mysql_dbname = 'payrollappdb';


    /*** select the users name from the database ***/
    $conn = new mysqli($mysql_hostname, $mysql_username, $mysql_password, $mysql_dbname);
    /*** $message = a message saying we have connected ***/

    /*** set the error mode to excptions ***/
    if($conn->connect_error){
      die("Connection failed!" . $conn->connect_error);
    }

    /*** prepare the query ***/
    $stmt = ("SELECT employee_id, hours_worked, job_group, date_worked FROM time_reports");

    /*** execute the prepared statement ***/
    $result = $conn->query($stmt);

    /*** check for a result ***/
    if ($result->num_rows > 0){
      /*** output data per row ***/
      $message = '';
      while ($row = $result->fetch_assoc()) {
        $message .= '<tr>';
        $message .= '<td>' . $row["employee_id"] . '</td>';
        $message .= '<td>' . $row["date_worked"] . '</td>';
        /*** Calculate amount owed per job_group per day ***/
        if ($row["job_group"] == 'A'){
          $amount = $row["hours_worked"] * 20;
        } else {
          $amount = $row["hours_worked"] * 30;
        }
        /***
          TODO: Refactor code to show 1 employee row per fortnightly pay-period
        ***/
        $message .= '<td>R' . $amount . '</td>';
        $message .= '</tr>';
      }
    }
  }
  catch (Exception $e)
  {
    /*** if we are here, something is wrong in the database ***/
    $message = '<tr><td colspan="3">We are unable to process your request. Please try again later' . $e . '</td></tr>';
  }

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Payroll App</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Capitec Payroll App</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <!-- TODO: implement security -->
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="#">
                  <span data-feather="users"></span>
                  Payroll <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Saved reports</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <!-- TODO code filters for month, Fortnight and All time -->
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current month
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  Current fortnight
                </a>
              </li>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span data-feather="file-text"></span>
                  All time
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Payroll Uploader</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>
			
			<div>
				<h2>Upload Payroll File</h2>
				<form method="post" action="upload_handler.php">
				  <div class="form-group">
					<label for="payrollFormControlFile">Select Payroll CSV File</label>
					<input type="file" class="form-control-file" id="payrollFormControlFile" name="payrollFormControlFile">
				  </div>
				  <button type="submit" class="btn btn-outline-secondary">
            <span data-feather="upload"></span>
            Upload
          </button>
				</form>
			</div>
		  <hr/>
          <h2>Report</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Employee ID</th>
                  <th>Pay Period</th>
                  <th>Amount Paid</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    /*** Render body of table here ***/
                    echo $message;
                ?>
              </tbody>
			  <tfoot>
				<tr>
					<th>Report ID</th>
					<th colspan="2">1014511245</th>
				</tr>
			  </tfoot>
            </table>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>


  </body>
</html>
