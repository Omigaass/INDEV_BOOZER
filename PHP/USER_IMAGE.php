<?php
session_start();
require 'CONFIG.php';

if (!isset($_SESSION['USER_ID'])) {
    // Adicione o tratamento apropriado para usuários não autenticados, se necessário
} else {
    $userID = mysqli_real_escape_string($conn, $_SESSION['USER_ID']);
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Certifique-se de que o ID do usuário está definido antes de continuar
        if (!empty($userID)) {
            // Verifica se há um arquivo enviado
            if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                $profile_image_tmp = $_FILES['profile_image']['tmp_name'];
                $profile_image_type = $_FILES['profile_image']['type'];
                $profile_image_size = $_FILES['profile_image']['size'];

                // Verifica o tipo do arquivo
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($profile_image_type, $allowed_types)) {
                    echo "Erro: Tipo de arquivo não suportado.";
                    echo "<button onclick=\"location.href='../HTML/ABRE_PERFIL.php'\">Retornar</button>";
                    exit();
                }

                // Verifica o tamanho do arquivo (opcional, dependendo da configuração do seu banco de dados)
                $max_size = 5 * 1024 * 1024; // 5 MB em bytes
                if ($profile_image_size > $max_size) {
                    echo "Erro: Tamanho do arquivo excede o limite permitido.";
                    echo "<br>";
                    echo "<button onclick=\"location.href='../HTML/ABRE_PERFIL.php'\">Retornar</button>";
                    exit();
                }

                // Leitura do conteúdo do arquivo
                $profile_image = file_get_contents($profile_image_tmp);

                // Atualiza o banco de dados
                $sql = "UPDATE bz_user SET USER_PROFILE_IMAGE = ? WHERE USER_ID = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ss', $profile_image, $userID);
                mysqli_stmt_send_long_data($stmt, 0, $profile_image);
                mysqli_stmt_execute($stmt);

                // Redireciona para a página do perfil ou outra após o upload
                header("Location: ../HTML/ABRE_PERFIL.php");
                exit();
            } else {
                // Trata o erro de envio de imagem
                echo "Erro: Nenhum arquivo enviado ou erro no envio.";
                echo "<button onclick=\"location.href='../HTML/ABRE_PERFIL.php'\">Retornar</button>";

                exit();
            }
        }
    }
}
?>
