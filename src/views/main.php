<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aluno</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/aluno.css">
</head>

<body>
    <?php

    require_once("../config/config.php");
    require_once("../models/auth/auth.php");
    require_once("../dao/ProfessorDaoMysql.php");
    require_once("../dao/UsuarioDaoMysql.php");
    require_once("../dao/AreaDao.php");
    require_once("../models/user/User.php");

    $auth = new Auth();
    $userInfo = $auth->checkToken($pdo);

    if ($userInfo == false) {
        header("Location: ./login.php");
        exit;
    }

    $uDao = new UsuarioDaoMySql($pdo);
    $aDao = new AreaDao($pdo);

    $pDao = new ProfesorDaoMySql($pdo);
    $professor = $pDao->findByUserId($userInfo->getId());
    $todosProfessores = $pDao->findAll();

    function getFoto($caminhoFoto, $usuario, $uDao)
    {
        if (!file_exists($caminhoFoto)) {
            $caminhoFoto = "../uploads/semPerfil.png";
            $usuario->setLinkFoto($caminhoFoto);
            $uDao->update($usuario);
        }

        return $caminhoFoto;
    }

    ?>

    <header>

        <div class="header">
            <div class="logo">
                <img src="../../public/images/Logo Delfos branco.svg">
            </div>
            <div class="buttons">
                <a class="perfil-button notif" href=""><img src="../../public/images/sino-icon.png" alt=""></a>
                <?php if (!$professor): ?>
                    <a class="perfil-button prof" href="./novoPerfilProf.php"><img src="../../public/images/school-icon.png"
                            alt="">Seja um professor
                    </a>
                <?php endif; ?>

                <?php if ($professor): ?>
                    <a class="perfil-button prof" href="./editarPerfilProf.php"><img
                            src="../../public/images/school-icon.png" alt="">Perfil do professor
                    </a>
                <?php endif; ?>
                <div class="perfil-button"><img src="../../public/images/login-icon.png" alt="">Perfil</div>
            </div>


        </div>

    </header>

    <main>

        <div class="titulo-principal">
            <h1>Escolha os melhores <strong>★★★★★</strong></h1>
        </div>

        <div class="slider-container">

            <button class="slider-btn prev">◀</button>

            <div class="slider">

                <?php foreach ($todosProfessores as $p): ?>
                    <?php
                    $usuario = $uDao->findById($p->getUserId());
                    $rating = $p->getRating() == 0 ? 1 : $p->getRating();
                    if ($usuario):
                        ?>
                        <div class="slider-item">
                            <div class="image-container">
                                <img src="<?= getFoto($usuario->getLinkFoto(),$usuario, $uDao) ?>" alt="foto">
                                <div class="info">

                                    <p class="name"><?= $usuario->getNome() ?></p>


                                    <p class="subject">Assunto: <?= $aDao->findById($p->getArea())->getArea(); ?></p>
                                    <p class="rating"><?php echo str_repeat('★', round($rating));?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <button class="slider-btn next">▶</button>

        </div>

        <div class="divisoria">
            <div class="divisoria-pilar">
                <img src="../../public/images/Mask group.png" alt="">
            </div>
            <div class="divisoria-wpp">
                <img src="../../public/images/Group 46.png" alt="">
            </div>
        </div>

        <div class="subtitulo">
            <h1>Aprenda com profissionais qualificados</h1>
            <button>O que deseja aprender ? <img src="../../public/images/pesquisaIcon.png" alt=""></button>
        </div>

        <div class="slider-container slider-small">

            <h2>Os melhores em Programação <strong>★★★★★</strong></h2>

            <button class="slider-btn prev">◀</button>

            <div class="slider">
                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/walter white.jpg" alt="Professor Walter White">
                        <div class="info">
                            <p class="name">Walter White</p>
                            <p class="subject">Assunto: Química</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/professor girafales.jpg" alt="Professor Girafales">
                        <div class="info">
                            <p class="name">Girafales</p>
                            <p class="subject">Assunto: História</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/professora helena.jpeg" alt="Professora Helena">
                        <div class="info">
                            <p class="name">Professora Helena</p>
                            <p class="subject">Assunto: Português</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/professor vanderlei.jpg" alt="Pufexô">
                        <div class="info">
                            <p class="name">Pufexô Vanderlei</p>
                            <p class="subject">Assunto: Ed. Física</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/fortune-tiger-logo.png" alt="Tigrinho">
                        <div class="info">
                            <p class="name">Tigrinho</p>
                            <p class="subject">Assunto: Economia</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/inri-cristo.jpg" alt="Inri Cristo">
                        <div class="info">
                            <p class="name">Inri Cristo</p>
                            <p class="subject">Assunto: Religião</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

            </div>

            <button class="slider-btn next">▶</button>

        </div>

        <div class="slider-container slider-small">

            <h2>Os melhores em Matemática <strong>★★★★★</strong></h2>

            <button class="slider-btn prev">◀</button>

            <div class="slider">
                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/walter white.jpg" alt="Professor Walter White">
                        <div class="info">
                            <p class="name">Walter White</p>
                            <p class="subject">Assunto: Química</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/professor girafales.jpg" alt="Professor Girafales">
                        <div class="info">
                            <p class="name">Girafales</p>
                            <p class="subject">Assunto: História</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/professora helena.jpeg" alt="Professora Helena">
                        <div class="info">
                            <p class="name">Professora Helena</p>
                            <p class="subject">Assunto: Português</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/professor vanderlei.jpg" alt="Pufexô">
                        <div class="info">
                            <p class="name">Pufexô Vanderlei</p>
                            <p class="subject">Assunto: Ed. Física</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/fortune-tiger-logo.png" alt="Tigrinho">
                        <div class="info">
                            <p class="name">Tigrinho</p>
                            <p class="subject">Assunto: Economia</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

                <div class="slider-item">
                    <div class="image-container">
                        <img src="../../public/images/inri-cristo.jpg" alt="Inri Cristo">
                        <div class="info">
                            <p class="name">Inri Cristo</p>
                            <p class="subject">Assunto: Religião</p>
                            <p class="rating">★★★★★</p>
                        </div>
                    </div>
                </div>

            </div>

            <button class="slider-btn next">▶</button>

        </div>

    </main>

</body>

</html>