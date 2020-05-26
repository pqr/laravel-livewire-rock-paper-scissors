<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/main.css') }}" >
        <title>Rock Paper Scissors</title>
        @livewireStyles
    </head>
    <body>
    <h1 class="site-name">Rock Paper Scissors</h1>

    @livewire('game')

    @livewireScripts
    </body>
</html>
