<?php
    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login']:false;

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

        <title>決済カード情報｜SQUARE, inc.</title>
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
                        <li><a href="calendar.php">無料ご相談会</a></li>
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
                        <li><a href="calendar.php">無料ご相談会</a></li>
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
            <div class="breadcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="index.php">TOP</a></li>
                        <li><a href="shop.php">商品一覧</a></li>
                        <li><a href="cart.php">カート</a></li>
                        <li><a href="pay.php">ご購入者情報</a></li>
                        <li>決済カード情報</li>
                    </ul>
                </div>
            </div>
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>決済カード情報</h3>
                        <span class="error"></span>
                    </div>
                    <form class="pay-form" action="pay_conf.php" method="POST">
                        <input type="hidden" name="name" value="<?php echo $name; ?>">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="hidden" name="tel" value="<?php echo $tel; ?>">
                        <input type="hidden" name="postcode" value="<?php echo $postcode; ?>">
                        <input type="hidden" name="address" value="<?php echo $address; ?>">
                        <div class="form-group">
                            <p class="form-title">カード番号 *</p>
                            <input type="text" id="card-number" required>
                        </div>
                        <div class="form-group">
                            <p class="form-title">セキュリティーコード *</p>
                            <input type="text" id="cvc" class="sm-form" required>
                        </div>
                        <div class="form-group">
                            <p class="form-title">カード有効期限 *</p>
                            <label>月</label>
                            <input type="text" id="exp_month" placeholder="7" class="sm-form" required>
                            <label>年</label>
                            <input type="text" id="exp_year" placeholder="2020" class="sm-form" required>
                        </div>
                        <div class="form-group">
                            <p class="form-title">カード名義 *</p>
                            <input type="text" id="card-name" placeholder="TARO YAMADA">
                        </div>
                        <button type="button" class="btn btn-blue confirm">確認する</button>
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
        <script type="text/javascript" src="https://js.pay.jp/"></script>
        <script type="text/javascript">Payjp.setPublicKey('pk_test_c9axxxxxxxxxxxxxxxxx');</script>
        <script>
            $(function () {

                $(".error").empty(); //最初はエラーは空

                // ハンバーガーメニューの動作
                $('.toggle').click(function () {
                    $("header").toggleClass('open');
                    $(".sp-menu").slideToggle(500);
                });

                // クレジットカード動作
                $(".confirm").click(function() {
            
                    $(".error").empty(); //最初はエラーは空
                    
                    //それぞれの値を取得
                    var number = $("#card-number").val();
                    var cvc = $("#cvc").val();
                    var exp_month = $("#exp_month").val();
                    var exp_year = $("#exp_year").val();     
                    
                    //すべての値をcardに格納
                    var card = {
                        number: number,
                        cvc: cvc,
                        exp_month: exp_month,
                        exp_year: exp_year
                    };

                    //トークン発行
                    Payjp.createToken(card, function(s, response) {
                
                        if (response.error) {
                            // エラーの場合、エラー内容を表示
                            $(".error").append(response.error.message);
                            return false;
                        }else {
                            //OKの場合、response.idでトークンを取得
                            var token = response.id;
                            //取得したトークンをformに追加
                            $(".pay-form").append($('<input type="hidden" name="payjp_token" />').val(token));
                            //支払い実行ページに送信
                            $(".pay-form").submit();
                        }
                    });
                });
            });
        </script>
    </body>
</html>