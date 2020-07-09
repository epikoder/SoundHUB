<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('media.upload')}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="text" name="title" placeholder="title">
    <br>
    <input type="text" name="album" placeholder="album">
    <br>
    <input type="text" name="genre" placeholder="genre">
    <br>
    <input type="file" name="track">
    <button type="submit" name="submit">Submit</button>
</form>
</body>
</html>
