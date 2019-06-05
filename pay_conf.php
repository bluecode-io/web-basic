<?php
    // 値の受け取り
    $name = isset($_POST['name'])? htmlspecialchars($_POST['name'],ENT_QUOTES,'utf-8'):'';
    $email = isset($_POST['email'])? htmlspecialchars($_POST['email'],ENT_QUOTES,'utf-8'):'';
    $tel = isset($_POST['tel'])? htmlspecialchars($_POST['tel'],ENT_QUOTES,'utf-8'):'';
    $postcode = isset($_POST['postcode'])? htmlspecialchars($_POST['postcode'],ENT_QUOTES,'utf-8'):'';
    $address = isset($_POST['address'])? htmlspecialchars($_POST['address'],ENT_QUOTES,'utf-8'):'';

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

        <title>ご購入手続き｜SQUARE, inc.</title>
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
                        <li><a href="register.html">会員登録</a></li>
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
                        <li><a href="register.html">会員登録</a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <div class="breadcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="index.php">TOP</a></li>
                        <li><a href="cart.php">カート</a></li>
                        <li>ご購入者情報</li>
                    </ul>
                </div>
            </div>
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>ご購入者情報</h3>
                    </div>
                    <form class="pay-form"  action="pay_end.php" method="POST">
                        <div class="form-group">
                            <p class="form-title">お名前 *</p>
                            <p><?php echo $name; ?></p>
                            <input type="hidden" name="name" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <p class="form-title">Email *</p>
                            <p><?php echo $email; ?></p>
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <p class="form-title">電話番号 *</p>
                            <p><?php echo $tel; ?></p>
                            <input type="hidden" name="tel" value="<?php echo $tel; ?>">
                        </div>
                        <div class="form-group">
                            <p class="form-title">お届け先 *</p>
                            <label>郵便番号</label><br>
                            <p><?php echo $postcode; ?></p>
                            <input type="hidden" name="postcode" value="<?php echo $postcode; ?>">
                            <label>住所</label><br>
                            <p><?php echo $address; ?></p>
                            <input type="hidden" name="address" value="<?php echo $address; ?>">
                        </div>
                        <p>この内容で送信してよろしいですか？</p>
                        <button type="submit" class="btn btn-blue">購入する</button>
                        <button type="button" class="btn btn-gray" onclick="location.href='./pay.php'">修正する</button>
                    </form>
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
            $(function () {
                // ハンバーガーメニューの動作
                $('.toggle').click(function () {
                    $("header").toggleClass('open');
                    $(".sp-menu").slideToggle(500);
                });
            });
        </script>
    </body>
</html>