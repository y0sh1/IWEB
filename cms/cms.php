<?php

	require_once('../includes/database.php');
	require_once('../includes/contenttypes.php');
	require_once('../includes/cms_formulieren.php');
	
	// Bepaal de huidige pagina / het huidige contenttype
	if (isset($_GET['p']))
	{
		$section = $_GET['p'];
		$section = urldecode($section);
	}
	else
	{
		// set default waarde
		$section = 'pagina\'s';
	}
	
	// Bepaal het id (primary key) van de content die op dit moment bewerkt wordt
	// veld mag leeg zijn (er wordt niets bewerkt), een primary key van een contenttype bevatten
	// of de waarde 'new' voor het toevoegen van nieuwe content
	if (isset($_GET['id']))
	{
		$contentID = $_GET['id'];
		$contentID = urldecode($contentID);
	}

	// Bouw de bovenkant van de pagina en navigatie op
	require('../includes/cms_header.php');	
?>

<tr>
	<td class="upperleft">

<?php
	echo 'Beschikbare ' . $section . ':<br/>';
	
	// Open Database connectie
	if (!$dbLink = openDB())
	{
		exit;
	}

	// haal overzicht van alle content van het gekozen type uit de juiste databasetabel
	$query = sprintf("SELECT %s, %s FROM %s",
		mysql_real_escape_string($contentPrimaryKey[$section]),
		mysql_real_escape_string($contentNaam[$section]),
	    mysql_real_escape_string($contentDBTabel[$section]));	 
	 
	// Voer Query uit
	$contentResult = mysql_query($query, $dbLink);

	// Controleer en gebruik resultaten
	if (checkDBResults($contentResult))
	{
		// maak lijst met alle content van dit type met link om deze te bewerken
		while ($row = mysql_fetch_assoc($contentResult))
		{
			$huidigeContentID = $row[$contentPrimaryKey[$section]];
			$huidigeContentNaam = $row[$contentNaam[$section]];
			echo '<a href="cms.php?p=' . urlencode($section) . '&id=' . urlencode($huidigeContentID) . '">' . $huidigeContentNaam . '</a><br>';
		}
	}

	// Geef resources vrij
	mysql_free_result($contentResult);

	// knop om nieuwe content toe te voegen, laad de pagina opnieuw met content id = 'new'
	?>

	<br />
	<form action="cms.php" method="get">
	<input type="hidden" name="p" value="<?php echo urlencode($section); ?>">
	<input type="hidden" name="id" value="new">
	<input type="submit" value="Toevoegen">
	</form>

	</td>
	<td class="upperright">	

	<?php
	// als er een uniek id van een type content is meegeven, kan deze content bewerkt worden

	if (isset($contentID))
	{
		// kijk of het gaat om bestaande content, of om het toevoegen van nieuwe content
		if ($contentID != 'new')
		{
			// bestaande content: haal de geselecteerde content uit de juiste databasetabel
			$query = sprintf("SELECT * FROM %s WHERE %s = '%s'",
				mysql_real_escape_string($contentDBTabel[$section]),
				mysql_real_escape_string($contentPrimaryKey[$section]),
				mysql_real_escape_string($contentID));	
		 
			// Voer Query uit
			$contentResult = mysql_query($query, $dbLink);

			// Controleer en gebruik eerste resultaat
			if (checkDBResults($contentResult)) {
				$row = mysql_fetch_assoc($contentResult);
				extract($row);
			}
			
			// maak formulier om het gekozen contenttype te bewerken
			echo '<form action="cms_update.php" method="post">';
			
		}
		else
		{
			// maak formulier om nieuwe content in database toe te voegen
			echo '<form action="cms_insert.php" method="post">';
		}

?>

		<table class="form">
		
<?php
		// toon de specifieke velden voor het gekozen type content
		switch($section)
		{
			case 'pagina\'s' :
				maakPaginaFormulier($row);
				break;
			case 'tekst' :
				maakTekstFormulier($row);
				break;
			case 'afbeeldingen' :
				maakAfbeeldingFormulier($row);
				break;
            case 'placekitten' :
                maakPlaceKittenFormulier($row);
                break;
		}
?>

		</table>
		<br />
		<input type="hidden" name="section" value="<?php echo $section; ?>">
		<input type="hidden" name="contentID" value="<?php echo $contentID; ?>">
		<input type="reset" value="Annuleren" onClick="javascript:location.reload()">
		<input type="submit" value="Opslaan">
		</form>
<?php	
		if ($contentID != 'new')
		{
			// knop voor verwijderen (bestaande) content
?>
				<form action="cms_delete.php" method="post">
				<input type="hidden" name="section" value="<?php echo $section; ?>">
				<input type="hidden" name="contentID" value="<?php echo $contentID; ?>">
				<input class="delete" type="submit" value="Verwijderen">
				</form>
<?php
		}
	}

?>
	
	</td>
</tr>

<?php	
	// Geef resources vrij
	mysql_free_result($contentResult);
	closeDB($dbLink);

	// Bouw de onderkant van de pagina op
	include('../includes/cms_footer.php');
?>