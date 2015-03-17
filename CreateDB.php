<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<?php
			$server = "zaaxu2ktd4.database.windows.net,1433";
            $user = "cmpt350_pie654";
            $pwd = "Cmpt350!";
            $db = "cmpt350_pie654";
			
            try{
                $conn = new PDO( "sqlsrv:Server= $server ; Database = $db ", $user, $pwd);
                $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                echo "Connection successfully</br>";
            }
            catch(Exception $e){
                die("Connection failed: ".print_r($e));
            }
			
			 $sql = "CREATE TABLE AddressBook (
				id INT IDENTITY(1,1),
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				company VARCHAR(30),
				phone INT NOT NULL,
				email VARCHAR(255) NOT NULL,
				url VARCHAR(255),
				address VARCHAR(255) NOT NULL,
				birthday DATE,
				add_date DATE NOT NULL,
				note VARCHAR(255),
				PRIMARY KEY(id)
			)";
			
			
			
			echo "Got this far";
			
			try{
				$result = $conn->query($sql);
				echo "Table created";
			}
			
			catch(Exception $e){
				print_r($e);
			}
			
		?>
	<body>
</html>