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
 <h1>Dodaj nowe doświadczenie</h1>
		<br><br>
            <form method="POST">
                   
                <b>Podaj swoje imię:</b>
				<?php
                            $zapytanie = "SELECT * FROM laboranci";
                            $rezultat = mysqli_query($connection, $zapytanie);
                            
                            echo '<select  name="laboranci" id="laboranci">';
                            while($bufor = mysqli_fetch_assoc($rezultat))
                            {
                                echo '<option value='.$bufor['id_l'].'>'.$bufor['imie'].'</option>';
                            }
                            echo "</select>";
                            
                        ?>
				<br><br>
				<b>Podaj glebę na której rosła roślina:</b>
				<?php
                            $zapytanie = "SELECT * FROM powierzchnia";
                            $rezultat = mysqli_query($connection, $zapytanie);
                            
                            echo '<select  name="powierzchnia" id="powierzchnia">';
                            while($bufor = mysqli_fetch_assoc($rezultat))
                            {
                                echo '<option value='.$bufor['id_p'].'>'.$bufor['gleba'].'</option>';
                            }
                            echo "</select>";
                           
                        ?>
				<br><br>
				<b>Podaj nazwę rośliny:</b>
				<?php
                            $zapytanie = "SELECT * FROM rosliny";
                            $rezultat = mysqli_query($connection, $zapytanie);
                            
                            echo '<select  name="rosliny" id="rosliny">';
                            while($bufor = mysqli_fetch_assoc($rezultat))
                            {
                                echo '<option value='.$bufor['id_r'].'>'.$bufor['nazwa'].'</option>';
                            }
                            echo "</select>";
                           
                        ?>
						<br>
                <br><b>Podaj czas:</b>
                        <input type="text" id="czas" name="czas" placeholder="Czas wzrostu" required><br>
				<br><b>Podaj wysokość:</b>
                        <input type="text" id="wysokosc" name="wysokosc" placeholder="Wysokość" required><br>
                <br><button type="submit">Dodaj Rekord</button>
                </form>
           <br><br> <a href="main.php"><h1>Powrót</h1></a> </br>
            <?php
                if(isset($_POST["laboranci"])&&isset($_POST["powierzchnia"])&&isset($_POST["rosliny"])&&isset($_POST["czas"])&&isset($_POST["wysokosc"])){
                    
                    $laboranci = $_POST["laboranci"];
                    $powierzchnia = $_POST["powierzchnia"];
					$rosliny = $_POST["rosliny"];
                    $czas = $_POST["czas"];
					$wysokosc = $_POST["wysokosc"];
                    $query = "insert into wyniki(id_l, id_p, id_r, wysokosc, czas) values (?, ?, ?, ?, ?)";
                    $statement = $connection->prepare($query);
					$statement->bind_param("sssii", $laboranci, $powierzchnia, $rosliny, $czas, $wysokosc);
					$laboranci = $connection->real_escape_string($laboranci);
                    $powierzchnia = $connection->real_escape_string($powierzchnia);
					$rosliny = $connection->real_escape_string($rosliny);
					$czas = $connection->real_escape_string($czas);
					$wysokosc = $connection->real_escape_string($wysokosc);
                    $statement->execute();         
                    $statement->close();
                }
                
                mysqli_close($connection); 
            ?>
    </body>
</html>
