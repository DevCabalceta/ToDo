<?php
// Enviar código 404 ANTES de cualquier salida
http_response_code(404);

// (Opcional) si usas sesión/navegación común
// session_start();
?>
<!DOCTYPE html>
<html lang="es" class="h-full scroll-smooth">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Página no encontrada · 404</title>
  <meta name="theme-color" content="#0ea5e9">
  <script src="https://cdn.tailwindcss.com"></script>
  <meta name="description" content="La página que buscas no existe o fue movida." />
  <link rel="icon" type="image/svg+xml" href="https://tailwindcss.com/favicons/favicon-32x32.png">
  <style>
    /* sutil grano para dar textura */
    .noise:before{
      content:"";
      position:fixed;inset:0;pointer-events:none;opacity:.06;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='140' height='140' viewBox='0 0 140 140'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='.85' numOctaves='2' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='.25'/%3E%3C/svg%3E");
    }
  </style>
</head>
<body class="h-full antialiased bg-gradient-to-br from-sky-50 via-white to-indigo-50 dark:from-slate-900 dark:via-slate-950 dark:to-slate-900 text-slate-800 dark:text-slate-100 noise">
  <!-- Orbes decorativos -->
  <div aria-hidden="true" class="pointer-events-none fixed -top-24 -right-24 h-72 w-72 rounded-full blur-3xl bg-sky-300/30 dark:bg-sky-500/20"></div>
  <div aria-hidden="true" class="pointer-events-none fixed -bottom-24 -left-24 h-72 w-72 rounded-full blur-3xl bg-indigo-300/30 dark:bg-indigo-500/20"></div>

  <main class="min-h-full grid place-items-center p-6">
    <section class="w-full max-w-3xl">
      <!-- Card principal -->
      <div class="relative overflow-hidden rounded-3xl bg-white/70 dark:bg-white/5 backdrop-blur-xl ring-1 ring-slate-900/10 dark:ring-white/10 shadow-2xl">
        <!-- borde luminoso -->
        <div aria-hidden="true" class="pointer-events-none absolute inset-0 rounded-3xl" style="mask: radial-gradient(70% 60% at 50% 0%, rgba(255,255,255,0.9) 0, transparent 60%);">
          <div class="absolute -top-24 left-1/2 -translate-x-1/2 h-48 w-[36rem] bg-gradient-to-r from-sky-400/40 via-fuchsia-400/40 to-indigo-400/40 blur-3xl"></div>
        </div>

        <div class="relative grid md:grid-cols-[1fr_auto] gap-8 p-8 md:p-12">
          <!-- Texto -->
          <div class="flex flex-col gap-6">
            <span class="inline-flex w-fit items-center gap-2 rounded-full border border-slate-200/60 dark:border-white/10 bg-white/60 dark:bg-white/5 px-3 py-1 text-xs tracking-wide text-slate-600 dark:text-slate-300">
              <span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
              Error 404 · No encontrado
            </span>

            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight">
              Ups… no encontramos esta página
            </h1>
            <p class="text-slate-600 dark:text-slate-300 text-lg">
              Puede que el enlace esté roto o que la página haya sido movida. Intenta volver al inicio o busca lo que necesitas.
            </p>

            <!-- Botones -->
            <div class="flex flex-wrap gap-3">
              <a href="/ToDo/home/"
                 class="inline-flex items-center justify-center gap-2 rounded-2xl px-5 py-3 font-semibold bg-sky-500 text-white hover:bg-sky-600 active:scale-[.99] shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Ir al inicio
              </a>
              <a href="mailto:soporte@tu-dominio.com"
                 class="inline-flex items-center justify-center gap-2 rounded-2xl px-5 py-3 font-semibold border border-slate-300/70 dark:border-white/10 bg-white/70 dark:bg-white/5 hover:bg-white/90 dark:hover:bg-white/10 active:scale-[.99] transition">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M1.5 6.75A2.25 2.25 0 013.75 4.5h16.5A2.25 2.25 0 0122.5 6.75v10.5A2.25 2.25 0 0120.25 19.5H3.75A2.25 2.25 0 011.5 17.25V6.75Zm2.4-.75a.75.75 0 00-.75.75v.267l8.268 5.164a.75.75 0 00.764 0L20.35 7.017V6.75a.75.75 0 00-.75-.75H3.9Z"/></svg>
                 Contactar soporte
              </a>
              <a href="javascript:history.back()"
                 class="inline-flex items-center justify-center gap-2 rounded-2xl px-5 py-3 font-semibold border border-transparent hover:border-slate-300/70 dark:hover:border-white/10 bg-transparent hover:bg-white/60 dark:hover:bg-white/5 active:scale-[.99] transition">
                 ← Volver
              </a>
            </div>
          </div>

          <!-- Ilustración -->
          <div class="mx-auto md:mx-0 flex items-center">
            <div class="relative h-40 w-40 md:h-52 md:w-52">
              <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-sky-400 to-indigo-500 opacity-20 blur-2xl"></div>
              <svg viewBox="0 0 200 200" class="relative h-full w-full drop-shadow">
                <defs>
                  <linearGradient id="g" x1="0" x2="1" y1="0" y2="1">
                    <stop offset="0%" stop-color="#38bdf8"/>
                    <stop offset="100%" stop-color="#6366f1"/>
                  </linearGradient>
                </defs>
                <g fill="url(#g)">
                  <path d="M100 10c49 0 88 39 88 88s-39 88-88 88S12 147 12 98 51 10 100 10zm0 22a66 66 0 100 132 66 66 0 000-132z"/>
                  <circle cx="76" cy="88" r="6" />
                  <circle cx="124" cy="88" r="6" />
                  <path d="M70 128c18-16 42-16 60 0" stroke="url(#g)" stroke-width="8" stroke-linecap="round" fill="none"/>
                </g>
                <text x="100" y="108" text-anchor="middle" font-size="44" font-family="ui-sans-serif, system-ui" fill="currentColor" class="fill-slate-900/80 dark:fill-white/80">404</text>
              </svg>
            </div>
          </div>
        </div>

        <!-- Footer mini -->
        <div class="flex items-center justify-between gap-4 border-t border-slate-900/10 dark:border-white/10 px-8 md:px-12 py-5 text-sm text-slate-500 dark:text-slate-400">
          <span>¿Llegaste aquí por un enlace roto?</span>
          <a href="/reportar-error" class="font-medium hover:text-sky-600 dark:hover:text-sky-400 transition">Reportar</a>
        </div>
      </div>

      <!-- Sugerencias -->
      <div class="mx-auto mt-6 flex flex-wrap items-center justify-center gap-2 text-sm text-slate-600 dark:text-slate-400">
        <span class="px-3 py-1 rounded-full bg-white/70 dark:bg-white/5 border border-slate-200/60 dark:border-white/10">Revisa la URL</span>
        <span class="px-3 py-1 rounded-full bg-white/70 dark:bg-white/5 border border-slate-200/60 dark:border-white/10">Usa la barra de búsqueda</span>
        <span class="px-3 py-1 rounded-full bg-white/70 dark:bg-white/5 border border-slate-200/60 dark:border-white/10">Vuelve al inicio</span>
      </div>
    </section>
  </main>
</body>
</html>


