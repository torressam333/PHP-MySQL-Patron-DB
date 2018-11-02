<?php

function connectDatabase()
{
	//**********************************************
	//*
	//*  Connect to MySQL and Database
	//*
	//**********************************************

		 require('../../DBtest_pptest.php');

		 $host =  'localhost';
		 $userid =  '';
		 $password = '';
		 $dbname = 'testdb';

		 $db = mysqli_connect($host, $userid, $password, $dbname);

		 if (!$db)
		 {
		     print "<h1>Unable to Connect to MySQLi</h1>";
		     exit;
		 }

	     return $db;
}//End of connectDatabase


function doValidation($firstname, $lastname, $email, $bYear, $city)
{
   
	$errmsg = '';

	if (empty($firstname))
	{
		$errmsg .= "<br>Error: You must enter a First Name";
	}

	if (empty($lastname))
	{
		$errmsg .= "<br>Error: You must enter a Last Name";
    }
    
    if (empty($email))
	{
		$errmsg .= "<br>Error: You must enter your Email";
    }

	if (empty($bYear))
	{
		$errmsg .= "<br>Error: You must enter your Birthyear";
	}
	else
	{
		if (!is_numeric($bYear))
		{
			$errmsg .= "<br>Error: Your Birth Year must be numeric<br>";
		}
		else
		{
			$length_of_year = strlen($bYear);

			if ($length_of_year != 4)
			{
				$errmsg .= "<br>Error: Your Birth Year must be exaclty four numbers<br>";
			}
        }
    }

    if(empty($city) || $city == "-")
    {
        $errmsg .= "<br>Error: You must select a City<br>";
    }

	return $errmsg;
}//End of doValidation


function displayPage($firstname, $lastname, $email, $bYear, $city)
{
     //Validating users age
     $currentYear = date('Y');
    
     $age = $currentYear - $bYear;  
     
         if($age <= 15){
             $section = "Children";
         }
             if($age >= 16)
             {
                 $section = "Adult";
             }
                 if($age > 54)
                 {
                     $section = "Senior";
                 }
                 if($firstname && $lastname && $email && $bYear && $city && $age){
                     print("<div style='padding:20px;'>Thank you for Registering!");
                     print("<p>Name: " . $firstname . " " . $lastname. "</p>");
                     print("<p>Email: " . $email . "</p>");
                     print("<p>City: " . $city . "</p>");
                     print("<p>Section: " . $section . "</p>");
                     print "Row added to the Patron Table<br>";
                     print('<br>For Admin Use Only: <a href="assignment_6_view_patron.php">View Patrons</a></div>');
                     }

}//end of displayPage
?>