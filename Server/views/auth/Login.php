<?php include_once __DIR__.'/../includes/Header.php'; ?>
    <main class="flex flex-col h-screen w-screen overflow-hidden justify-center items-center">
        <figure class="fixed top-4 left-4">
            <img src="./assets/icons/m2m_verde.png" alt="Logo de M2M" class="w-24">
        </figure>
        <?php if (!empty($error)): ?>
            <div class="fixed right-2 left-2 top-4 flex justify-center">
                <p class="p-3 text-sm text-red-500 bg-red-100 backdrop-blur-md rounded-xl w-fit font-medium"><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>
        <div class=" flex justify-center items-center xs:w-11/12 sm:w-7/12 lg:w-4/12">
            <form method="POST" action="login" class="flex flex-col gap-6 w-full">
                <div class="flex flex-col">
                    <h2 class="font-medium text-zinc-600"><span class="text-[#393784]">M</span><span class="text-[#01911E]">2M</span> Cloud</h2>
                    <h1 class="text-zinc-900 font-bold uppercase text-3xl">Inicio de sesión </h1>
                    <span class="text-zinc-500 text-sm mt-2">La plataforma para la gestión de proyectos de <a href="https://m2m.com.mx/" target="_blank" class="font-medium text-zinc-800">Move To México</a>.</span>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col items-start w-full gap-1">
                        <label for="username" class="text-zinc-500 text-sm">Usuario</label>
                        <input id="name" type="text" name="username" id="username" placeholder="DMora_aws" required class="text-zinc-700 p-2 border border-zinc-200 rounded-lg bg-zinc-50 w-full outline-none focus:bg-zinc-100 transition-all ease-in-out"/>
                    </div>
                    <div class="flex flex-col items-start w-full gap-1">
                        <label for="password" class="text-zinc-500 text-sm">Contraseña</label>
                        <input id="name"  type="password" name="password" id="password" placeholder="********" required class="text-zinc-700 p-2 border border-zinc-200 rounded-lg bg-zinc-50 w-full outline-none focus:bg-zinc-100 transition-all ease-in-out"/>
                    </div>
                    <button type="submit" class="bg-zinc-900 cursor-pointer p-2 rounded-md text-white font-medium hover:bg-zinc-800 hover:scale-102 transition-all ease-in-out">Iniciar sesión</button>
                </div>
            </form>
        </div>
            
        <div class="fixed bottom-2 w-full flex justify-center">
            <span class="text-[#8b8b8b] text-xs text-nowrap">Todos los derechos reservados @M2M - 2025</span>
        </div>
    </main>
<?php include_once __DIR__.'/../includes/Footer.php'; ?>
