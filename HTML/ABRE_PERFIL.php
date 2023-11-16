<?php
    session_start();

    require '../PHP/USER_VALIDATION.php';
    include '../PHP/CONFIG.php';

    // Verificar se o usuário está logado
    if (!isset($_SESSION['USER_ID'])) {
        $login_btn = "<a href=../index.html class=header_btn><button>Login</button></a>";
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
    $USERSYSTEMINFO = '';
    $USERINFOEDIT_1 = '';
    $USERINFOEDIT_2 = '';
    $USERINFOEDIT_3 = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($row['USER_NAME'] > 0){
                $USERINFO .= '<tr><th scope="row">Nome:</th><td>' . $row['USER_NAME'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">Nome:</th><td>null</td></tr>';
            }
            if($row['USER_EMAIL'] > 0){
                $USERINFO .= '<tr><th scope="row">Email:</th><td>' . $row['USER_EMAIL'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">Email:</th><td>null</td></tr>';
            }
            if($row['USER_CPFCNPJ'] > 0){
                $USERINFO .= '<tr><th scope="row">CPF/CNPJ:</th><td class="USER_CPFCNPJ">' . $row['USER_CPFCNPJ'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">CPF/CNPJ:</th><td>null</td></tr>';
            }
            if($row['USER_RG'] > 0){
                $USERINFO .= '<tr><th scope="row">RG:</th><td class="USER_RG">' . $row['USER_RG'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">RG:</th><td>null</td></tr>';
            }
            if($row['USER_TEL'] > 0){
                $USERINFO .= '<tr><th scope="row">Telefone:</th><td class="USER_TEL">' . $row['USER_TEL'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">Telefone:</th><td>null</td></tr>';
            }
            if($row['USER_CEL'] > 0){
                $USERINFO .= '<tr><th scope="row">Celular:</th><td class="USER_CEL">' . $row['USER_CEL'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">Celular:</th><td>null</td></tr>';
            }
            if($row['USER_CEP'] > 0){
                $USERINFO .= '<tr><th scope="row">CEP:</th><td class="USER_CEP">' . $row['USER_CEP'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">CEP:</th><td>null</td></tr>';
            }
            if($row['USER_END'] > 0){
                $USERINFO .= '<tr><th scope="row">Endereço:</th><td>' . $row['USER_END'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">Endereço:</th><td>null</td></tr>';
            }
            if($row['USER_CIDADE'] > 0){
                $USERINFO .= '<tr><th scope="row">Cidade:</th><td>' . $row['USER_CIDADE'] . '</td></tr>';
            } else{
                $USERINFO .= '<tr><th scope="row">Cidade:</th><td>null</td></tr>';
            }
            $USERINFO .= '<div class="btn btn-outline-primary btn-sm userUpdateBtn"><i class="fa-solid fa-pen-to-square"></i> Editar</div>';

            //?-------------------------------------------------------------------------------?

            if($row['USER_EMAIL'] > 0){
                $USERINFOEDIT_1 .= '  <div class="u_row form-row userInfo_row">
                                        <div class="u_col form-group col-md-4">
                                            <label for="USER_EMAIL_EDIT" class="form-label">Login</label>
                                            <input type="text" class="form-control" id="USER_EMAIL_EDIT" name="USER_EMAIL_EDIT" value="' . $row['USER_EMAIL'] . '">
                                        </div>';
            } else{
                $USERINFOEDIT_1 .= '  <div class="u_row form-row userInfo_row">
                                        <div class="u_col form-group col-md-4">
                                            <label for="USER_EMAIL_EDIT" class="form-label">Login</label>
                                            <input type="text" class="form-control" id="USER_EMAIL_EDIT" name="USER_EMAIL_EDIT" placeholder="null">
                                        </div>';
            }

            $USERINFOEDIT_1 .= '  <div class="u_col form-group col-md-4">
                                    <label for="USER_PASSWORD_EDIT" class="form-label">Senha</label>
                                    <input type="text" class="form-control" id="USER_PASSWORD_EDIT" name="USER_PASSWORD_EDIT" value="Inserir nova senha">
                                </div>    
                            </div>';

            if($row['USER_CPFCNPJ'] > 0){
                $USERINFOEDIT_1 .= '  <div class="u_row form-row userInfo_row">
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_CPFCNPJ_EDIT" class="form-label">CPF / CNPJ</label>
                                            <input type="text" class="form-control" id="USER_CPFCNPJ_EDIT" name="USER_CPFCNPJ_EDIT" value="' . $row['USER_CPFCNPJ'] . '" maxlength="18" placeholder="000.000.000-00 ou 00.000.000/0000-00" oninput="formatarCPF(this)">
                                        </div>';
            } else{
                $USERINFOEDIT_1 .= ' <div class="u_row form-row userInfo_row">
                                        <div class="u_col form-group col-md-2">
                                            <label for="USER_CPFCNPJ_EDIT" class="form-label">CPF / CNPJ</label>
                                            <input type="text" class="form-control" id="USER_CPFCNPJ_EDIT" name="USER_CPFCNPJ_EDIT" placeholder="null" maxlength="18" placeholder="000.000.000-00 ou 00.000.000/0000-00" oninput="formatarCPF(this)">
                                        </div>';
            } 
            
            if($row['USER_RG'] > 0){
                $USERINFOEDIT_1 .= '  <div class="u_col form-group col-md-2">
                                        <label for="USER_RG_EDIT" class="form-label">RG</label>
                                        <input type="text" class="form-control" id="USER_RG_EDIT" name="USER_RG_EDIT" value="' . $row['USER_RG'] . '" maxlength="12" placeholder="00.000.000-0" oninput="formatarRG(this)">
                                    </div>';
            } else{
                $USERINFOEDIT_1 .= '  <div class="u_col form-group col-md-2">
                                        <label for="USER_RG_EDIT" class="form-label">RG</label>
                                        <input type="text" class="form-control" id="USER_RG_EDIT" name="USER_RG_EDIT" placeholder="null" maxlength="12" placeholder="00.000.000-0" oninput="formatarRG(this)">
                                    </div>';
            }
            
            if($row['USER_NAME'] > 0){
                $USERINFOEDIT_1 .= '  <div class="u_col form-group col-md-4">
                                        <label for="USER_NAME_EDIT" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="USER_NAME_EDIT" name="USER_NAME_EDIT" value="' . $row['USER_NAME'] . '">
                                    </div>';
            } else{
                $USERINFOEDIT_1 .= '  <div class="u_col form-group col-md-4">
                                        <label for="USER_NAME_EDIT" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="USER_NAME_EDIT" name="USER_NAME_EDIT" placeholder="null">
                                    </div>';
            }                    
            
            if($row['USER_DTNASC'] > 0){
                $USERINFOEDIT_1 .= '  <div class="u_col form-group col-md-2">
                                        <label for="USER_DTNASC_EDIT" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="USER_DTNASC_EDIT" name="USER_DTNASC_EDIT" value="' . $row['USER_DTNASC'] . '">
                                    </div>
                                </div>';
            } else{
                $USERINFOEDIT_1 .= '  <div class="u_col form-group col-md-2">
                                        <label for="USER_DTNASC_EDIT" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="USER_DTNASC_EDIT" name="USER_DTNASC_EDIT">
                                    </div>
                                </div>';
            }     
            
            if($row['USER_CEP'] > 0){
                $USERINFOEDIT_2 .= '    <div class="u_row form-row userInfo_row">
                                            <div class="u_col form-group col-md-2">
                                                <label for="USER_CEP_EDIT" class="form-label">CEP</label>
                                                <input type="text" class="form-control" id="USER_CEP_EDIT" name="USER_CEP_EDIT" value="' . $row['USER_CEP'] . '"maxlength="9" placeholder="00000-000" oninput="formatarCEP(this)">
                                            </div>';
            } else{
                $USERINFOEDIT_2 .= '    <div class="u_row form-row userInfo_row">
                                            <div class="u_col form-group col-md-2">
                                                <label for="USER_CEP_EDIT" class="form-label">CEP</label>
                                                <input type="text" class="form-control" id="USER_CEP_EDIT" name="USER_CEP_EDIT" placeholder="null"maxlength="9" placeholder="00000-000" oninput="formatarCEP(this)">
                                            </div>';
            }   
            if($row['USER_END'] > 0){
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-5">
                                            <label for="USER_END_EDIT" class="form-label">Endereço</label>
                                            <input type="text" class="form-control" id="USER_END_EDIT" name="USER_END_EDIT" value="' . $row['USER_CEP'] . '">
                                        </div>';
            } else{
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-5">
                                            <label for="USER_END_EDIT" class="form-label">Endereço</label>
                                            <input type="text" class="form-control" id="USER_END_EDIT" name="USER_END_EDIT" placeholder="null">
                                        </div>';
            }   
            if($row['USER_ENDNUM'] > 0){
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-1">
                                            <label for="USER_ENDNUM_EDIT" class="form-label">Número</label>
                                            <input type="text" class="form-control" id="USER_ENDNUM_EDIT" name="USER_ENDNUM_EDIT" value="' . $row['USER_ENDNUM'] . '">
                                        </div>
                                    </div>';
            } else{
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-1">
                                            <label for="USER_ENDNUM_EDIT" class="form-label">Número</label>
                                            <input type="text" class="form-control" id="USER_ENDNUM_EDIT" name="USER_ENDNUM_EDIT" placeholder="null">
                                        </div>
                                    </div>';
            } 
            if($row['USER_UF'] > 0){
                $USERINFOEDIT_2 .= '    <div class="u_row form-row userInfo_row">
                                            <div class="u_col form-group col-md-2">
                                                <label for="selectbox7">UF (ATUAL: ' . $row['USER_UF'] . ')</label>
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
                                            </div>';
            } else{
                $USERINFOEDIT_2 .= '    <div class="u_row form-row userInfo_row">
                                            <div class="u_col form-group col-md-2">
                                                <label for="selectbox7">UF (ATUAL: Nenhuma)</label>
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
                                            </div>';
            } 
            if($row['USER_CIDADE'] > 0){
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-2">
                                            <label for="USER_CIDADE_EDIT" class="form-label">Cidade</label>
                                            <input type="text" class="form-control" id="USER_CIDADE_EDIT" name="USER_CIDADE_EDIT" value="' . $row['USER_CIDADE'] . '">
                                        </div>';
            } else{
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-2">
                                            <label for="USER_CIDADE_EDIT" class="form-label">Cidade</label>
                                            <input type="text" class="form-control" id="USER_CIDADE_EDIT" name="USER_CIDADE_EDIT" placeholder="null">
                                        </div>';
            } 
            if($row['USER_BAIRRO'] > 0){
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-2">
                                            <label for="USER_BAIRRO_EDIT" class="form-label">Bairro</label>
                                            <input type="text" class="form-control" id="USER_BAIRRO_EDIT" name="USER_BAIRRO_EDIT" value="' . $row['USER_BAIRRO'] . '">
                                        </div>';
            } else{
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-2">
                                            <label for="USER_BAIRRO_EDIT" class="form-label">Bairro</label>
                                            <input type="text" class="form-control" id="USER_BAIRRO_EDIT" name="USER_BAIRRO_EDIT" placeholder="null">
                                        </div>';
            } 
            if($row['USER_COMPLE'] > 0){
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-2">
                                            <label for="USER_COMPLE_EDIT" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="USER_COMPLE_EDIT" name="USER_COMPLE_EDIT" value="' . $row['USER_COMPLE'] . '">
                                        </div>
                                    </div>';
            } else{
                $USERINFOEDIT_2 .= '    <div class="u_col form-group col-md-2">
                                            <label for="USER_COMPLE_EDIT" class="form-label">Complemento</label>
                                            <input type="text" class="form-control" id="USER_COMPLE_EDIT" name="USER_COMPLE_EDIT" placeholder="null">
                                        </div>
                                    </div>';
            }

            if($row['USER_TEL'] > 0){
                $USERINFOEDIT_3 .= '    <div class="u_row form-row userInfo_row">
                                            <div class="u_col form-group col-md-4">
                                                <label for="USER_TEL_EDIT" class="form-label">Telefone</label>
                                                <input type="text" class="form-control" id="USER_TEL_EDIT" name="USER_TEL_EDIT" value="' . $row['USER_TEL'] . '" maxlength="15" placeholder="(00) 00000-0000" oninput="formatarTEL(this)">
                                            </div>';
            } else{
                $USERINFOEDIT_3 .= '    <div class="u_row form-row userInfo_row">
                                            <div class="u_col form-group col-md-4">
                                                <label for="USER_TEL_EDIT" class="form-label">Telefone</label>
                                                <input type="text" class="form-control" id="USER_TEL_EDIT" name="USER_TEL_EDIT" placeholder="null" maxlength="15" placeholder="(00) 00000-0000" oninput="formatarTEL(this)">
                                            </div>';
            }
            
            if($row['USER_CEL'] > 0){
                $USERINFOEDIT_3 .= '    <div class="u_col form-group col-md-4">
                                            <label for="USER_CEL_EDIT" class="form-label">Celular</label> 
                                            <input type="text" class="form-control" id="USER_CEL_EDIT" name="USER_CEL_EDIT" value="' . $row['USER_CEL'] . '" maxlength="15" placeholder="(00) 00000-0000" oninput="formatarCEL(this)">
                                        </div>
                                    </div>';
            } else{
                $USERINFOEDIT_3 .= '    <div class="u_col form-group col-md-4">
                                            <label for="USER_CEL_EDIT" class="form-label">Celular</label> 
                                            <input type="text" class="form-control" id="USER_CEL_EDIT" name="USER_CEL_EDIT" placeholder="null" maxlength="15" placeholder="(00) 00000-0000" oninput="formatarCEL(this)">
                                        </div>
                                    </div>';
            } 
            if($row['USER_EMAIL_CON'] > 0){
                $USERINFOEDIT_3 .= '    <div class="u_row form-row userInfo_row">
                                            <div class="u_col form-group col-md-4">
                                                <label for="USER_EMAIL_CON" class="form-label">Email Principal</label>
                                                <input type="text" class="form-control" id="USER_EMAIL_CON" name="USER_EMAIL_CON" value="' . $row['USER_EMAIL_CON'] . '">
                                            </div>';
            } else{
                $USERINFOEDIT_3 .= '    <div class="u_row form-row userInfo_row">
                                            <div class="u_col form-group col-md-4">
                                                <label for="USER_EMAIL_CON" class="form-label">Email Principal</label>
                                                <input type="text" class="form-control" id="USER_EMAIL_CON" name="USER_EMAIL_CON" placeholder="null">
                                            </div>';
            } 
            if($row['USER_EMAIL2_CON'] > 0){
                $USERINFOEDIT_3 .= '    <div class="u_col form-group col-md-4">
                                            <label for="USER_EMAIL2_CON" class="form-label">Email Secundário</label>
                                            <input type="text" class="form-control" id="USER_EMAIL2_CON" name="USER_EMAIL2_CON" value="' . $row['USER_EMAIL2_CON'] . '">
                                        </div>
                                    </div>';
            } else{
                $USERINFOEDIT_3 .= '    <div class="u_col form-group col-md-4">
                                            <label for="USER_EMAIL2_CON" class="form-label">Email Secundário</label>
                                            <input type="text" class="form-control" id="USER_EMAIL2_CON" name="USER_EMAIL2_CON" placeholder="null">
                                        </div>
                                    </div>';
            } 

            //?--------------------------------------------------------------------------?

            if($row['USER_FAVBOOKNUM'] > 0){
                $USERSYSTEMINFO .= '<div class="pfl_info">
                                    <span>Livros Favoritados: </span><span> <br> ' . $row['USER_FAVBOOKNUM'] . ' </span>
                                </div>
                                <hr>';
            } else{
                $USERSYSTEMINFO .= '<div class="pfl_info">
                                    <span>Livros Favoritados: </span><span> <br> 0 </span>
                                </div>
                                <hr>';
            } 
            if($row['USER_BUYBOOKNUM'] > 0){
                $USERSYSTEMINFO .= '<div class="pfl_info">
                                    <span>Livros Comprados:</span><span><br> ' . $row['USER_BUYBOOKNUM'] . ' </span>
                                </div>
                                <hr>';
            } else{
                $USERSYSTEMINFO .= '<div class="pfl_info">
                                    <span>Livros Comprados:</span><span><br> 0 </span>
                                </div>
                                <hr>';
            }
            
            $USERSYSTEMINFO .= '<div class="pfl_info">
                                    <span>Se juntou ao Boozer: </span><span><br>' . $row['USER_REGISTER_TIME'] . '</span>
                                </div>
                                <hr>';
        }
    } else {
        $USERSYSTEMINFO = '';

        $USERINFO .= '  <div class="pfl_infoNone">
                            <div class="infoNone_text">
                                <span> Faça login para ver os detalhes de sua conta!</span>
                            </div>
                            <div class="infoNone_btn">
                                <button class="infoNoneBtn">Fazer Login</button>
                            </div>
                        </div>';
                        
        $USERINFO .= '  <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                    const back_screen = document.querySelector(".back_screen");
                                    const modal_account = document.querySelector(".userAccountNone");

                                    document.querySelector(".infoNoneBtn").addEventListener("click", () => {
                                        modal_account.classList.toggle("hidden");
                                        back_screen.classList.toggle("hidden");
                                    });
                                    document.querySelector(".m_userAccountNone_close").addEventListener("click", () => {
                                        modal_account.classList.toggle("hidden");
                                        back_screen.classList.toggle("hidden");
                                    });

                            });
                        </script>';
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
                <section class="pfl_mainSec">
                    <div class="pfl_photo_sec">
                        <?php
                            if (!isset($_SESSION['USER_ID'])) {
                                echo '<img class="pfl_photo" src="../IMG/PROFILE_DEFAULT.svg" alt="Imagem">';
                            } else {
                                $sql = "SELECT USER_PROFILE_IMAGE FROM bz_user WHERE USER_ID = $userID";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    echo '<img class="pfl_photo" src="data:image/jpeg;base64,' . base64_encode($row['USER_PROFILE_IMAGE']) . '" alt="Imagem">';
                                } else {
                                    echo 'Nenhuma imagem encontrada.';
                                }
                            }
                        ?>
                        <div class="changePfl_photo">
                            <i class="fa-regular fa-camera-rotate fa-xl"></i>
                        </div>
                    </div>
                    <div class="pfl_systemInfo_sec">
                        <section class="pfl_systemInfo">
                            <?= $USERSYSTEMINFO ?>
                        </section>
                    </div>
                    <div class="pfl_userInfo_sec">
                        <div class="pfl_info_sec">
                            <table class="table table-hover table-sm">
                                <tbody>
                                    <?= $USERINFO ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="pfl_userHistory">
                        <div class="pfl_info_sec">
                            <table class="table table-hover table-sm">
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Qtd. Livros</th>
                                    <th scope="col">Data da Compra</th>
                                    <th scope="col">Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">001</th>
                                        <td>4</td>
                                        <td>30/03/2023</td>
                                        <td>R$ 345.45</td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </section>
                
                <section class="pfl_menuSec">
                    <!-- <a class="pfl_btn pfl_btn-items">Meus items<span></span></a>
                    <a class="pfl_btn pfl_btn-edit">Editar Perfil<span></span></a>
                    <a class="pfl_btn pfl_btn-hist">Histórico<span></span></a>
                    <a class="pfl_btn pfl_btn-gold">Boozer Gold<span></span></a> -->
                    <img src="../IMG/BANNER_ADS.svg" alt="" srcset="">
                </section>
            </main>
            <footer class="footer_sec">
                <p>&copy; 2023 Boozer - Todos os direitos reservados.</p>
            </footer>
        </div>
        <div class="back_screen hidden"></div>
        <modal class="userAccountNone m_start hidden">
            <div class="m_AccountNone_wrap">
                <i class="m_userAccountNone_close fa-regular fa-xmark fa-xl"></i>
                <div class="leftside_sec">
                    <img src="../IMG/library_background3.jpg" alt="">
                </div>
                <div class="rightside_sec">
                    <div class="login_form_sec">
                        <form class="signin_body" action="../PHP/PROFILE_SIGN-IN.php" method="post">
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
                            <button class="submitBtn" type="submit" value="login">Sign-In</button>
                            <span href="../index.html">Não tenho conta.</span>
                        </form>
                    </div>
                </div>
            </div>
        </modal>
        <modal class="userChangeImage m_start hidden">
            <div class="m_wrapChange">
                <section class="m_headChange">
                    <span class="m_title"><i class="fa-regular fa-camera-rotate"></i><span>Escolha sua nova imagem:</span></span>
                    <i class="m_userChangeImage_close fa-regular fa-xmark fa-xl"></i>
                </section>
                <section class="m_bodyChange">
                    <form action="../PHP/USER_IMAGE.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="profile_image" accept="image/*">
                        <input type="submit" value="Upload Image">
                    </form>
                </section>
            </div>
        </modal>
        <modal class="userUpdateBtn_modal m_start hidden">
            <div class="m_wrap">
                <section class="m_head">
                    <span class="m_title"><span><i class="fa-solid fa-book"></i>Dados do Usuário</span></span>
                    <i class="m_close m_userUpdateBtn_close fa-regular fa-circle-xmark fa-xl"></i>
                </section>
                <section class="m_body">
                    <form class="f_body" action="../PHP/USER_UPDATE.php" method="post">
                        <div class="f_navbar">
                            <hr />
                            <div class="f_nav_btn userBasic active"><i class="fa-solid fa-address-card fa-xl"></i></div>
                            <div class="f_nav_btn userAddress"><i class="fa-solid fa-map-location-dot fa-xl"></i></div>
                            <div class="f_nav_btn userContact"><i class="fa-solid fa-address-book fa-xl"></i></div>
                        </div>
                        <div class="userEditForm userBasic_form active">
                            <div class="userEditForm_body">
                                
                                    <?= $USERINFOEDIT_1 ?>

                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <div class="userNext userEdit_btn btn btn-outline-success">Próximo</div>
                                </div>
                            </div>
                        </div>
                        <div class="userEditForm userAddress_form"> 
                            
                            <?= $USERINFOEDIT_2 ?>
                            
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <div class="userPrev userEdit_btn btn btn-outline-secondary">Anterior</div>
                                <div class="userNext userEdit_btn btn btn-outline-success">Próximo</div>
                            </div>
                        </div>
                        <div class="userEditForm userContact_form">
                            
                            <?= $USERINFOEDIT_3 ?>
                            
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <div class="userPrev userEdit_btn btn btn-outline-secondary">Anterior</div><button id="userUpdateChange" class="userEdit_btn btn btn-outline-success">Gravar</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </modal>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="../JS/CONFIG_NAV.JS"></script>
    <script src="../JS/ABRE_NAV_RESPONSIVE.js"></script>
    <script src="../JS/perfil.js"></script>
    <script>

    const back_screen = document.querySelector(".back_screen");

    const changePfl_photo = document.querySelector(".changePfl_photo");
    const userChangeImage = document.querySelector(".userChangeImage");
    const m_userChangeImage_close = document.querySelector(".m_userChangeImage_close");

    changePfl_photo.addEventListener("click", () => {
        userChangeImage.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    m_userChangeImage_close.addEventListener("click", () => {
        userChangeImage.classList.toggle("hidden");
        back_screen.classList.toggle("hidden");
    });

    
document.querySelector(".userBasic").addEventListener("click", f_showBasic);
document.querySelector(".userAddress").addEventListener("click", f_showAddress);
document.querySelector(".userContact").addEventListener("click", f_showContact);

function f_hideAll() {
    document.querySelector(".userBasic_form").classList.remove("active");
    document.querySelector(".userAddress_form").classList.remove("active");
    document.querySelector(".userContact_form").classList.remove("active");
}

function f_activateTab(tab) {
    document.querySelector(".userBasic").classList.remove("active");
    document.querySelector(".userAddress").classList.remove("active");
    document.querySelector(".userContact").classList.remove("active");
    tab.classList.add("active");
}

function f_showBasic() {
    f_hideAll();
    f_activateTab(document.querySelector(".userBasic"));
    document.querySelector(".userBasic_form").classList.add("active");
}

function f_showAddress() {
    f_hideAll();
    f_activateTab(document.querySelector(".userAddress"));
    document.querySelector(".userAddress_form").classList.add("active");
}

function f_showContact() {
    f_hideAll();
    f_activateTab(document.querySelector(".userContact"));
    document.querySelector(".userContact_form").classList.add("active");
}

//--------------------------------------------------------------------------

const userPrev = document.querySelectorAll(".userPrev");
const userNext = document.querySelectorAll(".userNext");

function navigate(button, direction) {
    // Encontrar o formulário ativo atualmente
    const currentForm = document.querySelector(".userEditForm.active");
    const currentBtn = document.querySelector(".f_nav_btn.active");

    if (direction === 'next') {
        const targetForm = currentForm.nextElementSibling;
        const targetBtn = currentBtn.nextElementSibling;
        if (targetForm) {
            // Esconder o formulário atual e mostrar o próximo
            currentForm.classList.remove("active");
            targetForm.classList.add("active");
            currentBtn.classList.remove("active");
            targetBtn.classList.add("active");
        }
    } else if (direction === 'prev') {
        const targetForm = currentForm.previousElementSibling;
        const targetBtn = currentBtn.previousElementSibling;
        if (targetForm) {
            // Esconder o formulário atual e mostrar o anterior
            currentForm.classList.remove("active");
            targetForm.classList.add("active");
            currentBtn.classList.remove("active");
            targetBtn.classList.add("active");
        }
    }
}

userPrev.forEach(button => {
    button.addEventListener("click", () => {
        navigate(button, 'prev');
    });
});

userNext.forEach(button => {
    button.addEventListener("click", () => {
        navigate(button, 'next');
    });
});


    var $wrap = $('.pfl_photo'),
        lFollowX = 5,
        lFollowY = 10,
        x = 0,
        y = 0,
        friction = 1 / 12,
        xMax = 10, // Valor máximo de rotação em graus
        xMin = -10, // Valor mínimo de rotação em graus
        yMax = 10, // Valor máximo de rotação em graus
        yMin = -10; // Valor mínimo de rotação em graus

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
        // var pIS = document.querySelector('.pfl_info_sec');
        var pp = document.querySelector('.pfl_photo');

        // var iW = pIS.clientWidth;
        var ppW = pp.clientWidth;

        // pIS.style.height = iW + 'px';
        pp.style.height = ppW + 'px';
    }

    atualizarAlturaElementos();

    window.addEventListener('resize', function() {
        atualizarAlturaElementos();
    });

    const register = document.querySelector(".signup_body");
    const login = document.querySelector(".signin_body");
    const form = document.querySelector(".login_form_sec");

    function slide() {
        const toggleClass = (element, className, slideClassName) => {
            element.classList.toggle(className);
            element.classList.toggle(slideClassName);
        };

        toggleClass(register, "signup_body", "signup_body_slide");
        toggleClass(login, "signin_body", "signin_body_slide");
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

        $('.USER_CPFCNPJ').mask('000.000.000-00');
        $('.USER_RG').mask('00.000.000-0');
        $('.USER_TEL').mask('(00) 00000-0000');
        $('.USER_CEL').mask('(00) 00000-0000');
        $('.USER_CEP').mask('00000-000');
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