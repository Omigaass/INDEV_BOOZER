<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boozer_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão com o banco de dados falhou: " . $conn->connect_error);
}

$product_select = "";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $whereConditions = array();

    // Título do Livro
    $bookTitle = $_POST["BOOK_TITULO"];
    if (!empty($bookTitle)) {
        $whereConditions[] = "BOOK_TITULO LIKE '%" . $bookTitle . "%'";
    }

    // Nome do Autor
    $bookAuthor = $_POST["BOOK_AUTOR"];
    if (!empty($bookAuthor)) {
        $whereConditions[] = "BOOK_AUTOR LIKE '%" . $bookAuthor . "%'";
    }

    // Nome da Editora
    $bookEditor = $_POST["BOOK_EDITORA"];
    if (!empty($bookEditor)) {
        $whereConditions[] = "BOOK_EDITORA LIKE '%" . $bookEditor . "%'";
    }

    // Ano de Publicação
    $yearStart = $_POST["BOOK_ANO_PUBLICACAO_INI"];
    $yearEnd = $_POST["BOOK_ANO_PUBLICACAO_FIN"];
    if (!empty($yearStart) && !empty($yearEnd)) {
        $whereConditions[] = "BOOK_ANO_PUBLICACAO BETWEEN '" . $yearStart . "' AND '" . $yearEnd . "'";
    }

    // Preço
    $priceMin = $_POST["BOOK_PRECO_MIN"];
    $priceMax = $_POST["BOOK_PRECO_MAX"];
    if (!empty($priceMin) && !empty($priceMax)) {
        $whereConditions[] = "BOOK_PRECO BETWEEN " . $priceMin . " AND " . $priceMax;
    }

    // Gênero
    if (isset($_POST["BOOK_GENERO"])) {
        $selectedGenres = $_POST["BOOK_GENERO"];
        $genreConditions = array();
        foreach ($selectedGenres as $genre) {
            $genreConditions[] = "BOOK_GENERO = '" . $genre . "'";
        }
        $genreClause = "(" . implode(" OR ", $genreConditions) . ")";
        $whereConditions[] = $genreClause;
    }

    // Classificação
    if (isset($_POST["BOOK_CLASSIFICACAO"])) {
        $selectedRatings = $_POST["BOOK_CLASSIFICACAO"];
        $ratingConditions = array();
        foreach ($selectedRatings as $rating) {
            $ratingConditions[] = "BOOK_CLASSIFICACAO = '" . $rating . "'";
        }
        $ratingClause = "(" . implode(" OR ", $ratingConditions) . ")";
        $whereConditions[] = $ratingClause;
    }

    // Idioma
    if (isset($_POST["BOOK_IDIOMA"])) {
        $selectedLanguages = $_POST["BOOK_IDIOMA"];
        $languageConditions = array();
        foreach ($selectedLanguages as $language) {
            $languageConditions[] = "BOOK_IDIOMA = '" . $language . "'";
        }
        $languageClause = "(" . implode(" OR ", $languageConditions) . ")";
        $whereConditions[] = $languageClause;
    }

    // Formato
    if (isset($_POST["BOOK_FORMATO"])) {
        $selectedFormats = $_POST["BOOK_FORMATO"];
        $formatConditions = array();
        foreach ($selectedFormats as $format) {
            $formatConditions[] = "BOOK_FORMATO = '" . $format . "'";
        }
        $formatClause = "(" . implode(" OR ", $formatConditions) . ")";
        $whereConditions[] = $formatClause;
    }

    // Disponibilidade
    if (isset($_POST["BOOK_DISPONIBILIDADE"])) {
        $selectedAvailability = $_POST["BOOK_DISPONIBILIDADE"];
        $availabilityConditions = array();
        foreach ($selectedAvailability as $availability) {
            $availabilityConditions[] = "BOOK_DISPONIBILIDADE = '" . $availability . "'";
        }
        $availabilityClause = "(" . implode(" OR ", $availabilityConditions) . ")";
        $whereConditions[] = $availabilityClause;
    }

    // Público-Alvo
    if (isset($_POST["BOOK_PUBLICO_ALVO"])) {
        $selectedAudience = $_POST["BOOK_PUBLICO_ALVO"];
        $audienceConditions = array();
        foreach ($selectedAudience as $audience) {
            $audienceConditions[] = "BOOK_PUBLICO_ALVO = '" . $audience . "'";
        }
        $audienceClause = "(" . implode(" OR ", $audienceConditions) . ")";
        $whereConditions[] = $audienceClause;
    }

    // Constrói a cláusula WHERE
    $whereClause = implode(" AND ", $whereConditions);

    // Query SELECT
    $selectQuery = "SELECT * FROM bz_book";
    if (!empty($whereClause)) {
        $selectQuery .= " WHERE " . $whereClause;
    }

    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Processa os resultados da consulta
            $product_select .= '<div class="object_shield"><div class="object_image_shield"><img src="' . $row["IMG_ID"] . '" alt="" class="object_image"></div><div class="object_info"><div class="object_price"><div class="object_price_current"><span class="object_ms_text object_price_symbol">R$</span><span class="object_price_whole">' . $row["BOOK_PRECO"] . '</span><span class="object_ms_text object_price_fraction">' . $row["BOOK_PRECO_DESC"] . '</span></div><div class="object_price_discount"><span class="object_price_whole">' . $row["BOOK_PRECO_DESC"] . '</span></div></div><div class="object_description"><span class="object_title">' . $row["BOOK_TITULO"] . '</span></div></div></div>';
        }
    } else {
        $product_select = '<span class="non_result">Nenhum resultado encontrado!</span>';
    }
    echo "<script language='javascript' type='text/javascript'>window.location.href='../HTML/ABRE_CATALOGO.php';</script>";
}

$conn->close();
?>