<?php

    $name = (isset($_POST['name']))? htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8') : '';
    $price = (isset($_POST['price']))? htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8') : '';
    $count = (isset($_POST['count']))? htmlspecialchars($_POST['count'], ENT_QUOTES, 'utf-8') : '';
    
    session_start();

    //もし、sessionにproductsがあったら
    if(isset($_SESSION['products'])){  
        //$_SESSION['products']を$productsという変数にいれる
        $products = $_SESSION['products']; 
        //$proeuctsをforeachで回し、キー(商品名)と値（金額・個数）取得
        foreach($products as $key => $product){  
            //もし、キーとPOSTで受け取った商品名が一致したら、
            if($key == $name){ 
                //既に商品がカートに入っているので、個数を足し算する     
                $count = (int)$count + (int)$product['count'];
            }
        }
    }  
    //配列に入れるには、$name,$count,$priceの値が取得できていることが前提なのでif文で空のデータを排除する
    if($name!=''&&$count!=''&&$price!=''){
        $_SESSION['products'][$name]=[
            'count' => $count,
            'price' => $price
        ];
    }
    $products = isset($_SESSION['products'])? $_SESSION['products']:[];

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

        <title>商品一覧｜SQUARE, inc.</title>
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
                        <li>商品一覧</li>
                    </ul>
                </div>
            </div>
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>SHOP</h3>
                        <p>商品一覧</p>
                    </div>
                    <div class="itemlist">
                        <ul>
                            <li>
                                <img src="products/banana.jpg" >
                                <div class="item-body">
                                    <h5>バナナ</h5>
                                    <p>¥500</p>
                                    <form action="shop.php" method="POST" class="item-form">
                                        <input type="hidden" name="name" value="バナナ">
                                        <input type="hidden" name="price" value="500">
                                        <input type="text" value="1" name="count">
                                        <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
                                    </form>
                                </div><!-- end item-body--> 
                            </li>
                            <li>
                                <img src="products/cucumber.jpg" >
                                <div class="item-body">
                                    <h5>きゅうり</h5>
                                    <p>¥100</p>
                                    <form action="shop.php" method="POST" class="item-form">
                                        <input type="hidden" name="name" value="きゅうり">
                                        <input type="hidden" name="price" value="100">
                                        <input type="text" value="1" name="count">
                                        <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
                                    </form>
                                </div><!-- end item-body--> 
                            </li>
                            <li>
                                <img src="products/onion.jpg" >
                                <div class="item-body">
                                    <h5>玉ねぎ</h5>
                                    <p>¥200</p>
                                    <form action="shop.php" method="POST" class="item-form">
                                        <input type="hidden" name="name" value="玉ねぎ">
                                        <input type="hidden" name="price" value="200">
                                        <input type="text" value="1" name="count">
                                        <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
                                    </form>
                                </div><!-- end item-body--> 
                            </li>
                            <li>
                                <img src="products/tomato.jpg" >
                                <div class="item-body">
                                    <h5>トマト</h5>
                                    <p>¥150</p>
                                    <form action="shop.php" method="POST" class="item-form">
                                        <input type="hidden" name="name" value="トマト">
                                        <input type="hidden" name="price" value="150">
                                        <input type="text" value="1" name="count">
                                        <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
                                    </form>    
                                </div><!-- end item-body--> 
                            </li>
                        </ul>
                    </div><!-- end itemlist -->
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