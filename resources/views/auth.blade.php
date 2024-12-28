<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type">
        <meta charset="utf-8">
        <link rel="stylesheet" href="./css/auth.css">
        <title>Auth</title>
    </head>
    <body>
        <main>
        <form method="post">
            @csrf
            <p><input required name="email" type="email" placeholder="..email"></p>
            <p><input required name="password" type="password" placeholder="..password"></p>
            <p><input class="submit" type="submit" value="Auth"></p>
        </form>
        </main>
    </body>
</html>