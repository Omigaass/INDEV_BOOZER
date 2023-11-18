<?php

    include '../PHP/CONFIG.php';

    if (isset($_POST['p_BookHidden'])) {

        $id_livro = $_POST['BOOK_ID'];

        $sql = "UPDATE bz_book SET BOOK_VISIBLE = 1 WHERE BOOK_ID = $id_livro";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert($id_livro); window.location.href = '../HTML/ABRE_CATALOGO.php';</script>";
        } else {
            echo "<script>alert('Erro na atualização: " . $conn->error . "');</script>";
        }
    }

    $conn->close();

?>
