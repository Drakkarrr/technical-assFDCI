<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Thank You page</title>

    <style>
        body {
            display: grid;
            place-items: center;
            margin-top: 120px;
        }
    </style>
</head>

<body>
    <h1>Thank you for registering</h1>
    <button class="btn btn-primary" onclick="redirectToContacts()">Continue</button>

    <script>
        function redirectToContacts() {
            window.location.href = 'contacts.php';
        }
    </script>
</body>

</html>