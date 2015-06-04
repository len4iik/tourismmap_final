<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- Set the viewport so this responsive site displays correctly on mobile devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TourismMap.net</title>
        <!-- Bootstrap -->
        {{ HTML::style('css/bootstrap.css'); }}
        {{ HTML::style('css/outer.css'); }}
    </head>
    <body>
    <div class="header-cont header">
        <a href="/about" style="margin-right: 10px;">About</a>
        <a href="/contacts" style="margin-right: 10px;">Contacts</a>
    </div>
        @yield('content')
    </body>
</html>