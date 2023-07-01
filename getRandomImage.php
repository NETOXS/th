<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thalitinha";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT id, image_data FROM images ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageData = base64_encode($row["image_data"]);
    $response = array(
        'id' => $row["id"],
        'image' => $imageData
    );
    echo json_encode($response);
} else {
    echo json_encode(null);
}

$conn->close();
?>