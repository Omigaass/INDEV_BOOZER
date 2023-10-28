
<?php
    include_once "../PHP/CONFIG.php";

    function VerificarUsuarioExistente($conn, $email) {
        $sql = "SELECT * FROM bz_user WHERE USER_EMAIL = ?";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            return "Erro";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            
            if ($user) {
                return "Existente";
            } else {
                return "Não Existente";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    $USER_NAME = mysqli_real_escape_string($conn, $_POST['USER_NAME']);
    $USER_PASSWORD = mysqli_real_escape_string($conn, $_POST['USER_PASSWORD']);
    $USER_EMAIL = mysqli_real_escape_string($conn, $_POST['USER_EMAIL']);
    $USER_CPFCNPJ = preg_replace('/\D/', '', $_POST['USER_CPFCNPJ']);    
    $USER_TYPE = mysqli_real_escape_string($conn, $_POST['USER_TYPE']);
    
    // HASH a senha para proteger
    $hashed_password = password_hash($USER_PASSWORD, PASSWORD_DEFAULT);

    $result = VerificarUsuarioExistente($conn, $USER_EMAIL);

    if ($result == "Existente") {
        OpenAlert("Usuário com este e-mail já existe");
    } else if ($result == "Não Existente") { 
        $sql = "INSERT INTO bz_user (USER_NAME, USER_PASSWORD, USER_EMAIL, USER_CPFCNPJ, USER_TYPE) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            OpenAlert("Erro ao inserir");
            echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_USUARIOS.php";</script>';
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $USER_NAME, $hashed_password, $USER_EMAIL, $USER_CPFCNPJ, $USER_TYPE);
            mysqli_stmt_execute($stmt);
        
            $affected_rows = mysqli_stmt_affected_rows($stmt);
        
            if ($affected_rows == 1) {
                OpenAlert("Usuário Cadastrado");
                echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_USUARIOS.php";</script>';
            } else if ($affected_rows == 0) {
                OpenAlert("Usuário já existe");
                echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_USUARIOS.php";</script>';
            }
        }

        
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        OpenAlert("Erro ao verificar o usuário");
        echo '<script language="javascript" type="text/javascript">window.location.href="../HTML/ABRE_USUARIOS.php";</script>';
    }

    
    function OpenAlert($message) {
        echo "<script>alert('$message');</script>";
    }
?>