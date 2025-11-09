<?php $current = $_SERVER['REQUEST_URI']; ?>
<header class="xs:flex lg:hidden p-5 justify-between items-center">
    <figure class="flex ">
        <img src="./assets/icons/m2m_verde.png" alt="Logo de la empresa m2m" class="w-20">
    </figure>
    <button id="btnOpenNavBar" class="p-2 hover:bg-zinc-100 rounded-lg transition-all ease-in-out cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
</header>
<aside id="sidebar-desktop" class="hidden lg:flex flex-col justify-between h-screen lg:w-2/12 p-4 border-r border-r-[#e2e2e2] bg-white">
    <div class="flex flex-col gap-5">
        <figure class="flex justify-center">
            <img src="./assets/icons/m2m_verde.png" alt="Logo de la empresa m2m" class="w-28 ">
        </figure>
       
        <div class="flex flex-col">
            <a href="<?= $urlAbsolute.'/' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= $current === $urlAbsolute.'/' ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                Dashboard
            </a>
            <?php if ($userSession->role->name === 'Administrador'): ?>
                <a href="<?= $urlAbsolute.'/clients' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                    <?= str_starts_with($current, $urlAbsolute.'/clients') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    Clientes
                </a>
            <?php endif; ?>
            <a href="<?= $urlAbsolute.'/projects' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= str_starts_with($current, $urlAbsolute.'/projects') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                </svg>
                Proyectos
            </a>
            <a href="<?= $urlAbsolute.'/activities' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= str_starts_with($current, needle: $urlAbsolute.'/activities') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 8.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v8.25A2.25 2.25 0 0 0 6 16.5h2.25m8.25-8.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-7.5A2.25 2.25 0 0 1 8.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 0 0-2.25 2.25v6" />
                </svg>
                Actividades
            </a>
            <a class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= str_starts_with($current, $urlAbsolute.'/history') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Historial
            </a>
        </div>
    </div>
    <div class="flex flex-col">
        <?php if ($userSession->role->name === 'Administrador'): ?>
            <a href="<?= $urlAbsolute.'/users' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= str_starts_with($current, $urlAbsolute.'/users') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                Control de cuentas
            </a>
        <?php endif; ?>
        <a href="<?= $urlAbsolute.'/settings' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
            <?= str_starts_with($current, $urlAbsolute.'/settings') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            Configuración
        </a>
        <a class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
            <?= str_starts_with($current, $urlAbsolute.'/support') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
            </svg>
            Ayuda
        </a>
        <form id="btnLogoutResposive" action="logout" method="POST" class="w-full">
            <button class="text-sm hover:scale-102 w-full flex flex-row items-center gap-2 text-[#969696] font-medium cursor-pointer hover:bg-zinc-100 hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                Salir
            </button>
        </form>
    </div>
</aside>

<aside id="sidebar-mobile" class="shadow-md fixed -translate-x-full transition-transform duration-300 ease-in-out lg:hidden flex flex-col justify-between h-screen xs:w-7/12 sm:w-4/12 p-4 border-r border-r-[#e2e2e2] bg-white z-50">
    <div class="flex flex-col gap-5">
        <figure class="flex justify-center">
            <img src="./assets/icons/m2m_verde.png" alt="Logo de la empresa m2m" class="w-28">
        </figure>
        <div class="flex flex-col">
            <a href="<?= $urlAbsolute.'/' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= $current === $urlAbsolute.'/' ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                Dashboard
            </a>
            <?php if ($userSession->role->name === 'Administrador'): ?>
                <a href="<?= $urlAbsolute.'/clients' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                    <?= str_starts_with($current, $urlAbsolute.'/clients') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    Clientes
                </a>
            <?php endif; ?>
            <a href="<?= $urlAbsolute.'/projects' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= str_starts_with($current, $urlAbsolute.'/projects') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                </svg>
                Proyectos
            </a>
            <a href="<?= $urlAbsolute.'/activities' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= str_starts_with($current, $urlAbsolute.'/activities') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 8.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v8.25A2.25 2.25 0 0 0 6 16.5h2.25m8.25-8.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-7.5A2.25 2.25 0 0 1 8.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 0 0-2.25 2.25v6" />
                </svg>
                Actividades
            </a>
            <a class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= str_starts_with($current, $urlAbsolute.'/history') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Historial
            </a>
        </div>
    </div>
    <div class="flex flex-col">
        <?php if ($userSession->role->name === 'Administrador'): ?>
            <a href="<?= $urlAbsolute.'/users' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
                <?= str_starts_with($current, $urlAbsolute.'/users') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                Control de cuentas
            </a>
        <?php endif; ?>
        <a href="<?= $urlAbsolute.'/settings' ?>" class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
            <?= str_starts_with($current, $urlAbsolute.'/settings') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            Configuración
        </a>
        <a class="text-sm hover:scale-102 flex flex-row items-center gap-2 font-medium cursor-pointer hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out
            <?= str_starts_with($current, $urlAbsolute.'/support') ? 'text-[#393784] bg-[#eeedfa]' : 'text-[#969696] hover:bg-zinc-100' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
            </svg>
            Ayuda
        </a>
        <form id="btnLogout" action="logout" method="POST" class="w-full">
            <button class="text-sm hover:scale-102 w-full flex flex-row items-center gap-2 text-[#969696] font-medium cursor-pointer hover:bg-zinc-100 hover:text-zinc-600 p-2 rounded-xl transition-all ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.2rem" height="1.2rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                Salir
            </button>
        </form>
    </div>
</aside>
<script>
    const btnOpenNavBar = document.getElementById('btnOpenNavBar');
    const aside = document.getElementById('sidebar-mobile');

    btnOpenNavBar.addEventListener('click', () => {
        aside.classList.toggle('-translate-x-full'); // oculto
        aside.classList.toggle('translate-x-0');     // visible
    });
</script>