<?php

    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login']:false;
    
    //ログインしてなかったらカレンダーにリダイレクト
    if($user_login==false){
        header('location:./calendar.php');
    }
    //user_id取得
    $user_id = $_SESSION['user_id'];

    $reservation_id = isset($_POST['reservation_id'])? htmlspecialchars($_POST['reservation_id'], ENT_QUOTES, 'utf-8'):'';
    $reserve_date = isset($_POST['reserve_date'])? htmlspecialchars($_POST['reserve_date'], ENT_QUOTES, 'utf-8'):'';
    $name = isset($_POST['name'])? htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8'):'';
    $email = isset($_POST['email'])? htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8'):'';
    $tel = isset($_POST['tel'])? htmlspecialchars($_POST['tel'], ENT_QUOTES, 'utf-8'):'';
    $number = isset($_POST['number'])? htmlspecialchars($_POST['number'], ENT_QUOTES, 'utf-8'):'';

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    $stmt = $dbh->prepare("UPDATE reservations SET reserve_date=:reserve_date, name=:name, email=:email, tel=:tel, number=:number, updated_at=now() WHERE id=:id");
    $stmt->bindParam(":reserve_date",$reserve_date);
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":tel",$tel);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":number",$number,PDO::PARAM_INT);
    $stmt->bindParam(":id",$reservation_id,PDO::PARAM_INT);

    $stmt->execute();
    
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
                        <li>ご予約完了</li>
                    </ul>
                </div>
            </div>
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>ご予約完了</h3>
                    </div>
                    <div class="wrapper-body">
                        <div class="thanks">
                            <h4>ご予約内容を変更しました。</h4>
                        </div>
                        <button type="button" class="btn btn-gray" onclick="location.href='./index.php'">トップページに戻る</button>
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