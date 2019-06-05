<?php
    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login']:false;


    require_once './vendor/payjp/payjp-php/init.php';
    \Payjp\Payjp::setApiKey("sk_test_21a7xxxxxxxxxxxxxxxxxxxx");

    // 値の受け取り
    $name = isset($_POST['name'])? htmlspecialchars($_POST['name'],ENT_QUOTES,'utf-8'):'';
    $email = isset($_POST['email'])? htmlspecialchars($_POST['email'],ENT_QUOTES,'utf-8'):'';
    $tel = isset($_POST['tel'])? htmlspecialchars($_POST['tel'],ENT_QUOTES,'utf-8'):'';
    $postcode = isset($_POST['postcode'])? htmlspecialchars($_POST['postcode'],ENT_QUOTES,'utf-8'):'';
    $address = isset($_POST['address'])? htmlspecialchars($_POST['address'],ENT_QUOTES,'utf-8'):'';
    $payjp_token = isset($_POST['payjp_token'])? htmlspecialchars($_POST['payjp_token'],ENT_QUOTES,'utf-8'):'';

    session_start();
    $products = isset($_SESSION['products'])? $_SESSION['products']:[];
    $total = isset($_SESSION['total_price'])? $_SESSION['total_price']:0;

    $currency = 'jpy';

    $res = \Payjp\Charge::create(array(
            "card" => $payjp_token,
            "amount" => (int)$total,
            "currency" => "jpy"
    ));
    if($res['error']){
        $result = '決済処理に失敗しました。';
        $result_title = '決済失敗';
    }else{
        $result = 'ご購入ありがとうございます。';
        $result_title = '購入完了';
    }

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    //ordersテーブル
    $stmt1 = $dbh->prepare("INSERT INTO orders(name,email,tel,postcode,address,total,created_at,updated_at) VALUES(:name,:email,:tel,:postcode,:address,:total,now(),now())");
    $stmt1->bindParam(':name',$name);
    $stmt1->bindParam(':email',$email);
    $stmt1->bindParam(':tel',$tel);
    $stmt1->bindParam(':postcode',$postcode);
    $stmt1->bindParam(':address',$address);
    $stmt1->bindParam(':total',$total);
    $stmt1->execute();

    //ordersのid取得
    $order_id = $dbh->lastInsertId();

    //order_productsテーブル
    foreach($products as $key => $product){
        $stmt2 = $dbh->prepare("INSERT INTO order_products(order_id,product_name,num,price) VALUES(:order_id,:product_name,:num,:price)");
        $stmt2->bindParam(':order_id',$order_id);
        $stmt2->bindParam(':product_name',$key);
        $stmt2->bindParam(':num',$product['count']);
        $stmt2->bindParam(':price',$product['price']);
        $stmt2->execute();
    }
    unset($_SESSION['products']);
    unset($_SESSION['total_price']);
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

        <title><?php echo $result_title; ?>｜SQUARE, inc.</title>
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
                        <li><?php echo $result_title; ?></li>
                    </ul>
                </div>
            </div>
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3><?php echo $result_title; ?></h3>
                    </div>
                    <div class="wrapper-body">
                        <div class="thanks">
                            <h4><?php echo $result; ?></h4>
                        </div>
                        <button type="button" class="btn btn-gray" onclick="location.href='index.php'">トップページに戻る</button>
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