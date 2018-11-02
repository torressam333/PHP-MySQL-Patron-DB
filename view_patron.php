<!DOCTYPE html>
<html lang="en">
<head>
	<title>assignment_6_view_patron</title>
    <link rel="stylesheet" type="text/css" href="css/kinglib_6.css">
</head>
<body>
<div id="logo">
	<img src="http://profperry.com/Classes20/PHPwithMySQL/KingLibLogo.jpg" alt="King Real Estate Logo">
</div>
<div id="results2">
<h1>View Patrons</h1>


<?php
include "assignment_6_db_functions.php";
$db = connectDatabase();
//**********************************************
//*
//*  SELECT from table and display Results
//*
//**********************************************

$sql_statement  = "SELECT lastname, firstname, email, city, birthyear ";
$sql_statement .= "FROM patron ";
$sql_statement .= "ORDER BY lastname, firstname ";

$result = mysqli_query($db, $sql_statement);

$outputDisplay = "";
$myrowcount = 0;

if (!$result) {
	$outputDisplay .= "<p style='color: red;'>MySQL No: ".mysqli_errno($db)."<br>";
	$outputDisplay .= "MySQL Error: ".mysqli_error($db)."<br>";
	$outputDisplay .= "<br>SQL: ".$sql_statement."<br>";
	$outputDisplay .= "<br>MySQL Affected Rows: ".mysqli_affected_rows($db)."</font><br>";
} else {

	$outputDisplay .= '<table border=1 style="color: black;">';
	$outputDisplay .= '<tr><th>Last Name</th><th>First Name</th><th>Email</th><th>City</th><th>Birth Year</th></tr>';

    $numresults = mysqli_num_rows($result);
    
    if($numresults == 0)
    {
        $outputDisplay .= "<strong>No Patrons Found</strong><br><br>";
    }

	for ($i = 0; $i < $numresults; $i++)
	{
		if (!($i % 2) == 0)
		{
			 $outputDisplay .= "<tr style=\"background-color: #FFFFCC;\">";
		} else {
			 $outputDisplay .= "<tr style=\"background-color: white;\">";
		}


		$myrowcount++;

		$row = mysqli_fetch_array($result);

		$lastname  = $row['lastname'];
        $firstname = $row['firstname'];
        $email = $row['email'];
        $city = $row['city'];
        $bYear = $row['birthyear'];

		$outputDisplay .= "<td>".$lastname."</td>";
        $outputDisplay .= "<td>".$firstname."</td>";
        $outputDisplay .= "<td>".$email."</td>";
        $outputDisplay .= "<td>".$city."</td>";
        $outputDisplay .= "<td>".$bYear."</td>";

		$outputDisplay .= "</tr>";
	}

	$outputDisplay .= "</table>";

}
print $outputDisplay;

?>
        </div>
    </body>
</html>