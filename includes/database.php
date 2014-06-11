<?php

	require_once('settings.php');
	
	function openDB()
	{
		// Controleer of verbinding met databaseserver gemaakt kan worden
		if (!$dbLink = mysql_connect(DB_HOST, DB_USER, DB_PASS))
		{
			echo('<!-- Could not connect to mysql -->');
			echo('<!-- MySQL Error: ' . mysql_error() . ' -->');
	
			return false;
		}
	
		// Controleer of opgevraagde database geopend kan worden
		if (!mysql_select_db(DB_NAME, $dbLink))
		{
			echo('<!-- Could not select database -->');
			echo('<!-- MySQL Error: ' . mysql_error() . ' -->');
			return false;
		}
	
		return $dbLink;
	}
	
	function closeDB($dbLink)
	{
		if(!mysql_close($dbLink))
		{
			echo('<!-- Could not close the mysql connection -->');
			echo('<!-- MySQL Error: ' . mysql_error() . ' -->');
			return false;
		}
		
		return true;
	}
	
	function checkDBResults($resultSet)
	{
		// Controleer of query uitgevoerd kon worden
		if (!$resultSet)
		{
			echo('<!-- Could not query the database -->\n');
			echo('<!-- MySQL Error: ' . mysql_error() . ' -->');
			return false;
		}
	
		// Controleer of er een resultaat is
		if (mysql_num_rows($resultSet) == 0)
		{
			echo('<!-- No matching results in resultset -->\n');
			echo('<!-- MySQL Error: ' . mysql_error() . ' -->');
			return false;
		}
	
		return true;
	}

?>
