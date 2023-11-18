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

    $PRODUCT_SELECT_VAR = "";
    $PRODUCT_SCRIPT = "";

        $sql = "SELECT * FROM bz_book WHERE 1 = 1";

        $conditions = array();
        $params = array();

        if (!empty($_POST['BOOK_TITULO'])) {
            $BOOK_TITULO = $_POST['BOOK_TITULO'];
            $conditions[] = "BOOK_TITULO LIKE ?";
            $params[] = '%' . $BOOK_TITULO . '%';
        }

        if (!empty($_POST['BOOK_AUTOR'])) {
            $BOOK_AUTOR = $_POST['BOOK_AUTOR'];
            $conditions[] = "BOOK_AUTOR LIKE ?";
            $params[] = '%' . $BOOK_AUTOR . '%';
        }

        if (!empty($_POST['BOOK_EDITORA'])) {
            $BOOK_EDITORA = $_POST['BOOK_EDITORA'];
            $conditions[] = "BOOK_EDITORA LIKE ?";
            $params[] = '%' . $BOOK_EDITORA . '%';
        }
        
        if (!empty($_POST['BOOK_ANO_PUBLICACAO_INI']) && !empty($_POST['BOOK_ANO_PUBLICACAO_FIM'])) {
            $BOOK_ANO_PUBLICACAO_INI = $_POST['BOOK_ANO_PUBLICACAO_INI'];
            $BOOK_ANO_PUBLICACAO_FIM = $_POST['BOOK_ANO_PUBLICACAO_FIM'];
            $conditions[] = "BOOK_ANO_PUBLICACAO BETWEEN ? AND ?";
            $params[] = $BOOK_ANO_PUBLICACAO_INI;
            $params[] = $BOOK_ANO_PUBLICACAO_FIM;
        } elseif (!empty($_POST['BOOK_ANO_PUBLICACAO_INI']) && empty($_POST['BOOK_ANO_PUBLICACAO_FIM'])) {
            $BOOK_ANO_PUBLICACAO_INI = $_POST['BOOK_ANO_PUBLICACAO_INI'];
            $conditions[] = "BOOK_ANO_PUBLICACAO >= ?";
            $params[] = $BOOK_ANO_PUBLICACAO_INI;
        } elseif (empty($_POST['BOOK_ANO_PUBLICACAO_INI']) && !empty($_POST['BOOK_ANO_PUBLICACAO_FIM'])) {
            $BOOK_ANO_PUBLICACAO_FIM = $_POST['BOOK_ANO_PUBLICACAO_FIM'];
            $conditions[] = "BOOK_ANO_PUBLICACAO <= ?";
            $params[] = $BOOK_ANO_PUBLICACAO_FIM;
        }
        
        
        if (!empty($_POST['BOOK_PRECO_MIN']) && !empty($_POST['BOOK_PRECO_MAX'])) {
            $BOOK_PRECO_MIN = $_POST['BOOK_PRECO_MIN'];
            $BOOK_PRECO_MAX = $_POST['BOOK_PRECO_MAX'];
            $conditions[] = "BOOK_PRECO BETWEEN ? AND ?";
            $params[] = $BOOK_PRECO_MIN;
            $params[] = $BOOK_PRECO_MAX;
        } elseif (!empty($_POST['BOOK_PRECO_MIN']) && empty($_POST['BOOK_PRECO_MAX'])) {
            $BOOK_PRECO_MIN = $_POST['BOOK_PRECO_MIN'];
            $conditions[] = "BOOK_PRECO >= ?";
            $params[] = $BOOK_PRECO_MIN;
        } elseif (empty($_POST['BOOK_PRECO_MIN']) && !empty($_POST['BOOK_PRECO_MAX'])) {
            $BOOK_PRECO_MAX = $_POST['BOOK_PRECO_MAX'];
            $conditions[] = "BOOK_PRECO <= ?";
            $params[] = $BOOK_PRECO_MAX;
        }

        if (!empty($_POST['BOOK_GENERO'])) {
            $selected_generos = implode("','", $_POST['BOOK_GENERO']);
            $conditions[] = "BOOK_GENERO IN ('$selected_generos')";
        }

        if (!empty($_POST['BOOK_CLASSIFICACAO'])) {
            $selected_class = implode("','", $_POST['BOOK_CLASSIFICACAO']);
            $conditions[] = "BOOK_CLASSIFICACAO IN ('$selected_class')";
        }

        if (!empty($_POST['BOOK_IDIOMA'])) {
            $selected_idioma = implode("','", $_POST['BOOK_IDIOMA']);
            $conditions[] = "BOOK_IDIOMA IN ('$selected_idioma')";
        }
        
        if (!empty($_POST['BOOK_FORMATO'])) {
            $selected_formato = implode("','", $_POST['BOOK_FORMATO']);
            $conditions[] = "BOOK_FORMATO IN ('$selected_formato')";
        }
        
        if (!empty($_POST['BOOK_DISPONIBILIDADE'])) {
            $selected_disponibilidade = implode("','", $_POST['BOOK_DISPONIBILIDADE']);
            $conditions[] = "BOOK_DISPONIBILIDADE IN ('$selected_disponibilidade')";
        }
        
        if (!empty($_POST['BOOK_PUBLICO_ALVO'])) {
            $selected_p_alvo = implode("','", $_POST['BOOK_PUBLICO_ALVO']);
            $conditions[] = "BOOK_PUBLICO_ALVO IN ('$selected_p_alvo')";
        }

        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            if (count($params) > 0) {
                $types = str_repeat('s', count($params)); 
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();
        }

        if (isset($result) && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $BOOK_VISIBLE = $row['BOOK_VISIBLE'];
                if ($BOOK_VISIBLE == 1) {
                    $USER_SELECT_VAR = "";
                } else{
                    $PRODUCT_SELECT_VAR .= '<div class="p_start ' . $DefaultConfigBookMenuStyle . '">';
                    $PRODUCT_SELECT_VAR .= '<div class="p_img_div ' . $DefaultConfigBookMenuStyle . '">';
                    $PRODUCT_SELECT_VAR .= '<img src="../IMG/livro_capa.jpg" class="p_img"></div>';
                    $PRODUCT_SELECT_VAR .= '<div class="p_info_div"><div class="p_info_price">';
                    $PRODUCT_SELECT_VAR .= '<span class="p_symble">R$</span>';
                    $PRODUCT_SELECT_VAR .= '<span class="p_price">' . $row['BOOK_PRECO'] . '</span>';
                    $PRODUCT_SELECT_VAR .= '<div class="p_info_price_discount">';
                    $PRODUCT_SELECT_VAR .= '<span class="p_symble">R$</span>';
                    $PRODUCT_SELECT_VAR .= '<span class="p_price">' . $row['BOOK_PRECO_DESC'] . '</span></div></div>';
                    $PRODUCT_SELECT_VAR .= '<div class="p_info_text">';
                    $PRODUCT_SELECT_VAR .= '<span class="p_title">' . $row['BOOK_TITULO'] . '</span>';
                    $PRODUCT_SELECT_VAR .= '<span class="p_autor">' . $row['BOOK_AUTOR'] . '</span>';
                    $PRODUCT_SELECT_VAR .= '<span class="p_date">' . $row['BOOK_ANO_PUBLICACAO'] . '</span></div></div>';
                    if (isset($isNotDefault) && $isNotDefault) {
                        $PRODUCT_SELECT_VAR .= '<div class="p_menu">';
                        $PRODUCT_SELECT_VAR .= '<form method="POST" action="../PHP/PRODUCT_MENU.php">';
                        $PRODUCT_SELECT_VAR .= '<input type="hidden" name="USER_ID" value="' . $user_id . '">';
                        $PRODUCT_SELECT_VAR .= '<input type="hidden" name="BOOK_ID" value="' . $row['BOOK_ID'] . '">';
                        $PRODUCT_SELECT_VAR .= '<div class="p_menu_div">';
                        $PRODUCT_SELECT_VAR .= '<input type="submit" name="p_BookEdit" id="p_BookEdit" class="p_btn p_BookEdit" value="">';
                        $PRODUCT_SELECT_VAR .= '<label class=" p_label p_BookEdit_l" for="p_BookEdit"><i class="icon fa-solid fa-pen-to-square fa-lg"></i><span class="p_btn_cap">Editar</span></label></div>';

                        $PRODUCT_SELECT_VAR .= '<div class="p_menu_div">';
                        $PRODUCT_SELECT_VAR .= '<input type="submit" name="p_BookRemove" id="p_BookRemove" class="p_btn p_BookRemove" value="">';
                        $PRODUCT_SELECT_VAR .= '<label class=" p_label p_BookRemove_l" for="p_BookRemove"><i class="icon fa-solid fa-file-xmark fa-lg"></i><span class="p_btn_cap">Remover</span></label></div>';

                        $PRODUCT_SELECT_VAR .= '<div class="p_menu_div">';
                        $PRODUCT_SELECT_VAR .= '<input type="submit" name="p_BookHidden" id="p_BookHidden" class="p_btn p_BookHidden" value="">';
                        $PRODUCT_SELECT_VAR .= '<label class=" p_label p_BookHidden_l" for="p_BookHidden"><i class="icon fa-solid fa-eye-slash fa-lg"></i><span class="p_btn_cap">Ocultar</span></label></div>';

                        $PRODUCT_SELECT_VAR .= '</form></div></div>';
                        $PRODUCT_SELECT_VAR .= '<hr class="p_line">'; 
                    } else {
                        $PRODUCT_SELECT_VAR .= '<div class="p_menu">';
                        $PRODUCT_SELECT_VAR .= '</div></div>';
                        $PRODUCT_SELECT_VAR .= '<hr class="p_line">'; 
                    }
                    
                    $PRODUCT_SCRIPT = " 
                    var parentContainers = document.querySelectorAll('.p_menu_div');

                    parentContainers.forEach(function(parentContainer) {
                        parentContainer.addEventListener('mouseover', function(event) {
                            if (event.target.classList.contains('p_btn') || event.target.classList.contains('p_label') || event.target.classList.contains('icon')) {
                                var buttons = parentContainer.querySelectorAll('.p_btn');
                                var icons = parentContainer.querySelectorAll('.icon');
                                buttons.forEach(function(button, index) {
                                    button.style.backgroundColor = '#d6e9f5';
                                    icons[index].classList.add('icon-hover');
                                });
                            }
                        });

                        parentContainer.addEventListener('mouseout', function(event) {
                            var buttons = parentContainer.querySelectorAll('.p_btn');
                            var icons = parentContainer.querySelectorAll('.icon');
                            buttons.forEach(function(button, index) {
                                button.style.backgroundColor = 'initial';
                                icons[index].classList.remove('icon-hover');
                            });
                        });
                    });
                    ";
                }  
            }
        } else {
            $PRODUCT_SELECT_VAR .= '<span class="EmptyMsg">Nenhum Produto encontrado.</span>';
        }

        $conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/MAIN.CSS">
    <link rel="stylesheet" href="../CSS/ABRE_CATALOGO.CSS">
    <link rel="stylesheet" href="../CSS/MODAL.CSS">
    <link rel="stylesheet" href="../CSS/FORMS.CSS">
    <link rel="stylesheet" href="../CSS/HEADER.CSS">
    <link rel="stylesheet" href="../CSS/NAVBAR.CSS">
    <link rel="stylesheet" href="../CSS/FOOTER.CSS">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/bilbo" type="text/css" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/sniglet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
            <?= $login_btn; ?>
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
                <?= $DefaultConfigNav ?>
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

                <?= $DefaultConfigBookBtn; ?>
            </section>
        </menu>
        <!-- #endregion -->

        <!-- #region -->
        <section class="catalogo_body">
            <div class="catalogo_table">
                <div class="catalogo_shield">
                    <?= $PRODUCT_SELECT_VAR; ?>
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
                    <input class="form_field" type="text" name="BOOK_TITULO" id="BOOK_TITULO" placeholder="Título" >
                    <label class="form_label" for="BOOK_TITULO">Título</label>
                </div>
                <div class="form_group">
                    <input class="form_field" type="text" name="BOOK_AUTOR" id="BOOK_AUTOR" placeholder="Autor" >
                    <label class="form_label" for="BOOK_AUTOR">Autor</label>
                </div>
                <div class="form_group">
                    <input class="form_field" type="text" name="BOOK_EDITORA" id="BOOK_EDITORA" placeholder="Editora" >
                    <label class="form_label" for="BOOK_EDITORA">Editora</label>
                </div>
                <div class="form_group_b">
                    <div class="form_group">
                        <input class="form_field" type="date" name="BOOK_ANO_PUBLICACAO_INI" id="BOOK_ANO_PUBLICACAO_INI">
                        <label class="form_label" for="BOOK_ANO_PUBLICACAO_INI">Ano Inicial</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="date" name="BOOK_ANO_PUBLICACAO_FIM" id="BOOK_ANO_PUBLICACAO_FIM">
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

                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="ficcao" id="ficcao">
                            <label for="ficcao" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Ficção</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="romance" id="romance">
                            <label for="romance" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Romance</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="misterio-suspense" id="misterio-suspense">
                            <label for="misterio-suspense" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Mistério / Suspense</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="fantasia" id="fantasia">
                            <label for="fantasia" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Fantasia</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="aventura" id="aventura">
                            <label for="aventura" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Aventura</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="ficcao-cientifica" id="ficcao-cientifica">
                            <label for="ficcao-cientifica" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Ficção Científica</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="amizade" id="amizade">
                            <label for="amizade" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Amizade</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="amor" id="amor">
                            <label for="amor" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Amor</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="historia" id="historia">
                            <label for="historia" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>História</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="biografia" id="biografia">
                            <label for="biografia" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Biografia</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="autoajuda" id="autoajuda">
                            <label for="autoajuda" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Autoajuda</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="crescimento-pessoal" id="crescimento-pessoal">
                            <label for="crescimento-pessoal" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Crescimento Pessoal</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="religiao" id="religiao">
                            <label for="religiao" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Religião</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_GENERO[]" value="politica" id="politica">
                            <label for="politica" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Política</span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Classificação</legend>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_CLASSIFICACAO[]" value="1" id="uma-estrela">
                            <label for="uma-estrela" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>1 Estrela</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_CLASSIFICACAO[]" value="2"  id="duas-estrelas">
                            <label for="duas-estrelas" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>2 Estrela</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_CLASSIFICACAO[]" value="3" id="tres-estrelas">
                            <label for="tres-estrelas" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>3 Estrela</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_CLASSIFICACAO[]" value="4" id="quatro-estrelas">
                            <label for="quatro-estrelas" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>4 Estrela</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_CLASSIFICACAO[]" value="5" id="cinco-estrelas">
                            <label for="cinco-estrelas" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>5 Estrela</span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Idioma</legend>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_IDIOMA[]" value="portugues" id="portugues">
                            <label for="portugues" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Português</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_IDIOMA[]" value="ingles" id="ingles">
                            <label for="ingles" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Inglês</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_IDIOMA[]" value="espanhol" id="espanhol">
                            <label for="espanhol" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Espanhol</span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Formato</legend>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_FORMATO[]" value="capa-dura" id="capa-dura">
                            <label for="capa-dura" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Capa Dura</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_FORMATO[]" value="capa-flexivel" id="capa-flexivel">
                            <label for="capa-flexivel" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Capa Flexível</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_FORMATO[]" value="e-book" id="e-book">
                            <label for="e-book" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>E-book</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_FORMATO[]" value="audio-book" id="audio-book">
                            <label for="audio-book" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Áudio-Book</span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Disponibilidade</legend>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_DISPONIBILIDADE[]" value="estoque" id="estoque">
                            <label for="estoque" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Em Estoque</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_DISPONIBILIDADE[]" value="pre-venda" id="pre-venda">
                            <label for="pre-venda" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Pré-Venda</span>
                            </label>
                        </div>
                    </fieldset>

                    <fieldset class="f_fieldset">
                        <legend class="f_legend">Público-Alvo</legend>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_PUBLICO_ALVO[]" value="criancas" id="criancas">
                            <label for="criancas" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Crianças</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_PUBLICO_ALVO[]" value="adolecentes" id="adolecentes">
                            <label for="adolecentes" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Adolecentes</span>
                            </label>
                        </div>
                        <div class="f_checkbox">
                            <input class="f_box" type="checkbox" name="BOOK_PUBLICO_ALVO[]" value="adultos" id="adultos">
                            <label for="adultos" class="f_label">
                                <svg width="45" height="45" viewbox="0 0 100 100">
                                <rect x="30" y="20" width="45" height="45" stroke="black" fill="none" rx="10" ry="10" />
                                    <g transform="translate(0,-952.36222)">
                                        <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4 "
                                        stroke="black" stroke-width="3" fill="none" class="path1" />
                                    </g>
                                </svg>
                                <span>Adultos</span>
                            </label>
                        </div>
                    </fieldset>
                    <div class="f_btn_div">
                        <button class="menu_btn f_btn_s" type="submit" name="product_btn">Filtrar</button>
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
                <form class="f_body" action="../PHP/PRODUCT_INSERT.php" method="post">
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_TITULO_CREATE" id="BOOK_TITULO_CREATE" placeholder="Título" >
                        <label class="form_label" for="BOOK_TITULO_CREATE">Título</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_AUTOR_CREATE" id="BOOK_AUTOR_CREATE" placeholder="Autor" >
                        <label class="form_label" for="BOOK_AUTOR_CREATE">Autor</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_EDITORA_CREATE" id="BOOK_EDITORA_CREATE" placeholder="Editora" >
                        <label class="form_label" for="BOOK_EDITORA_CREATE">Editora</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="date" name="BOOK_ANO_PUBLICACAO_CREATE" id="BOOK_ANO_PUBLICACAO_CREATE" >
                        <label class="form_label" for="BOOK_ANO_PUBLICACAO_CREATE">Ano de Publicação</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="number" name="BOOK_PRECO_CREATE" id="BOOK_PRECO_CREATE" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                        <label class="form_label" for="BOOK_PRECO_CREATE">Preço</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="number" name="BOOK_PRECO_DESC_CREATE" id="BOOK_PRECO_DESC_CREATE" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                        <label class="form_label" for="BOOK_PRECO_DESC_CREATE">Preço do Desconto</label>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox1">Gênero</label>
                        <select class="f_select" name="BOOK_GENERO_CREATE" id="selectbox1">
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
                        <select class="f_select" name="BOOK_CLASSIFICACAO_CREATE" id="selectbox2">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="1">1 Estrela</option>
                            <option value="2">2 Estrela</option>
                            <option value="3">3 Estrela</option>
                            <option value="4">4 Estrela</option>
                            <option value="5">5 Estrela</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox3">Idioma</label>
                        <select class="f_select" name="BOOK_IDIOMA_CREATE" id="selectbox3">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="portugues">Português</option>
                            <option value="ingles">Inglês</option>
                            <option value="espanhol">Espanhol</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox4">Formato</label>
                        <select class="f_select" name="BOOK_FORMATO_CREATE" id="selectbox4">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="capa-dura">Capa Dura</option>
                            <option value="capa-flexivel">Capa Flexível</option>
                            <option value="e-book">E-book</option>
                            <option value="audio-book">Áudio-Book</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox5">Disponibilidade</label>
                        <select class="f_select" name="BOOK_DISPONIBILIDADE_CREATE" id="selectbox5">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="estoque">Em Estoque</option>
                            <option value="pre-venda">Pré-Venda</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox6">Público-Alvo</label>
                        <select class="f_select" name="BOOK_PUBLICO_ALVO_CREATE" id="selectbox6">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="criancas">Crianças</option>
                            <option value="adolecentes">Adolecentes</option>
                            <option value="adultos">Adultos</option>
                        </select>
                    </div>
                    <div class="form_group form_group_img">
                        <input class="form_field form_field_img" type="file" name="BOOK_IMAGE_CREATE" id="BOOK_IMAGE_CREATE" accept="image/*">
                        <label class="form_label" for="BOOK_IMAGE_CREATE">Selecione uma Imagem</label>
                    </div>
                    <div class="f_btn_div">
                        <button class="menu_btn f_btn_s" type="submit">Adicionar</button>
                    </div>
                </form>
            </section>
        </div>
    </modal>

    <modal class="book_edit_modal m_start hidden">
        <div class="m_wrap">
            <section class="m_head">
                <span class="m_title"><span>Editar Livro</span></span>
                <i class="m_close m_book_edit_close fa-regular fa-circle-xmark fa-xl"></i>
            </section>
            <section class="m_body">
                <form class="f_body" action="../PHP/PRODUCT_INSERT.php" method="post">
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_TITULO_EDIT" id="BOOK_TITULO_EDIT" placeholder="Título" >
                        <label class="form_label" for="BOOK_TITULO_EDIT">Título</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_AUTOR_EDIT" id="BOOK_AUTOR_EDIT" placeholder="Autor" >
                        <label class="form_label" for="BOOK_AUTOR_EDIT">Autor</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_EDITORA_EDIT" id="BOOK_EDITORA_EDIT" placeholder="Editora" >
                        <label class="form_label" for="BOOK_EDITORA_EDIT">Editora</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="text" name="BOOK_ANO_PUBLICACAO_EDIT" id="BOOK_ANO_PUBLICACAO_EDIT" placeholder="MM/AAAA"  onfocus="changeInputType('BOOK_ANO_PUBLICACAO', 'month')" onblur="changeInputType('BOOK_ANO_PUBLICACAO', 'text')">
                        <label class="form_label" for="BOOK_ANO_PUBLICACAO_EDIT">Ano de Publicação</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="number" name="BOOK_PRECO_EDIT" id="BOOK_PRECO_EDIT" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                        <label class="form_label" for="BOOK_PRECO_EDIT">Preço</label>
                    </div>
                    <div class="form_group">
                        <input class="form_field" type="number" name="BOOK_PRECO_DESC_EDIT" id="BOOK_PRECO_DESC_EDIT" placeholder="R$ 000.00" step="0.01" pattern="\d{3}\.\d{2}">
                        <label class="form_label" for="BOOK_PRECO_DESC_EDIT">Preço do Desconto</label>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox7">Gênero</label>
                        <select class="f_select" name="BOOK_GENERO_EDIT" id="selectbox7">
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
                        <label class="form_label_s" for="selectbox8">Classificação</label>
                        <select class="f_select" name="BOOK_CLASSIFICACAO_EDIT" id="selectbox8">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="uma-estrela">1 Estrela</option>
                            <option value="duas-estrelas">2 Estrela</option>
                            <option value="tres-estrelas">3 Estrela</option>
                            <option value="quatro-estrelas">4 Estrela</option>
                            <option value="cinco-estrelas">5 Estrela</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox9">Idioma</label>
                        <select class="f_select" name="BOOK_IDIOMA_EDIT" id="selectbox9">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="portugues">Português</option>
                            <option value="ingles">Inglês</option>
                            <option value="espanhol">Espanhol</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox10">Formato</label>
                        <select class="f_select" name="BOOK_FORMATO_EDIT" id="selectbox10">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="capa-dura">Capa Dura</option>
                            <option value="capa-flexivel">Capa Flexível</option>
                            <option value="e-book">E-book</option>
                            <option value="audio-book">Áudio-Book</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox11">Disponibilidade</label>
                        <select class="f_select" name="BOOK_DISPONIBILIDADE_EDIT" id="selectbox11">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="estoque">Em Estoque</option>
                            <option value="pre-venda">Pré-Venda</option>
                        </select>
                    </div>
                    <div class="form_group form_group_select">
                        <label class="form_label_s" for="selectbox12">Público-Alvo</label>
                        <select class="f_select" name="BOOK_PUBLICO_ALVO_EDIT" id="selectbox12">
                            <option value="">Selecione uma Opção&hellip;</option>
                            <option value="criancas">Crianças</option>
                            <option value="adolecentes">Adolecentes</option>
                            <option value="adultos">Adultos</option>
                        </select>
                    </div>
                    <div class="form_group form_group_img">
                        <input class="form_field form_field_img" type="file" name="BOOK_IMAGE_EDIT" id="BOOK_IMAGE_EDIT">
                        <label class="form_label" for="BOOK_IMAGE_EDIT">Selecione uma Imagem</label>
                    </div>
                    <div class="f_btn_div">
                        <button class="menu_btn f_btn_s" type="submit" name="bookCreate">Salvar</button>
                    </div>
                </form>
            </section>
        </div>
    </modal>
    <modal class="bookDeleteModal m_start hidden">
        <div class="m_wrapDel">
            <section class="m_headDel">
                <span class="m_title"><i class="fa-solid fa-triangle-exclamation"></i><span>Deseja deletar esse Livro?</span></span>
            </section>
            <section class="m_bodyDel">
                <form action="" method="post">
                    <div class="bookDeleteBtn bookDeleteModal_close btn btn-outline-danger"><i class="fa-regular fa-circle-xmark fa-xl"></i></div>
                    <button class="bookDeleteBtn btn btn-outline-success" type="submit"><i class="fa-solid fa-trash-check fa-xl"></i></button>
                </form>
            </section>
        </div>
    </modal>
    <modal class="bookVisibleTable m_start hidden">
        <div class="m_wrap">
            <section class="m_head">
                <span class="m_title"><span><i class="fa-solid fa-book"></i>Livros Ocultos</span></span>
                <i class="m_close m_bookVisibleTable_close fa-regular fa-circle-xmark fa-xl"></i>
            </section>
            <section class="m_body">
                
            </section>
        </div>
    </modal>
    <!-- #endregion -->
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../JS/SELECT_CONFIG.js"></script>
<script src="../JS/CONFIG_NAV.js"></script>
<script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
<script src="../JS/CATALOG_MENU.js"></script>
<script src="../JS/CATALOG_PAG.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?= $PRODUCT_SCRIPT ?>
    });

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
</html>