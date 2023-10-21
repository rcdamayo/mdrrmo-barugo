<?php
// Connect to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$database = "disaster_ready";

$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the data in the database
$success = true; // Flag to track if the update was successful

if (isset($_POST['level']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $levels = $_POST['level'];
    $latitudes = $_POST['latitude'];
    $longitudes = $_POST['longitude'];

    for ($i = 0; $i < count($levels); $i++) {
        $level = $conn->real_escape_string($levels[$i]);
        $latitude = $conn->real_escape_string($latitudes[$i]);
        $longitude = $conn->real_escape_string($longitudes[$i]);
        $id = $i + 1; // Assuming the id starts from 1 and increments by 1 for each row

        $sql = "UPDATE map_markers SET level='$level', latitude='$latitude', longitude='$longitude' WHERE id='$id'";

        if ($conn->query($sql) !== true) {
            $success = false;
            break;
        }
    }
}

if ($success) {
    echo "Records updated successfully";
} else {
    echo "Error updating records";
}

$conn->close();
?>

