<html>
    <head>
        <meta charset="utf-8">
        <title>Hospital Manager</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-bland text-black text-decoration-none fw-bold" href="#">通院管理アプリ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        {{-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">About</a>
                        </li> --}}
                    </ul>
                    @if (Route::has('login'))
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('/dashboard') }}">ダッシュボード</a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                            </li>
                            @endif
                        @endauth
                    </ul>
                    @endif
                </div>
            </div>
        </nav>
        <div class="main-container h-100">
            <div class="d-flex h-100 align-items-center justify-content-center">
                通院管理アプリ                
            </div>
        </div><!-- .main-container -->
    </body>
</html>