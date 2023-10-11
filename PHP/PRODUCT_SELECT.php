<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boozer_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão com o banco de dados foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Inicialização de variáveis de filtro (você pode obtê-las de um formulário)
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$precoMin = isset($_GET['preco_min']) ? $_GET['preco_min'] : '';
$precoMax = isset($_GET['preco_max']) ? $_GET['preco_max'] : '';

// Construção da consulta SQL com base nos filtros ativos
$sql = "SELECT * FROM produtos WHERE 1=1";

if (!empty($nome)) {
    $sql .= " AND nome LIKE '%$nome%'";
}

if (!empty($categoria)) {
    $sql .= " AND categoria = '$categoria'";
}

if (!empty($precoMin)) {
    $sql .= " AND preco >= $precoMin";
}

if (!empty($precoMax)) {
    $sql .= " AND preco <= $precoMax";
}

// Execução da consulta
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    // Loop para exibir os resultados
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nome: " . $row["nome"] . " - Categoria: " . $row["categoria"] . " - Preço: " . $row["preco"] . "<br>";
    }
} else {
    echo "Nenhum resultado encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
