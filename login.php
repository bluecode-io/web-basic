<?php
    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login']:false;
?>
<!DOCTYPE html>
<html>
    <head>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-13xxxxxxxxx"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-13xxxxxxxxx');
        </script>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>ログイン｜SQUARE, inc.</title>
        <meta name="description" content="ここにサイトの説明文">

        <meta property="og:title" content="SQUARE, inc." />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="https://ドメイン/img/bg.png" />
        <meta property="og:url" content="https://ドメイン" />
        <meta property="og:description" content="SQUARE, inc.のコーポレートサイトです">

        <link rel="icon" href="favicon.ico">

        <!-- css -->
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="responsive.css">

        <!-- icon -->
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="header-logo">
                    <h1><a href="index.php"><img src="img/square_logo.png" id="logo"></a></h1>
                </div>

                <!-- ハンバーガーメニューボタン -->
                <div class="toggle">
                    <div>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <div class="cart">
                    <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                </div>

                <nav class="sp-menu menu">
                    <ul>
                        <li><a href="index.php#service">サービス</a></li>
                        <li><a href="shop.php">商品一覧</a></li>
                        <li><a href="index.php#news">お知らせ</a></li>
                        <li><a href="index.php#about">会社概要</a></li>
                        <li><a href="ブログのURL">ブログ</a></li>
                        <?php if($user_login==true): ?>
                            <li><a href="logout.php">ログアウト</a></li>
                        <?php else: ?>
                            <li><a href="login.php">ログイン</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>

                <nav class="pc-menu menu-left menu">
                    <ul>
                        <li><a href="index.php#service">サービス</a></li>
                        <li><a href="shop.php">商品一覧</a></li>
                        <li><a href="index.php#news">お知らせ</a></li>
                        <li><a href="index.php#about">会社概要</a></li>
                        <li><a href="ブログのURL">ブログ</a></li>
                    </ul>
                </nav>
                <nav class="pc-menu menu-right menu">
                    <ul>
                        <li><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                        <?php if($user_login==true): ?>
                            <li><a href="logout.php">ログアウト</a></li>
                        <?php else: ?>
                            <li><a href="login.php">ログイン</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </header> 
        <main>
            <!-- register -->
            <div class="wrapper last-wrapper register-wrapper">
                <div class="container">
                    <div class="login">
                        <div class="wrapper-title">
                            <h4>ログイン</h4>
                        </div>
                        <form class="login-form" action="user_check.php" method="POST">
                            <div class="form-group">
                                <p>メールアドレス</p>
                                <input type="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <p>パスワード</p>
                                <input type="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-gray">ログイン</button>
                        </form>
                    </div>
                    <div class="register">
                        <div class="wrapper-title">
                            <h4>新規登録</h4>
                            <p>登録がお済みでない方はこちらから新規登録してください。</p>
                        </div>
                        <button type="button" class="btn btn-submit" onclick="location.href='register.php'">新規登録</button>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="container">
                <p>Copyright @ 2018 SQUARE, inc.</p>
            </div>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>

            $(function(){
                // ハンバーガーメニューの動作
                $('.toggle').click(function(){
                    $("header").toggleClass('open');
                    $(".sp-menu").slideToggle(500);
                });

            });

        </script>
    </body>
</html>

