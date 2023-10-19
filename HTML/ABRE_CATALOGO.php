<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';
    require '../PHP/PRODUCT_SELECT.php';
    require '../PHP/PRODUCT_insert.php';
    require '../PHP/ALERT.php';

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
    <link rel="stylesheet" href="../CSS/ABRE_CATALOGO.CSS">
    <link rel="stylesheet" href="../CSS/HEADER.CSS">
    <link rel="stylesheet" href="../CSS/NAVBAR.CSS">
    <link rel="stylesheet" href="../CSS/FOOTER.CSS">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/bilbo" type="text/css" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/sniglet" type="text/css" />

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
        <!-- #region -->
        <menu class="menu_sec">
            <section class="menu_title">
                <span class="menu_title-s">Catalogo Boozer</span>
            </section>
            <section class="menu_action">
                <div class="menu_div" style="width: 30%;">
                    <button class="menu_btn left-radius grid_view m_active"><i class="fa-solid fa-grid-round-2 fa-xl"></i></button>
                    <button class="menu_btn right-radius list_view"><i class="fa-solid fa-list-radio fa-xl"></i></button>
                </div>
                <div class="menu_div" style="width: 30%;">
                    <button class="menu_btn left-radius prev_page"><i class="fa-solid fa-backward fa-xl"></i></button>
                    <span class="current_page">1</span>
                    <button class="menu_btn right-radius next_page"><i class="fa-solid fa-forward fa-xl"></i></button>
                </div>
                <div class="menu_div" style="width: 20%;">
                    <button class="menu_btn filter_menu_btn"><i class="fa-solid fa-filter-list fa-xl"></i></button>
                </div>

                <?php echo $DefaultConfigBookBtn; ?>
            </section>
        </menu>
        <!-- #endregion -->

        <!-- #region -->
        <section class="catalogo_body">
            <div class="catalogo_table">
                <div class="catalogo_shield">

                    <div class="p_start">
                        <div class="p_img_div">
                            <img src="../IMG/livro_capa.jpg" class="p_img">
                        </div>
                        <div class="p_info_div">
                            <div class="p_info_price">
                                <span class="p_symble">R$</span>
                                <span class="p_price">70.50</span>
                                <div class="p_info_price_discount">
                                    <span class="p_symble">R$</span>
                                    <span class="p_price">90.50</span>
                                </div>
                            </div>
                            <div class="p_info_text">
                                <span class="p_title">Livro Boozer</span>
                                <span class="p_autor">Autor Boozer</span>
                                <span class="p_date">09/90</span>
                            </div>
                        </div>
                    </div>
                    <hr class="p_line"/>
                    <div class="p_start">
                        <div class="p_img_div">
                            <img src="../IMG/livro_capa.jpg" class="p_img">
                        </div>
                        <div class="p_info_div">
                            <div class="p_info_price">
                                <span class="p_symble">R$</span>
                                <span class="p_price">70.50</span>
                                <div class="p_info_price_discount">
                                    <span class="p_symble">R$</span>
                                    <span class="p_price">90.50</span>
                                </div>
                            </div>
                            <div class="p_info_text">
                                <span class="p_title">Livro Boozer</span>
                                <span class="p_autor">Autor Boozer</span>
                                <span class="p_date">09/90</span>
                            </div>
                        </div>
                    </div>
                    <hr class="p_line"/>
                    <div class="p_start">
                        <div class="p_img_div">
                            <img src="../IMG/livro_capa.jpg" class="p_img">
                        </div>
                        <div class="p_info_div">
                            <div class="p_info_price">
                                <span class="p_symble">R$</span>
                                <span class="p_price">70.50</span>
                                <div class="p_info_price_discount">
                                    <span class="p_symble">R$</span>
                                    <span class="p_price">90.50</span>
                                </div>
                            </div>
                            <div class="p_info_text">
                                <span class="p_title">Livro Boozer</span>
                                <span class="p_autor">Autor Boozer</span>
                                <span class="p_date">09/90</span>
                            </div>
                        </div>
                    </div>
                    <hr class="p_line"/>
                    <div class="p_start">
                        <div class="p_img_div">
                            <img src="../IMG/livro_capa.jpg" class="p_img">
                        </div>
                        <div class="p_info_div">
                            <div class="p_info_price">
                                <span class="p_symble">R$</span>
                                <span class="p_price">70.50</span>
                                <div class="p_info_price_discount">
                                    <span class="p_symble">R$</span>
                                    <span class="p_price">90.50</span>
                                </div>
                            </div>
                            <div class="p_info_text">
                                <span class="p_title">Livro Boozer</span>
                                <span class="p_autor">Autor Boozer</span>
                                <span class="p_date">09/90</span>
                            </div>
                        </div>
                    </div>
                    <hr class="p_line"/>
                    <div class="p_start">
                        <div class="p_img_div">
                            <img src="../IMG/livro_capa.jpg" class="p_img">
                        </div>
                        <div class="p_info_div">
                            <div class="p_info_price">
                                <span class="p_symble">R$</span>
                                <span class="p_price">70.50</span>
                                <div class="p_info_price_discount">
                                    <span class="p_symble">R$</span>
                                    <span class="p_price">90.50</span>
                                </div>
                            </div>
                            <div class="p_info_text">
                                <span class="p_title">Livro Boozer</span>
                                <span class="p_autor">Autor Boozer</span>
                                <span class="p_date">09/90</span>
                            </div>
                        </div>
                    </div>
                    <hr class="p_line"/>
                    <div class="p_start">
                        <div class="p_img_div">
                            <img src="../IMG/livro_capa.jpg" class="p_img">
                        </div>
                        <div class="p_info_div">
                            <div class="p_info_price">
                                <span class="p_symble">R$</span>
                                <span class="p_price">70.50</span>
                                <div class="p_info_price_discount">
                                    <span class="p_symble">R$</span>
                                    <span class="p_price">90.50</span>
                                </div>
                            </div>
                            <div class="p_info_text">
                                <span class="p_title">Livro Boozer</span>
                                <span class="p_autor">Autor Boozer</span>
                                <span class="p_date">09/90</span>
                            </div>
                        </div>
                    </div>
                    <hr class="p_line"/>

                </div>
            </div>
        </section>
        <!-- #endregion -->

    </main>
    <footer class="footer_sec">
        <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
    </footer>

    <!-- #region -->
    <div class=" back_screen hidden"></div>
    <modal class="filter_modal m_start hidden">
        <div class="m_wrap">
            <section class="m_head">
                <span class="m_title"><span>Adicionar Filtro</span></span>
                <i class="m_close m_filter_close fa-regular fa-circle-xmark fa-xl"></i>
            </section>
            <section class="m_body">
                <form class="f_body" action="" method="post">
                    
                <div class="form_group">
                    <input class="form_field" type="text" name="BOOK_TITULO" id="BOOK_TITULO" placeholder="Título" required>
                    <label class="form_label" for="BOOK_TITULO">Título</label>
                </div>
                <div class="form_group">
                    <input class="form_field" type="text" name="BOOK_AUTOR" id="BOOK_AUTOR" placeholder="Autor" required>
                    <label class="form_label" for="BOOK_AUTOR">Autor</label>
                </div>
                <div class="form_group">
                    <input class="form_field" type="text" name="BOOK_EDITORA" id="BOOK_EDITORA" placeholder="Editora" required>
                    <label class="form_label" for="BOOK_EDITORA">Editora</label>
                </div>
                <div class="form_group_b">
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_ANO_PUBLICACAO_INI" id="BOOK_ANO_PUBLICACAO_INI" placeholder="MM/AAAA" required onfocus="changeInputType('BOOK_ANO_PUBLICACAO_INI', 'month')" onblur="changeInputType('BOOK_ANO_PUBLICACAO_INI', 'text')">
                        <label class="form_label" for="BOOK_ANO_PUBLICACAO_INI">Ano Inicial</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_ANO_PUBLICACAO_FIM" id="BOOK_ANO_PUBLICACAO_FIM" placeholder="MM/AAAA" required onfocus="changeInputType('BOOK_ANO_PUBLICACAO_FIM', 'month')" onblur="changeInputType('BOOK_ANO_PUBLICACAO_FIM', 'text')">
                        <label class="form_label" for="BOOK_ANO_PUBLICACAO_FIM">Ano Final</label>
                    </div>
                </div>
                <div class="form_group_b">
                    <div class="form_group ">
                        <input class="form_field " type="number" name="BOOK_PRECO_MIN" id="BOOK_PRECO_MIN" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                        <label class="form_label " for="BOOK_PRECO_MIN">Preço Mínimo</label>
                    </div>
                    <div class="form_group ">
                        <input class="form_field " type="number" name="BOOK_PRECO_MAX" id="BOOK_PRECO_MAX" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                        <label class="form_label " for="BOOK_PRECO_MAX">Preço Máximo</label>
                    </div>
                </div>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Gênero</legend>
                        <label class="form_label_c" for="ficcao">
                            Ficção <input class="f_checkbox" type="checkbox" name="ficcao" id="ficcao">
                        </label>
                        <label class="form_label_c" for="romance">
                            Romance <input class="f_checkbox" type="checkbox" name="romance" id="romance">
                        </label>
                        <label class="form_label_c" for="misterio-suspense">
                            Mistério / Suspense <input class="f_checkbox" type="checkbox" name="misterio-suspense" id="misterio-suspense">
                        </label>
                        <label class="form_label_c" for="fantasia">
                            Fantasia <input class="f_checkbox" type="checkbox" name="fantasia" id="fantasia">
                        </label>
                        <label class="form_label_c" for="aventura">
                            Aventura <input class="f_checkbox" type="checkbox" name="aventura" id="aventura">
                        </label>
                        <label class="form_label_c" for="ficcao-cientifica">
                            Ficção Científica <input class="f_checkbox" type="checkbox" name="ficcao-cientifica" id="ficcao-cientifica">
                        </label>
                        <label class="form_label_c" for="amizade">
                            Amizade <input class="f_checkbox" type="checkbox" name="amizade" id="amizade">
                        </label>
                        <label class="form_label_c" for="amor">
                            Amor <input class="f_checkbox" type="checkbox" name="amor" id="amor">
                        </label>
                        <label class="form_label_c" for="historia">
                            História <input class="f_checkbox" type="checkbox" name="historia" id="historia">
                        </label>
                        <label class="form_label_c" for="biografia">
                            Biografia <input class="f_checkbox" type="checkbox" name="biografia" id="biografia">
                        </label>
                        <label class="form_label_c" for="autoajuda">
                            Autoajuda <input class="f_checkbox" type="checkbox" name="autoajuda" id="autoajuda">
                        </label>
                        <label class="form_label_c" for="crescimento-pessoal">
                            Crescimento Pessoal <input class="f_checkbox" type="checkbox" name="crescimento-pessoal" id="crescimento-pessoal">
                        </label>
                        <label class="form_label_c" for="religiao">
                            Religião <input class="f_checkbox" type="checkbox" name="religiao" id="religiao">
                        </label>
                        <label class="form_label_c" for="politica">
                            Política <input class="f_checkbox" type="checkbox" name="politica" id="politica">
                        </label>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Classificação</legend>
                        <label class="form_label_c" for="uma-estrela">
                            1 Estrela <input class="f_checkbox" type="checkbox" name="uma-estrela" id="uma-estrela">
                        </label>
                        <label class="form_label_c" for="duas-estrelas">
                            2 Estrelas <input class="f_checkbox" type="checkbox" name="duas-estrelas" id="duas-estrelas">
                        </label>
                        <label class="form_label_c" for="tres-estrelas">
                            3 Estrelas <input class="f_checkbox" type="checkbox" name="tres-estrelas" id="tres-estrelas">
                        </label>
                        <label class="form_label_c" for="quatro-estrelas">
                            4 Estrelas <input class="f_checkbox" type="checkbox" name="quatro-estrelas" id="quatro-estrelas">
                        </label>
                        <label class="form_label_c" for="cinco-estrelas">
                            5 Estrelas <input class="f_checkbox" type="checkbox" name="cinco-estrelas" id="cinco-estrelas">
                        </label>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Idioma</legend>
                        <label class="form_label_c" for="portugues">
                            Português <input class="f_checkbox" type="checkbox" name="portugues" id="portugues">
                        </label>
                        <label class="form_label_c" for="ingles">
                            Inglês <input class="f_checkbox" type="checkbox" name="ingles" id="ingles">
                        </label>
                        <label class="form_label_c" for="espanhol">
                            Espanhol <input class="f_checkbox" type="checkbox" name="espanhol" id="espanhol">
                        </label>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Formato</legend>
                        <label class="form_label_c" for="capa-dura">
                            Capa Dura <input class="f_checkbox" type="checkbox" name="capa-dura" id="capa-dura">
                        </label>
                        <label class="form_label_c" for="capa-flexivel">
                            Capa Flexível <input class="f_checkbox" type="checkbox" name="capa-flexivel" id="capa-flexivel">
                        </label>
                        <label class="form_label_c" for="e-book">
                            E-book <input class="f_checkbox" type="checkbox" name="e-book" id="e-book">
                        </label>
                        <label class="form_label_c" for="audio-book">
                            Áudio-Book <input class="f_checkbox" type="checkbox" name="audio-book" id="audio-book">
                        </label>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Disponibilidade</legend>
                        <label class="form_label_c" for="estoque">
                            Em Estoque <input class="f_checkbox" type="checkbox" name="estoque" id="estoque">
                        </label>
                        <label class="form_label_c" for="pre-venda">
                            Pré-Venda <input class="f_checkbox" type="checkbox" name="pre-venda" id="pre-venda">
                        </label>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Público-Alvo</legend>
                        <label class="form_label_c" for="criancas">
                            Crianças <input class="f_checkbox" type="checkbox" name="criancas" id="criancas">
                        </label>
                        <label class="form_label_c" for="adolecentes">
                            Adolecentes <input class="f_checkbox" type="checkbox" name="adolecentes" id="adolecentes">
                        </label>
                        <label class="form_label_c" for="adultos">
                            Adultos <input class="f_checkbox" type="checkbox" name="adultos" id="adultos">
                        </label>
                    </fieldset>
                    <div class="f_btn_div">
                        <button class="menu_btn f_btn_s" type="submit">Filtrar</button>
                    </div>
                </form>
            </section>
        </div>
    </modal>

    <div class=" back_screen hidden"></div>
    <modal class="book_add_modal m_start hidden">
        <div class="m_wrap">
            <section class="m_head">
                <span class="m_title"><span><i class="fa-solid fa-book"></i>Adicionar Novo Livro</span></span>
                <i class="m_close m_book_add_close fa-regular fa-circle-xmark fa-xl"></i>
            </section>
            <section class="m_body">
                <form class="f_body" action="" method="post">
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_TITULO" id="BOOK_TITULO" placeholder="Título" required>
                        <label class="form_label" for="BOOK_TITULO">Título</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_AUTOR" id="BOOK_AUTOR" placeholder="Autor" required>
                        <label class="form_label" for="BOOK_AUTOR">Autor</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_EDITORA" id="BOOK_EDITORA" placeholder="Editora" required>
                        <label class="form_label" for="BOOK_EDITORA">Editora</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_ANO_PUBLICACAO" id="BOOK_ANO_PUBLICACAO" placeholder="MM/AAAA" required onfocus="changeInputType('BOOK_ANO_PUBLICACAO', 'month')" onblur="changeInputType('BOOK_ANO_PUBLICACAO', 'text')">
                        <label class="form_label" for="BOOK_ANO_PUBLICACAO">Ano de Publicação</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="number" name="BOOK_PRECO" id="BOOK_PRECO" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                        <label class="form_label" for="BOOK_PRECO">Preço</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="number" name="BOOK_PRECO_DESC" id="BOOK_PRECO_DESC" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                        <label class="form_label" for="BOOK_PRECO_DESC">Preço do Desconto</label>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox1">Gênero</label>
                        <select class="f_select" name="selectbox1" id="selectbox1">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="ficcao">Ficção</option>
                            <option value="romance">Romance</option>
                            <option value="misterio-suspense">Mistério / Suspense</option>
                            <option value="fantasia">Fantasia</option>
                            <option value="aventura">Aventura</option>
                            <option value="ficcao-cientifica">Ficção Científica</option>
                            <option value="amizade">Amizade</option>
                            <option value="amor">Amor</option>
                            <option value="historia">História</option>
                            <option value="biografia">Biografia</option>
                            <option value="autoajuda">Autoajuda</option>
                            <option value="crescimento-pessoal">Crescimento Pessoal</option>
                            <option value="religiao">Religião</option>
                            <option value="politica">Política</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox2">Classificação</label>
                        <select class="f_select" name="selectbox2" id="selectbox2">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="uma-estrela">1 Estrela</option>
                            <option value="duas-estrelas">2 Estrela</option>
                            <option value="tres-estrelas">3 Estrela</option>
                            <option value="quatro-estrelas">4 Estrela</option>
                            <option value="cinco-estrelas">5 Estrela</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox3">Idioma</label>
                        <select class="f_select" name="selectbox3" id="selectbox3">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="portugues">Português</option>
                            <option value="ingles">Inglês</option>
                            <option value="espanhol">Espanhol</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox4">Formato</label>
                        <select class="f_select" name="selectbox4" id="selectbox4">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="capa-dura">Capa Dura</option>
                            <option value="capa-flexivel">Capa Flexível</option>
                            <option value="e-book">E-book</option>
                            <option value="audio-book">Áudio-Book</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox5">Disponibilidade</label>
                        <select class="f_select" name="selectbox5" id="selectbox5">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="estoque">Em Estoque</option>
                            <option value="pre-venda">Pré-Venda</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox6">Público-Alvo</label>
                        <select class="f_select" name="selectbox6" id="selectbox6">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="criancas">Crianças</option>
                            <option value="adolecentes">Adolecentes</option>
                            <option value="adultos">Adultos</option>
                        </select>
                    </div>
                    <div class="f_btn_div">
                        <button class="menu_btn f_btn_s" type="submit">Adicionar</button>
                    </div>
                </form>
            </section>
        </div>
    </modal>

    <div class=" back_screen hidden"></div>
    <modal class="book_edit_modal m_start hidden">
        <div class="m_wrap">
            <section class="m_head">
                <span class="m_title"><span>Editar Livro</span></span>
                <i class="m_close m_book_edit_close fa-regular fa-circle-xmark fa-xl"></i>
            </section>
            <section class="m_body">
                
            </section>
        </div>
    </modal>
    <!-- #endregion -->
    <!-- #region -->
    <div class="a_modal a_active">
        <span class="a_span"><?php echo $Alert_Msg; ?></span>
        <span class="m_close a_btn"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></span>
    </div>
    <!-- #endregion -->
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../JS/SELECT_CONFIG.js"></script>
<script src="../JS/CONFIG_NAV.js"></script>
<script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
<script src="../JS/CATALOG_MENU.js"></script>
<script>
    function abre_login() {
        window.location.href = "../index.html";
    }
    configurarNavegacao(".navbar_item");
    const telaId = "catalogo"
    const navbar_btn = document.getElementById(`navbar_${telaId}`);
    navbar_btn.classList.add("navbar_active");

    <?php echo $DefaultConfigBookScript; ?>

    var l1 = document.querySelector(".prev_page");
    var l2 = document.querySelector(".current_page");
    var al = l1.clientHeight;
    l2.style.height = al + "px";

    function changeInputType(inputId, newType) {
        var inputElement = document.getElementById(inputId);
        if (inputElement) {
            inputElement.type = newType;
        }
    }
</script>

<script>
</script>
</html>