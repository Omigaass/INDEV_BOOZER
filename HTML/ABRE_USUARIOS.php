<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';

    if (!isset($_SESSION['USER_ID'])) {
        $login_btn = "<button class='header_btn'><a href=../index.html>Login</a></button>";
    } else {
        $login_btn = "<a href=../PHP/LOGOUT.php class=header_btn><button>Sair</button></a>";
    }
    
    include '../PHP/CONFIG.php';

    $USER_SELECT_VAR = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userListBtn'])) {

        $sql = "SELECT * FROM bz_user WHERE 1 = 1";

        $conditions = array();
        $params = array();

        if (!empty($_POST['USER_STATUS'])) {
            $USER_STATUS = $_POST['USER_STATUS'];
            $conditions[] = "USER_STATUS = ?";
            $params[] = $USER_STATUS;
        }

        if (!empty($_POST['USER_TYPE'])) {
            $USER_TYPE = $_POST['USER_TYPE'];
            $conditions[] = "USER_TYPE = ?";
            $params[] = $USER_TYPE;
        }

        if (!empty($_POST['SEARCH_TYPE']) && !empty($_POST['input_text_type'])) {
            $SEARCH_TYPE = $_POST['SEARCH_TYPE'];
            $SEARCH_TEXT = $conn->real_escape_string($_POST['input_text_type']);
            $conditions[] = "USER_" . strtoupper($SEARCH_TYPE) . " LIKE ?";
            $params[] = '%' . $SEARCH_TEXT . '%';
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
                $USER_SELECT_VAR .= "<tr>";
                $USER_SELECT_VAR .= "<th scope='row'>" . $row['USER_ID'] . "</th>";
                $USER_SELECT_VAR .= "<td>" . $row['USER_TYPE'] . "</td>";
                $USER_STATUS = $row['USER_STATUS'];
                if ($USER_STATUS == 1) {
                    $USER_SELECT_VAR .= "<td>Ativo</td>";
                } elseif ($USER_STATUS == 2) {
                    $USER_SELECT_VAR .= "<td>Inativo</td>";
                } elseif ($USER_STATUS == 3) {
                    $USER_SELECT_VAR .= "<td>Suspenso</td>";
                } else {
                    $USER_SELECT_VAR .= "<td>Nulo</td>";
                }
                $USER_SELECT_VAR .= "<td class='user_identify'>" . $row['USER_CPFCNPJ'] . "</td>";
                $USER_SELECT_VAR .= "<td>" . $row['USER_NAME'] . "</td>";
                $USER_SELECT_VAR .= "<td class='table_action_btn'>";
                $USER_SELECT_VAR .= "<button type='submit' id='" . $row['USER_ID']. "' class='user_view btn btn-sm btn-outline-primary'><i class='fa-solid fa-user-magnifying-glass'></i></button>";
                $USER_SELECT_VAR .= "<button type='submit' id='" . $row['USER_ID']. "' class='user_buy btn btn-sm btn-outline-success'><i class='fa-solid fa-basket-shopping'></i></button>";
                $USER_SELECT_VAR .= "<button type='submit' id='" . $row['USER_ID']. "' class='user_delete btn btn-sm btn-outline-danger' onclick='deleteUser(this.id)'><i class='fa-solid fa-user-minus'></i></button>";
                $USER_SELECT_VAR .= "</td>";
                $USER_SELECT_VAR .= "</tr>";
            }
        } else {
            $USER_SELECT_VAR .= "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
        }

        $conn->close();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_view'])) {
        $parent_id = $_POST['parent_id'];

        $sql = "SELECT USER_ID, USER_TYPE, USER_STATUS, USER_CPFCNPJ, USER_CEP, USER_NAME, USER_PASSWORD, USER_EMAIL, USER_RG, USER_IDADE, USER_DTNASC, USER_END, USER_ENDNUM, USER_BAIRRO, USER_CIDADE, USER_CEL, USER_TEL, USER_REGISTER_TIME FROM user_bz WHERE USER_ID = '$parent_id'";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "USER_ID: " . $row["USER_ID"]. " - USER_NAME: " . $row["USER_NAME"]. "<br>";
            }
        }
        
        $conn->close();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_buy'])) {

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
        $userId = $_POST['user_id'];
        $sql = "DELETE FROM bz_user WHERE USER_ID = ?";
    
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $userId);
            $stmt->execute();
        }
    }


?>

    <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../CSS/MAIN.CSS">
            <link rel="stylesheet" href="../CSS/ABRE_USUARIOS.CSS">
            <link rel="stylesheet" href="../CSS/MODAL.CSS">
            <link rel="stylesheet" href="../CSS/FORMS.CSS">
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
                        <div class=""><h2><i class="fa-solid fa-users-gear"></i> Usuários </h2> <button class="btn btn-primary u_btn user_create"><i class="fa-solid fa-user-plus"></i></button></div>
                        <hr />
                    </header>
                    <form action="" method="post">
                        <div class="u_row form-row">
                            <div class="u_col form-group col-md-2">
                                <label for="USER_STATUS">Status</label>
                                <select class="form-control" name="USER_STATUS" id="selectbox1">
                                    <option value="">Selecione uma Opção&hellip;</option>
                                    <option value="1">Ativo</option>
                                    <option value="2">Inativo</option>
                                    <option value="3">Suspenso</option>
                                </select>
                            </div>
                            <div class="u_col form-group col-md-2">
                                <label for="USER_TYPE">Tipo</label>
                                <select class="form-control" name="USER_TYPE" id="selectbox2">
                                    <option value="">Selecione uma Opção&hellip;</option>
                                    <option value="false">Cliente</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="u_row form-row">
                            <div class="u_col form-group col-md-2">
                                <label for="SEARCH_TYPE">Pesquisa</label>
                                <select class="form-control" name="SEARCH_TYPE" id="selectbox3">
                                    <option value="">Selecione uma Opção&hellip;</option>
                                    <option value="name">Nome</option>
                                    <option value="email">Email</option>  
                                    <option value="cpfcnpj">CPF</option>
                                </select>
                            </div>
                            <div class="u_col form-group col-md-5">
                                <label for="input_text_type">Text</label>
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                    <div class="user_search_bar input-group-text"><button type="submit" name="userListBtn" class="u_btn user_search btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button></div>
                                    </div>
                                    <input type="text" class="form-control" name="input_text_type" id="input_text_type" placeholder="Username" autocomplete="off">
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
                                <input type="text" class="form-control" name="USER_CPFCNPJ" maxlength="18" placeholder="000.000.000-00 ou 00.000.000/0000-00" oninput="formatarCPF(this)">
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
                        <form class="f_body" action="" method="post">
                            <div class="f_navbar">
                                <hr />
                                <div class="f_nav_btn userBasic active"><i class="fa-solid fa-address-card fa-xl"></i></div>
                                <div class="f_nav_btn userAddress"><i class="fa-solid fa-map-location-dot fa-xl"></i></div>
                                <div class="f_nav_btn userContact"><i class="fa-solid fa-address-book fa-xl"></i></div>
                            </div>
                            <div class="userEditForm userBasic_form active">
                                <div class="userEditForm_body">
                                    <div class="u_row form-row userInfo_row">
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_TYPE">Tipo</label>
                                            <select class="form-control" name="USER_TYPE" id="selectbox5">
                                                <option value="">Selecione uma Opção&hellip;</option>
                                                <option value="0">Cliente</option>
                                                <option value="1">Administrador</option>
                                            </select>
                                        </div>
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_TYPE">Status</label>
                                            <select class="form-control" name="USER_TYPE" id="selectbox6">
                                                <option value="">Selecione uma Opção&hellip;</option>
                                                <option value="0">Cliente</option>
                                                <option value="1">Administrador</option>
                                            </select>
                                        </div>
                                        <div class="u_col form-group col-md-3">
                                            <label for="USER_NAME" class="form-label">Login</label>
                                            <input type="text" class="form-control" name="USER_NAME">
                                        </div>
                                        <div class="u_col form-group col-md-3">
                                            <label for="USER_CPFCNPJ" class="form-label">Senha</label>
                                            <input type="text" class="form-control" name="USER_CPFCNPJ">
                                        </div>
                                    </div>
                                    <div class="u_row form-row userInfo_row">
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_CPFCNPJ" class="form-label">CPF / CNPJ</label>
                                            <input type="text" class="form-control" name="USER_CPFCNPJ" maxlength="18" placeholder="000.000.000-00 ou 00.000.000/0000-00" oninput="formatarCPF(this)">
                                        </div>
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_NAME" class="form-label">RG</label>
                                            <input type="text" class="form-control" name="USER_NAME">
                                        </div>
                                        <div class="u_col form-group col-md-4">
                                            <label for="USER_CPFCNPJ" class="form-label">Nome</label>
                                            <input type="text" class="form-control" name="USER_CPFCNPJ">
                                        </div>
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_NAME" class="form-label">Data de Nascimento</label>
                                            <input type="text" class="form-control" name="USER_NAME">
                                        </div>
                                    </div>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <div class="userNext userEdit_btn btn btn-outline-success">Próximo</div>
                                    </div>
                                </div>
                            </div>
                            <div class="userEditForm userAddress_form">   
                                <div class="u_row form-row userInfo_row">
                                    <div class="u_col form-group col-md-2">
                                        <label for="USER_CPFCNPJ" class="form-label">CEP</label>
                                        <input type="text" class="form-control" name="USER_CPFCNPJ">
                                    </div>
                                    <div class="u_col form-group col-md-5">
                                        <label for="USER_CPFCNPJ" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" name="USER_CPFCNPJ">
                                    </div>
                                    <div class="u_col form-group col-md-1">
                                        <label for="USER_NAME" class="form-label">Número</label>
                                        <input type="text" class="form-control" name="USER_NAME">
                                    </div>
                                </div>
                                <div class="u_row form-row userInfo_row">
                                    <div class="u_col form-group col-md-2">
                                        <label for="USER_TYPE">UF</label>
                                        <select class="form-control" name="USER_TYPE" id="selectbox7">
                                            <option value="">Selecione uma Opção&hellip;</option>
                                            <option value="0">Cliente</option>
                                            <option value="1">Administrador</option>
                                        </select>
                                    </div>
                                    <div class="u_col form-group col-md-2">
                                        <label for="USER_CPFCNPJ" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" name="USER_CPFCNPJ">
                                    </div>
                                    <div class="u_col form-group col-md-2">
                                        <label for="USER_NAME" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" name="USER_NAME">
                                    </div>
                                    <div class="u_col form-group col-md-2">
                                        <label for="USER_NAME" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" name="USER_NAME">
                                    </div>
                                </div>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <div class="userPrev userEdit_btn btn btn-outline-secondary">Anterior</div>
                                    <div class="userNext userEdit_btn btn btn-outline-success">Próximo</div>
                                </div>
                            </div>
                            <div class="userEditForm userContact_form">
                                <div class="u_row form-row userInfo_row">
                                    <div class="u_col form-group col-md-4">
                                        <label for="USER_CPFCNPJ" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" name="USER_CPFCNPJ">
                                    </div>
                                    <div class="u_col form-group col-md-4">
                                        <label for="USER_NAME" class="form-label">Celular</label>
                                        <input type="text" class="form-control" name="USER_NAME">
                                    </div>
                                </div>
                                <div class="u_row form-row userInfo_row">
                                    <div class="u_col form-group col-md-4">
                                        <label for="USER_CPFCNPJ" class="form-label">Email Principal</label>
                                        <input type="text" class="form-control" name="USER_CPFCNPJ">
                                    </div>
                                    <div class="u_col form-group col-md-4">
                                        <label for="USER_NAME" class="form-label">Email Secundário</label>
                                        <input type="text" class="form-control" name="USER_NAME">
                                    </div>
                                </div>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <div class="userPrev userEdit_btn btn btn-outline-secondary">Anterior</div><button id="userConfirmChange" class="userEdit_btn btn btn-outline-success">Gravar</button>
                                </div>
                            </div>
                        </form>
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
                        <table class="table table-hover t_userBuy">
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

                            </tbody>
                        </table>
                    </section>
                </div>
            </modal>
        <!-- #endregion -->
    </body>
    <script src="../JS/CONFIG_NAV.JS"></script>
    <script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
    <script src="../JS/USER_MODAL.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deleteUser(userId) {
            console.log('Deletando usuário com ID ' + userId);
            $.ajax({
                url: 'ABRE_USUARIOS.php',
                type: 'POST',
                data: {user_id: userId},
                success: function(response) {
                    console.log('Resposta recebida: ' + response);
                    if (response == "success") {
                        location.reload();
                    } else {
                        alert("usuario deletado.");
                        location.reload();
                    }
                }
            });
        }
    </script>
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