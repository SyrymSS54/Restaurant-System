@php
use Illuminate\Support\Facades\Vite;
@endphp

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta content="text/html">
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Order</title>
        @viteReactRefresh
        @vite(['resources/css/order.css','resources/js/order.jsx'])
    </head>
    <body>
        <main id="app"></main>
    </body>
</html>