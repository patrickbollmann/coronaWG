<?php
include "db.php";
$sql = "SELECT * FROM Event ORDER BY Datum DESC";
$eventresult = $mysqli->query($sql);
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
        <h1>Bevorstehende Veranstaltungen:</h1>
        <br>
        <form method="get" action="newEvent.php">
            <button class="btn btn-info" type="submit">Neue Veranstaltung erstellen</button>
        </form>
        <br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <td><b>Titel</b></td>
                    <td><b>Datum / Uhrzeit</b></td>
                    <td><b>Einladungslink</b></td>
                    <td><b>Details anzeigen</b></td>
                    <td><b>Bearbeiten</b></td>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($events = $eventresult->fetch_assoc()) :
                ?>
                    <tr>
                        <td><?php echo $events["Titel"] ?></td>
                        <td><?php echo $events["Datum"] ?></td>
                        <td><a href="https://mobilofix.de/coronawg/login.php?key=<?php echo $events["token"] ?>">https://mobilofix.de/coronawg/login.php?key=<?php echo $events["token"] ?></a></td>
                        <td><a href=<?php echo "eventInfo.php?id=" . $events['ID']  ?> class="btn btn-info">Details</a> </td>
                        <td><a href=<?php echo "editEvent.php?id=" . $events['ID']  ?> class="btn btn-warning">Bearbeiten</a> </td>
                    </tr>
                <?php endwhile; ?>


            </tbody>
        </table>
    </div>
</body>

</html>