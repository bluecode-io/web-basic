<?php
    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login']:false;
    
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    $stmt = $dbh->prepare("SELECT * FROM news ORDER BY id DESC LIMIT 5");
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

        <title>SQUARE, inc.</title>
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
            <!-- top画像 -->
            <div class="top-img">
                <div class="container">
                    <div class="top-text">
                        <h2>THE BEST SERVICE</h2>
                        <h2>TO YOU.</h2>
                    </div>
                </div>
            </div>
            <!-- end top画像 -->

            <!-- end top画像 -->

            <!-- お知らせ -->
            <div class="wrapper" id="news">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>NEWS</h3>
                        <p>お知らせ</p>
                    </div>
                    <div class="news-list">
                        <?php foreach($news as $new): ?>
                        <ul>
                            <li><a href="page.php?id=<?php echo $new['id']; ?>"><?php echo $new['updated_at']; ?> <?php echo $new['title']; ?></a></li>
                        </ul>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- end お知らせ -->

            <!-- サービス一覧 -->
            <div class="wrapper" id="service">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>SERVICE</h3>
                        <p>サービス</p>
                    </div>
                    <div class="boxs">
                        <div class="box">
                            <img src="img/serviceimg-1.png">
                            <h4 class="service-title">ITコンサルティング</h4>
                        </div>
                        <div class="box">
                            <img src="img/serviceimg-2.png">
                            <h4 class="service-title">ソフトウェア開発</h4>
                        </div>
                    </div>
                    <div class="boxs">
                        <div class="box">
                            <img src="img/serviceimg-3.png">
                            <h4 class="service-title">WEBデザイン</h4>
                        </div>
                        <div class="box">
                            <img src="img/serviceimg-4.png">
                            <h4 class="service-title">動画制作</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end サービス一覧 -->

            <!-- 会社概要 -->
            <div class="wrapper" id="about">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>ABOUT US</h3>
                        <p>会社概要</p>
                    </div>
                    <table class="about-table">
                        <tbody>
                            <tr>
                                <th>会社名</th>
                                <td>SQUARE, inc.</td>
                            </tr>
                            <tr>
                                <th>代表者名</th>
                                <td>四角 太郎</td>
                            </tr>
                            <tr>
                                <th>所在地</th>
                                <td>
                                    <p>〒100-0005</p>
                                    <p>東京都千代田区丸の内1-1 SQUAREビル5階</p>
                                </td>
                            </tr>
                            <tr>
                                <th>アクセス</th>
                                <td><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.925086816978!2d139.75987771566892!3d35.67884653770935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188bf0a5c4c4f5%3A0xf7aa802c1d56e295!2z44CSMTAwLTAwMDUg5p2x5Lqs6YO95Y2D5Luj55Sw5Yy65Li444Gu5YaF77yS5LiB55uu77yR4oiS77yR!5e0!3m2!1sja!2sjp!4v1554886389817!5m2!1sja!2sjp" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end 会社概要 -->

            <!-- お問合せ -->
            <div class="wrapper last-wrapper" id="contact">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>CONTACT</h3>
                        <p>お問い合わせ</p>
                    </div>
                    <form method="POST" action="confirm.php">
                        <div class="form-group">
                            <p>お名前 *</p>
                            <input type="text" name="name">                     
                        </div>
                        <div class="form-group">
                            <p>Email *</p>
                            <input type="email" name="email">
                        </div>
                        <div class="form-group">
                            <p>お問合せ内容 *</p>
                            <textarea name="text"></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit">内容を確認する</button>
                    </form>
                </div>
            </div>
            <!-- end お問合せ -->

            <!-- SNS -->
            <div class="wrapper last-wrapper" id="sns">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>SOCIAL</h3>
                        <p>ソーシャルメディア</p>
                    </div>
                            
                    <div class="sns">
                        <a class="twitter-timeline" href="https://twitter.com/TwitterDev/timelines/539487832448843776?ref_src=twsrc%5Etfw">National Park Tweets - Curated tweets by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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