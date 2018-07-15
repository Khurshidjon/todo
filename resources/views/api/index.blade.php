<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <nav class="nav navbar-expand-md navbar-light">
            <a href="" class="nav navbar-brand">API crud</a>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link"  data-toggle="modal" data-target="#create-modal">Add Post</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <a id="logoutDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="logoutDropdown">
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <button class="dropdown-item btn btn-outline-light" href="" id="logout-user">Logout</button>
                            </form>
                        </div>
                    </li>
                @else
                <li class="nav-item">
                    <a href="#" class="nav-link"  data-toggle="modal" data-target="#loginModal">Login</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link"  data-toggle="modal" data-target="#registerModal">Register</a>
                </li>
                @endif
            </ul>
        </nav>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>DETAIL</th>
                        <th colspan="2">ACTION</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        @include('api.auth.register')

        @include('api.auth.login')

        @include('api.create')
        @include('api.edit')

    </div>
    <script type="text/javascript">
        var url = '<?php echo route('posts.index')?>';
    </script>
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
</body>
</html>