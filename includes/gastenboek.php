<tr>
    <td class="upperleft">
    <center><img src="img/welcome.gif"></center>
    </td>
    <td class="upperright">
    <center><img src="img/gastenboek.gif"></center>
    </td>
</tr>
<?php
if($_POST['name'] AND $_POST['message']){
    $name = mysql_real_escape_string($_POST['name']);
    $message = mysql_real_escape_string($_POST['message']);
    $sqlpost = "INSERT INTO Gastenboek (name, message) VALUES ('$name', '$message')";
    mysql_query($sqlpost);
}
?>
<tr>
    <td class="lowerleft">
        <table>
            <tr>
            <form id="Gastenboekinvoer" name="Gastenboekinvoer" method="post" action="index.php?p=Gastenboek">
                <td>
                Naam:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Bericht:</td>
                <td><input type="text" name="message"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Verzenden"></td>
            </tr>
            </form>
        </table>
    </td>
    <td class="lowerright">
        <?php
            $sql = "SELECT name, message from Gastenboek";
            $uitkomst = mysql_query($sql);

        while($rows=mysql_fetch_array($uitkomst)){
            echo '<table border="1px" width="90%">';
            echo '<tr>';
            echo '<td>' . $rows['name'] .'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>' . $rows['message'] .'</td>';
        echo '</tr>';
        echo '</table>';
        echo '<br>';
        }
        ?>
    </td>
</tr>