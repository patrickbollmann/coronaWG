<?php
include "db.php";
$key = mysqli_real_escape_string($mysqli, $_GET['key']);
$sql = "SELECT * FROM Event WHERE token ='" . $key . "'";
$result = $mysqli->query($sql);
$event = $result->fetch_assoc();
?>
<html>

<head>
    <title>Zur Veranstaltung <?php echo $event["Titel"] ?> anmelden</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>

<body>
    <?php if ($event['Titel'] == '') {
    ?>
        <h1>Veranstaltungslink ungültig</h1>
        <h3>Bitte überprüfen Sie den Link und den Veranstaltungsschlüssel</h3>
    <?php
    } else { ?>
        <div class="container">
            <form action="process.php" method="post" enctype="multipart/form-data">
                <h1>Zur Veranstaltung "<?php echo $event['Titel']; ?>" anmelden</h1>
                <h6>Beschreibung: <?php echo $event['Beschreibung']; ?></h6>
                <h6>Datum: <?php echo date('d M Y', strtotime($event['Datum'])); ?></h6>
                <h6>Start: <?php echo date('H:i', strtotime($event['Datum'])); ?> Uhr</h6>
                <small>Zur Kontaktverfolgung setzen wir bei dieser Veranstaltung auf ein eigenes System auf unserem privaten Server in Deutschland. Die Daten werden 14 Tage nach der Veranstaltung durch uns gelöscht. Im Falle einer Infektion eines Gastes durch das Coronavirus behalten wir uns vor die Daten an das Gesundheitsamt weiterzugeben. Eine Weitergabe der Daten an andere Dritte ist ausgeschlossen. Falls du damit nicht einverstanden bist, ist eine Teilmahme an der Veranstaltung leider nicht möglich. Nur wer seinen Test / Impfnachweis im vorfeld der Party hier hochlädt kann an der Veranstaltung teilnehmen. Testnachweise in Papierform oder auf dem Handy am Abend der Veranstaltung werden NICHT akzeptiert! Der hochgeladene Test darf zu Beginn der Veranstaltung maximal 48 Std. alt sein! Solltest du bereits geimpft sein und noch kein digitales Zertifikat besitzen ist neben dem Upload des Impfpasses dieser im Original während der Veranstaltung mitzuführen. Beim Upload des Impfpasses darf alles, was nicht relevant für die Corona Schutzimpfung ist geschwärzt werden. Diese Bedingungen sind gesetzlich notwendig um eine Party dieser Größe zu ermöglichen.</small>
                <br>
                <br>
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>Vorname:</label> <input class="form-control" name="vorname" type="text">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Nachname:</label> <input class="form-control" name="nachname" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>Straße:</label> <input class="form-control" name="straße" type="text">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Hausnummer:</label> <input class="form-control" name="hausnummer" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>Postleitzahl:</label> <input class="form-control" name="postleitzahl" type="text">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Ort:</label> <input class="form-control" name="ort" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>E-Mail:</label> <input class="form-control" name="email" type="text">
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <label>Telefon:</label> <input class="form-control" name="tel" type="text">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <label>Foto, Screenshot oder Scan des Test- /Impfnachweises:</label> <input class="form-control" type="file" name="file">
                    </div>
                </div>
                <br>
                <input class="form-control" name="eventid" type="hidden" value="<?php echo $event['ID'] ?>">
                <?php
                $secondsUntilEvent = strtotime($event['Datum']) - strtotime("now"); //two days to ensure no one gets an early covid test
                if ($secondsUntilEvent <= 172800) {
                ?>
                    <button class="btn btn-primary mb-3" name="login" type="submit">Ich bin mit den oben genannten Bedingungen einverstanden und möchte mich zu der Veranstaltung anmelden</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-primary mb-3" name="" type="" disabled>Ich bin mit den oben genannten Bedingungen einverstanden und möchte mich zu der Veranstaltung anmelden</button>
                    <br>
                    Die Anmeldung öffnet 48 Std. vor dem Beginn der Veranstaltung
                <?php } ?>
            </form>
        </div>
    <?php } ?>
</body>

</html>