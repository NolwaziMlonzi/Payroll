<?php
    ini_set('max_execution_time', 300); //300 seconds = 5 minutes
    set_time_limit(300);
    
    /** read, parse and save csv file to database **/
    if (isset($_POST['payrollFormControlFile'])){
        /** Open the file for reading **/
        if (($h = fopen($_POST['payrollFormControlFile'], "r")) !== FALSE) 
        {
            /** Convert each line into the local $data array variable **/
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {	
                $first_cell_preview = $data[0];
                if ((strcasecmp($first_cell_preview, "date") !== 0 ) && (strcasecmp($first_cell_preview, "report id") !== 0)){
                    /** Read the data from a single line into variables **/
                    $date_worked = $data[0];
                    $hours_worked = $data[1];
                    $employee_id = $data[2];
                    $job_group = $data[3];
                    /*** Call function to save to DB ***/
                    $message = save_to_db($date_worked, $hours_worked, $employee_id, $job_group);
                } else{
                    if (strcasecmp($first_cell_preview, "report id") == 0){
                        /** read report id in last line **/
                        $report_id = $data[1];
                    }
                }
                                
            }
            /** Close the file **/
            fclose($h);
        }
    }
    /*** Redirect to Index Page ***/
    header('Location: index.php');

    function save_to_db($date_worked, $hours_worked, $employee_id, $job_group){
        /*** connect to database ***/
		/*** mysql hostname ***/
		$mysql_hostname = 'localhost';
        
        /*** mysql username ***/
        $mysql_username = 'root';

        /*** mysql password ***/
        $mysql_password = '';

        /*** database name ***/
        $mysql_dbname = 'payrollappdb';

        try
		{
			$dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
			/*** $message = a message saying we have connected ***/
            
			/*** set the error mode to exceptions ***/
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			/*** prepare the insert ***/
			$stmt = $dbh->prepare("INSERT INTO time_reports (date_worked, hours_worked, employee_id, job_group ) VALUES (:date_worked, :hours_worked, :employee_id, :job_group )");

			/*** bind the parameters ***/
			$stmt->bindParam(':date_worked', $date_worked, PDO::PARAM_STR);
			$stmt->bindParam(':hours_worked', $hours_worked, PDO::PARAM_STR);
			$stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_STR);
			$stmt->bindParam(':job_group', $job_group, PDO::PARAM_STR);
			
			/*** execute the prepared statement ***/
			$stmt->execute();

			/*** if all is done, say thanks ***/
			$message = 'New Time Report Added!';
		}
		catch(Exception $e)
		{
			/*** check if the ti already exists ***/
			if( $e->getCode() == 23000)
			{
				$message = 'Time Report Already Exists';
			}
			else
			{
				/*** if we are here, something has gone wrong with our database ***/
				$message = 'We are unable to process your request. Please try again later"';
			}
        }
        
        return $message;
        
        
    }
    

?>
