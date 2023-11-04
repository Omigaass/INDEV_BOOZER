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
                $USER_SELECT_VAR .= "<button type='submit' id='" . $row['USER_ID']. "' class='user_view btn btn-sm btn-outline-primary' onclick='ViewId(this.id)'><i class='fa-solid fa-user-magnifying-glass'></i></button>";
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userViewId'])) {
        $user_id = $_POST['userViewId'];
    
        $query = "SELECT USER_ID, USER_TYPE, USER_STATUS, USER_CPFCNPJ, USER_NAME, USER_PASSWORD, USER_RG, USER_DTNASC, USER_CEP, USER_END, USER_ENDNUM, USER_UF, USER_CIDADE, USER_BAIRRO, USER_COMPLE, USER_TEL, USER_CEL, USER_EMAIL_CON, USER_EMAIL2_CON FROM bz_user WHERE USER_ID = ?";
        
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
    
            echo json_encode($row);
        } else {
            echo json_encode(array('error' => 'Erro na consulta.'));
        }
        
        $conn->close();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_buy'])) {

    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userDeleteId'])) {
        $userId = $_POST['userDeleteId'];
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                <label for="selectbox1">Status</label>
                                <select class="form-control" name="USER_STATUS" id="selectbox1">
                                    <option value="">Selecione uma Opção&hellip;</option>
                                    <option value="1">Ativo</option>
                                    <option value="2">Inativo</option>
                                    <option value="3">Suspenso</option>
                                </select>
                            </div>
                            <div class="u_col form-group col-md-2">
                                <label for="selectbox2">Tipo</label>
                                <select class="form-control" name="USER_TYPE" id="selectbox2">
                                    <option value="">Selecione uma Opção&hellip;</option>
                                    <option value="false">Cliente</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="u_row form-row">
                            <div class="u_col form-group col-md-2">
                                <label for="selectbox3">Pesquisa</label>
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
                                <label for="selectbox4">Tipo</label>
                                <select class="form-control" name="USER_TYPE" id="selectbox4">
                                    <option value="">Selecione uma Opção&hellip;</option>
                                    <option value="0">Cliente</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                            <div class="u_col form-group col-md-3">
                                <label for="USER_CPFCNPJ" class="form-label">CPF / CNPJ</label>
                                <input type="text" class="form-control" id="USER_CPFCNPJ" name="USER_CPFCNPJ" maxlength="18" placeholder="000.000.000-00 ou 00.000.000/0000-00" oninput="formatarCPF(this)">
                            </div>
                            <div class="u_col form-group col-md-4">
                                <label for="USER_NAME" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="USER_NAME" name="USER_NAME">
                            </div>
                        </div>
                        <div class="u_row form-row">
                            <div class="u_col form-group col-md-3">
                                <label for="USER_EMAIL" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fa-solid fa-envelope"></i></div>
                                    <input type="email" class="form-control" id="USER_EMAIL" name="USER_EMAIL" placeholder="exemplo@gmail.com">
                                </div>
                            </div>
                            <div class="u_col form-group col-md-3">
                                <label for="USER_PASSWORD" class="form-label">Password</label>
                                <div class="input-group">
                                    <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                                    <input type="password" class="form-control" id="USER_PASSWORD" name="USER_PASSWORD" placeholder="**********">
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
                                            <label for="selectbox5">Tipo</label>
                                            <select class="form-control" name="USER_TYPE_EDIT" id="selectbox5">
                                                <option value="">Selecione uma Opção&hellip;</option>
                                                <option value="0">Cliente</option>
                                                <option value="1">Administrador</option>
                                            </select>
                                        </div>
                                        <div class="u_col form-group col-md-2">
                                            <label for="selectbox6">Status</label>
                                            <select class="form-control" name="USER_STATUS_EDIT" id="selectbox6">
                                                <option value="">Selecione uma Opção&hellip;</option>
                                                <option value="1">Ativo</option>
                                                <option value="2">Suspenso</option>
                                                <option value="3">Inativo</option>
                                            </select>
                                        </div>
                                        <div class="u_col form-group col-md-3">
                                            <label for="USER_EMAIL_EDIT" class="form-label">Login</label>
                                            <input type="text" class="form-control" id="USER_EMAIL_EDIT" name="USER_EMAIL_EDIT">
                                        </div>
                                        <div class="u_col form-group col-md-3">
                                            <label for="USER_PASSWORD_EDIT" class="form-label">Senha</label>
                                            <input type="text" class="form-control" id="USER_PASSWORD_EDIT" name="USER_PASSWORD_EDIT">
                                        </div>
                                    </div>
                                    <div class="u_row form-row userInfo_row">
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_CPFCNPJ_EDIT" class="form-label">CPF / CNPJ</label>
                                            <input type="text" class="form-control" id="USER_CPFCNPJ_EDIT" name="USER_CPFCNPJ_EDIT" maxlength="18" placeholder="000.000.000-00 ou 00.000.000/0000-00" oninput="formatarCPF(this)">
                                        </div>
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_RG_EDIT" class="form-label">RG</label>
                                            <input type="text" class="form-control" id="USER_RG_EDIT" name="USER_RG_EDIT" maxlength="12" placeholder="00.000.000-0" oninput="formatarRG(this)">
                                        </div>
                                        <div class="u_col form-group col-md-4">
                                            <label for="USER_NAME_EDIT" class="form-label">Nome</label>
                                            <input type="text" class="form-control" id="USER_NAME_EDIT" name="USER_NAME_EDIT">
                                        </div>
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_DTNASC_EDIT" class="form-label">Data de Nascimento</label>
                                            <input type="text" class="form-control" id="USER_DTNASC_EDIT" name="USER_DTNASC_EDIT">
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
                                        <label for="USER_CEP_EDIT" class="form-label">CEP</label>
                                        <input type="text" class="form-control" id="USER_CEP_EDIT" name="USER_CEP_EDIT" maxlength="9" placeholder="00000-000" oninput="formatarCEP(this)">
                                    </div>
                                    <div class="u_col form-group col-md-5">
                                        <label for="USER_END_EDIT" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="USER_END_EDIT" name="USER_END_EDIT">
                                    </div>
                                    <div class="u_col form-group col-md-1">
                                        <label for="USER_ENDNUM_EDIT" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="USER_ENDNUM_EDIT" name="USER_ENDNUM_EDIT">
                                    </div>
                                </div>
                                <div class="u_row form-row userInfo_row">
                                    <div class="u_col form-group col-md-2">
                                        <label for="selectbox7">UF</label>
                                        <select class="form-control" name="USER_UF_EDIT" id="selectbox7">
                                            <option value="">Selecione uma Opção&hellip;</option>
                                            <option value="AC">Acre (AC)</option>
                                            <option value="AL">Alagoas (AL)</option>
                                            <option value="AP">Amapá (AP)</option>
                                            <option value="AM">Amazonas (AM)</option>
                                            <option value="BA">Bahia (BA)</option>
                                            <option value="CE">Ceará (CE)</option>
                                            <option value="DF">Distrito Federal (DF)</option>
                                            <option value="ES">Espírito Santo (ES)</option>
                                            <option value="GO">Goiás (GO)</option>
                                            <option value="MA">Maranhão (MA)</option>
                                            <option value="MT">Mato Grosso (MT)</option>
                                            <option value="MS">Mato Grosso do Sul (MS)</option>
                                            <option value="MG">Minas Gerais (MG)</option>
                                            <option value="PA">Pará (PA)</option>
                                            <option value="PB">Paraíba (PB)</option>
                                            <option value="PR">Paraná (PR)</option>
                                            <option value="PE">Pernambuco (PE)</option>
                                            <option value="PI">Piauí (PI)</option>
                                            <option value="RJ">Rio de Janeiro (RJ)</option>
                                            <option value="RN">Rio Grande do Norte (RN)</option>
                                            <option value="RS">Rio Grande do Sul (RS)</option>
                                            <option value="RO">Rondônia (RO)</option>
                                            <option value="RR">Roraima (RR)</option>
                                            <option value="SC">Santa Catarina (SC)</option>
                                            <option value="SP">São Paulo (SP)</option>
                                            <option value="SE">Sergipe (SE)</option>
                                            <option value="TO">Tocantins (TO)</option>
                                        </select>
                                    </div>
                                    <div class="u_col form-group col-md-2">
                                        <label for="USER_CIDADE_EDIT" class="form-label">Cidade</label>
                                        <input type="text" class="form-control" id="USER_CIDADE_EDIT" name="USER_CIDADE_EDIT">
                                    </div>
                                    <div class="u_col form-group col-md-2">
                                        <label for="USER_BAIRRO_EDIT" class="form-label">Bairro</label>
                                        <input type="text" class="form-control" id="USER_BAIRRO_EDIT" name="USER_BAIRRO_EDIT">
                                    </div>
                                    <div class="u_col form-group col-md-2">
                                        <label for="USER_COMPLE_EDIT" class="form-label">Complemento</label>
                                        <input type="text" class="form-control" id="USER_COMPLE_EDIT" name="USER_COMPLE_EDIT">
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
                                        <label for="USER_TEL_EDIT" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" id="USER_TEL_EDIT" name="USER_TEL_EDIT" maxlength="14" placeholder="(00) 00000-0000" oninput="formatarTEL(this)">
                                    </div>
                                    <div class="u_col form-group col-md-4">
                                        <label for="USER_CEL_EDIT" class="form-label">Celular</label> 
                                        <input type="text" class="form-control" id="USER_CEL_EDIT" name="USER_CEL_EDIT" maxlength="14" placeholder="(00) 00000-0000" oninput="formatarCEL(this)">
                                    </div>
                                </div>
                                <div class="u_row form-row userInfo_row">
                                    <div class="u_col form-group col-md-4">
                                        <label for="USER_EMAIL_CON" class="form-label">Email Principal</label>
                                        <input type="email" class="form-control" id="USER_EMAIL_CON" name="USER_EMAIL_CON">
                                    </div>
                                    <div class="u_col form-group col-md-4">
                                        <label for="USER_EMAIL2_CON" class="form-label">Email Secundário</label>
                                        <input type="email" class="form-control" id="USER_EMAIL2_CON" name="USER_EMAIL2_CON">
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
            function deleteUser(userDeleteId) {
                console.log('Deletando usuário com ID ' + userDeleteId);
                $.ajax({
                    url: 'ABRE_USUARIOS.php',
                    type: 'POST',
                    data: {userDeleteId: userDeleteId},
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
            function ViewId(userId) {
                getUserData(userId, function(data) {
                    document.getElementsByName('USER_TYPE_EDIT')[0].value = data.USER_TYPE;
                    document.getElementsByName('USER_STATUS_EDIT')[0].value = data.USER_STATUS;
                    document.getElementsByName('USER_EMAIL_EDIT').value = data.USER_EMAIL;
                });
            }
            
            function getUserData(userId, callback) {
                $.ajax({
                    url: 'ABRE_USUARIOS.php',
                    type: 'POST',
                    data: { userViewId: userId },
                    dataType: 'json',
                    success: function(data) {
                        callback(data);
                    }
                });
            }

            
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

        function formatarRG(campo) {
            // Remove todos os caracteres não numéricos
            const valor = campo.value.replace(/\D/g, '');

            campo.value = valor.replace(/(\d{2})(\d{3})(\d{3})(\d{1,2})/, '$1.$2.$3-$4');
        }

        function formatarCEP(campo) {
            // Remove todos os caracteres não numéricos
            const valor = campo.value.replace(/\D/g, '');

            // Adiciona a máscara de CEP
            campo.value = valor.replace(/(\d{5})(\d{3})/, '$1-$2');
        }

        function formatarTEL(campo) {
            // Remove todos os caracteres não numéricos
            const valor = campo.value.replace(/\D/g, '');

            // Adiciona a máscara de telefone
            if (valor.length === 10) {
                campo.value = valor.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            } else {
                campo.value = valor.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            }
        }

        function formatarCEL(campo) {
            // Remove todos os caracteres não numéricos
            const valor = campo.value.replace(/\D/g, '');

            // Adiciona a máscara de celular
            if (valor.length === 11) {
                campo.value = valor.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else {
                campo.value = valor.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            }
        }

        function userIdentify(text) {
            if (text.length <= 11) {
                return text.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
            } else {
                return text.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            }
        }

        const elements = document.querySelectorAll('.user_identify');

        elements.forEach(element => {
            const text = element.textContent;
            const formattedText = userIdentify(text); // Chame a função de formatação
            element.textContent = formattedText; // Atualize o conteúdo formatado
        });

        function abre_login() {
            window.location.href = "../index.html";
        }
        configurarNavegacao(".navbar_item");
        const telaId = "usuarios"
        const navbar_btn = document.getElementById(`navbar_${telaId}`);
        navbar_btn.classList.add("navbar_active");
    </script>
    </html>