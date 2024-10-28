<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>NIC GAMES</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo"><p><strong>NIC</strong> GAMES</p></div>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/vendas">Vendas realizadas</a></li>
                <li><a href="/auth/signin"><i class="fa-regular fa-user"></i></a></li>
                @auth
                <form action="/auth/logout" method="POST">
                    @csrf
                    <div class="button-logout">
                        <button id="logout" type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Sair
                        </button>
                    </div>
                </form>
                @endauth
            </ul>
        </nav>
    </header>
