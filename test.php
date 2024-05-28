<?php
include 'config/db.php';

session_start();

// Fetch all contact details from the database
$sql = "SELECT name, company, phone, email FROM contacts";
$result = $conn->query($sql);

$contacts = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $contacts[] = $row;
    }
}

// Delete contact if delete button is clicked
if (isset($_POST['delete'])) {
    $emailToDelete = $_POST['emailToDelete'];
    $sqlDelete = "DELETE FROM contacts WHERE email = '$emailToDelete'";
    if ($conn->query($sqlDelete) === TRUE) {
        echo "Contact deleted successfully";
        // Redirect to refresh the page
        header("Location: contacts.php");
        exit();
    } else {
        echo "Error deleting contact: " . $conn->error;
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
    <title>Contact page</title>


</head>

<body>
    <div class="navigation">
        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="true" href="addcontact.php">Add</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="search">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                    aria-describedby="basic-addon2">
            </div>
        </div>
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th scope="col colcus">Name</th>
                    <th scope="col">Company</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?php echo $contact['name']; ?></td>
                        <td><?php echo $contact['company']; ?></td>
                        <td><?php echo $contact['phone']; ?></td>
                        <td><?php echo $contact['email']; ?></td>
                        <td>
                            <form method="POST" style="display: inline-block;">
                                <input type="hidden" name="emailToDelete" value="<?php echo $contact['email']; ?>">
                                <button type="submit" class="btn btn-danger" name="delete"
                                    onclick="return confirm('Are you sure you want to delete this contact?')">Delete</button>
                            </form>
                            <a href="editcontact.php?email=<?php echo $contact['email']; ?>"
                                class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
</body>

</html>