<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thalitinha";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    $imageData = mysqli_real_escape_string($conn, $imageData);

    $sql = "INSERT INTO images (image_data) VALUES ('$imageData')";
    if ($conn->query($sql) === TRUE) {
        echo "Upload da imagem realizado com sucesso!";
    } else {
        echo "Erro ao fazer upload da imagem: " . $conn->error;
    }

    header("Location: index.html"); // Redireciona para o index
    exit(); // Encerra o script após o redirecionamento
}

$conn->close();
?>