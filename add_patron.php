<!DOCTYPE html>
<html lang="en">
<head>
	<title>assignment_6_add_patron</title>
    <link rel="stylesheet" type="text/css" href="css/kinglib_6.css">
</head>
<body>
<div id="logo">
	<img src="http://profperry.com/Classes20/PHPwithMySQL/KingLibLogo.jpg" alt="King Real Estate Logo">
    <br><br>
<div id="results">
<?php

include "assignment_6_db_functions.php";
$db = connectDatabase();

//Pull data information using POST
if(isset($_POST['submit'])){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $bYear = $_POST['birthyear'];
    $city = $_POST['city'];
}

    //Form validation being pulled from db_functions
    $rtnmsg = doValidation($firstname, $lastname, $email, $bYear, $city);

    if($rtnmsg == '')
    {
        displayPage($firstname, $lastname, $email, $bYear, $city);
    }
    else
    {
        print $rtnmsg;
    }


//**********************************************
//*
//*  Add Patron to Table
//*
//**********************************************

if (isset($_POST['submit']))
{
	$submitButton = trim($_POST['submit']);
} else {
	$submitButton = '';
}

if ($submitButton == 'Add Patron')
{

	if (isset($_POST['firstname']))
	{
		$myfirst = trim($_POST['firstname']);
	} else {
		$myfirst = '';
	}

	if (isset($_POST['lastname']))
	{
		$mylast = trim($_POST['lastname']);
	} else {
		$mylast = '';
	}

	if (isset($_POST['email']))
	{
		$myemail = trim($_POST['email']);
	} else {
		$myemail = '';
    }
    
    if (isset($_POST['birthyear']))
	{
		$myBY = trim($_POST['birthyear']);
	} else {
		$myBY = '';
    }
    
    if (isset($_POST['city']))
	{
		$mycity = trim($_POST['city']);
	} else {
		$mycity = '';
	}

    $length_of_year = strlen($myBY);


	if (empty($myfirst) || empty($mylast) || empty($myemail) || empty($myBY) || $length_of_year != 4 || (!is_numeric($myBY)) || empty($mycity) || $city == "-")
	{
		print "<br>Go BACK and make corrections";
	} else {
		$rtninfo = insertPatron($db, $myfirst, $mylast, $myemail, $myBY, $mycity);

		if ($rtninfo == "NotAdded")
		{
			print "";
		} else {
			print "";
		}
	}
}


    //INSERT NEW ROW TO THE DB

    function insertPatron($db, $firstname, $lastname, $email, $bYear, $city)
    {
    
        $statement 	= "insert into patron (lastname, firstname, email, birthyear, city) ";
        $statement .= "values (";
        $statement .= "'".$lastname."', '".$firstname."', '".$email."', '" .$bYear. "', '" .$city. "'";
        $statement .= ");";
    
        $result = mysqli_query($db, $statement);
    
        if ($result)
        {
            return $lastname;
        } else {
                echo("<h4>MySQL No: ".mysqli_errno($db)."</h4>");
                echo("<h4>MySQL Error: ".mysqli_error($db)."</h4>");
                echo("<h4>SQL: ".$statement."</h4>");
                echo("<h4>MySQL Affected Rows: ".mysqli_affected_rows($db)."</h4>");
            }
    
            return 'NotAdded';
        }

?>
            </div>
        </div>
    </body>
</html>