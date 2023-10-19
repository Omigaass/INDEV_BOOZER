<?php
    session_start();
    
    require '../PHP/USER_VALIDATION.php';
    require '../PHP/ALERT.php';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['USER_ID'])) {
        $login_btn = "<a href=../index.html class=header_btn><button>Login</button></a>";
    } else {
        $login_btn = "<a href=../PHP/LOGOUT.php class=header_btn><button>Sair</button></a>";
    }
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

            <div class="content">
                <section>
                <table class="table">
                    <thead class="thead">
                    <tr class="tr">
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Total</th>
                        <th>-</th>
                    </tr>
                    </thead>
                    <tbody class="tbody">
                    <tr class="tr">
                        <td>
                        <div class="product">
                            <img src="https://picsum.photos/100/120" alt="" />
                            <div class="info">
                            <div class="name">Nome do produto</div>
                            <div class="category">Categoria</div>
                            </div>
                        </div>
                        </td>
                        <td>R$ 120</td>
                        <td>
                        <div class="qty">
                            <button><i class="bx bx-minus"><i class="fa-solid fa-minus fa-sm"></i></i></button>
                            <span>2</span>
                            <button><i class="bx bx-plus"><i class="fa-solid fa-plus fa-sm"></i></i></button>
                        </div>
                        </td>
                        <td>R$ 240</td>
                        <td>
                        <button class="remove"><i class="bx bx-x"><i class="fa-solid fa-delete-left"></i></i></button>
                        </td>
                    </tr>
                    <tr class="tr">
                        <td>
                        <div class="product">
                            <img src="https://picsum.photos/100/120" alt="" />
                            <div class="info">
                            <div class="name">Nome do produto</div>
                            <div class="category">Categoria</div>
                            </div>
                        </div>
                        </td>
                        <td>R$ 120</td>
                        <td>
                        <div class="qty">
                            <button><i class="bx bx-minus"><i class="fa-solid fa-minus fa-sm"></i></i></button>
                            <span>2</span>
                            <button><i class="bx bx-plus"><i class="fa-solid fa-plus fa-sm"></i></i></button>
                        </div>
                        </td>
                        <td>R$ 240</td>
                        <td>
                        <button class="remove"><i class="bx bx-x"><i class="fa-solid fa-delete-left"></i></i></button>
                        </td>
                    </tr>
                    <tr class="tr">
                        <td>
                        <div class="product">
                            <img src="https://picsum.photos/100/120" alt="" />
                            <div class="info">
                            <div class="name">Nome do produto</div>
                            <div class="category">Categoria</div>
                            </div>
                        </div>
                        </td>
                        <td>R$ 120</td>
                        <td>
                        <div class="qty">
                            <button><i class="bx bx-minus"><i class="fa-solid fa-minus fa-sm"></i></i></button>
                            <span>2</span>
                            <button><i class="bx bx-plus"><i class="fa-solid fa-plus fa-sm"></i></i></button>
                        </div>
                        </td>
                        <td>R$ 240</td>
                        <td>
                        <button class="remove"><i class="bx bx-x"><i class="fa-solid fa-delete-left"></i></i></button>
                        </td>
                    </tr>
                    <tr class="tr">
                        <td>
                        <div class="product">
                            <img src="https://picsum.photos/100/120" alt="" />
                            <div class="info">
                            <div class="name">Nome do produto</div>
                            <div class="category">Categoria</div>
                            </div>
                        </div>
                        </td>
                        <td>R$ 120</td>
                        <td>
                        <div class="qty">
                            <button><i class="bx bx-minus"><i class="fa-solid fa-minus fa-sm"></i></i></button>
                            <span>2</span>
                            <button><i class="bx bx-plus"><i class="fa-solid fa-plus fa-sm"></i></i></button>
                        </div>
                        </td>
                        <td>R$ 240</td>
                        <td>
                        <button class="remove"><i class="bx bx-x"><i class="fa-solid fa-delete-left"></i></i></button>
                        </td>
                    </tr>
                    <tr class="tr">
                        <td>
                        <div class="product">
                            <img src="https://picsum.photos/100/120" alt="" />
                            <div class="info">
                            <div class="name">Nome do produto</div>
                            <div class="category">Categoria</div>
                            </div>
                        </div>
                        </td>
                        <td>R$ 120</td>
                        <td>
                        <div class="qty">
                            <button><i class="bx bx-minus"><i class="fa-solid fa-minus fa-sm"></i></i></button>
                            <span>2</span>
                            <button><i class="bx bx-plus"><i class="fa-solid fa-plus fa-sm"></i></i></button>
                        </div>
                        </td>
                        <td>R$ 240</td>
                        <td>
                        <button class="remove"><i class="bx bx-x"><i class="fa-solid fa-delete-left"></i></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </section>
                <aside>
                    <div class="box">
                        <header>Resumo da compra</header>
                        <div class="info">
                        <div><span>Sub-total</span><span>R$ 418</span></div>
                        <div><span>Frete</span><span>Gratuito</span></div>
                        <div>
                            <button>
                            Adicionar cupom de desconto
                            <i class="bx bx-right-arrow-alt"></i>
                            </button>
                        </div>
                        </div>
                        <footer>
                        <span>Total</span>
                        <span>R$ 418</span>
                        </footer>
                    </div>
                    <button>Finalizar Compra</button>
                </aside>
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