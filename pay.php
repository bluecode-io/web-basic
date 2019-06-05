<?php
    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login'] : false;
    if($user_login == true){

        //sessionからuser_id取得
        $user_id = $_SESSION['user_id']; 
        //DB接続
        try{
            $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
        }catch(PDOException $e){
            var_dump($e->getMessage());
            exit;
        }
        //user_idでSELECT文作成
        $stmt = $dbh->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->bindParam(":id",$user_id);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //データ取得
        $name = $users[0]['name'];
        $email = $users[0]['email'];
        $address = $users[0]['address'];

    }else{
        //ログインしてない
        $name = '';
        $email = '';
        $address = '';
    }
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
            <div class="breadcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="index.php">TOP</a></li>
                        <li><a href="shop.php">商品一覧</a></li>
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
                    <form class="pay-form" action="pay_card.php" method="POST">
                        <div class="form-group">
                            <p class="form-title">お名前 *</p>
                            <input type="text" name="name" required>
                            <input type="text" name="name" required value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <p class="form-title">Email *</p>
                            <input type="email" name="email" required>
                            <input type="email" name="email" required value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <p class="form-title">電話番号 *</p>
                            <input type="tel" name="tel" required>
                        </div>
                        <div class="form-group">
                            <p class="form-title">お届け先 *</p>
                            <label>郵便番号</label><br>
                            <input type="text" name="postcode" required>
                            <label>住所</label><br>
                            <input type="text" name="address" required>
                            <input type="text" name="address" required value="<?php echo $address; ?>">
                        </div>
                        <button type="submit" class="btn btn-blue">決済情報を入力する</button>
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