<?php
    session_start();
    
    require '../PHP/ALERT.php';

    if (isset($_SESSION['USER_ID'])) {
        // O cliente está logado
        $botao = '<button href="../PHP/LOGOUT.php">Sair</button>';
    } else {
        // O cliente não está logado
        $botao = '<button onclick="abre_login()">Login</button>';
    }
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/MAIN.CSS">
    <link rel="stylesheet" href="../CSS/ABRE_SOBRE.CSS">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/bilbo" type="text/css" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/sniglet" type="text/css"/>
    <link rel="stylesheet" data-purpose="Layout StyleSheet" title="Web Awesome" href="/css/app-wa-02670e9412103b5852dcbe140d278c49.css?vsn=d">
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
            <div class="header_btn_sec">
                <button onclick="abre_menu()"><i class="fa-duotone fa-chevrons-left"></i>Voltar</button>
            </div>
        </header>
        <main class="main_sec">
            <section class="first_sec">
                <div class="leftside_first_sec">
                    <span class="logo_marca_first_sec">Boozer</span>
                    <span class="title_first_sec"></span>
                    <span class="subtitle_first_sec">O Boozer é uma instituição que tem como objetivo principal promover o acesso à educação, cultura e informação de forma gratuita ou a preços acessíveis, muitas vezes direcionando seus serviços para comunidades carentes ou desfavorecidas.</span>
                </div>
                <div class="rightside_first_sec"></div>
            </section>
            <section class="second_sec">
                <div class="box01_second_sec">
                    <span class="box_title">
                        Ad quas facilis eos expedita omnis?
                    </span>
                    <span class="box_text">
                        Sit voluptate accusamus sed voluptatem sunt id doloremque mollitia qui obcaecati quod. Ut rerum odio et commodi voluptas 33 nihil modi. Est animi voluptas ex fugiat nisi non autem odit aut culpa eligendi.
                    </span>
                </div>
                <div class="box02_second_sec">
                    <span class="box_title">
                        Ea quis quos aut nihil corrupti.
                    </span>
                    <span class="box_text">
                        Lorem ipsum dolor sit amet. Hic maxime consequatur ea dolorem sapiente sit consequatur assumenda. Ut quasi ducimus aut expedita optio et deserunt possimus ut consequatur perspiciatis cum commodi fugit aut natus harum. Eos rerum quos ea eaque aliquid At illo amet qui atque eius ut repellat velit.
                    </span>
                </div>
                <div class="box03_second_sec">
                    <span class="box_title">
                        Vel doloribus inventore sit obcaecati error aut porro omnis.
                    </span>
                    <span class="box_text">
                        Sed quod accusantium aut galisum voluptas sed cumque similique sed enim tempora. Quo iste numquam id voluptas esse id dignissimos veniam et illum laborum.
                    </span>
                </div>
            </section>
            <section class="third_sec">
                <i class="fa-solid fa-users fa-3x"></i>
                <span class="third_sec_title">
                    Ut impedit veniam rem consequuntur soluta.
                </span>
                <span class="third_sec_text">
                    Ea doloremque rerum et magni officia et nisi beatae qui quam minus rem consequatur eveniet ut rerum consectetur et dicta nemo. Et dolorum voluptate et eveniet sapiente ut porro voluptatem et dignissimos fuga? Vel totam quam rem blanditiis temporibus eum facere voluptatum est rerum molestiae.
                </span>
            </section>
            <section class="fourth_sec">
                <div class="leftside_fourth_sec"></div>
                <div class="rightside_fourth_sec">
                    <span class="fourth_sec_title">
                        Aut perspiciatis provident aut quam ratione.
                    </span>
                    <span class="fourth_sec_text">
                        Hic nostrum porro sit voluptate dolores et similique nisi id tempora magni aut praesentium molestias. Quo corporis illo et suscipit aperiam est laudantium obcaecati et atque cumque ut soluta quasi aut modi dicta qui placeat iste. Qui consectetur sint ab eligendi omnis et aliquid sapiente ut temporibus voluptatem ut unde inventore. Ea sapiente quasi ut veritatis veniam est labore iure et facilis enim ut maiores error vel distinctio dolorem. Et magni animi ut nobis voluptas est magni illo et molestiae excepturi non amet quia. Id dignissimos veritatis nam tempora odio eum reiciendis mollitia? Aut culpa quaerat At cupiditate perferendis qui expedita fugit!
                    </span>
                </div>
            </section>
            <section class="fifth_sec">
                <span class="fifth_sec_title">
                    Est autem tempora a distinctio.
                </span>
                <span class="fifth_sec_text">
                    Ut fuga omnis ut quaerat omnis id soluta architecto.
                </span>
                <div class="fifth_sec_grid">
                    <div class="grid_box" id="grid_box01">
                        <i class="fa-solid fa-star fa-2x"></i>
                        <span class="grid_title">
                            Acessibilidade Universal:
                        </span>
                        <span class="grid_text">
                            Uma biblioteca online poder ser acessada em qualquer lugar a qualquer hora.
                        </span>
                    </div>
                    <div class="grid_box" id="grid_box02">
                        <i class="fa-solid fa-star fa-2x"></i>
                        <span class="grid_title">
                            Flexibilidade de horários:
                        </span>
                        <span class="grid_text">
                            Estaremos disponível para vocês 24 horas por dia, 7 dias por semana ou qualquer horário que precisarem de nós!
                        </span>
                    </div>
                    <div class="grid_box" id="grid_box03">
                        <i class="fa-solid fa-star fa-2x"></i>
                        <span class="grid_title">
                            Alcance Ampliado:
                        </span>
                        <span class="grid_text">
                            Uma biblioteca online pode atingir públicos de vários lugares ao mesmo tempo, com acesso fácil e rápido.
                        </span>
                    </div>
                    <div class="grid_box" id="grid_box04">
                        <i class="fa-solid fa-star fa-2x"></i>
                        <span class="grid_title">
                            Variedade dos nossos recursos digitais:
                        </span>
                        <span class="grid_text">
                            Os nossos materiais digitais podem ser oferecer ampla gama de recursos, garantindo que a biblioteca sempre ofereça informações relevantes e atualizadas á vocês.
                        </span>
                    </div>
                    <div class="grid_box" id="grid_box05">
                        <i class="fa-solid fa-star fa-2x"></i>
                        <span class="grid_title">
                            Facilita a inclusão digital: 
                        </span>
                        <span class="grid_text">
                            Ajuda a promover a alfabetização digital e a capacidade das pessoas de utilizarem a tecnologia de forma eficaz.
                        </span>
                    </div>
                    <div class="grid_box" id="grid_box06">
                        <i class="fa-solid fa-star fa-2x"></i>
                        <span class="grid_title">
                            Est autem tempora a distinctio.
                        </span>
                        <span class="grid_text">
                            Todos os nossos recursos  serão investidos cada vez mais na melhora do site, e na ajuda a pessoas que não conseguem ter acesso tão fácil a leitura.
                        </span>
                    </div>
                </div>
            </section>
            <section class="sixth_sec">
                <div class="leftside_sixth_sec">
                    <span class="sixth_sec_title">
                        Ut minima accusantium non veniam rerum.
                    </span>
                    <span class="sixth_sec_text">
                        Est dignissimos excepturi sit sunt voluptatum ad quasi repellat qui voluptas voluptates qui quaerat veritatis nam atque debitis. Qui libero sequi et blanditiis quis qui consequatur eveniet. Est pariatur voluptatem qui consequuntur saepe ea consequuntur voluptatibus qui enim dolores! Ut blanditiis nemo aut recusandae totam sed nemo minima aut tenetur laboriosam vel nihil adipisci est voluptas dicta aut vero quaerat.
                    </span>
                </div>
                <div class="rightside_sixth_sec">
                </div>
            </section>
            <section class="seventh_sec">
                <div id="carousel">
                    <div class="hideLeft">
                        <img src="../IMG/carousel_photo01_resized.jpg">
                    </div>
                
                    <div class="prevLeftSecond">
                        <img src="../IMG/carousel_photo02_resized.jpg">
                    </div>
                
                    <div class="prev">
                        <img src="../IMG/carousel_photo03_resized.jpg">
                    </div>
                
                    <div class="selected">
                        <img src="../IMG/carousel_photo04_resized.jpg">
                    </div>
                
                    <div class="next">
                        <img src="../IMG/carousel_photo05_resized.jpg">
                    </div>
                
                    <div class="nextRightSecond">
                        <img src="../IMG/carousel_photo06_resized.jpg">
                    </div>
                
                    <div class="hideRight">
                        <img src="../IMG/carousel_photo07_resized.jpg">
                    </div>
                </div>
                <div class="buttons">
                    <button id="prev"><i class="fa-duotone fa-chevrons-left"></i>Prev</button>
                    <button id="next">Next<i class="fa-duotone fa-chevrons-right"></i></button>
                </div>
            </section>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function abre_menu() {
        window.location.href = "ABRE_MENU.php";
    }
</script>
<script>
    function moveToSelected(element) {
    var selected, next, prev, prevSecond, nextSecond;

    if (element === "next") {
        selected = $(".selected").next();
    } else if (element === "prev") {
        selected = $(".selected").prev();
    } else {
        selected = element;
    }

    next = selected.next();
    prev = selected.prev();
    prevSecond = prev.prev();
    nextSecond = next.next();

    selected.removeClass().addClass("selected");
    prev.removeClass().addClass("prev");
    next.removeClass().addClass("next");
    nextSecond.removeClass().addClass("nextRightSecond");
    prevSecond.removeClass().addClass("prevLeftSecond");
    nextSecond.nextAll().removeClass().addClass('hideRight');
    prevSecond.prevAll().removeClass().addClass('hideLeft');
}

$(document).keydown(function(e) {
    switch (e.which) {
        case 37: // left
            moveToSelected('prev');
            break;
        case 39: // right
            moveToSelected('next');
            break;
        default:
            return;
    }
    e.preventDefault();
});

$('#carousel div').click(function() {
    moveToSelected($(this));
});

$('#prev').click(function() {
    moveToSelected('prev');
});

$('#next').click(function() {
    moveToSelected('next');
});
</script>
</html>