<?php
    session_start();
    require 'CONFIG.php';

    if (!isset($_SESSION['USER_ID'])) {
    } else {
        $userID = mysqli_real_escape_string($conn, $_SESSION['USER_ID']);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Certifique-se de que o ID do usuário está definido antes de continuar
            if (!empty($userID)) {
                $profile_image = file_get_contents($_FILES['profile_image']['tmp_name']);
                $profile_image = mysqli_real_escape_string($conn, $profile_image);

                $sql = "UPDATE bz_user SET USER_PROFILE_IMAGE = '$profile_image' WHERE USER_ID = $userID";
                mysqli_query($conn, $sql);

                // Redirecione para a página do perfil ou outra após o upload
                header("Location: ../HTML/ABRE_PERFIL.php");
                exit();
            }
        }
    }
?>
