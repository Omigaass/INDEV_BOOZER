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
    <link rel="stylesheet" href="../CSS/ABRE_PERFIL.CSS">
    <link rel="stylesheet" href="../CSS/HEADER.CSS">
    <link rel="stylesheet" href="../CSS/NAVBAR.CSS">
    <link rel="stylesheet" href="../CSS/FOOTER.CSS">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/bilbo" type="text/css" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/sniglet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                <a href="ABRE_MENU.php">Boozer</a>
            </div>
            <div class="header_btn_sec">
                <?php 
                    echo $login_btn;
                ?>
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
                    <?php echo $DefaultConfigNav ?>
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
            <div class="profile-container">
                <div class="profile-container-img">
                    <img class="profile-picture" src="https://www.promoview.com.br/uploads/2017/04/b72a1cfe.png"
                        alt="Imagem de Perfil">
                </div>
                <div class="profile-container-info">
                    <h1>Nome do Usuário</h1>
                    <p>Desenvolvedor Web</p>
                    <p>Email: exemplo@email.com</p>
                    <div class="userUpdate_btn">
                        <button class="userUpdate" id="button"><i class="fa-solid fa-pen"
                                style="color: #4465ca;"></i></button>
                    </div>
                </div>
            </div>


            <div class="navbar_card" id="botao_teste">
                <i class="fa-solid fa-cart-shopping fa-lg"></i>
                <a>Carrinho</a>
            </div>

            <div class="navbar_card" id="botao_teste">
                <i class="fa-solid fa-cart-shopping fa-lg"></i>
                <a>Carrinho</a>
            </div>
        </main>
        <footer class="footer_sec">
            <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
        </footer>
    </div>
    <!-- #region -->
    <div class="a_modal">
        <span class="a_span">
        </span>
        <span class="m_close a_btn"><i class="fa-regular fa-circle-xmark"></i></span>
    </div>
    <!-- #endregion -->
    <div class="back_screen hidden"></div>
    <modal class="userUpdate_modal m_start hidden">
        <div class="m_wrap">
            <section class="m_head">
                <span class="m_title"><span><i class="fa-solid fa-user-plus"></i>Criar novo Usuário</span></span>
                <i class="m_close m_userUpdate_close fa-regular fa-circle-xmark fa-xl"></i>
            </section>
            <section class="m_body">
                <header class="u_head mu_head">
                    <h5><i class="fa-solid fa-users-gear"></i> Dados do novo usuário </h5>
                    <hr />
                </header>
                <form class="f_body" action="../PHP/PRODUCT_INSERT.php" method="post">
                    
                <div class="form_group">
                    <label>Nome:</label>
                    <input type="text" placeholder="Digite seu nome" name="nome" required>
                </div>

                <div class="form_group">
                    <label>Email:</label>
                    <input type="text" placeholder="Digite seu email" name="Email" required>
                </div>

                    <div class="form_group">
                        <label class="form_label" for="BOOK_TITULO">Cpf:</label>
                        <input class="form_field" type="text" name="BOOK_TITULO" id="BOOK_TITULO" placeholder="Digite seu cpf" required>
                    </div>
                    <div class="form_group">
                        <label class="form_label" for="BOOK_AUTOR">Rg:</label>
                        <input class="form_field" type="text" name="BOOK_AUTOR" id="BOOK_AUTOR" placeholder="Digite seu rg" required>
                        
                    </div>
                    <div class="form_group">
                        <label class="form_label" for="BOOK_EDITORA">Idade:</label>
                        <input class="form_field" type="text" name="BOOK_EDITORA" id="BOOK_EDITORA" placeholder="Digite seu rg" required>
                       
                    </div>
                    <div class="form_group">
                        <label class="form_label" for="BOOK_ANO_PUBLICACAO">Data de nascimento:</label>
                        <input class="form_field" type="text" name="BOOK_ANO_PUBLICACAO" id="BOOK_ANO_PUBLICACAO" placeholder="DD/MM/AAAA" required onfocus="changeInputType('BOOK_ANO_PUBLICACAO', 'month')" onblur="changeInputType('BOOK_ANO_PUBLICACAO', 'text')">
                       
                    </div>
                    <div class="form_group">
                        <label class="form_label" for="BOOK_PRECO">Preço</label>
                        <input class="form_field" type="number" name="BOOK_PRECO" id="BOOK_PRECO" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                       
                    </div>
                    <div class="form_group">
                        <label class="form_label" for="BOOK_PRECO_DESC">Preço do Desconto</label>
                        <input class="form_field" type="number" name="BOOK_PRECO_DESC" id="BOOK_PRECO_DESC" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                    </div>
                    
                    <div class="f_btn_div">
                        <button class="menu_btn f_btn_s" type="submit">Adicionar</button>
                    </div>
                </form>
            </section>
        </div>
    </modal>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../JS/CONFIG_NAV.JS"></script>
<script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
<script src="../JS/perfil.js"></script>
<script>

    const userUpdate = document.querySelector(".userUpdate");
    const userUpdate_modal = document.querySelector(".userUpdate_modal");
    const userUpdate_close = document.querySelector(".m_userUpdate_close");
    const back_screen = document.querySelector(".back_screen");

    userUpdate.addEventListener("click", () => {
        userUpdate_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    userUpdate_close.addEventListener("click", () => {
        userUpdate_modal.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });
</script>
<script>
    function abre_login() {
        window.location.href = "../index.html";
    }
    configurarNavegacao(".navbar_item");
    const telaId = "perfil"
    const navbar_btn = document.getElementById(`navbar_${telaId}`);
    navbar_btn.classList.add("navbar_active");
</script>

</html>