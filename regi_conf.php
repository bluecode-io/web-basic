<?php
    // 値の受け取り
    $name = isset($_POST['name'])? htmlspecialchars($_POST['name'],ENT_QUOTES,'utf-8'):'';
    $email = isset($_POST['email'])? htmlspecialchars($_POST['email'],ENT_QUOTES,'utf-8'):'';
    $password = isset($_POST['password'])? htmlspecialchars($_POST['password'],ENT_QUOTES,'utf-8'):'';
    $address = isset($_POST['address'])? htmlspecialchars($_POST['address'],ENT_QUOTES,'utf-8'):'';
    $dm = isset($_POST['dm'])? $_POST['dm']:[];
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

        <title>登録内容確認｜SQUARE, inc.</title>
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

                <nav class="sp-menu menu">
                    <ul>
                        <li><a href="index.php#service">サービス</a></li>
                        <li><a href="index.php#news">お知らせ</a></li>
                        <li><a href="index.php#about">会社概要</a></li>
                        <li><a href="index.php#contact">お問合せ</a></li>
                        <li><a href="ブログのURL">ブログ</a></li>
                        <li><a href="register.html">会員登録</a></li>
                    </ul>
                </nav>

                <nav class="pc-menu menu-left menu">
                    <ul>
                        <li><a href="index.php#service">サービス</a></li>
                        <li><a href="index.php#news">お知らせ</a></li>
                        <li><a href="index.php#about">会社概要</a></li>
                        <li><a href="index.php#contact">お問合せ</a></li>
                        <li><a href="ブログのURL">ブログ</a></li>
                    </ul>
                </nav>
                <nav class="pc-menu menu-right menu">
                    <a href="register.html">会員登録</a>
                </nav>
            </div>
        </header>
       <main>
            <!-- contact　conf -->
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>CONFIRM</h3>
                        <p>登録内容確認</p>
                    </div>
                    <form method="POST" action="regi_end.php" class="conf-form">
                        <div class="form-group">
                            <p>お名前 *</p>
                            <p><?php echo $name; ?></p>
                            <input type="hidden" name="name" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <p>Email *</p>
                            <p><?php echo $email; ?></p>
                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <p>パスワード *</p>
                            <p><?php echo $password; ?></p>
                            <input type="hidden" name="password" value="<?php echo $password; ?>">
                        </div>
                        <div class="form-group">
                            <p>住所 *</p>
                            <p><?php echo $address; ?></p>
                            <input type="hidden" name="address" value="<?php echo $address; ?>">
                        </div>
                        <div class="form-group">
                            <p>SQUAREからのお知らせを受信しますか？</p>
                            <p><?php echo $dm; ?></p>
                            <input type="hidden" name="dm" value="<?php echo $dm; ?>">
                        </div>
                        <p>この内容で送信してよろしいですか？</p>
                        <button type="submit" class="btn btn-submit">送信する</button>
                    </form>
                </div>
            </div>
            <!-- end contact -->
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