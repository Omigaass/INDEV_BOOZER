<?php
if (isset($_SESSION['USER_ID'])) {
    // Replace with your database connection details.
    $mysqli = new mysqli('localhost', 'root', '', 'boozer_db');

    // Check the connection.
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Retrieve USER_ID from the session.
    $user_id = $_SESSION['USER_ID'];

    // Prepare a SQL query to retrieve USER_TYPE.
    $sql = "SELECT USER_TYPE FROM bz_user WHERE USER_ID = $user_id";

    // Execute the query.
    $result = $mysqli->query($sql);

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
        $mysqli->close();
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
} else {
    echo "<script language='javascript' type='text/javascript'>
    console.log('Usuário sem conta');</script>";
}

if (isset($isNotDefault) && $isNotDefault) {
    $DefaultConfigMenu = '<div class="navbar_card" id="card_usuarios">
    <i class="fa-solid fa-users fa-lg"></i>
    <a>Usuarios</a>
    </div>';
    $DefaultConfigNav = '<div class="navbar_item" id="navbar_usuarios">
    <i class="fa-solid fa-users"></i>
    <a>Usuarios</a>
    </div>';
    $DefaultConfigBookBtn = '<div class="menu_btn book_menu">
    <i class="fa-solid fa-layer-plus fa-lg"></i>
    </div>';
} else {
    $DefaultConfigMenu = '';
    $DefaultConfigNav = '';
    $DefaultConfigBookBtn = '';
}
?>
