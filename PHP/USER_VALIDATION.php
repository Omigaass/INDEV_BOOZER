<?php
function openAlert($message) {
    echo "<script>alert('$message');</script>";
}

if (isset($_SESSION['USER_ID'])) {
    // Include the database connection configuration
    include 'CONFIG.php';

    // Retrieve USER_ID from the session and sanitize it to prevent SQL injection
    $user_id = mysqli_real_escape_string($conn, $_SESSION['USER_ID']);

    // Prepare a parameterized SQL query to retrieve USER_TYPE
    $sql = "SELECT USER_TYPE FROM bz_user WHERE USER_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // "i" represents an integer

    // Execute the query
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $isNotDefault = ($row['USER_TYPE'] == 1);
        }

        // Close the result and the database connection
        $result->close();
        $stmt->close();
        $conn->close();
    } else {
        echo "Error: " . $sql . "<br>" . $stmt->error;
    }
} else {
    openAlert("Usuário não encontrado.");
}

if (isset($isNotDefault) && $isNotDefault) {
    $DefaultConfigMenu = '
        <div class="navbar_card" id="card_usuarios">
            <i class="fa-solid fa-users fa-lg"></i>
            <a>Usuarios</a>
        </div>';
    $DefaultConfigNav = '
        <div class="navbar_item" id="navbar_usuarios">
            <i class="fa-solid fa-users"></i>
            <a>Usuarios</a>
        </div>';
    $DefaultConfigBookBtn = '
        <div class="menu_div" style="width: 20%;">
            <button class="menu_btn book_menu_btn">
                <i class="fa-solid fa-file-plus fa-xl"></i>
            </button>
        </div>';
    $DefaultConfigBookScript = '
        const book_menu_btn = document.querySelector(".book_menu_btn");
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
    $DefaultConfigBookMenuStyle = 'DefaultConfig';
} else {
    $DefaultConfigMenu = '';
    $DefaultConfigNav = '';
    $DefaultConfigBookBtn = '';
    $DefaultConfigBookScript = '';
    $DefaultConfigBookMenuStyle = '';
}
?>
