<?php
    include 'CONFIG.php';

    // Consulta SQL para recuperar informações de usuários
    $query = "SELECT * FROM bz_user";
    $result = $conn->query($query);
    
    $USER_SELECT_VAR = '';
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $USER_SELECT_VAR .= "<tr>";
            $USER_SELECT_VAR .= "<th scope='row'>" . $row['USER_ID'] . "</th>";
            $USER_SELECT_VAR .= "<td>" . $row['USER_TYPE'] . "</td>";
            $USER_SELECT_VAR .= "<td>" . $row['USER_STATUS'] . "</td>";
            $USER_SELECT_VAR .= "<td>" . $row['USER_CPFCNPJ'] . "</td>";
            $USER_SELECT_VAR .= "<td>" . $row['USER_NAME'] . "</td>";
            $USER_SELECT_VAR .= "<td id='" . $row['USER_ID']. "'>";
            $USER_SELECT_VAR .= "<button type='submit' class='user_view btn btn-sm btn-outline-primary'><i class='fa-solid fa-user-magnifying-glass'></i></button>";
            $USER_SELECT_VAR .= "<button type='submit' class='user_buy btn btn-sm btn-outline-success'><i class='fa-solid fa-basket-shopping'></i></button>";
            $USER_SELECT_VAR .= "</td>";
            $USER_SELECT_VAR .= "</tr>";
        }
    } else {
        $USER_SELECT_VAR .= "<tr><td colspan='5'>Nenhum usuário encontrado.</td></tr>";
    }
?>