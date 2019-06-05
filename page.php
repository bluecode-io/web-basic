<?php
    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login']:false;


    $id = isset($_GET['id'])? htmlspecialchars($_GET['id'], ENT_QUOTES, 'utf-8'):'';

    if($id==''){
        header('location:./index.php');
    }

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    $stmt = $dbh->prepare("SELECT * FROM news WHERE id=:id");
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

        <title><?php echo $news[0]['title']; ?>｜SQUARE, inc.</title>
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
                        <li><?php echo $news[0]['title']; ?></li>
                    </ul>
                </div>
            </div>
            <div class="wrapper">
                <div class="container">
                    <article>
                        <div class="page-title">
                            <h1><?php echo $news[0]['title']; ?></h1>
                            <p><?php echo $news[0]['updated_at']; ?></p>
                        </div>
                        <div class="page-text">
                            <?php echo $news[0]['content']; ?>
                        </div>
                    </article>
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