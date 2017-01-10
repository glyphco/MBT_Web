<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - MyBoringTown.com</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600"
        rel="stylesheet" type="text/css">
   <link href="https://fonts.googleapis.com/css?family=Fira+Mono|Fira+Sans" rel="stylesheet">

    <!-- Styles -->
<style>
html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Raleway', sans-serif;
    font-weight: 100;
    height: 100vh;
    margin: 0;
}

.flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
}

.position-ref {
    position: relative;
}

.top-right {
    position: absolute;
    right: 10px;
    top: 18px;
}

.content {
    text-align: center;
}
.head {
    text-align: center;
}
.title {
    font-size: 44px;
}


.listing {
    font-family: 'Fira Sans', sans-serif;
    font-size: 12px;
}
.monospace {
    font-family: 'Fira Mono', monospace;
}
.event-venue {
    font-family: 'Arial', sans-serif;
    color: #333333;
    font-weight: 100;

}
.b10 {
    margin-bottom: 10px;
}

.left {
    align-items: left;
    justify-content: left;
    text-align: left;
}

.links {
    text-align: center;
}
.links>a:link { color: #636b6f; text-decoration: none }
.links>a:active { color: #636b6f; text-decoration: none }
.links>a:visited { color: #636b6f; text-decoration: none }
.links>a:hover { color: #636b6f; text-decoration: underline; background: #cccccc }


</style>
</head>


    <body>
        <div class="position-ref">
            <div class="head">
                @section('head')
                    <div class="title">MyBoringTown -0.0a</div>
                @show
            </div>
            <div class="position-ref links">
                @section('links')
<a href="\">Events</a> - <a href="logout">Logout</a>
                @show
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>

