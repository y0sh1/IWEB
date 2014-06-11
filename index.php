<?php

	require_once('includes/database.php');
	require_once('includes/content.php');
	
	// Bepaal de huidige pagina
	$section = $_GET['p'];
	$section = urldecode($section);
	
	if (empty($section))
	{
		$section = "home";
	}
	
	// Open Database connectie
	if (!$dbLink = openDB())
	{
        echo 'oke doei!';
	    exit;
	}
	
	// Bouw de bovenkant van de pagina en navigatie op
	include('includes/header.php');
	
	// Haal de huidige pagina op
	$query = sprintf("SELECT * FROM paginas WHERE naam='%s'",
	        mysql_real_escape_string($section));
    if($section == "Gastenboek"){
    include('includes/gastenboek.php');
    } else {
	
	// Voer Query uit
	$pageResult = mysql_query($query, $dbLink);
	
	// Controleer en gebruik eerste resultaat
	if (checkDBResults($pageResult))
	{
		$row = mysql_fetch_assoc($pageResult);
		extract($row);

?>	

	<tr>
	<td class="upperleft">

<?php

		// Schrijf content voor vlak 1, linksboven
		writeContent($vlak1_type, $vlak1_link, $dbLink);

?>

	</td>
	<td class="upperright">

<?php

		// Schrijf content voor vlak 2, rechtsboven
		writeContent($vlak2_type, $vlak2_link, $dbLink);

?>

	</td>
	</tr>	

	<tr>
	<td class="lowerleft">

<?php

		// Schrijf content voor vlak 3, linksonder
		writeContent($vlak3_type, $vlak3_link, $dbLink);

?>

	</td>
	<td class="lowerright">

<?php

		// Schrijf content voor vlak 4, rechtsonder
		writeContent($vlak4_type, $vlak4_link, $dbLink);

?>

	</td>
	</tr>	

<?php

	}
	else
	{
		// Opgevraagde pagina niet gevonden in de database

?>
	<tr>
	<td class="upperleft">
		<h1 class="headertitel">Pagina niet gevonden</h1>
		<p>Deze pagina kan niet worden weergegeven. <a href="/">Keer terug naar de homepage.</a><p>
	</td>
    <td class="upperright">&nbsp;</td>
	</tr>
	<tr>
	<td class="lowerleft">&nbsp;</td>
    <td class="lowerright">&nbsp;</td>
	</tr>

<?php

	}


	// Geef resources vrij
	mysql_free_result($pageResult);	
    }
	// Bouw de onderkant van de pagina op
	include('includes/footer.php');
	
	closeDB($dbLink);

?>