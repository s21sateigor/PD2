<!doctype html>
<html lang="lv">
 <head>
 <meta charset="utf-8">
 <title>{{ $title }}</title>
 <meta name="description" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link
 href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
 rel="stylesheet"
 integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
 crossorigin="anonymous"
 >
 </head>
 <body>
 <header class="navbar navbar-dark bg-dark mb-5">
 <div class="container">
 <span class="navbar-brand mb-0 h1">{{ $title }}</span>
 </div>
 </header>
 <main class="container">
 <div id="root"></div>
 </main>
 <footer class="mt-5 py-5">
 <div class="container">
 I. Šaters, VeA, 2023
 </div>
 </footer>
 <script src="{{ asset('/js/app.js') }}"></script>
 </body>
</html>