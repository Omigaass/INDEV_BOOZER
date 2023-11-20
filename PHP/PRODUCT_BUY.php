<?php

include_once "../PHP/CONFIG.php";

$user_index = $_POST['user_index'];
$book_index = $_POST['button_index'];

$sql = "INSERT INTO bz_buy (USER_ID, BOOK_ID) VALUES ('$user_index', '$book_index')";

if ($conn->query($sql) === TRUE) {
    echo "Adicionado com sucesso!";
} else {
    echo "Erro ao registrar a venda: " . $conn->error;
}

// Fechar a conexão
$conn->close();
?>
