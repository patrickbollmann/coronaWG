<?php
include "db.php";
if (isset($_POST['login'])) {
    if ($_POST['vorname'] == null or $_POST['nachname'] == null or $_POST['straße'] == null or $_POST['hausnummer'] == null or $_POST['postleitzahl'] == null or $_POST['ort'] == null or $_POST['email'] == null or $_POST['tel'] == null) {
        echo "Bitte alle Felder ausfüllen";
    } else {
        $timestamp = strtotime("now");
        // File upload path
        $uploadOK = false;
        $targetDir = "fileUpload/";
        $fileName = basename($_FILES["file"]["name"]);
        $fileType = pathinfo($targetDir . $fileName, PATHINFO_EXTENSION);
        $targetFilePath = $targetDir . "Test_" . $_POST['vorname'] . "_" . $_POST['nachname'] . "_" . $timestamp . "." . $fileType;

        //File Upload
        if (!empty($_FILES["file"]["name"])) {
            // Upload file to server
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {

                //file uploaded successfully
                $uploadOK = true;
            } else {
                //error uploading
                echo "Fehler beim upload des Testnachweises. Ist die Datei zu groß? Bitte wenden Sie sich an den Veranstalter\r\n";
            }
        } else {
            //no file selected
            echo "Es wurde kein Testnachweis ausgewählt\r\n";
        }


        //if upload ok insert user in database
        if ($uploadOK == true) {
            $sql = "INSERT INTO User (Vorname, Nachname, Straße, Hausnummer, Postleitzahl, Ort, Email, Telefon, Event, File) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysqli->stmt_init();

            if ($stmt->prepare($sql)) {
                $stmt->bind_param("ssssssssis", $_POST['vorname'], $_POST['nachname'], $_POST['straße'], $_POST['hausnummer'], $_POST['postleitzahl'], $_POST['ort'], $_POST['email'], $_POST['tel'], $_POST['eventid'], $targetFilePath);
                $OK = $stmt->execute();

                if ($OK) {

?>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
                    <h1>Du hast dich erfolgreich zu der Veranstaltung angemeldet!</h1>
                    <br><br>

                    <?php
                    $sql = "SELECT * FROM Event WHERE ID ='" . $_POST['eventid'] . "'";
                    $eventresult = $mysqli->query($sql);
                    $event = $eventresult->fetch_assoc();
                    if ($event["Payment"] != "") {
                    ?>

                        Möchtest du die Spende direkt Online Zahlen? Dann musst du bei der Party kein Bargeld mirbringen.
                        <br>
                        <a href="<?php echo $event["Payment"] ?>" class="btn btn-success">Mit paypal online bezahlen</a>
                        <br>
                        <br>
                        <a href="haha-yes.jpg" class="btn btn-danger">Barzahlung am Abend der Party</a>

                    <?php } ?>


<?php
                } else {
                    echo "Etwas ist schiefgelaufen.." . "\r\n";
                    echo $stmt->error . "\r\n";
                }
            }
        }
    }
}
if (isset($_POST['newEvent'])) {
    if ($_POST['titel'] == null or $_POST['datetime'] == null or $_POST['beschreibung'] == null) {
        echo "Bitte alle Felder ausfüllen";
    } else {

        $datum = date("Y-m-d H:i:s", strtotime($_POST['datetime']));
        $token = md5(strval(rand()) . date('Y-m-d'));
        $sql = "INSERT INTO Event (Titel, Datum, Beschreibung, token, Payment VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqli->stmt_init();

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("sssss", $_POST['titel'], $datum, $_POST['beschreibung'], $token, $_POST['payment']);
            $OK = $stmt->execute();

            if ($OK) {
                echo "Veranstaltung erfolgreich erstellt\r\n";
                header("Location: index.php");
            } else {
                echo "Etwas ist schiefgelaufen.." . "\r\n";
                echo $stmt->error . "\r\n";
            }
        }
    }
}
if (isset($_POST['editEvent'])) {
    if ($_POST['titel'] == null or $_POST['datetime'] == null or $_POST['beschreibung'] == null) {
        echo "Bitte alle Felder ausfüllen";
    } else {
        $datum = date("Y-m-d H:i:s", strtotime($_POST['datetime']));
        $sql = "Update Event Set Titel = ?, Datum=?, Beschreibung=?, Payment=? WHERE ID =?";
        $stmt = $mysqli->stmt_init();

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("sssss", $_POST['titel'], $datum, $_POST['beschreibung'], $_POST['payment'], $_POST['id']);
            $OK = $stmt->execute();

            if ($OK) {
                echo "Veranstaltung erfolgreich bearbeitet\r\n";
                header("Location: index.php");
            } else {
                echo "Etwas ist schiefgelaufen.." . "\r\n";
                echo $stmt->error . "\r\n";
            }
        }
    }
}
