<?php
    session_start();
    require_once('../PHP/SESSION_VERIFY');
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/MAIN.CSS">
        <link rel="stylesheet" href="../CSS/ABRE_CARRINHO.CSS">
        <link rel="stylesheet" href="../CSS/HEADER.CSS">
        <link rel="stylesheet" href="../CSS/NAVBAR.CSS">
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
                <button onclick="abre_login()">Login</button>
            </div>
        </header>
        <div class="navbar_outline">
            <div class="blue_square">
                <div class="white_square1"></div>
            </div>
            <nav class="navbar_sec">
                <div class="navbar_body">
                    <div class="navbar_button" id="navbar_button">
                        <i class="fa-solid fa-bars fa-lg"></i>
                    </div>
                    <div class="navbar_item" id="navbar_catalogo">
                        <i class="fa-solid fa-bookmark"></i>
                        <a>Catalogo</a>
                    </div>
                    <div class="navbar_item" id="navbar_carrinho">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <a>Carrinho</a>
                    </div>
                    <div class="navbar_item" id="navbar_perfil">
                        <i class="fa-solid fa-user"></i>
                        <a>Meu Perfil</a>
                    </div>
                    <div class="navbar_item" id="navbar_usuarios">
                        <i class="fa-solid fa-users"></i>
                        <a>Usuarios</a>
                    </div>
                </div>
            </nav>
            <div class="blue_square">
                <div class="white_square2"></div>
            </div>
            </div>
        <main class="main_sec">
            <!--             
                 ?██████  ██████  ███    ██ ████████ ███████ ██    ██ ██████   ██████  
                ?██      ██    ██ ████   ██    ██    ██      ██    ██ ██   ██ ██    ██ 
                ?██      ██    ██ ██ ██  ██    ██    █████   ██    ██ ██   ██ ██    ██ 
                ?██      ██    ██ ██  ██ ██    ██    ██      ██    ██ ██   ██ ██    ██ 
                 ?██████  ██████  ██   ████    ██    ███████  ██████  ██████   ██████   
            -->
        </main>
        <footer class="footer_sec">
            <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
<script src="https://kit.fontawesome.com/724309404c.js" crossorigin="anonymous"></script>
<script src="../JS/CONFIG_NAV.JS"></script>
<script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
<script>
    function abre_login() {
        window.location.href = "../index.html";
    }
    configurarNavegacao(".navbar_item");
    const telaId = "carrinho"
    const navbar_btn = document.getElementById(`navbar_${telaId}`);
    navbar_btn.classList.add("navbar_active");
</script>
</html>