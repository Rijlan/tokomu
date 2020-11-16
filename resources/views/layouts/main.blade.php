<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

</head>

<body>
    <nav class="nav-wrapper grey darken-2">
        <div class="container">
            <a href="#" class="brand-logo">
                Dashboard
            </a>
            <a href="#" class="sidenav-trigger" data-target="mobile-links">
                <i class="material-icons">menu</i>
            </a>
            <ul class="right hide-on-med-and-down">
                <li><a href="/category">Category</a></li>
                <li><a href="/user">User</a></li>
                <li><a href="/shop">Shop</a></li>
                <li><a href="/product">Product</a></li>
                <li><a href="/chart">Cart</a></li>
                <li><a href="/transaction">Transaction</a></li>
                <li>
                    <!-- Dropdown Trigger -->
                    <a class="dropdown-trigger btn grey lighten-3 black-text" href="#"
                        data-target="dropdown1">{{ Auth::user()->name }}</a>

                    <!-- Dropdown Structure -->
                    <ul id="dropdown1" class="dropdown-content">
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        </li>
                        <form style="display: none;" id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="mobile-links">
        <li><a href="/category">Category</a></li>
        <li><a href="/user">User</a></li>
        <li><a href="/shop">Shop</a></li>
        <li><a href="/product">Product</a></li>
        <li><a href="/cart">Cart</a></li>
        <li><a href="/transaction">Transaction</a></li>
        <li>
            <!-- Dropdown Trigger -->
            <a class="dropdown-trigger btn grey lighten-3 black-text" href="#"
                data-target="dropdown2">{{ Auth::user()->name }}</a>

            <!-- Dropdown Structure -->
            <ul id="dropdown2" class="dropdown-content">
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </li>
    </ul>

    @yield('content')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.sidenav').sidenav();
        });

        $('.dropdown-trigger').dropdown();

        $(document).ready(function () {
            $('.modal').modal();
        });

    </script>

</body>

</html>
