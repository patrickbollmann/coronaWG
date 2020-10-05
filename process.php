<?php
include "db.php";
if (isset($_POST['login'])) {
    if ($_POST['vorname'] == null or $_POST['nachname'] == null or $_POST['straße'] == null or $_POST['hausnummer'] == null or $_POST['postleitzahl'] == null or $_POST['ort'] == null or $_POST['email'] == null or $_POST['tel'] == null) {
        echo "Bitte alle Felder ausfüllen";
    } else {
        $sql = "INSERT INTO User (Vorname, Nachname, Straße, Hausnummer, Postleitzahl, Ort, Email, Telefon, Event) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->stmt_init();

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("ssssssssi", $_POST['vorname'], $_POST['nachname'], $_POST['straße'], $_POST['hausnummer'], $_POST['postleitzahl'], $_POST['ort'], $_POST['email'], $_POST['tel'], $_POST['eventid']);
            $OK = $stmt->execute();

            if ($OK) {
                echo "<h2>Sie haben sich erfolgreich zu der Veranstaltung angemeldet</h2>";
            } else {
                echo "Etwas ist schiefgelaufen.." . "\r\n";
                echo $stmt->error . "\r\n";
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
        $sql = "INSERT INTO Event (Titel, Datum, Beschreibung, token) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->stmt_init();

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("ssss", $_POST['titel'], $datum, $_POST['beschreibung'], $token);
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
        echo "edit";

        $datum = date("Y-m-d H:i:s", strtotime($_POST['datetime']));
        $sql = "Update Event Set Titel = ?, Datum=?, Beschreibung=? WHERE ID =?";
        $stmt = $mysqli->stmt_init();

        if ($stmt->prepare($sql)) {
            $stmt->bind_param("ssss", $_POST['titel'], $datum, $_POST['beschreibung'], $_POST['id']);
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