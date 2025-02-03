<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="../../public/css/popup.css">
    <title>Delfos</title>
</head>

<body>
    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo != false) {
        echo "asdhoasdhsa";
        header("Location: ./main.php");
        exit;
    }
    ?>

    <div id="popup" class="modal-sign">
        <div class="modal-content">
            <div class="mensagem">
                <img alt="Cadastro realizado!" src="../../public/images/gif.gif" class="checkGif" />

                <p>Cadastro realizado com sucesso</p>
                <a id="closeModalBtn" style="cursor: pointer;">Login</a>
            </div>
        </div>
    </div>

    <header>
        <div class="header">
            <div class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </div>
            <a class="login-button" href="./telaLogin.php" style="text-decoration: none; color: #000;" id="loginButton">Login</a>

        </div>

    </header>

    <main>
        <div class="container">
            <div class="img-container">
                <img src="../../public/images/moça-do-login.png">
            </div>

            <div class="forms-container">
                <form class="signup-form" method="post" action="./../service/cadastro.php">
                    <h2>Se junte ao Delfos</h2>
                    <input type="text" name="nome" placeholder="Nome Completo" required>
                    <input type="text" name="cpf" placeholder="CPF" required>
                    <input type="email" name="email" placeholder="E-mail" required>
                    <input type="text" name="telefone" placeholder="Telefone" required>
                    <input type="password" name="senha" placeholder="Senha" required>
                    <button type="submit">Criar</button>
                </form>
            </div>

        </div>

       
    </main>



    <?php

    if (!empty($_SESSION['verifyCad']) && $_SESSION['verifyCad'] == true) {
        echo '<script> document.getElementById("popup").style.display = "flex"; </script>';
        $_SESSION['verifyCad'] = false;
    }

    if (!empty($_SESSION['aviso']) && $_SESSION['aviso']) {
        echo "<script>alert('" . $_SESSION['aviso'] . "')</script>";
        $_SESSION['aviso'] = '';
    }

    ?>

    <script src="../../public/js/closeModal.js"></script>
    <script>
        document.getElementById("closeModalBtn").addEventListener("click", () => {
            document.getElementById("popup").style.display = "none";
        });
    </script>
</body>

</html>