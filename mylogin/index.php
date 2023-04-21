<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arvieForm</title>
    <link rel="stylesheet"type="text/css" href="style.css">
</head>
<body style="  background: linear-gradient(90deg, #e218c7 0%, #3880b7 100%); ">

<?php
// Connect to database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "database_name";
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];

    // Check if name already exists in database
    $sql = "SELECT * FROM users WHERE firstName='$firstName' AND lastName='$lastName'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Error: Name already exists in database.";
    } else {
        // Add name to database
        $sql = "INSERT INTO users (firstName, lastName) VALUES ('$firstName', '$lastName')";
        if (mysqli_query($conn, $sql)) {
            echo "Name added to database successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Name</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        First Name: <input type="text" name="firstName"><br>
        Last Name: <input type="text" name="lastName"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

</body>
</html>