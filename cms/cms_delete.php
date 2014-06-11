<?php

	require_once('../includes/database.php');
	require_once('../includes/contenttypes.php');
	
	// Bepaal het contenttype
	if (isset($_POST['section']))
	{
		$section = $_POST['section'];
	}

	// Bepaal het id (primary key) van de content die verwijderd wordt
	if (isset($_POST['contentID']))
	{
		$contentID = $_POST['contentID'];
	}

	// Bouw de bovenkant van de pagina en navigatie op
	require('../includes/cms_header.php');	
?>

<tr>
	<td class="upperleft">
	
<?php	
	// Open Database connectie
	if (!$dbLink = openDB())
	{
		exit;
	}

	if (isset($section) && isset($contentID))
	{
		// schrijf de juiste query
		$query = sprintf("DELETE FROM %s WHERE %s='%s'",
			mysql_real_escape_string($contentDBTabel[$section]),
			mysql_real_escape_string($contentPrimaryKey[$section]),				
			mysql_real_escape_string($contentID));

		// Voer Query uit, update de database
		$updateResult = mysql_query($query, $dbLink);

		// Controleer of update succesvol is verlopen
		if ($updateResult)
		{
			echo "De content is verwijderd.<br><br>";
		}
		else
		{
			echo "Er is een fout opgetreden. Zorg dat alle velden ingevuld zijn.<br><br>";
			echo('MySQL Error: ' . mysql_error() . '<br><br>');
		}
		
	}
	else
	{
		echo "Er is een fout opgetreden. Zorg dat alle velden ingevuld zijn.<br><br>";
	}
		
	// knop om terug te keren naar de cms pagina
?>

<form action="cms.php" method="get">
<div>
<input type="hidden" name="p" value="<?php echo urlencode($section); ?>">
<input type="submit" value="Doorgaan">
</div>
</form>

	</td>
	<td class="upperright">&nbsp;</td>
</tr>

<?php	
	// Geef resources vrij
	mysql_free_result($updateResult);
	closeDB($dbLink);

	// Bouw de onderkant van de pagina op
	include('../includes/cms_footer.php');
?>