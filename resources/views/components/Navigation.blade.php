<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans+Semi+Condensed:wght@100;200;300;400;500;600;700;800;900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title></title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow-x: hidden;
        }
        .menu{
            display: flex;
        }
        .left-bar{
            background-color: #0c323c;
            width: 100%;
            max-width: 14rem;
            height: 100vh;
            padding: 2rem .85rem;
            position: fixed;
        }
        .top-leftbar{
            padding: .5rem 0 2rem;
        }
        .nav-username{
            color: #fff;
            margin-top: auto;
            margin-bottom: auto;
        }
        .nav-label{
            color: #fff;
            margin-top: auto;
            margin-bottom: auto;
        }
        li{
            list-style-type: none;
        }
        ul{
            display: flex;
            flex-direction: column;
            gap: .85rem;
            margin-top: auto;
            margin-bottom: auto;
        }
        ul .li-links{
            cursor: pointer;
        }
        .li-links a{
            text-decoration: none;
            color: #fff;
        }
        a{
            text-decoration: none;
        }
        .pfp{
            background-color: #ccc;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-bottom: .5rem;
        }
        .bottom-leftbar{
            display: flex;
            flex-direction: column;
            gap: .85rem;

        }
        .top-bar{
            height: 50px;
            border-bottom: 1px solid #ddd;
            flex: 1;
            background-color: #fff;
            display: flex;
            justify-content: end;
            align-items: center;
            gap: 2rem;
            padding: 0 3rem 0;
            color: #4a4a4a;
        }
        .btn-logout{
            background-color: transparent;
            border: none;
            color: #4a4a4a;
        }
        

    </style>
</head>
<body>
    <div class="menu">
        <div class="left-bar">
            <div class="top-leftbar">
                <p class="pfp"></p>
                <p class="nav-username">
                    {{ Auth::user()->name ?? Auth::guard('role')->user()->name }}
                    @if (Auth::check() && Auth::user()->role == 1)
                        <span>(Admin)</span>
                    @elseif (Auth::guard('role')->check() && Auth::guard('role')->user()->role == 1)
                        <span>(Admin)</span>
                    @else
                        <span>(User)</span>
                    @endif
                </p>
                
                
                
            </div>
            <div class="bottom-leftbar">
                <a href="Admin.Dashboard" class="nav-label">Dashboard</a>
            @if (Auth::check() && Auth::user()->role == 1)
                <p class="nav-label">User Management</p>
                    <ul>
                        <li class="li-links"><a href="Admin.Role"> Roles</a></li>
                        <li class="li-links"><a href="Admin.User"> Users</a></li>
                    </ul>
            @elseif (Auth::guard('role')->check() && Auth::guard('role')->user()->role == 1)
                <p class="nav-label">User Management</p>
                    <ul>
                        <li class="li-links"><a href="Admin.Role"> Roles</a></li>
                        <li class="li-links"><a href="Admin.User"> Users</a></li>
                    </ul>
            @endif
                <p class="nav-label">Expense Management</p>
                <ul>
                @if (Auth::check() && Auth::user()->role == 1)
                    <li class="li-links"><a href="Admin.Category"> Expense Categories</a></li>
                @elseif (Auth::guard('role')->check() && Auth::guard('role')->user()->role == 1)
                    <li class="li-links"><a href="Admin.Category"> Expense Categories</a></li>
                @endif
                    <li class="li-links"><a href="User.Expense"> Expenses</a></li>
                </ul>
            </div>
        </div>
        <div class="top-bar">
            <p class="mt-auto mb-auto">Welcome to Expense Manager</p>
            <form action="{{route('logoutUser')}}" method="POST">
                @csrf
                <button class="btn-logout">Logout</button>
            </form>
        </div>
    </div>

    
</body>
</html>