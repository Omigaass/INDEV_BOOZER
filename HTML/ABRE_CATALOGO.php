<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';
    require '../PHP/PRODUCT_SELECT.php';
    require '../PHP/PRODUCT_insert.php';

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
                <?php 
                    echo $DefaultConfigBookBtn;
                ?>
                <div class="back_screen hidden"></div>
                <div class="default_modal book_modal hidden">
                    <div class="modal_body">
                        <header class="modal_header">
                            <div class="modal_title">Adicionar novo Livro</div>
                            <i class="fa-solid fa-x fa-lg" id="modal_book_btn"></i>
                        </header>
                        <section class="modal_book_sec">
                        <form action="../PHP/PRODUCT_INSERT.php" method="post">
                            <legend>Dados do Livro</legend>
                            <div class="book_row">
                                <div class="book_col">
                                    <label class="book_label">Título do Livro</label>
                                    <input class="book_input" type="text" name="BOOK_TITULO">
                                </div>
                                <div class="book_col">
                                    <label class="book_label">Nome do Autor</label>
                                    <input class="book_input" type="text" name="BOOK_AUTOR">
                                </div>
                                <div class="book_row">
                                    <div class="book_col">
                                    <label class="book_label">Editora</label>
                                    <input class="book_input" type="text" name="BOOK_EDITORA">
                                </div>
                            </div>
                            <div class="book_row">
                                <div class="book_col">
                                    <label class="book_label">Publicação</label>
                                    <input class="book_input" type="date" name="BOOK_ANO_PUBLICACAO">
                                </div>
                                <div class="book_col">
                                    <label class="book_label">Valor</label>
                                    <input class="book_input" type="number" step="0.01" name="BOOK_PRECO" placeholder="R$ 00.00">
                                </div>
                                <div class="book_col">
                                    <label class="book_label">Valor do Desconto</label>
                                    <input class="book_input" type="number" step="0.01" name="BOOK_PRECO_DESC" placeholder="R$ 00.00">
                                </div>
                            </div>
                            <div class="book_row">
                                <div class="book_col">
                                    <label class="book_label">Gênero</label>
                                    <select id="selectbox1" name="BOOK_GENERO">
                                        <option value="">Select an option&hellip;</option>
                                        <option value="ficcao">Ficção</option>
                                        <option value="romance">Romance</option>
                                        <option value="misterio-suspense">Mistério / Suspense</option>
                                        <option value="fantasia">Fantasia</option>
                                        <option value="aventura">Aventura</option>
                                        <option value="ficcao-cientifica">Ficção Científica</option>
                                        <option value="amizade">Amizade</option>
                                        <option value="amor">Amor</option>
                                        <option value="hostoria">História</option>
                                        <option value="biografia">Biografia</option>
                                        <option value="autoajuda">Autoajuda</option>
                                        <option value="crescimento-pessoal">Crescimento Pessoal</option>
                                        <option value="religiao">Religião</option>
                                        <option value="politica">Política</option>
                                    </select>
                                </div>
                                <div class="book_col">
                                    <label class="book_label">Classificação</label>
                                    <select id="selectbox2" name="BOOK_CLASSIFICACAO">
                                        <option value="">Select an option&hellip;</option>
                                        <option value="uma-estrela">1 Estrela</option>
                                        <option value="duas-estrela">2 Estrelas</option>
                                        <option value="tres-estrela">3 Estrelas</option>
                                        <option value="quatro-estrela">4 Estrelas</option>
                                        <option value="cinco-estrela">5 Estrelas</option>
                                    </select>
                                </div>
                                <div class="book_col">
                                    <label class="book_label">Idioma</label>
                                    <select id="selectbox3" name="BOOK_IDIOMA">
                                        <option value="">Select an option&hellip;</option>
                                        <option value="Inglês">Inglês</option>
                                        <option value="Espanhol">Espanhol</option>
                                        <option value="Português">Português</option>
                                    </select>
                                </div>
                            </div>
                            <div class="book_row">
                                <div class="book_col">
                                    <label class="book_label">Formato</label>
                                    <select id="selectbox4" name="BOOK_FORMATO" >
                                        <option value="">Select an option&hellip;</option>
                                        <option value="Capa Dura">Capa Dura</option>
                                        <option value="Capa Flexível">Capa Flexível</option>
                                        <option value="E-book">E-book</option>
                                        <option value="Áudio-livro">Áudio-livro</option>
                                    </select>
                                </div>
                                <div class="book_col">
                                    <label class="book_label">Disponibilidade</label>
                                    <select id="selectbox5" name="BOOK_DISPONIBILIDADE" >
                                        <option value="">Select an option&hellip;</option>
                                        <option value="Em Estoque">Em Estoque</option>
                                        <option value="Pré-venda">Pré-venda</option>
                                    </select>
                                </div>
                                <div class="book_col">
                                    <label class="book_label">Público-Alvo</label>
                                    <select id="selectbox6" name="BOOK_PUBLICO_ALVO" >
                                        <option value="">Select an option&hellip;</option>
                                        <option value="Crianças">Crianças</option>
                                        <option value="Adolescentes">Adolescentes</option>
                                        <option value="Adultos">Adultos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="book_row">
                                <div class="book_col">
                                    <label class="book_label">Imagem da Capa</label>
                                    <input type="file" name="BOOK_IMAGE" id="BOOK_IMAGE">
                                </div>
                            </div>
                            <input class="book_insert_btn" type="submit" value="Adicionar Livro">
                        </form>
                        </section>
                    </div>
                </div>
                <div class="default_modal filter_modal hidden">
                    <div class="modal_body">
                        <header class="modal_header">
                            <div class="modal_title">Filtro de Livros</div>
                            <i class="fa-solid fa-x fa-lg" id="modal_filter_btn"></i>
                        </header>
                        <section class="modal_filter_sec">
                            <form action="../PHP/PRODUCT_SELECT.php" method="post">
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Livro</legend>
                                    <label class="label_textbox">Título do Livro<input class="textbox" type="text" name="BOOK_TITULO"></label>
                                </fieldset> 
                                <hr />
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Autor</legend>
                                    <label class="label_textbox">Nome do Autor<input class="textbox" type="text" name="BOOK_AUTOR"></label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Editora</legend>
                                    <label for="editora" class="box_big">Nome da Editora<input type="text" name="BOOK_EDITORA"></label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Ano de Publicação</legend>
                                    <label for="ano_publicacao_ini" class="box_middle">Ano Inicial<input class="textbox" type="text" name="BOOK_ANO_PUBLICACAO_INI"></label>
                                    <label for="ano_publicacao_fin" class="box_middle">Ano Final<input class="textbox" type="text" name="BOOK_ANO_PUBLICACAO_FIN"></label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset" style="justify-content: center;">
                                    <legend>Preço</legend>
                                    <label class="box_middle">Valor Minimo<input type="number" name="BOOK_PRECO_MIN"></label>
                                    <label class="box_middle">Valor Máximo<input type="number" name="BOOK_PRECO_MAX"></label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Gênero</legend>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Ficção"> Ficção</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Não Ficção"> Não Ficção</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Romance"> Romance</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Mistério / Suspense"> Mistério / Suspense</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Fantasia"> Fantasia</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Aventura"> Aventura</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Ficção Científica"> Ficção Científica</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Amizade"> Amizade</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Amor"> Amor</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="História"> História</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Biografia"> Biografia</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Autoajuda"> Autoajuda</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Crescimento Pessoal"> Crescimento Pessoal</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Religião"> Religião</label>
                                    <label><input type="checkbox" name="BOOK_GENERO[]" value="Política"> Política</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Classificação</legend>
                                    <label><input type="checkbox" name="BOOK_CLASSIFICACAO[]" value="uma-estrela"> 1 Estrela</label>
                                    <label><input type="checkbox" name="BOOK_CLASSIFICACAO[]" value="duas-estrela"> 2 Estrelas</label>
                                    <label><input type="checkbox" name="BOOK_CLASSIFICACAO[]" value="tres-estrela"> 3 Estrelas</label>
                                    <label><input type="checkbox" name="BOOK_CLASSIFICACAO[]" value="quatro-estrela"> 4 Estrelas</label>
                                    <label><input type="checkbox" name="BOOK_CLASSIFICACAO[]" value="cinco-estrela"> 5 Estrelas</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Idioma</legend>
                                    <label><input type="checkbox" name="BOOK_IDIOMA[]" value="Inglês"> Inglês</label>
                                    <label><input type="checkbox" name="BOOK_IDIOMA[]" value="Espanhol"> Espanhol</label>
                                    <label><input type="checkbox" name="BOOK_IDIOMA[]" value="Português"> Português</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Formato</legend>
                                    <label><input type="checkbox" name="BOOK_FORMATO[]" value="Capa Dura"> Capa Dura</label>
                                    <label><input type="checkbox" name="BOOK_FORMATO[]" value="Capa Flexível"> Capa Flexível</label>
                                    <label><input type="checkbox" name="BOOK_FORMATO[]" value="E-book"> E-book</label>
                                    <label><input type="checkbox" name="BOOK_FORMATO[]" value="Áudio-livro"> Áudio-livro</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Disponibilidade</legend>
                                    <label><input type="checkbox" name="BOOK_DISPONIBILIDADE[]" value="Em Estoque"> Em Estoque</label>
                                    <label><input type="checkbox" name="BOOK_DISPONIBILIDADE[]" value="Pré-venda"> Pré-venda</label>
                                </fieldset>
                                <hr/>
                                <fieldset class="filter_fieldset">
                                    <legend>Público-Alvo</legend>
                                    <label><input type="checkbox" name="BOOK_PUBLICO_ALVO[]" value="Crianças"> Crianças</label>
                                    <label><input type="checkbox" name="BOOK_PUBLICO_ALVO[]" value="Adolescentes"> Adolescentes</label>
                                    <label><input type="checkbox" name="BOOK_PUBLICO_ALVO[]" value="Adultos"> Adultos</label>
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
                <?php echo $product_select; ?>                
            </div>
        </div>
    </main>
    <footer class="footer_sec">
        <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../JS/CONFIG_NAV.js"></script>
<script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
<script src="../JS/CATALOG_MENU.js"></script>
<script>
// Iterate over each select element
$('select').each(function () {

// Cache the number of options
var $this = $(this),
    numberOfOptions = $(this).children('option').length;

// Hides the select element
$this.addClass('s-hidden');

// Wrap the select element in a div
$this.wrap('<div class="select"></div>');

// Insert a styled div to sit over the top of the hidden select element
$this.after('<div class="styledSelect"></div>');

// Cache the styled div
var $styledSelect = $this.next('div.styledSelect');

// Show the first select option in the styled div
$styledSelect.text($this.children('option').eq(0).text());

// Insert an unordered list after the styled div and also cache the list
var $list = $('<ul />', {
    'class': 'options'
}).insertAfter($styledSelect);

// Insert a list item into the unordered list for each select option
for (var i = 0; i < numberOfOptions; i++) {
    $('<li />', {
        text: $this.children('option').eq(i).text(),
        rel: $this.children('option').eq(i).val()
    }).appendTo($list);
}

// Cache the list items
var $listItems = $list.children('li');

// Show the unordered list when the styled div is clicked (also hides it if the div is clicked again)
$styledSelect.click(function (e) {
    e.stopPropagation();
    $('div.styledSelect.active').each(function () {
        $(this).removeClass('active').next('ul.options').hide();
    });
    $(this).toggleClass('active').next('ul.options').toggle();
});

// Hides the unordered list when a list item is clicked and updates the styled div to show the selected list item
// Updates the select element to have the value of the equivalent option
$listItems.click(function (e) {
    e.stopPropagation();
    $styledSelect.text($(this).text()).removeClass('active');
    $this.val($(this).attr('rel'));
    $list.hide();
    /* alert($this.val()); Uncomment this for demonstration! */
});

// Hides the unordered list when clicking outside of it
$(document).click(function () {
    $styledSelect.removeClass('active');
    $list.hide();
});

});
</script>
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