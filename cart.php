<?php

    $delete_name = (isset($_POST['delete_name']))? htmlspecialchars($_POST['delete_name'], ENT_QUOTES, 'utf-8') : '';

    session_start();

    if($delete_name != '') unset($_SESSION['products'][$delete_name]);
    
    //合計の初期値は0
    $total = 0; 

    $products = isset($_SESSION['products'])? $_SESSION['products']:[];

    foreach($products as $name => $product){
        //各商品の小計を取得
        $subtotal = (int)$product['price']*(int)$product['count'];
        //各商品の小計を$totalに足す
        $total += $subtotal;
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

        <title>カート｜SQUARE, inc.</title>
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
                        <li>カート</li>
                    </ul>
                </div>
            </div>
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>MY CART</h3>
                        <p>カート</p>
                    </div>
                    <div class="cartlist">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>商品名</th>
                                    <th>価格</th>
                                    <th>個数</th>
                                    <th>小計</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($products as $name => $product): ?>
                                <tr>
                                    <td label="商品名："><?php echo $name; ?></td>
                                    <td label="価格：" class="text-right">¥<?php echo $product['price']; ?></td>
                                    <td label="個数：" class="text-right"><?php echo $product['count']; ?></td>
                                    <td label="小計：" class="text-right">¥<?php echo $product['price']*$product['count']; ?></td>
                                    <td>
                                        <form action="cart.php" method="post">
                                            <input type="hidden" name="delete_name" value="<?php echo $name; ?>">
                                            <button type="submit" class="btn btn-red">削除</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <tr class="total">
                                    <th colspan="3">合計</th>
                                    <td colspan="2">¥<?php echo $total; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="cart-btn">
                            <button type="button" class="btn btn-blue">購入手続きへ</button>
                            <button type="button" class="btn btn-gray">お買い物を続ける</button>
                        </div>
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