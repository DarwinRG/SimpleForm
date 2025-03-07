<?php
include('server.php');

// Redirect to login if not authenticated
if (!isset($_SESSION['username'])) {
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Data Form</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="header">
        <h2>User Information Form</h2>
        <a href="index.php?logout='1'" class="logout">Logout</a>
    </div>

    <form method="post" action="server.php">
        <div class="input-group">
            <label>Full Name</label>
            <input type="text" name="name" required>
        </div>
        <div class="input-group">
            <label>Age</label>
            <input type="number" name="age" required>
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="input-group">
            <label>Address</label>
            <textarea name="address" required></textarea>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="submit_data">Save Record</button>
        </div>
    </form>

    <div class="records">
        <h3>Stored Records</h3>
        <?php
        $query = "SELECT * FROM records";
        $results = mysqli_query($conn, $query);

        if (mysqli_num_rows($results) > 0) {
            echo "<table>";
            echo "<tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Created</th>
                  </tr>";
            while ($row = mysqli_fetch_assoc($results)) {
                echo "<tr>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['age'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['address'] . "</td>
                        <td>" . $row['created_at'] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-data'>No records found</p>";
        }
        ?>
    </div>
</body>

</html>