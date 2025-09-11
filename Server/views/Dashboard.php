<?php include_once __DIR__.'/includes/Header.php'; ?>
    <main class="dash_container">
        <?php include_once __DIR__.'/includes/Aside.php'; ?>
        <section class="dash_container_content content">
            <article class="dash_container_content_header">
                <div>
                    <span>Inicio</span>
                    <h1>Dashboard</h1>
                </div>
                <nav>
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="1.5rem" height="1.5rem">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
                        </svg>
                        Nuevo proyecto
                    </button>
                    <button class="notification">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="1.5rem" height="1.5rem">
                            <path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0 24.585 24.585 0 0 1-4.831-1.244.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 5.25 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0 25.057 25.057 0 0 1-4.496 0Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </nav>
            </article>
            <article class="dash_container_content_body">
                <div class="dash_container_content_body_info">
                    <span>Hola, Angel de Jesus 🖐🏻</span>
                    <p>A continuación te presentamos los KPI´s de la semana de manera general.</p>
                </div>
                <div class="dash_container_content_body_kpi">
                    <div class="dash_container_content_body_kpi_card">
                        <div class="dash_container_content_body_kpi_card_header">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="2rem" height="2rem">
                                <path d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                            </svg>
                            <h2>Proyectos</h2>
                        </div>
                       <div class="dash_container_content_body_kpi_card_footer">
                            <span class="span-1">2 Proyectos activos</span>
                            <span class="span-2">1 Proyecto completado</span>
                        </div>
                    </div>
                    <div class="dash_container_content_body_kpi_card">
                        <div class="dash_container_content_body_kpi_card_header">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="2rem" height="2rem">
                                <path d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                            </svg>
                            <h2>Proyectos</h2>
                        </div>
                       <div class="dash_container_content_body_kpi_card_footer">
                            <span class="span-1">2 Proyectos activos</span>
                            <span class="span-2">1 Proyecto completado</span>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </main>
<?php include_once __DIR__.'/includes/Footer.php'; ?>