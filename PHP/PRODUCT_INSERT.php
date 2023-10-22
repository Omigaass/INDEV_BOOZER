<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "boozer_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Coleta os dados do formulário
    $titulo = $_POST['BOOK_TITULO'];
    $autor = $_POST['BOOK_AUTOR'];
    $editora = $_POST['BOOK_EDITORA'];
    $ano_publicacao = $_POST['BOOK_ANO_PUBLICACAO'];
    $preco = $_POST['BOOK_PRECO'];
    $preco_desc = $_POST['BOOK_PRECO_DESC'];
    $genero = $_POST['BOOK_GENERO'];
    $classificacao = $_POST['BOOK_CLASSIFICACAO'];
    $idioma = $_POST['BOOK_IDIOMA'];
    $formato = $_POST['BOOK_FORMATO'];
    $disponibilidade = $_POST['BOOK_DISPONIBILIDADE'];
    $publico_alvo = $_POST['BOOK_PUBLICO_ALVO'];

    // Inserção na tabela de livros
    $sql = "INSERT INTO bz_book (BOOK_TITULO, BOOK_AUTOR, BOOK_EDITORA, BOOK_ANO_PUBLICACAO, BOOK_PRECO, BOOK_PRECO_DESC, BOOK_GENERO, BOOK_CLASSIFICACAO, BOOK_IDIOMA, BOOK_FORMATO, BOOK_DISPONIBILIDADE, BOOK_PUBLICO_ALVO) VALUES ('$titulo', '$autor', '$editora', '$ano_publicacao', '$preco', '$preco_desc', '$genero', '$classificacao', '$idioma', '$formato', '$disponibilidade', '$publico_alvo')";

    if ($conn->query($sql) === TRUE) {
        $livro_id = $conn->insert_id; // Obtém o ID do livro recém-inserido
    } else {
        echo "Erro na inserção de livros: " . $conn->error;
    }

    // Inserção da imagem na tabela de imagens
    if (isset($_FILES['BOOK_IMAGE']) && $_FILES['BOOK_IMAGE']['error'] === UPLOAD_ERR_OK) {
        $imagem = file_get_contents($_FILES['BOOK_IMAGE']['tmp_name']);
        $imagem = $conn->real_escape_string($imagem);

        $sql = "INSERT INTO bz_image (IMG_INFO) VALUES ('$imagem')";

        if ($conn->query($sql) === TRUE) {
            $imagem_id = $conn->insert_id; // Obtém o ID da imagem recém-inserida
        } else {
            echo "Erro na inserção de imagens: " . $conn->error;
        }

        // Vincula a imagem ao livro usando a chave estrangeira
        $sql = "UPDATE livros SET IMG_ID = $imagem_id WHERE BOOK_ID = $livro_id";
        if ($conn->query($sql) === TRUE) {
            echo "Livro e imagem inseridos com sucesso!";
        } else {
            echo "Erro na vinculação da imagem ao livro: " . $conn->error;
        }
    }

    $conn->close();
?>
