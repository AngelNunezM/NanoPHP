<!doctype html>
<html lang="es" class="dark">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>NanoPHP — Where simplicity becomes good practice.</title>
  <meta name="description" content="NanoPHP: microframework ligero para PHP 8.2. Minimalista, rápido y preparado para producción." />
  <link rel="stylesheet" href="css/output.css">
  <style>
    body {
      background: radial-gradient(circle at 10% 10%, rgba(124,58,237,0.25), transparent 40%),
                  radial-gradient(circle at 90% 90%, rgba(6,182,212,0.15), transparent 40%),
                  #0a0a12;
      color: #f9fafb;
      transition: background 0.4s ease, color 0.4s ease;
    }
  </style>
</head>
<body class="font-inter min-h-screen flex items-center justify-center p-8 transition-all duration-500">
  <main class="max-w-5xl w-full bg-white/10 dark:bg-white/5 border border-white/10 dark:border-white/10 rounded-2xl p-8 shadow-2xl backdrop-blur-md transition-all duration-500">
    <header class="flex flex-col sm:flex-row justify-between items-center gap-6">
      <div class="flex items-center gap-3 animate-fade-in">
        <div id="logo" class="w-14 h-14 rounded-xl bg-gradient-to-br from-violet-500/30 to-cyan-500/30 flex items-center justify-center border border-white/10">
          <img src="assets/icons/NanoPHPIcon.png" alt="NanoPHP Logo" class="w-10 h-10">
        </div>
        <div>
          <h1 class="text-3xl font-bold text-white">NanoPHP</h1>
          <p class="text-sm text-gray-400">Microframework PHP 8.2 — ligero, explícito y listo para producción.</p>
        </div>
      </div>
      <div class="flex gap-3">
        <button class="px-5 py-2 rounded-xl bg-gradient-to-r from-violet-600 to-cyan-500 text-white text-sm transition-all duration-300 hover:opacity-90">Prueba gratuita</button>
      </div>
    </header>

    <section class="mt-10 grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h2 class="text-2xl font-semibold text-white">Donde la simplicidad se convierte en buenas prácticas.</h2>
        <div class="w-16 h-1 bg-gradient-to-r from-violet-500 to-cyan-400 rounded-full mt-3"></div>
        <p class="text-gray-400 text-sm mt-4">Empieza rápido: routing minimal, controladores claros y una curva de aprendizaje corta. Ideal para APIs y microservicios.</p>

        <div class="flex flex-wrap gap-3 mt-6">
          <button class="bg-gradient-to-r from-violet-600 to-cyan-500 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:opacity-90 transition-all duration-300">Empezar — Gratis</button>
          <button class="bg-white/10 hover:bg-white/20 border border-white/10 px-5 py-2 rounded-lg text-sm text-white transition-all duration-300">Ver docs</button>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-8 text-sm text-gray-300">
          <div class="bg-white/5 border border-white/10 p-3 rounded-lg">⚡ Rendimiento optimizado</div>
          <div class="bg-white/5 border border-white/10 p-3 rounded-lg">🧩 Modular y extensible</div>
          <div class="bg-white/5 border border-white/10 p-3 rounded-lg">🔒 Buenas prácticas por defecto</div>
        </div>
      </div>

      <aside class="bg-white/5 border border-white/10 rounded-xl p-6 transition-all duration-500">
        <h3 class="font-semibold text-white">Únete a la lista</h3>
        <p class="text-sm text-gray-400 mt-1 mb-4">Recibe novedades, ejemplos y plantillas para arrancar con NanoPHP.</p>
        <form id="joinForm" onsubmit="event.preventDefault();subscribe()" class="space-y-3">
          <input id="email" type="email" placeholder="tu@correo.com" required class="w-full bg-transparent border border-white/10 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-violet-500 transition-all duration-300 text-white placeholder-gray-500">
          <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-gradient-to-r from-violet-600 to-cyan-500 text-white rounded-lg px-3 py-2 text-sm hover:opacity-90 transition-all duration-300">Unirme</button>
            <button type="button" onclick="copyRepo()" class="flex-1 bg-white/10 hover:bg-white/20 border border-white/10 rounded-lg px-3 py-2 text-sm text-white transition-all duration-300">Copiar repo</button>
          </div>
          <p id="msg" class="text-sm text-gray-400"></p>
        </form>
      </aside>
    </section>

    <footer class="mt-10 flex flex-col sm:flex-row justify-between items-center text-xs text-gray-400 transition-all duration-300">
      <div>© <strong>NanoPHP</strong> — 2025</div>
      <div>Hecho para desarrolladores · PHP 8.2</div>
    </footer>
  </main>

  <script>
    function subscribe(){
      const email=document.getElementById('email').value.trim();
      const msg=document.getElementById('msg');
      if(!email){msg.textContent='Introduce un correo válido.';return;}
      msg.textContent='¡Gracias! Hemos registrado tu correo.';
      setTimeout(()=>msg.textContent='',4000);
      document.getElementById('joinForm').reset();
    }

    function copyRepo(){
      const repo='https://github.com/tu-org/nanophp';
      navigator.clipboard?.writeText(repo).then(()=>{
        const msg=document.getElementById('msg');msg.textContent='URL del repo copiada al portapapeles.';
        setTimeout(()=>msg.textContent='',3000);
      }).catch(()=>alert('Copia manual: '+repo));
    }
  </script>

  <style>
    @keyframes fade-in { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .animate-fade-in { animation: fade-in 1s ease forwards; }
  </style>
</body>
</html>