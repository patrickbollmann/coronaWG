<?php
include "db.php";
$sql = "SELECT * FROM Event WHERE ID ='".$_GET['id']."'";
$eventresult = $mysqli->query($sql);
$event=$eventresult->fetch_assoc();
$sql = "SELECT * FROM User WHERE Event ='".$_GET['id']."'";
$userresult = $mysqli->query($sql);
?>

<html>

<head>
    <title>Pohlweg 64A Eventplanner</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <h1><?php echo $event['Titel']?></h1>
        <br>
        <p><b>Beschreibung:</b> <?php echo $event['Beschreibung']?></p>
        <p><b>Datum / Uhrzeit:</b> <?php echo $event['Datum']?></p>

        <br>
        <h2> Angemeldete Teilnehmer </h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <td><b>Name</b></td>
                    <td><b>Adresse</b></td>
                    <td><b>Email</b></td>
                    <td><b>Telefonnummer</b></td>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($user = $userresult->fetch_assoc()) :
                ?>
                    <tr>
                        <td><?php echo $user["Vorname"]." ".$user["Nachname"] ?></td>
                        <td><?php echo $user["Straße"]." ".$user["Hausnummer"]. ", ".$user["Postleitzahl"]." ".$user["Ort"] ?></td>
                        <td><?php echo $user["Email"] ?></td>
                        <td><?php echo $user["Telefon"] ?></td>
                    </tr>
                <?php endwhile; ?>


            </tbody>
        </table>
    </div>
</body>

</html>