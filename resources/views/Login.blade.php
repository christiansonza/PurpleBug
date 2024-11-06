<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>EMS</title>

    <style>
        .con{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            height: 100vh;
        }
        form{
            width: 100%;
            max-width: 22rem;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: .65rem;
        }
        .btn-login{
            border: none;
            background-color: #3b82f6;
            border-radius: 4px;
            color: #fff;
            padding: 4px 0;
        }

    </style>
</head>
<body>
    <div class="con">
        <h3>EMS</h3>
        <form action="{{route('loginUser')}}" method="POST">
            @csrf
            <input class="form-control" type="text" name="name" placeholder="Enter username">
            <button class="btn-login" type="submit">Enter</button>
        </form>
    </div>
</body>
</html>