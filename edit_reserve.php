<?php

    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login']:false;

    //ログインしてなかったらカレンダーにリダイレクト
    if($user_login==false){
        header('location:./calendar.php');
    }
    //user_id取得
    $user_id = $_SESSION['user_id'];

    $reservation_id = (isset($_GET['reservation_id']))? htmlspecialchars($_GET['reservation_id'], ENT_QUOTES, 'utf-8') : '';

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }
    
    $stmt = $dbh->prepare("SELECT * from reservations WHERE id=:id");
    $stmt->bindParam(":id",$reservation_id);
    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        <title>RESERVATION｜SQUARE, inc.</title>
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
                        <li><a href="index.php#contact">お問合せ</a></li>
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
                        <li><a href="index.php#contact">お問合せ</a></li>
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
                        <li><a href="calendar.php">無料ご相談会予約</a></li>
                        <li>ご予約</li>
                    </ul>
                </div>
            </div>
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>RESERVATION</h3>
                        <p>ご予約</p>
                    </div>
                    <form class="reserve-form" method="POST" action="update_reserve.php">
                        <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                        <div class="form-group">
                            <label for="reserveDate">予約日</label>
                            <input type="text" class="form-control" id="reserveDate" name="reserve_date" value="<?php echo $reservations[0]['reserve_date']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="name">氏名 *</label>
                            <input type="text" class="form-control" name="name" required value="<?php echo $reservations[0]['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="tel">電話番号 *</label>
                            <input type="text" class="form-control" name="tel" required value="<?php echo $reservations[0]['tel']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">メールアドレス *</label>
                            <input type="text" class="form-control" name="email" required value="<?php echo $reservations[0]['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">来訪人数 *</label>
                            <input type="text" class="form-control" name="number" required value="<?php echo $reservations[0]['number']; ?>">
                        </div>
                        <button type="submit" class="btn btn-submit">予約変更する</button>
                    </form>
                    <form method="POST" action="delete_reserve.php">
                        <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                        <button type="submit" class="btn btn-red">キャンセルする</button>
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