<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="m-4">
        <p class="">Hello {{ $signup->name }}</p>

        <!-- SoundHUB image -->

        <p class="py-2">
            To complete your account opening on SoundHUB, please follow the link below <br>
        </p>
        <a href="{{ env('APP_URL', 'http://localhost').'/?id='.$signup->id.'&token='.$signup->token }}">
            <button class="bg-blue-500 text-white rounded-sm p-1">Create account</button>
        </a>
    </div>
</body>
</html>
