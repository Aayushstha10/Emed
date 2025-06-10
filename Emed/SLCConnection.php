<!--ContactUs Connection-->

<?php
	$host = 'localhost';
	$user = 'root';
	$password = '';
	$db = 'contactusdb';

		//Create Connection
		$con = mysqli_connect($host, $user, $password, $db);
		if(!$con){
		//	echo "Connection Error...";
		}
		else{
		//	echo "Connection Success...";
		}
		echo "</br>";

		if(isset($_POST['cregister'])){
			$email = $_POST["uemail"];
			$message = $_POST["umessage"];

		$sql = "INSERT INTO contactusinfo(Email, Message) VALUES('".$email."', '".$message."')";
		
		$query = mysqli_query($con, $sql);

		if(!$query){
			echo "Unable To Insert Record...";
		}
		else{
			echo'<script>alert("Data Inserted Successfully"); // "Record Inserted Successfully..."
            window.location.href="/FP/frontpage.php";</script>';
		}
	}
?>
