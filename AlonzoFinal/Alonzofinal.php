<?php
session_start();

if (!isset($_SESSION['transactions'])) {
    $_SESSION['transactions'] = array();
}

if (isset($_POST['submit'])) {
    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $price = $_POST['price'];

    $_SESSION['transactions'][] = array('id' => $productID, 'name' => $productName, 'price' => $price);
}

if (isset($_POST['delete'])) {
    $deleteID = $_POST['deleteID'];
    foreach ($_SESSION['transactions'] as $key => $transaction) {
        if ($transaction['id'] == $deleteID) {
            unset($_SESSION['transactions'][$key]);
            break;
        }
    }
}

function displayTransactions() {
    if (!empty($_SESSION['transactions'])) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Grade</th><th>Action</th></tr>";
        foreach ($_SESSION['transactions'] as $transaction) {
            echo "<tr>";
            foreach ($transaction as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "<td><form method='post'><input type='hidden' name='deleteID' value='{$transaction['id']}'><input type='submit' name='delete' value='Delete'></form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Please Enter a transaction.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Lists</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        #content-container {
            text-align: center;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div id="content-container">
        <form method="post" action="">
            Student ID: <input type="text" name="productID"><br><br>
            Name: <input type="text" name="productName"><br><br>
            Grade: <input type="text" name="price"><br><br>
            <input type="submit" name="submit" value="Add Transaction">
        </form>

        <?php displayTransactions(); ?>
    </div>
</body>
</html>
