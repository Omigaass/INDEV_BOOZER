<?php
// Inclua o arquivo de configuração do banco de dados
include 'CONFIG.php';

$OpenAlert = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Recupere os valores do formulário HTML
$type = $_POST['USER_TYPE'];
$cpfcnpj = $_POST['USER_CPFCNPJ'];
$name = $_POST['USER_NAME'];
$email = $_POST['USER_EMAIL'];
$pw = $_POST['USER_PASSWORD'];

// Consulta SQL com prepared statement para evitar SQL injection
$query_select = "SELECT USER_NAME FROM bz_user WHERE USER_NAME = ?";
$session_id_select = "SELECT USER_ID FROM bz_user WHERE USER_EMAIL = ?";
$stmt = $conn->prepare($query_select);
$stmt->bind_param("s", $name); 

// Executar a consulta
$stmt->execute();

// Obter o resultado da consulta
$result = $stmt->get_result();

// Verificar se o usuário já existe
if ($result->num_rows > 0) {
    // Usuário já existe
        echo "<script language='javascript' type='text/javascript'>
        mostrarModal(); AlertMsg = 'Usuário já existe';</script>";
    die();
} else {
    // Usuário não existe, vamos inseri-lo no banco de dados

    // Consulta SQL para inserir usuário
    $query_insert = "INSERT INTO bz_user (USER_TYPE, USER_CPFCNPJ, USER_NAME, USER_PASSWORD, USER_EMAIL) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($query_insert);

    // Hash da senha
    $hashed_password = password_hash($pw, PASSWORD_DEFAULT);

    // Bind dos parâmetros
    $stmt_insert->bind_param("sssss", $type, $cpfcnpj, $name, $hashed_password, $email);

    // Executar a inserção
    if ($stmt_insert->execute()) {
        // Sucesso no cadastro
        $_SESSION['USER_ID'] = $session_id_select;
        echo "<script language='javascript' type='text/javascript'>
        mostrarModal(); 
        window.location.href='../HTML/ABRE_USUARIOS.php';
        AlertMsg = 'Usuário Cadastrado';</script>";
    } else {
        // Erro na inserção
        echo "<script language='javascript' type='text/javascript'>
        mostrarModal();
        AlertMsg = 'Erro ao inserir';</script>";
    }
}

}

// Fechar a conexão
$stmt->close();
$stmt_insert->close();
$conn->close();
?>
