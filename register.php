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

        <title>新規登録｜SQUARE, inc.</title>
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
                    <div class="register">
                        <div class="wrapper-title">
                            <h3>REGISTER</h3>
                            <p>新規登録</p>
                        </div>
                        <form class="regi-form" method="POST" action="./regi_conf.php">
                            <div class="form-group">
                                <p>お名前 *</p>
                                <input type="text" name="name" required>
                            </div>
                            <div class="form-group">
                                <p>Email *</p>
                                <input type="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <p>パスワード *</p>
                                <input type="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <p>住所 *</p>
                                <input type="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <p>SQUAREからのお知らせを受信しますか？</p>
                                <input type="hidden" name="dm" value="受信しない">
                                <input type="checkbox" class="checkbox" name="dm" value="受信する" checked>
                                <span>受信する</span>
                            </div>

                            <button type="submit" class="btn btn-submit">内容を確認する</button>
                        </form>
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