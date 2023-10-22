<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['USER_ID'])) {
        $login_btn = "<a href=../index.html class=header_btn><button>Login</button></a>";
    } else {
        $login_btn = "<a href=../PHP/LOGOUT.php class=header_btn><button>Sair</button></a>";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/MAIN.CSS">
        <link rel="stylesheet" href="../CSS/ABRE_MENU.CSS">
        <link rel="stylesheet" href="../CSS/HEADER.CSS">
        <link rel="stylesheet" href="../CSS/FOOTER.CSS">
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/bilbo" type="text/css" />
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/sniglet" type="text/css"/>
        <!--
        ?███████  ██████  ███    ██ ████████      █████  ██     ██ ███████ ███████  ██████  ███    ███ ███████ 
        ?██      ██    ██ ████   ██    ██        ██   ██ ██     ██ ██      ██      ██    ██ ████  ████ ██      
        ?█████   ██    ██ ██ ██  ██    ██        ███████ ██  █  ██ █████   ███████ ██    ██ ██ ████ ██ █████   
        ?██      ██    ██ ██  ██ ██    ██        ██   ██ ██ ███ ██ ██           ██ ██    ██ ██  ██  ██ ██      
        ?██       ██████  ██   ████    ██        ██   ██  ███ ███  ███████ ███████  ██████  ██      ██ ███████ 
        -->
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">
        <title>Boozer</title>
    </head>
<body>
    <div class="fullscreen">
        <header class="header_sec">
            <div class="logo_body">
                <img src="#">
                <a href="ABRE_MENU.php">Boozer</a>
            </div>
            <div class="header_btn_sec">
                <?php 
                    echo $login_btn;
                ?>
            </div>
        </header>
        <main class="main_sec">
            <h1 class="body_title">Descubra novos mundos, uma página de cada vez.</h1>
            <div class="navbar_menu">
                <div class="navbar_card" id="card_catalogo">
                    <i class="fa-solid fa-bookmark fa-lg"></i>
                    <a>Catalogo</a>
                </div>
                <div class="navbar_card" id="card_carrinho">
                    <i class="fa-solid fa-cart-shopping fa-lg"></i>
                    <a>Carrinho</a>
                </div>
                <div class="navbar_card" id="card_perfil">
                    <i class="fa-solid fa-user fa-lg"></i>
                    <a>Meu Perfil</a>
                </div>
                <?php echo $DefaultConfigMenu; ?>
            </div>
            <div class="content_body">
                <a class="card1"></a>
                <a class="card2"></a>
                <a class="card3"></a>
                <a class="card4"></a>
                <a class="card5" href="ABRE_SOBRE.php">Sobre Nós</a>
                <a class="card6"></a>
                <a class="card7"></a>
            </div>
        </main>
        <footer class="footer_sec">
            <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
        </footer>
    </div>
    <!-- #region -->
    <div class="a_modal">
        <span class="a_span"><?php echo $Alert_Msg; ?></span>
        <span class="m_close a_btn"><i class="fa-regular fa-circle-xmark"></i></span>
    </div>
    <!-- #endregion -->
</body>
<script src="../JS/CONFIG_NAV.js"></script>
<script>
    function abre_login() {
        window.location.href = "../index.html";
    }
    configurarMenu(".navbar_card");
</script>
</html>