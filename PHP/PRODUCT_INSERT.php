<?php
include_once "../PHP/CONFIG.php";

function VerificarLivroExistente($conn, $titulo) {
    $sql = "SELECT * FROM bz_book WHERE BOOK_TITULO = ?";
    $stmt = mysqli_stmt_init($conn);
    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        return "Erro";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $titulo);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $book = mysqli_fetch_assoc($result);
        
        if ($book) {
            return "Existente";
        } else {
            return "Não Existente";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $BOOK_TITULO_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_TITULO_CREATE']);
    $BOOK_AUTOR_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_AUTOR_CREATE']);
    $BOOK_EDITORA_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_EDITORA_CREATE']);
    $BOOK_ANO_PUBLICACAO_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_ANO_PUBLICACAO_CREATE']);
    $BOOK_PRECO_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_PRECO_CREATE']);
    $BOOK_PRECO_DESC_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_PRECO_DESC_CREATE']);
    $BOOK_GENERO_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_GENERO_CREATE']);
    $BOOK_CLASSIFICACAO_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_CLASSIFICACAO_CREATE']);
    $BOOK_IDIOMA_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_IDIOMA_CREATE']);
    $BOOK_FORMATO_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_FORMATO_CREATE']);
    $BOOK_DISPONIBILIDADE_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_DISPONIBILIDADE_CREATE']);
    $BOOK_PUBLICO_ALVO_CREATE = mysqli_real_escape_string($conn, $_POST['BOOK_PUBLICO_ALVO_CREATE']);

    $result = VerificarLivroExistente($conn, $BOOK_TITULO_CREATE);

    if ($result == "Existente") {
        OpenAlert("Livro com este título já existe");
        echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_CATALOGO.php";</script>';
    } else if ($result == "Não Existente") {
        $sql = "INSERT INTO bz_book (BOOK_TITULO, BOOK_AUTOR, BOOK_EDITORA, BOOK_ANO_PUBLICACAO, BOOK_PRECO, BOOK_PRECO_DESC, BOOK_GENERO, BOOK_CLASSIFICACAO, BOOK_IDIOMA, BOOK_FORMATO, BOOK_DISPONIBILIDADE, BOOK_PUBLICO_ALVO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $BOOK_TITULO_CREATE, $BOOK_AUTOR_CREATE, $BOOK_EDITORA_CREATE, $BOOK_ANO_PUBLICACAO_CREATE, $BOOK_PRECO_CREATE, $BOOK_PRECO_DESC_CREATE, $BOOK_GENERO_CREATE, $BOOK_CLASSIFICACAO_CREATE, $BOOK_IDIOMA_CREATE, $BOOK_FORMATO_CREATE, $BOOK_DISPONIBILIDADE_CREATE, $BOOK_PUBLICO_ALVO_CREATE);
            
            $insertResult = mysqli_stmt_execute($stmt);

            if ($insertResult) {
                OpenAlert("Livro cadastrado com sucesso");
                echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_CATALOGO.php";</script>';
            } else {
                OpenAlert("Erro ao inserir o livro");
                echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_CATALOGO.php";</script>';
            }
        } else {
            OpenAlert("Erro na preparação da consulta SQL");
            echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_CATALOGO.php";</script>';
        }
        mysqli_stmt_close($stmt);
    } else {
        OpenAlert("Erro ao verificar o livro");
        echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_CATALOGO.php";</script>';
    }

    mysqli_close($conn);
}

function OpenAlert($message) {
    echo "<script>alert('$message');</script>";
}
?>
