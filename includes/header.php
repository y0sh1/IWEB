<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<link rel="stylesheet" href="css/styles.css" type="text/css" >
</head>

<body class="body">
<table class="main">
<tr>
	<td colspan="2" class="header">
		<a href="/"><img class="logo" src="img/logo.gif" width="550" height="58"></a>
	</td>
</tr>
<tr>
	<td colspan="2" class="nav">

<?php

	// Haal de navigatiestructuur op
	$query = "SELECT naam, navtitel FROM paginas WHERE navitem = 'ja' ORDER BY nr";
	 
	// Voer Query uit
	$navResult = mysql_query($query, $dbLink);
	
	// Bouw de navigatie op
	if (checkDBResults($navResult))
	{
		while ($row = mysql_fetch_assoc($navResult))
		{
			if ($section == $row['naam'])
			{
				$navClass = "navlinkselected";
			}
			else
			{
				$navClass = "navlink";
			}
	
			echo '<a class="' . $navClass . '" href="index.php?p=' . $row['naam'] . '">' . $row['navtitel'] . '</a>';
		}
	}
	
	// Geef resources vrij
	mysql_free_result($navResult);

?>

	</td>
</tr>
