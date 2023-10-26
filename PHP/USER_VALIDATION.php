<?php
    if (isset($_SESSION['USER_ID'])) {
        // Replace with your database connection details.
        
        include 'CONFIG.php';

        // Retrieve USER_ID from the session.
        $user_id = $_SESSION['USER_ID'];

        // Prepare a SQL query to retrieve USER_TYPE.
        $sql = "SELECT USER_TYPE FROM bz_user WHERE USER_ID = $user_id";

        // Execute the query.
        $result = $conn->query($sql);

        // Check if the query was successful.
        if ($result) {
            // Fetch the row.
            $row = $result->fetch_assoc();

            // Check if USER_TYPE is 1.
            if ($row['USER_TYPE'] == 1) {
                $isNotDefault = true;
            } else {
                $isNotDefault = false;
            }

            // Close the database connection.
            $conn->close();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        OpenAlert("Usuário não encontrado.");
    }

    if (isset($isNotDefault) && $isNotDefault) {
        $DefaultConfigMenu = 
            '<div class="navbar_card" id="card_usuarios">
                <i class="fa-solid fa-users fa-lg"></i>
                <a>Usuarios</a>
            </div>';
        $DefaultConfigNav = 
            '<div class="navbar_item" id="navbar_usuarios">
                <i class="fa-solid fa-users"></i>
                <a>Usuarios</a>
            </div>';
        $DefaultConfigBookBtn =
            '<div class="menu_div" style="width: 20%;">
                <button class="menu_btn book_menu_btn">
                    <i class="fa-solid fa-file-plus fa-xl"></i>
                </button>
            </div>';
        $DefaultConfigBookScript = 
            'const book_menu_btn = document.querySelector(".book_menu_btn");
            const book_add_modal = document.querySelector(".book_add_modal");
            const book_add_close = document.querySelector(".m_book_add_close");
            const back_screen = document.querySelector(".back_screen");
            book_menu_btn.addEventListener("click", () => {
                book_add_modal.classList.toggle("hidden");
                back_screen.classList.toggle("hidden");
            });
            book_add_close.addEventListener("click", () => {
                book_add_modal.classList.toggle("hidden");
                back_screen.classList.toggle("hidden");
            });';
        $DefaultConfigBookMenu = 
            '<div class="p_menu">
                <button class="p_btn p_BookEdit"><i class="fa-solid fa-pen-to-square fa-lg"></i><span class="p_btn_cap">Editar</span></button>
                <button class="p_btn p_BookRemove"><i class="fa-solid fa-file-xmark fa-lg"></i><span class="p_btn_cap">Remover</span></button>
                <button class="p_btn p_BookHidden"><i class="fa-solid fa-eye-slash fa-lg"></i><span class="p_btn_cap">Ocultar</span></button>
            </div>';
        $DefaultConfigBookMenuStyle = 'DefaultConfig';
    } else {
        $DefaultConfigMenu = '';
        $DefaultConfigNav = '';
        $DefaultConfigBookBtn = '';
        $DefaultConfigBookScript = '';
        $DefaultConfigBookMenu = '';
        $DefaultConfigBookMenuStyle = '';
    }
?>
