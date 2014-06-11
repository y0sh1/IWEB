<?php

	function writeContent($contentType, $contentID, $dbLink)
	{
		// Bepaal het type content
		// Haal vervolgens content op uit database en roep functie aan om content te tonen
		switch ($contentType)
		{
			case "tekst":
				$tableName = "tekst";
				$content = getContent($tableName, $contentID, $dbLink);
				writeTekst($content);
				break;
			case "afbeelding":
				$tableName = "afbeelding";
				$content = getContent($tableName, $contentID, $dbLink);
				writeAfbeelding($content);
				break;
		}
	}
	
	function getContent($tableName, $contentID, $dbLink)
	{
		// Haal de content op
		$query = "SELECT * FROM " . $tableName . " WHERE id = " . $contentID;
	 
		// Voer Query uit
		$contentResult = mysql_query($query, $dbLink);
	
		// Controleer resultaat
		if (checkDBResults($contentResult))
		{
			$row = mysql_fetch_assoc($contentResult);
		}
	
		// Geef resources vrij
		mysql_free_result($contentResult);
	
		// Keer terug met content
		return $row;
	}
	
	function writeTekst($content)
	{
		extract($content);
		
		echo '<div class="tekst">';
		if($titel)
		{
			echo '<h1 class="headertitel">'. $titel . '</h1>';
		}
		echo $tekst;
		echo '</div>';
	}
	
	function writeAfbeelding($content)
	{
		extract($content);
		
		echo '<div class="image">';
		if ($url)
		{
			$url = 'img/' . $url;
			echo '<img class="image" onmouseover="alert(navigator.userAgent)"; src="' . $url . '" width="' . $breedte . '" height="' . $hoogte . '" alt="' . $titel . '">';
			echo '<p class="onderschrift">' . $titel . '</p>';
		}
		echo '</div>';
	}

?>