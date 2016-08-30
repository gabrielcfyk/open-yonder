<?php

if(!class_exists('OpenYonder')) {
	class OpenYonder {
                
                function check_post() {
                    
                    if (!empty($_POST)) {

                            $check = $this->check_inputs();
                        
                    }
                }
                
                function check_inputs() {
                    global $edb, $emailErr, $zipErr;
                    
                    if (empty($_POST["email"])) {
                        $emailErr = "Please provide an email address<br>";
                    } else {
                        $email = $edb->test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Make sure it's a working email<br>";
                        }
                    }
                    
                    if (empty($_POST["zip"])) {
			$zip = "";
                    } else {
			$zip = $edb->test_input($_POST["zip"]);
			if (strlen($zip) != 5 || !is_numeric($zip)) {
                            $zipErr = "Make sure it's a 5-digit Zip Code<br>";
			}
                    }
                    
                    $datetime = $edb->test_input($_POST["datetime"]);
                    
                    if (empty($zipErr) && empty($emailErr)) {
                        $this->get_updates($email, $zip, $datetime);
                    }
                }
                
		function get_updates($email, $zip, $datetime) {
			global $edb;
					
			require_once 'email_db.php';
						
			$table = 'emails_zips';
					
			$fields = array('email', 'zip', 'datetime');
					
			$values = array(
					'email' => $email, 
					'zip' => $zip, 
					'datetime' => $datetime
				);
			$insert = $edb->insert($table, $fields, $values);
					
		}
	}
}


$e = new OpenYonder();

?>
