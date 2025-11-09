<?php include_once __DIR__.'/includes/Header.php'; ?>
    <main class="flex lg:flex-row xs:flex-col h-screen overflow-hidden w-screen bg-zinc-50">
        <?php include_once __DIR__.'/includes/Aside.php'; ?>
        <div class="px-5 xs:pt-0 lg:pt-5 w-full overflow-y-scroll pb-2">
            <section class="flex flex-col p-5 w-full gap-6 bg-white shadow rounded-lg h-fit">
                <article class="flex items-center justify-between">
                    <div class="flex flex-col gap-1">
                        <span class="text-zinc-500 text-sm font-medium">Inicio</span>
                        <h1 class="text-zinc-800 font-bold md:text-3xl xs:text-2xl">Dashboard</h1>
                    </div>
                    <nav class="flex gap-2 items-center">
                        <button id="buttonModal" class="text-zinc-600 cursor-pointer hover:bg-zinc-100 p-2 rounded-md hover:scale-105 transition-all ease-in-out outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1.5rem" height="1.5rem">
                                <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </article>
                <article class="flex flex-col gap-4">
                    <div class="flex flex-col">
                        <div class="bg-zinc-50 text-white rounded-xl p-5 border hover:border-[#cacaca] cursor-pointer transition-all ease-in-out">
                            <h3 class="text-zinc-600 text-sm w-full">Detalle de Gráfico Curva S de Avance del proyecto</h3>
                        </div>
                    </div>
                </article>
            </section>
            <div class="fixed bottom-8 right-4 bg-white border border-zinc-100 shadow-md backdrop-blur-md p-5 rounded-md hover:scale-105 transition-all ease-in-out">
                <div class="flex flex-col">
                    <span class="text-zinc-600 xs:text-sm sm:text-base font-medium uppercase">Hola, <?= $userSession->name ?> 🖐🏻</span>
                    <p class="text-[#393784] text-sm">¡Nos da gusto tenerte por aquí!</p>
                </div>
            </div>
        </div>
    </main>
    <script> if(!localStorage.getItem('token_session')) localStorage.setItem('token_session', "<?= $_SESSION['token'] ?>"); </script>
<?php include_once __DIR__.'/includes/Footer.php'; ?>