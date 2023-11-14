<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input
        $user_email = $_POST['login_email_input'];
        $user_pw = $_POST['login_password_input'];

        // Include the database connection configuration
        include 'CONFIG.php';

        // Query to get the user based on email
        $query_select = "SELECT USER_ID, USER_PASSWORD FROM bz_user WHERE USER_EMAIL = ?";
        $stmt = $conn->prepare($query_select);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();

        // Get the result of the query
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['USER_ID'];
            $hashed_password = $row['USER_PASSWORD'];

            // Verify the password
            if (password_verify($user_pw, $hashed_password)) {
                // Correct password, store USER_ID in the session and redirect
                $_SESSION['USER_ID'] = $user_id;
                header('Location: ../HTML/ABRE_PERFIL.php');
            } else {
                // Incorrect password
                openAlert('Senha incorreta');
            }
        } else {
            // User not found
            openAlert('Usuário não encontrado');
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    }

    function openAlert($message) {
        echo "<script>alert('$message');window.location.href='../HTML/ABRE_PERFIL';</script>";
    }
?>
