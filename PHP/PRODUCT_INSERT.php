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

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $BOOK_TITULO = $_POST["BOOK_TITULO"];
    $BOOK_AUTOR = $_POST["BOOK_AUTOR"];
    $BOOK_EDITORA = $_POST["BOOK_EDITORA"];
    $BOOK_ANO_PUBLICACAO = $_POST["BOOK_ANO_PUBLICACAO"];
    $BOOK_PRECO = $_POST["BOOK_PRECO"];
    $BOOK_PRECO_DESC = $_POST["BOOK_PRECO_DESC"];
    $BOOK_GENERO = $_POST["BOOK_GENERO"];
    $BOOK_CLASSIFICACAO = $_POST["BOOK_CLASSIFICACAO"];
    $BOOK_IDIOMA = $_POST["BOOK_IDIOMA"];
    $BOOK_FORMATO = $_POST["BOOK_FORMATO"];
    $BOOK_DISPONIBILIDADE = $_POST["BOOK_DISPONIBILIDADE"];
    $BOOK_PUBLICO_ALVO = $_POST["BOOK_PUBLICO_ALVO"];

    // Manipulação de imagem
    $targetDirectory = "../IMG/DB"; // Substitua pelo caminho correto
    $targetFile = $targetDirectory . basename($_FILES["BOOK_IMAGE"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Verifique se o arquivo é uma imagem real ou se é falso
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["BOOK_IMAGE"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('O arquivo não é uma imagem');</script>";
            $uploadOk = 0;
        }
    }

    // Verifique se o arquivo já existe
    if (file_exists($targetFile)) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Imagem já existe');</script>";
        $uploadOk = 0;
    }

    // Verifique o tamanho do arquivo (opcional)
    if ($_FILES["BOOK_IMAGE"]["size"] > 500000) {
        echo "<script language='javascript' type='text/javascript'>
        alert('Arquivo muito grande');</script>";
        $uploadOk = 0;
    }

    // Permita apenas alguns tipos de formatos de imagem (você pode ajustar isso conforme necessário)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script language='javascript' type='text/javascript'>
        alert('Desculpe, apenas arquivos JPG, JPEG e PNG são permitidos');</script>";
        $uploadOk = 0;
    }

    // Se todas as verificações passaram, você pode mover o arquivo para o diretório desejado
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["BOOK_IMAGE"]["tmp_name"], $targetFile)) {
            echo "<script language='javascript' type='text/javascript'>
            alert('O arquivo " . htmlspecialchars(basename($_FILES["BOOK_IMAGE"]["name"])) . " foi carregado com sucesso.');</script>";

        } else {
            echo "<script language='javascript' type='text/javascript'>
            alert('Desculpe, ocorreu um erro ao carregar o arquivo');</script>";
        }
    }

    // Query de inserção
    $insertQuery = "INSERT INTO bz_book (BOOK_TITULO, BOOK_AUTOR, BOOK_ANO_PUBLICACAO, BOOK_PRECO, BOOK_PRECO_DESC, BOOK_EDITORA, BOOK_GENERO, BOOK_CLASSIFICACAO, BOOK_IDIOMA, BOOK_FORMATO, BOOK_DISPONIBILIDADE, BOOK_PUBLICO_ALVO, IMG_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssssssissssi", $BOOK_TITULO, $BOOK_AUTOR, $BOOK_ANO_PUBLICACAO, $BOOK_PRECO, $BOOK_PRECO_DESC, $BOOK_EDITORA, $BOOK_GENERO, $BOOK_CLASSIFICACAO, $BOOK_IDIOMA, $BOOK_FORMATO, $BOOK_DISPONIBILIDADE, $BOOK_PUBLICO_ALVO, $IMG_ID);

    if ($uploadOk == 1) {
        // Insira a imagem na tabela bz_image
        $sql_insert_image = "INSERT INTO bz_image (IMG_NAME, IMG_TYPE, IMG_INFO) VALUES (?, ?, ?)";
        
        $stmt = $conn->prepare($sql_insert_image);
        $img_name = $_FILES["BOOK_IMAGE"]["name"];
        $img_type = $imageFileType;
        $img_info = file_get_contents($targetFile);
        
        $stmt->bind_param("sss", $img_name, $img_type, $img_info);
        
        if ($stmt->execute()) {
            // Obtenha o IMG_ID da imagem inserida
            $img_id = $stmt->insert_id;
            
            // Agora você tem o IMG_ID da imagem associada ao livro
        } else {
            echo "Erro ao inserir a imagem na tabela bz_image: " . $stmt->error;
        }
        
        $stmt->close();
    }

    if ($stmt->execute()) {
        echo "<script language='javascript' type='text/javascript'>
            alert('Livro adicionado com sucesso');window.location.href='../HTML/ABRE_CATALOGO.php';</script>";
    } else {
        echo "<script language='javascript' type='text/javascript'>
            alert('Erro ao inserir dados');window.location.href='../HTML/ABRE_CATALOGO.php';</script>";
        echo "Erro ao inserir dados: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
