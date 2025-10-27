<?php include_once __DIR__.'/includes/Header.php'; ?>
    <main class="flex lg:flex-row xs:flex-col h-screen overflow-hidden w-screen bg-slate-50">
       
    </main>
    <script> if(!localStorage.getItem('token_session')) localStorage.setItem('token_session', "<?= $_SESSION['token'] ?>"); </script>
<?php include_once __DIR__.'/includes/Footer.php'; ?>