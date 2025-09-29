<?php
require_once('classes/CRUD.php');
$crud = new CRUD;
$select = $crud->select('client');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client List</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Client</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>
        <?php
        foreach ($select as $row) {
        ?>
            <tr>
                <td><a href="client-show.php?id=<?= $row['id'] ?>"><?= $row['name'] ?></a></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['email'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
    <br><br>
    <a href="client-create.php" class="btn">New Client</a>
</body>

</html>