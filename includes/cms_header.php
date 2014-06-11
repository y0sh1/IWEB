<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Content Management Systeem</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
<link rel="stylesheet" href="../css/styles.css" type="text/css" >
<link rel="stylesheet" href="../css/cms_styles.css" type="text/css" >

<!-- initialiseren van de TinyMCE rich text editor -->
<script type="text/javascript" src="../scripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript"src="../scripts/initTiny_mce.js"></script>
<!-- /TinyMCE -->

</head>

<body class="body">

<table class="main">
<tr>
	<td colspan="2" class="nav">
		Bewerk:&nbsp;


<?php
	// maak navigatie met voor elk beschikbaar contenttype een link om deze te kunnen bewerken
	foreach ($contentTypes as $navItem) 
	{
		if ($section == $navItem)
		{
			$navClass = "navlinkselected";
		}
		else
		{
			$navClass = "navlink";
		}
		echo '<a class="' . $navClass . '" href="cms.php?p=' . urlencode($navItem) . '">' . $navItem . '</a>';
	}
?>

	</td>
</tr>
