<?php include_once __DIR__.'/../includes/Header.php'; ?>
    <main class="container">
        <div class="container_form">
            <figure class="container_form_logo">
                <img src="./assets/icons/m2m_blanco.png" alt="Logo de M2M">
            </figure>
            <?php if (!empty($error)): ?>
                <p class="alert" style="background-color: rgb(231, 58, 58); color: white; "><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <form method="POST" action="login">
                <div class="container_form_header">
                    <h1 class="container_form_header_title">Inicio de sesión </h1>
                    <span class="container_form_header_subtitle">Accede con tus credenciales.</span>
                </div>
                <div class="container_form_input input_container">
                    <label for="username">Usuario</label>
                    <input type="text" name="username" id="username" placeholder="DMora_aws" required>
                </div>
                <div class="container_form_input input_container">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="********" required>
                </div>
                <button type="submit" class="container_form_button">Iniciar sesión</button>
            </form>
            <span class="container_form_copyright">Todos los derechos reservados @M2M - MoveToMexico 2025</span>
        </div>
        <figure class="container_image">
            <img src="./assets/images/background_login.png" alt="">
        </figure>
    </main>
<?php include_once __DIR__.'/../includes/Footer.php'; ?>
