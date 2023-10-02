<?php

$hostname = "localhost"; // Endereço do servidor MySQL
$username = "root"; // Nome de usuário do MySQL
$password = ""; // Senha do MySQL
$database = "boozer_db"; // Nome do banco de dados

// Conexão com o banco de dados
$mysqli = new mysqli($hostname, $username, $password, $database);

// Verificar a conexão
if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

/* Use cookies for session */
ini_set('session.use_cookies', 'true');
/* Change this to true if using phpMyAdmin over https */
$secure_cookie = false;
/* Need to have cookie visible from parent directory */
session_set_cookie_params(0, '/', '', $secure_cookie, true);
/* Create signon session */
$session_name = 'SignonSession';
session_name($session_name);
// Uncomment and change the following line to match your $cfg['SessionSavePath']
//session_save_path('/foobar');
@session_start();

/* Was data posted? */
if (isset($_POST['bz_user'])) {
    /* Store there credentials */
    $_SESSION['USER_EMAIL'] = $_POST['login_email_input'];
    $_SESSION['USER_PASSWORD'] = $_POST['login_password_input'];
    $_SESSION['BZ_SESSION_HOST'] = $_POST['host'];
    $_SESSION['BZ_SESSION_PORT'] = $_POST['port'];
    /* Update another field of server configuration */
    $_SESSION['BZ_SESSION_cfgupdate'] = ['verbose' => 'Signon test'];
    $_SESSION['BZ_SESSION_HMAC_secret'] = hash('sha1', uniqid(strval(random_int(0, mt_getrandmax())), true));
    $id = session_id();
    /* Close that session */
    @session_write_close();
    /* Redirect to phpMyAdmin (should use absolute URL here!) */
    header('Location: ../HTML/ABRE_HOME.html');
} else {
    /* Show simple form */
    header('Content-Type: text/html; charset=utf-8');

    echo '<?xml version="1.0" encoding="utf-8"?>' . "\n";
    echo '<!DOCTYPE HTML>
<html lang="en" dir="ltr">
<head>
<link rel="icon" href="../favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<meta charset="utf-8">
<title>phpMyAdmin single signon example</title>
</head>
<body>';

    if (isset($_SESSION['PMA_single_signon_error_message'])) {
        echo '<p class="error">';
        echo $_SESSION['PMA_single_signon_error_message'];
        echo '</p>';
    }

    echo '<form action="signon.php" method="post">
Username: <input type="text" name="user" autocomplete="username" spellcheck="false"><br>
Password: <input type="password" name="password" autocomplete="current-password" spellcheck="false"><br>
Host: (will use the one from config.inc.php by default)
<input type="text" name="host"><br>
Port: (will use the one from config.inc.php by default)
<input type="text" name="port"><br>
<input type="submit">
</form>
</body>
</html>';
}
