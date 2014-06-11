<?php

	// lijst met de leesbare namen van de verschillende contenttypes (namen zoals die aan de gebruiker worden getoond)
	$contentTypes = array('pagina\'s', 'tekst', 'afbeeldingen', 'placekitten');
	
	// lijst met de naam van de database tabel per contenttype
	// de leesbare naam is de index van de array
	$contentDBTabel = array('pagina\'s' => 'paginas', 'tekst' => 'tekst', 'afbeeldingen' => 'afbeelding', 'placekitten' => 'placekitten');
	
	// geef per contenttype aan, welk database veld de primary key bevat
	// de leesbare naam is de index van de array
	$contentPrimaryKey = array('pagina\'s' => 'naam', 'tekst' => 'id', 'afbeeldingen' => 'id', 'placekitten' => 'id');

	// geef per contenttype aan, welk database veld de omschrijving / titel bevat
	// de leesbare naam is de index van de array
	$contentNaam = array('pagina\'s' => 'navtitel', 'tekst' => 'titel', 'afbeeldingen' => 'titel', 'placekitten' => 'titel');
	
?>