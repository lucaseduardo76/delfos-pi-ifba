<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/redefinirSenha.css">
    <title>Document</title>
</head>

<body>

    <header>

        <div class="header">
            <a href="main.php" class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </a>
            <div class="buttons">
                <a href="mensagem.php">
                    <div class="perfil-button notif"><img src="../../public/images/sino-icon.png" alt=""></div>
                </a>
                <a class="perfil-button prof" href="./editarPerfilProf.php"><img
                        src="../../public/images/school-icon.png" alt="">Perfil do professor
                </a>
                <a href="editarPerfilAluno.php">
                    <div class="perfil-button">Perfil</div>
                </a>
                <a class="perfil-button notif" href="../service/logout.php"><img src="../../public/images/login-icon.png" alt=""></a>
            </div>

        </div>

    </header>

    <main>

        <div class="container">
            <form>
                <div class="campo">
                    <h2>Redefinir Senha</h2>
                    <input type="password" placeholder="Senha antiga...">
                    <input type="password" placeholder="Nova senha...">
                </div>

                <div class="campo">
                    <h2>E-mail</h2>
                    <input type="email" placeholder="Seu e-mail...">
                </div>
            </form>
        </div>

    </main>

</body>

</html>