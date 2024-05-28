<?php
include 'config/db.php';

session_start();

// Retrieve contact details based on the provided email
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $sql = "SELECT * FROM contacts WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $contact = $result->fetch_assoc();
    } else {
        echo "Contact not found";
    }
}

// Update contact details if form is submitted
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $company = $_POST['company'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "UPDATE contacts SET name = '$name', company = '$company', phone = '$phone' WHERE email = '$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Contact updated successfully";
        // Redirect to contacts page after update
        header("Location: contacts.php");
        exit();
    } else {
        echo "Error updating contact: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit Contact</title>
</head>

<body>
    <div class="container">
        <h1>Edit Contact</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $contact['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company</label>
                <input type="text" class="form-control" id="company" name="company"
                    value="<?php echo $contact['company']; ?>">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" class="form-control" id="phone" name="phone"
                    value="<?php echo $contact['phone']; ?>">
            </div>
            <input type="hidden" name="email" value="<?php echo $contact['email']; ?>">
            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>