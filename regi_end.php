<?php
    // 値の受け取り
    $name = isset($_POST['name'])? htmlspecialchars($_POST['name'],ENT_QUOTES,'utf-8'):'';
    $email = isset($_POST['email'])? htmlspecialchars($_POST['email'],ENT_QUOTES,'utf-8'):'';
    $password = isset($_POST['password'])? htmlspecialchars($_POST['password'],ENT_QUOTES,'utf-8'):'';
    $address = isset($_POST['address'])? htmlspecialchars($_POST['address'],ENT_QUOTES,'utf-8'):'';
    $dm = isset($_POST['dm'])? htmlspecialchars($_POST['dm'],ENT_QUOTES,'utf-8'):'';
    $dm_flag = ($dm=='受信する')? 1:0;

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }
    
    $stmt = $dbh->prepare("INSERT INTO users(name,email,password,address,dm,created_at,updated_at) VALUES(:name,:email,:password,:address,:dm,now(),now())");
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":password",$password);
    $stmt->bindParam(":address",$address);
    $stmt->bindParam(":dm",$dm_flag);
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
            <!-- contact　conf -->
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="thanks">
                    <h3>登録完了しました。</h3>
                    <p>ご登録ありがとうございました。</p>
                    <button type="button" class="btn btn-gray" onclick="location.href='./index.php'">トップページに戻る</button>
                    </div>
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