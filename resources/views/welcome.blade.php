<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="http://localhost:8000/api/user/signup">
        {{ csrf_token() }}

        <input type="text" name="name">
        <input type="email" name="email" id="">
        <input type="password" name="password" id="">
        <button type="submit">submit</button>
    </form>
</body>
</html>
