<!doctype html>
<html lang="de">
<title>Neues Event</title>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <h1>Neues Event erstellen</h1>
        <br>
        <form action="process.php" method="post">
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <label>Titel:</label> <input class="form-control" name="titel" type="text">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label>Datum / Uhrzeit:</label> <input class="form-control" name="datetime" type="datetime-local">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12 mb-3">
                    <label>Beschreibung:</label> <input class="form-control" name="beschreibung" type="text">
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <label>Link zur online Zahlung (optional):</label> <input class="form-control" name="payment" type="text">
                </div>
            </div>
            <br>
            <button class="btn btn-info" name="newEvent" type="submit">Event erstellen</button>
    </div>
    </form>
    </div>
</body>

</html>