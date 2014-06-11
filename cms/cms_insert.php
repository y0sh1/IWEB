<?php

	require_once('../includes/database.php');
	require_once('../includes/contenttypes.php');
	
	// Bepaal de huidige pagina
	if (isset($_POST['section']))
	{
		$section = $_POST['section'];
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

	if (isset($section))
	{
		// schrijf de juiste query, afhankelijk van het type content
		switch($section)
		{
			case 'pagina\'s' :
				// haal de juiste velden uit de post string en codeer voor opslaan in database
				$nr         = stripslashes($_POST['nr']);
				$naam       = stripslashes($_POST['naam']);
				$navitem    = stripslashes($_POST['navitem']);
				$navtitel   = stripslashes($_POST['navtitel']);
				$vlak1_type = stripslashes($_POST['vlak1_type']);
				$vlak1_link = stripslashes($_POST['vlak1_link']);
				$vlak2_type = stripslashes($_POST['vlak2_type']);
				$vlak2_link = stripslashes($_POST['vlak2_link']);
				$vlak3_type = stripslashes($_POST['vlak3_type']);
				$vlak3_link = stripslashes($_POST['vlak3_link']);
				$vlak4_type = stripslashes($_POST['vlak4_type']);
				$vlak4_link = stripslashes($_POST['vlak4_link']);
				
				// bouw query voor updaten van de database
				$query = sprintf("INSERT INTO %s VALUES (%d, '%s', '%s', '%s', '%s', %d, '%s', %d, '%s', %d, '%s', %d)",
					mysql_real_escape_string($contentDBTabel[$section]),
					mysql_real_escape_string($nr),
					mysql_real_escape_string($naam),
					mysql_real_escape_string($navitem),
					mysql_real_escape_string($navtitel),
					mysql_real_escape_string($vlak1_type),
					mysql_real_escape_string($vlak1_link),
					mysql_real_escape_string($vlak2_type),
					mysql_real_escape_string($vlak2_link),
					mysql_real_escape_string($vlak3_type),
					mysql_real_escape_string($vlak3_link),
					mysql_real_escape_string($vlak4_type),
					mysql_real_escape_string($vlak4_link));

				break;

			case 'tekst' :
				// haal de juiste velden uit de post string en codeer voor opslaan in database
				$titel  = stripslashes($_POST['titel']);
				$tekst  = stripslashes($_POST['tekst']);
				
				// bouw query voor updaten van de database
				$query = sprintf("INSERT INTO %s VALUES (NULL, '%s', '%s')",
					mysql_real_escape_string($contentDBTabel[$section]),
					mysql_real_escape_string($titel),
					mysql_real_escape_string($tekst));
				break;

			case 'afbeeldingen' :
				// haal de juiste velden uit de post string en codeer voor opslaan in database
				$titel   = stripslashes($_POST['titel']);
				$url     = stripslashes($_POST['url']);
				$breedte = stripslashes($_POST['breedte']);
				$hoogte  = stripslashes($_POST['hoogte']);
				
				// bouw query voor updaten van de database
				$query = sprintf("INSERT INTO %s VALUES (NULL, '%s', '%s', %d, %d)",
					mysql_real_escape_string($contentDBTabel[$section]),
					mysql_real_escape_string($titel),
					mysql_real_escape_string($url),
					mysql_real_escape_string($breedte),
					mysql_real_escape_string($hoogte));
				break;
            case 'placekitten' :
                $titel   = stripslashes($_POST['titel']);
                $breedte = stripslashes($_POST['breedte']);
                $hoogte  = stripslashes($_POST['hoogte']);

                $query = "INSERT INTO placekitten (titel, height, width) VALUES ($$titel, $$breedte, $$hoogte)";
                break;
		}

		// Voer Query uit, update de database
		$updateResult = mysql_query($query, $dbLink);

		// Controleer of update succesvol is verlopen
		if ($updateResult)
		{
			echo "De content is toegevoegd.<br><br>";
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