<?php
    include "../PHP/CONFIG.php";

    session_start();

    // Função para executar a verificação e o update
    function updateIfDifferent($conn, $tableName, $columnName, $inputValue, $inputName, $userId) {
        $sqlSelect = "SELECT * FROM $tableName WHERE $columnName = ? AND USER_ID = ?";
        $stmt = $conn->prepare($sqlSelect);
        $stmt->bind_param("si", $inputValue, $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script language='javascript' type='text/javascript'>window.location.href='../HTML/ABRE_PERFIL.php';</script>";
            echo "<script> console.log('A informação já existe para $inputName. Nenhuma atualização necessária');</script>";
        } else {
            // A informação não existe no banco, então faz o update
            $sqlUpdate = "UPDATE $tableName SET $columnName = ? WHERE USER_ID = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $inputValue, $userId);
            $stmtUpdate->execute();
            echo "<script language='javascript' type='text/javascript'>window.location.href='../HTML/ABRE_PERFIL.php';</script>";
            echo "<script>console.log('Informação atualizada para $inputName.');</script>";
        }
    }

    // Inputs de referência
    $userEmail = mysqli_real_escape_string($conn, $_POST['USER_EMAIL_EDIT']);
    $userPassword = mysqli_real_escape_string($conn, $_POST['USER_PASSWORD_EDIT']);
    $userCpfCnpj = preg_replace('/\D/', '', $_POST['USER_CPFCNPJ_EDIT']);
    $userRg = preg_replace('/\D/', '', $_POST['USER_RG_EDIT']);
    $userName = mysqli_real_escape_string($conn, $_POST['USER_NAME_EDIT']);
    $userDtnasc = mysqli_real_escape_string($conn, $_POST['USER_DTNASC_EDIT']);
    $userCep = preg_replace('/\D/', '', $_POST['USER_CEP_EDIT']);
    $userEnd = mysqli_real_escape_string($conn, $_POST['USER_END_EDIT']);
    $userEndNum = mysqli_real_escape_string($conn, $_POST['USER_ENDNUM_EDIT']);
    $userUf = mysqli_real_escape_string($conn, $_POST['USER_UF_EDIT']);
    $userCidade = mysqli_real_escape_string($conn, $_POST['USER_CIDADE_EDIT']);
    $userBairro = mysqli_real_escape_string($conn, $_POST['USER_BAIRRO_EDIT']);
    $userComple = mysqli_real_escape_string($conn, $_POST['USER_COMPLE_EDIT']);
    $userTel = preg_replace('/\D/', '', $_POST['USER_TEL_EDIT']);
    $userCel = preg_replace('/\D/', '', $_POST['USER_CEL_EDIT']);
    $userEmailCon = mysqli_real_escape_string($conn, $_POST['USER_EMAIL_CON']);
    $userEmailCon2 = mysqli_real_escape_string($conn, $_POST['USER_EMAIL2_CON']);

    $userId = mysqli_real_escape_string($conn, $_SESSION['USER_ID']);

    // Verificar se a senha foi alterada
    if (!empty($userPassword)) {
        // Gerar o hash da senha
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        // Chamada de função para senha com hash
        updateIfDifferent($conn, 'bz_user', 'USER_PASSWORD', $hashedPassword, 'USER_PASSWORD', $userId);
    } else {
        // A senha não foi alterada, realizar o insert com a senha original
        updateIfDifferent($conn, 'bz_user', 'USER_PASSWORD', $userPassword, 'USER_PASSWORD', $userId);
    }

    updateIfDifferent($conn, 'bz_user', 'USER_EMAIL', $userEmail, 'USER_EMAIL', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_CPFCNPJ', $userCpfCnpj, 'USER_CPFCNPJ', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_RG', $userRg, 'USER_RG', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_NAME', $userName, 'USER_NAME', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_DTNASC', $userDtnasc, 'USER_DTNASC', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_CEP', $userCep, 'USER_CEP', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_END', $userEnd, 'USER_END', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_ENDNUM', $userEndNum, 'USER_ENDNUM', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_UF', $userUf, 'USER_UF', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_CIDADE', $userCidade, 'USER_CIDADE', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_BAIRRO', $userBairro, 'USER_BAIRRO', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_COMPLE', $userComple, 'USER_COMPLE', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_TEL', $userTel, 'USER_TEL', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_CEL', $userCel, 'USER_CEL', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_EMAIL_CON', $userEmailCon, 'USER_EMAIL_CON', $userId);
    updateIfDifferent($conn, 'bz_user', 'USER_EMAIL2_CON', $userEmailCon2, 'USER_EMAIL2_CON', $userId);

    // Fechar a conexão
    $conn->close();
?>
