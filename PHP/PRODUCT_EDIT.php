<?php

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['EditID'])) {
    $EditID = $_POST['EditID'];
    error_log("Recebida solicitação para editar o livro com ID: " . $EditID);
    
    $conn = new PDO("mysql:host=127.0.0.1;dbname=boozer_db", "root", "");
    
    $stmt = $conn->prepare("SELECT BOOK_TITULO, BOOK_AUTOR, BOOK_EDITORA, BOOK_ANO_PUBLICACAO, BOOK_PRECO, BOOK_PRECO_DESC, BOOK_GENERO, BOOK_CLASSIFICACAO, BOOK_IDIOMA, BOOK_FORMATO, BOOK_DISPONIBILIDADE, BOOK_PUBLICO_ALVO FROM bz_book WHERE BOOK_ID = :id");
    $stmt->bindParam(':id', $EditID, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("Dados do livro recuperados com sucesso: " . json_encode($dados));
        echo json_encode($dados);
    } else {
        $error_message = "Erro ao buscar dados";
        error_log($error_message);
        echo json_encode(["message" => $error_message]);
        http_response_code(500);
    }
}
?>