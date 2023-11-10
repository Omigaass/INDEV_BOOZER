<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['USER_ID'])) {
        $login_btn = "<a href=../index.html class=header_btn><button>Login</button></a>";
    } else {
        $login_btn = "<a href=../PHP/LOGOUT.php class=header_btn><button>Sair</button></a>";
    }

    include '../PHP/CONFIG.php';

    $userID = mysqli_real_escape_string($conn, $_SESSION['USER_ID']);

    $sql = "SELECT * FROM bz_user WHERE USER_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $USERINFO = '';
            $USER_NAME_INFO = $row['USER_NAME'];
        }
    } else {
        $USERINFO = "Nenhum usuário encontrado.";
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
    <link rel="stylesheet" href="../CSS/MODAL.CSS">
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
            <section class="pfl_container">
                <div class="pfl_photo_sec">
                    <img class="pfl_photo" src="../IMG/Profile_photo.png" alt="">
                    <div class="changePfl_photo">
                        <i class="fa-regular fa-camera-rotate fa-xl"></i>
                    </div>
                </div>
                <div class="pfl_info_sec">
                    <?= $USERINFO ?>
                    <h1><?= $USER_NAME_INFO ?></h1>
                </div>
            </section>
            <section class="pfl_menuSec">
                <a class="pfl_btn pfl_btn-items">Meus items<span></span></a>
                <a class="pfl_btn pfl_btn-edit">Editar Perfil<span></span></a>
                <a class="pfl_btn pfl_btn-hist">Histórico<span></span></a>
                <a class="pfl_btn pfl_btn-gold">Boozer Gold<span></span></a>
            </section>

        </main>
        <footer class="footer_sec">
            <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
        </footer>
    </div>
    <div class="userUpdate_btn">
        <button class="userUpdate" id="button"><i class="fa-solid fa-pen" style="color: #4465ca;"></i></button>
    </div>

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

var $wrap = $('.pfl_photo'),
    lFollowX = 5,
    lFollowY = 10,
    x = 0,
    y = 0,
    friction = 1 / 12,
    xMax = 30, // Valor máximo de rotação em graus
    xMin = -30, // Valor mínimo de rotação em graus
    yMax = 30, // Valor máximo de rotação em graus
    yMin = -30; // Valor mínimo de rotação em graus

function animate() {
    x += (lFollowX - x) * friction;
    y += (lFollowY - y) * friction;

    // Limita a rotação dentro dos valores permitidos
    x = Math.min(xMax, Math.max(xMin, x));
    y = Math.min(yMax, Math.max(yMin, y));

    $wrap.css({
        'transform': 'perspective(600px) rotateY(' + -x + 'deg) rotateX(' + y + 'deg)'
    });

    window.requestAnimationFrame(animate);
}

$(window).on('mousemove click', function(e) {
    var lMouseX = e.pageX - $wrap.offset().left - $wrap.width() / 2;
    var lMouseY = e.pageY - $wrap.offset().top - $wrap.height() / 2;

    lFollowX = -(12 * lMouseX) / $wrap.width();
    lFollowY = -(10 * lMouseY) / $wrap.height();
});

animate();

$(function() {  
  $('.pfl_btn').on('mouseenter mouseout', function(e) {
    var parentOffset = $(this).offset(),
        relX = e.pageX - parentOffset.left,
        relY = e.pageY - parentOffset.top;

    $(this).find('span').css({top: relY, left: relX});
  });
});





function atualizarAlturaElementos() {
    var pPS = document.querySelector('.pfl_photo_sec');
    var pIS = document.querySelector('.pfl_info_sec');
    var pp = document.querySelector('.pfl_photo');

    var pW = pPS.clientWidth;
    var iW = pIS.clientWidth;
    var ppW = pp.clientWidth;

    pPS.style.height = pW + 'px';
    pIS.style.height = iW + 'px';
    pp.style.height = ppW + 'px';
}

atualizarAlturaElementos();

window.addEventListener('resize', function() {
    atualizarAlturaElementos();
});


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