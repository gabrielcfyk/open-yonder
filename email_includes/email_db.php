<?php

if (!class_exists('EmailDB')) {
	class EmailDB {
		
		function EmailDB() {
			return $this->__construct();
		}
		
                /*  Automatically calls the connect function when this class is instantiated */
                
		function __construct() {
			$this->connect();
		}
		
                /*  Creates a link to the MySQL Server, checks the connection, then
                 *  creates a link to the database, checks the connection. Receives
                 *  parameters from config.php. */
                
		function connect() {
			global $submitError, $submitAsk;
                        
                        $link = mysql_connect('localhost', DB_USER, DB_PASS);
			
			if (!$link) {
				$submitAsk = "";
                                $submitError = 'Cannot connect to server:<br>' . mysql_error();
			} else {
                            
                            $db_selected = mysql_select_db(DB_NAME, $link);
				
                            if (!$db_selected) {
                                $submitAsk = "";
				$submitError = 'Cannot use database:<br>' . mysql_error();
                            }
                        }
                }
		
                /*  Sanitizes any input to remove malicious code 
                 *  THIS MAY BE REPLACED/EDITED */
                
		function test_input($data) {
			$data1 = trim($data);
			$data2 = stripslashes($data1);
			$data3 = htmlspecialchars($data2);
			return $data3;
                }
                
                /*  Inserts the data ($values) designated by $fields into the $table,
                 *  which are all set in email_class.php. $link is defined in $edb->connect().
                 *  Then checks whether the data was successfully inserted */
                
		function insert($table, $fields, $values) {
			global $submitError, $submitSuccess, $submitAsk;
                    
                        $impfields = implode(", ", $fields);

			$impvalues = implode("', '", $values);
                        
			$sql = "INSERT INTO $table ($impfields) VALUES ('$impvalues')";
			
			if (!mysql_query($sql)) {
                            $submitAsk = "";
                            $submitError = 'MySQL Error: ' . mysql_error();
			} else {
                            $submitAsk = "";
                            $submitSuccess = "Success!";
                            return TRUE;
			}
		}
		
		function select($sql) {
			$results = mysql_query($sql);
                        
			return $results;
		}
	}
}

$edb = new EmailDB();
?>
