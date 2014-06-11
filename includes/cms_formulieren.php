<?php
	function maakTekstFormulier($content)
	{
		extract($content);
?>
		<tr>
			<td>ID Content: </td>
			<td><input type="text" size="5" readonly="readonly" value="<?php echo $id; ?>"></td>
		</tr>
		<tr>
			<td>Titel: </td>
			<td><input type="text" size="60" name="titel" value="<?php echo $titel; ?>"></td>
		</tr>
		<tr>
			<td colspan="2">
				Tekst: <br>
				<textarea cols="80" rows="25" name="tekst"><?php echo $tekst; ?></textarea>
			</td>
		</tr>
<?php
	}

	function maakAfbeeldingFormulier($content)
	{
		extract($content);
?>
		<tr>
			<td>ID Content: </td>
			<td><input type="text" size="5" readonly="readonly" value="<?php echo $id; ?>"></td>
		</tr>
		<tr>
			<td>Titel: </td>
			<td><input type="text" size="60" name="titel" value="<?php echo $titel; ?>"></td>
		</tr>
		<tr>
			<td>URL: </td>
			<td><input type="text" size="60" name="url" value="<?php echo $url; ?>"></td>
		</tr>
		<tr>
			<td>Breedte: </td>
			<td><input type="text" size="5" name="breedte" value="<?php echo $breedte; ?>"></td>
		</tr>
		<tr>
			<td>Hoogte: </td>
			<td><input type="text" size="5" name="hoogte" value="<?php echo $hoogte; ?>"></td>
		</tr>

    <?php
    }

function maakPlaceKittenFormulier($content)
{
    extract($content);
    ?>
    <tr>
        <td>Titel: </td>
        <td><input type="text" size="60" name="titel" value="<?php echo $titel; ?>"></td>
    </tr>
    <tr>
        <td>Breedte: </td>
        <td><input type="text" size="5" name="breedte" value="<?php echo $breedte; ?>"></td>
    </tr>
    <tr>
        <td>Hoogte: </td>
        <td><input type="text" size="5" name="hoogte" value="<?php echo $hoogte; ?>"></td>
    </tr>
<?php
	}
	
	function maakPaginaFormulier($content)
	{
		global $contentTypes, $contentDBTabel;
		
		extract($content);
?>
		<tr>
			<td>Positie in menu: </td>
			<td><input type="text" size="5" name="nr" value="<?php echo $nr; ?>"></td>
		</tr>
		<tr>
			<td>Naam in database: </td>
			<td><input type="text" size="60" name="naam" value="<?php echo $naam; ?>"></td>
		</tr>
		<tr>
			<td>Naam in menu: </td>
			<td><input type="text" size="60" name="navtitel" value="<?php echo $navtitel; ?>"></td>
		</tr>
		<tr>
			<td valign="top">Tonen in menu?: </td>
			<td>
<?php
				if ($navitem == 'ja') {
					echo '<input type="radio" name="navitem" value="ja" checked="checked" /> Ja<br />';
					echo '<input type="radio" name="navitem" value="nee" /> Nee';
				}
				else
				{
					echo '<input type="radio" name="navitem" value="ja" /> Ja<br />';
					echo '<input type="radio" name="navitem" value="nee" checked="checked" /> Nee';
				}
?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td></td>
		</tr>

		<tr>
			<td>Type content linksboven: </td>
			<td>
				<select name="vlak1_type">
<?php						
					foreach ($contentTypes as $contentType) 
					{
						// op een pagina mogen geen andere pagina's geplaatst worden, alleen andere contenttypes
						if ($contentType != 'pagina\'s')
						{
							if ($contentDBTabel[$contentType] == $vlak1_type)
							{
								echo '<option value="' . $contentDBTabel[$contentType] . '" selected="selected">' . $contentType . '</option>';
							}
							else
							{
								echo '<option value="' . $contentDBTabel[$contentType] . '">' . $contentType . '</option>';
							}
						}
					}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td>ID Content linksboven: </td>
			<td><input type="text" size="5" name="vlak1_link" value="<?php echo $vlak1_link; ?>"></td>
		</tr>

			<td>Type content rechtsboven: </td>
			<td>
				<select name="vlak2_type">
<?php						
					foreach ($contentTypes as $contentType) 
					{
						// op een pagina mogen geen andere pagina's geplaatst worden, alleen andere contenttypes
						if ($contentType != 'pagina\'s')
						{
							if ($contentDBTabel[$contentType] == $vlak2_type)
							{
								echo '<option value="' . $contentDBTabel[$contentType] . '" selected="selected">' . $contentType . '</option>';
							}
							else
							{
								echo '<option value="' . $contentDBTabel[$contentType] . '">' . $contentType . '</option>';
							}
						}
					}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td>ID Content rechtsboven: </td>
			<td><input type="text" size="5" name="vlak2_link" value="<?php echo $vlak2_link; ?>"></td>
		</tr>

			<td>Type content linksonder: </td>
			<td>
				<select name="vlak3_type">
<?php						
					foreach ($contentTypes as $contentType) 
					{
						// op een pagina mogen geen andere pagina's geplaatst worden, alleen andere contenttypes
						if ($contentType != 'pagina\'s')
						{
							if ($contentDBTabel[$contentType] == $vlak3_type)
							{
								echo '<option value="' . $contentDBTabel[$contentType] . '" selected="selected">' . $contentType . '</option>';
							}
							else
							{
								echo '<option value="' . $contentDBTabel[$contentType] . '">' . $contentType . '</option>';
							}
						}
					}
?>
				</select>
			</td>
		</tr>
		<tr>
			<td>ID Content linksonder: </td>
			<td><input type="text" size="5" name="vlak3_link" value="<?php echo $vlak3_link; ?>"></td>
		</tr>
		<tr>
			<td>Type content rechtsonder: </td>

			<td>
				<script type="text/javascript">
					function updateSelectBox()
					{
						var selectBox = document.getElementById("vlak4Type"); 
						window.alert(vlak4Type.text);";
					}
				</script>
			<select name="vlak4_type" id="vlak4Type" onchange="javascript:updateSelectBox();">
<?php
						
					foreach ($contentTypes as $contentType) 
					{
						// op een pagina mogen geen andere pagina's geplaatst worden, alleen andere contenttypes
						if ($contentType != 'pagina\'s')
						{
							if ($contentDBTabel[$contentType] == $vlak4_type)
							{
								echo '<option value="' . $contentDBTabel[$contentType] . '" selected="selected">' . $contentType . '</option>';
							}
							else
							{
								echo '<option value="' . $contentDBTabel[$contentType] . '">' . $contentType . '</option>';
							}
						}
					}
?>

				</select>
				
			</td>
		</tr>
		<tr>
			<td>ID Content rechtsonder: </td>
			<td>
				<input type="text" size="5" name="vlak4_link" value="<?php echo $vlak4_link; ?>"></td>	
			</td>
		</tr>

<?php

	}
?>