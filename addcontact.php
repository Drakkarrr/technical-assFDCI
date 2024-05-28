<?php
include 'config/db.php';





if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $company = $_POST['company'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if (empty($name) || empty($email) || empty($phone) || empty($company)) {
        echo "All fields are required";
    } else {
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "Email already exists";
        } else {
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, company) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $company);
            if ($stmt->execute()) {
                $_SESSION['email'] = $email;
                header("Location: contacts.php");
                exit();
            } else {
                echo "Adding contact failed";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div class="container">

        <div class="navigation">
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="addcontact.php">add</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacts.php">contacts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Logout</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <form method="POST">
            <h1>Add Contact</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company</label>
                <input type="text" class="form-control" id="company" name="company">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email">
            </div>

            <button type="submit" class="btn btn-primary" name="add">Submit</button>
        </form>
    </div>

</body>

</html>