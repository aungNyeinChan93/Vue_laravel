<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        main{
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center
        }
        img{
          width: 400px;
          height: 400px;
        }
    </style>
</head>
<body>
    <main >
        <img src="{{ asset('/storage/recipes/10KaeGEGxKNN8yoy91p7pYccIMBu0BYs8G2Hu8tX.jpg') }}" alt="">

        <a href="{{ route('download','10KaeGEGxKNN8yoy91p7pYccIMBu0BYs8G2Hu8tX.jpg') }}">Download Image</a>
    </main>
</body>
</html>
