<!DOCTYPE html>
<html>
    <head>
        <title>BADANIE</title>
        <meta charset="UTF-8">
    </head>
    <body>
    <?php
        include("connection.php");
        $connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbDatabase)
        or die('Blad polaczenia z serwerem MySQL.<br />'.mysqli_error($connection)); 
        mysqli_set_charset($connection, "utf-8");
    ?>


<?php
			require("connection.php");
			$sql="SET NAMES 'utf8' COLLATE 'utf8_polish_ci'";
			$result = $connection->query($sql);
			// $sql = "select id, laboranci.imie, rosliny.nazwa, powierzchnia.gleba, czas, wysokosc  from wyniki INNER JOIN laboranci on wyniki.id_l=laboranci.id_l INNER JOIN rosliny on wyniki.id_r=rosliny.id_r INNER JOIN wyniki.id_p on wyniki.id_lp=powierzchnia.id_p;";
			// $sql = "select id, laboranci.imie, rosliny.nazwa, powierzchnia.gleba, czas, wysokosc  from wyniki JOIN laboranci on wyniki.id_l=laboranci.id_l JOIN rosliny on wyniki.id_r=rosliny.id_r JOIN wyniki.id_p on wyniki.id_lp=powierzchnia.id_p;";
			// $sql = "select * from wyniki";
			$sql = 'select id, laboranci.imie as imiex, rosliny.nazwa as nazwax, powierzchnia.gleba as glebax, czas as czasx, wysokosc as wysokoscx FROM wyniki JOIN laboranci on wyniki.id_l=laboranci.id_l JOIN rosliny on wyniki.id_r=rosliny.id_r JOIN powierzchnia on wyniki.id_p=powierzchnia.id_p;';
			$result = $connection->query($sql);
			
			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_array())
				{
				echo ''.$row[0].'<br><br><br>Laborant: '.$row['imiex'].'<br>Roslina: '.$row['nazwax'].'<br>Powierzchnia: '.$row['glebax'].'<br>Czas: '.$row['czasx'].'<br>Wzrost: '.$row['wysokoscx'].'<br><br><br>';
				} 
			}
			$connection->close();
		?> 

<br><br> <a href="main.php"><h1>Powrót</h1></a> </br>
</body>
</html>


