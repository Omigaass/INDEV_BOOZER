<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['USER_ID'])) {
        $login_btn = "<button class='header_btn'><a href=../index.html>Login</a></button>";
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
    <link rel="stylesheet" href="../CSS/ABRE_CATALOGO.CSS">
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
    <!-- 
    *██   ██ ███████  █████  ██████  ███████ ██████  
    *██   ██ ██      ██   ██ ██   ██ ██      ██   ██ 
    *███████ █████   ███████ ██   ██ █████   ██████  
    *██   ██ ██      ██   ██ ██   ██ ██      ██   ██ 
    *██   ██ ███████ ██   ██ ██████  ███████ ██   ██  
    -->
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
    <main class="catalogo_sec">
        <!--             
            * ██████  ██████  ███    ██ ████████ ███████ ██    ██ ██████   ██████  
            *██      ██    ██ ████   ██    ██    ██      ██    ██ ██   ██ ██    ██ 
            *██      ██    ██ ██ ██  ██    ██    █████   ██    ██ ██   ██ ██    ██ 
            *██      ██    ██ ██  ██ ██    ██    ██      ██    ██ ██   ██ ██    ██ 
            * ██████  ██████  ██   ████    ██    ███████  ██████  ██████   ██████   
        -->
        <menu class="menu_sec">
            <span class="menu_title">Catalogo Boozer</span>
            <div class="menu_body">
                <div class="visual_menu">
                    <button class="menu_btn menu_grid"><i class="fa-solid fa-grid-2 fa-lg"></i></button>
                    <button class="menu_btn menu_list"><i class="fa-solid fa-list-ul fa-lg"></i></button>
                </div>
                <div class="pagination_menu">
                    <button class="menu_btn prev_page_btn">Anterior</button>
                    <span class="current_page"></span>
                    <button class="menu_btn next_page_btn">Próximo</button>
                </div>
                <div class="filter_menu">
                    <button class="menu_btn filter_btn"><i class="fa-solid fa-filter fa-lg"></i></button>
                </div>
                <div class="back_screen hidden"></div>
                <div class="filter_modal hidden">
                    <div class="modal_body">
                        <header class="modal_header">
                            <div class="modal_title">Filtro de Livros</div>
                            <i class="fa-solid fa-x fa-lg" id="modal_filter_btn"></i>
                        </header>
                        <section class="modal_filter_sec">
                            <form action="../PHP/PRODUCT_SELECT.php" method="post">
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Livro</legend>
                                    <label class="label_textbox">Título do Livro<input class="textbox" type="text" name="autor"></label>
                                </fieldset> 
                                <hr />
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Autor</legend>
                                    <label class="label_textbox">Nome do Autor<input class="textbox" type="text" name="autor"></label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Ano de Publicação</legend>
                                    <label for="ano_publicacao_ini" class="box_middle">Ano Inicial<input class="textbox" type="text" name="ano_publicacao_ini"></label>
                                    <label for="ano_publicacao_fin" class="box_middle">Ano Final<input class="textbox" type="text" name="ano_publicacao_fin"></label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Preço</legend>
                                    <label class="box_middle">Valor Minimo<input type="number" name="preco_min"></label>
                                    <label class="box_middle">Valor Máximo<input type="number" name="preco_max"></label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Editora</legend>
                                    <label for="editora" class="box_big">Nome da Editora<input type="text" name="editora"></label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Gênero</legend>
                                    <label><input type="checkbox" name="genero[]" value="Ficção"> Ficção</label>
                                    <label><input type="checkbox" name="genero[]" value="Não Ficção"> Não Ficção</label>
                                    <label><input type="checkbox" name="genero[]" value="Romance"> Romance</label>
                                    <label><input type="checkbox" name="genero[]" value="Mistério / Suspense"> Mistério / Suspense</label>
                                    <label><input type="checkbox" name="genero[]" value="Fantasia"> Fantasia</label>
                                    <label><input type="checkbox" name="genero[]" value="Ficção Científica"> Ficção Científica</label>
                                    <label><input type="checkbox" name="genero[]" value="História"> História</label>
                                    <label><input type="checkbox" name="genero[]" value="Biografia"> Biografia</label>
                                    <label><input type="checkbox" name="genero[]" value="Autoajuda"> Autoajuda</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Classificação</legend>
                                    <label><input type="checkbox" name="classificacao[]" value="uma-estrela"> 1 Estrela</label>
                                    <label><input type="checkbox" name="classificacao[]" value="duas-estrela"> 2 Estrelas</label>
                                    <label><input type="checkbox" name="classificacao[]" value="tres-estrela"> 3 Estrelas</label>
                                    <label><input type="checkbox" name="classificacao[]" value="quatro-estrela"> 4 Estrelas</label>
                                    <label><input type="checkbox" name="classificacao[]" value="cinco-estrela"> 5 Estrelas</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Idioma</legend>
                                    <label><input type="checkbox" name="idioma[]" value="Inglês"> Inglês</label>
                                    <label><input type="checkbox" name="idioma[]" value="Espanhol"> Espanhol</label>
                                    <label><input type="checkbox" name="idioma[]" value="Português"> Português</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Formato</legend>
                                    <label><input type="checkbox" name="formato[]" value="Capa Dura"> Capa Dura</label>
                                    <label><input type="checkbox" name="formato[]" value="Capa Flexível"> Capa Flexível</label>
                                    <label><input type="checkbox" name="formato[]" value="E-book"> E-book</label>
                                    <label><input type="checkbox" name="formato[]" value="Áudio-livro"> Áudio-livro</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset"> 
                                    <legend>Tema</legend>
                                    <label><input type="checkbox" name="tema[]" value="Amizade"> Amizade</label>
                                    <label><input type="checkbox" name="tema[]" value="Amor"> Amor</label>
                                    <label><input type="checkbox" name="tema[]" value="Aventura"> Aventura</label>
                                    <label><input type="checkbox" name="tema[]" value="Mistério"> Mistério</label>
                                    <label><input type="checkbox" name="tema[]" value="Crescimento Pessoal"> Crescimento Pessoal</label>
                                    <label><input type="checkbox" name="tema[]" value="Política"> Política</label>
                                    <label><input type="checkbox" name="tema[]" value="Religião"> Religião</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Disponibilidade</legend>
                                    <label><input type="checkbox" name="disponibilidade[]" value="Em Estoque"> Em Estoque</label>
                                    <label><input type="checkbox" name="disponibilidade[]" value="Pré-venda"> Pré-venda</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Público-Alvo</legend>
                                    <label><input type="checkbox" name="publico_alvo[]" value="Crianças"> Crianças</label>
                                    <label><input type="checkbox" name="publico_alvo[]" value="Adolescentes"> Adolescentes</label>
                                    <label><input type="checkbox" name="publico_alvo[]" value="Adultos"> Adultos</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset_submit">
                                    <input class="filter_submit_btn" type="submit" value="Filtrar">
                                </fieldset>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </menu>
        <div class="catalog_body">
            <div class="catalog_products">
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
                <div class="object_shield">
                    <div class="object_image_shield">
                        <img src="../IMG/livro_capa.jpg" alt="" class="object_image">
                    </div>
                    <div class="object_info">
                        <div class="object_price">
                            <div class="object_price_current">
                                <span class="object_ms_text object_price_symbol">R$</span>
                                <span class="object_price_whole">140</span>
                                <span class="object_ms_text object_price_fraction">99</span>
                            </div>
                            <div class="object_price_discount">
                                <span class="object_price_whole">R$ 150,99</span>
                            </div>
                        </div>
                        <div class="object_description">
                            <span class="object_title">O segredo nas sombras aaaaaaaaaaaaaaaaaaaaaaa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer_sec">
        <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
    </footer>
</body>
<script src="../JS/CONFIG_NAV.js"></script>
<script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
<script src="../JS/CATALOG_MENU.js"></script>
<script src="../JS/CATALOGO_VIEW.js"></script>
<script>
    function abre_login() {
        window.location.href = "../index.html";
    }
    configurarNavegacao(".navbar_item");
    const telaId = "catalogo"
    const navbar_btn = document.getElementById(`navbar_${telaId}`);
    navbar_btn.classList.add("navbar_active");
</script>
</html>