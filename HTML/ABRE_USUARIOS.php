<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';
    include '../PHP/USER_SELECT.php';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['USER_ID'])) {
        $login_btn = "<button class='header_btn'><a href=../index.html>Login</a></button>";
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
        <link rel="stylesheet" href="../CSS/ABRE_USUARIOS.CSS">
        <link rel="stylesheet" href="../CSS/HEADER.CSS">
        <link rel="stylesheet" href="../CSS/NAVBAR.CSS">
        <link rel="stylesheet" href="../CSS/FOOTER.CSS">
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/bilbo" type="text/css" />
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org//face/sniglet" type="text/css"/>
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
            <section class="u_filter">
                <header class="u_head">
                    <div class=""><h2><i class="fa-solid fa-users-gear"></i> Usuários </h2> <button class="btn btn-primary user_create"><i class="fa-solid fa-user-plus"></i></button></div>
                    <hr />
                </header>
                <form action="../PHP/USER_SELECT.php" method="post">
                    <div class="u_row form-row">
                        <div class="u_col form-group col-md-2">
                            <label for="USER_STATUS">Status</label>
                            <select class="form-control" name="USER_STATUS" id="selectbox1">
                                <option value="">Selecione uma Opção&hellip;</option>
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                                <option value="suspenso">Suspenso</option>
                            </select>
                        </div>
                        <div class="u_col form-group col-md-2">
                            <label for="USER_TYPE">Tipo</label>
                            <select class="form-control" name="USER_TYPE" id="selectbox2">
                                <option value="">Selecione uma Opção&hellip;</option>
                                <option value="user">Cliente</option>
                                <option value="adm">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <div class="u_row form-row">
                        <div class="u_col form-group col-md-2">
                            <label for="SEARCH_TYPE">Pesquisa</label>
                            <select class="form-control" name="SEARCH_TYPE" id="selectbox3">
                                <option value="">Selecione uma Opção&hellip;</option>
                                <option value="nome">Nome</option>
                                <option value="tipo">Tipo</option>
                                <option value="cpf">CPF</option>
                            </select>
                        </div>
                        <div class="u_col form-group col-md-5">
                            <label for="inlineFormInputGroupUsername2">Text</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                <div class="user_search_bar input-group-text"><button type="submit" class="user_search btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button></div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <section class="u_table table-responsive-md">
                <table class="table table-hover ">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Status</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo $USER_SELECT_VAR;
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
        <footer class="footer_sec">
            <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
        </footer>
        
    </div>
    <!-- #region -->
        <div class="back_screen hidden"></div>
        <modal class="userInsert_modal m_start hidden">
            <div class="m_wrap">
                <section class="m_head">
                    <span class="m_title"><span><i class="fa-solid fa-user-plus"></i>Criar novo Usuário</span></span>
                    <i class="m_close m_userInsert_close fa-regular fa-circle-xmark fa-xl"></i>
                </section>
                <section class="m_body">
                <header class="u_head mu_head">
                    <h5><i class="fa-solid fa-users-gear"></i> Dados do novo usuário </h5>
                    <hr />
                </header>
                <form action="../PHP/USER_INSERT.php" method="post">
                    <div class="u_row form-row">
                        <div class="u_col form-group col-md-3">
                            <label for="USER_TYPE">Tipo</label>
                            <select class="form-control" name="USER_TYPE" id="selectbox4">
                                <option value="">Selecione uma Opção&hellip;</option>
                                <option value="0">Cliente</option>
                                <option value="1">Administrador</option>
                            </select>
                        </div>
                        <div class="u_col form-group col-md-3">
                            <label for="USER_CPFCNPJ" class="form-label">CPF / CNPJ</label>
                            <input type="text" class="form-control" name="USER_CPFCNPJ" maxlength="14" placeholder="000.000.000-00" oninput="formatarCPF(this)">
                        </div>
                        <div class="u_col form-group col-md-4">
                            <label for="USER_NAME" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="USER_NAME">
                        </div>
                    </div>
                    <div class="u_row form-row">
                        <div class="u_col form-group col-md-3">
                            <label for="USER_EMAIL" class="form-label">Email</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fa-solid fa-envelope"></i></div>
                                <input type="email" class="form-control" name="USER_EMAIL" placeholder="exemplo@gmail.com">
                            </div>
                        </div>
                        <div class="u_col form-group col-md-3">
                            <label for="USER_PASSWORD" class="form-label">Password</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                                <input type="password" class="form-control" name="USER_PASSWORD" placeholder="**********">
                            </div>
                        </div>
                        <div class="u_col form-group col-md-3" style="display: flex; align-items: flex-end;">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary" style="width: 50%;">Criar</button>
                            </div>
                        </div>
                    </div>
                </form>
                </section>
            </div>
        </modal>
    <!-- #endregion -->
    <!-- #region -->
        <modal class="userView_modal m_start hidden">
            <div class="m_wrap">
                <section class="m_head">
                    <span class="m_title"><span><i class="fa-solid fa-book"></i>Dados do Usuário</span></span>
                    <i class="m_close m_userView_close fa-regular fa-circle-xmark fa-xl"></i>
                </section>
                <section class="m_body">
                    
                </section>
            </div>
        </modal>
    <!-- #endregion -->
    <!-- #region -->
        <modal class="userBuy_modal m_start hidden">
            <div class="m_wrap">
                <section class="m_head">
                    <span class="m_title"><span><i class="fa-solid fa-book"></i>Dados de Vendas</span></span>
                    <i class="m_close m_userBuy_close fa-regular fa-circle-xmark fa-xl"></i>
                </section>
                <section class="m_body">
                    
                </section>
            </div>
        </modal>
    <!-- #endregion -->
</body>
<script src="../JS/CONFIG_NAV.JS"></script>
<script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
<script src="../JS/USER_MODAL.js"></script>
<script>
    function formatarCPF(campo) {
        // Remove todos os caracteres não numéricos
        const valor = campo.value.replace(/\D/g, '');

        // Adiciona a máscara de CPF
        if (valor.length <= 11) {
            campo.value = valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        } else {
            // Se o valor for maior que 11 dígitos, limite o campo a 14 caracteres
            campo.value = valor.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
        }
    }

    const elements = document.querySelectorAll('.user_identify');

    elements.forEach(element => {
        const text = element.textContent;
        const formattedText = userIdentify(text); // Chame a função de formatação
        element.textContent = formattedText; // Atualize o conteúdo formatado
    });

    function userIdentify(text) {
        if (text.length <= 11) {
            return text.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        } else {
            return text.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
        }
    }

    function abre_login() {
        window.location.href = "../index.html";
    }
    configurarNavegacao(".navbar_item");
    const telaId = "usuarios"
    const navbar_btn = document.getElementById(`navbar_${telaId}`);
    navbar_btn.classList.add("navbar_active");
</script>
</html>