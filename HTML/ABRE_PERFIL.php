<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';
    include '../PHP/CONFIG.php';
    
    $USERID_UNDEFINED = '';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['USER_ID'])) {
        $login_btn = "<a href=../index.html class=header_btn><button>Login</button></a>";
        $USERID_UNDEFINED .= '';
    } else {
        $login_btn = "<a href=../PHP/LOGOUT.php class=header_btn><button>Sair</button></a>";
        $userID = mysqli_real_escape_string($conn, $_SESSION['USER_ID']);
    }


    $sql = "SELECT * FROM bz_user WHERE USER_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    $USERINFO = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $USERINFO .= '<section class="pfl_info_body">';
            $USERINFO .= '<div class="pfl_info">';
            $USERINFO .= '<span>Nome:</span>';
            if($row['USER_NAME'] > 0){
                $USERINFO .= '<span>' . $row['USER_NAME'] . '</span></div>';
            } else{
                $USERINFO .= '<span> null </span></div>';
            }
            $USERINFO .= '<hr />';
            $USERINFO .= '<div class="pfl_info">';
            $USERINFO .= '<span>Email:</span>';
            if($row['USER_EMAIL'] > 0){
                $USERINFO .= '<span>' . $row['USER_EMAIL'] . '</span></div>';
            } else{
                $USERINFO .= '<span> null </span></div>';
            }
            $USERINFO .= '<hr />';
            $USERINFO .= '<div class="pfl_info">';
            $USERINFO .= '<span>CPF/CNPJ:</span>';
            if($row['USER_CPFCNPJ'] > 0){
                $USERINFO .= '<span>' . $row['USER_CPFCNPJ'] . '</span></div></section>';
            } else{
                $USERINFO .= '<span> null </span></div></section>';
            }
        }
    } else {
        $USERINFO .= '  <div class="pfl_infoNone">
                            <div class="infoNone_text">
                                <span> Faça login para ver os detalhes de sua conta!</span>
                            </div>
                            <div class="infoNone_btn">
                                <button class="infoNoneBtn">Fazer Login</button>
                            </div>
                        </div>';
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
        <div class="blurScreen"></div>
        <div class="BlurScreenAlert">
            <span>Faça login para acessar sua conta!</span>
            <div class="rightside_sec">
                <div class="login_form_sec">
                    <form class="signup_body" action="PHP/SIGN-UP.php" method="post">
                        <div class="inputbox">
                            <i class="fa-regular fa-user fa-xl"></i>
                            <input name="signup_user_input" type="text" placeholder="#" required>
                            <label>Usuário</label>
                        </div>
                        <div class="inputbox">
                            <i class="fa-regular fa-envelope fa-xl"></i>
                            <input name="signup_email_input" type="email" placeholder="#" required>
                            <label>Email</label>
                        </div>
                        <div class="inputbox">
                            <i class="fa-regular fa-lock fa-xl"></i>
                            <input name="signup_password_input" type="password" placeholder="#" required>
                            <label>Senha</label>
                        </div>
                        <button type="submit">Sign-Up</button>
                        <span onclick="slide()">Já possuo conta.</span>
                    </form>
                    <form class="signin_body" action="PHP/SIGN-IN.php" method="post">
                        <div class="inputbox">
                            <i class="fa-regular fa-envelope fa-xl"></i>
                            <input name="login_email_input" type="email" placeholder="#" required>
                            <label>Email</label>
                        </div>
                        <div class="inputbox">
                            <i class="fa-regular fa-lock fa-xl"></i>
                            <input name="login_password_input" type="password" placeholder="#" required>
                            <label>Senha</label>
                        </div>
                        <button type="submit" value="login">Sign-In</button>
                        <span onclick="slide()">Não tenho conta.</span>
                    </form>
                </div>
            </div>
        </div>

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
                <?= $USERID_UNDEFINED ?>
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