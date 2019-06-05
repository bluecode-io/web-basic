<?php
    session_start();
    $user_login = isset($_SESSION['user_login'])? $_SESSION['user_login']:false;

    require 'vendor/autoload.php';
    use Carbon\Carbon;

    $m = (isset($_GET['m']))? htmlspecialchars($_GET['m'], ENT_QUOTES, 'utf-8') : '';
    $y = (isset($_GET['y']))? htmlspecialchars($_GET['y'], ENT_QUOTES, 'utf-8') : '';
    if($m!=''||$y!=''){
        $dt = Carbon::createFromDate($y,$m,01);
    }else{
        $dt = Carbon::createFromDate();
    }
    
    function renderCalendar($dt)
    {   
        $dt->startOfMonth(); //今月の最初の日
        $dt->timezone = 'Asia/Tokyo'; //日本時刻で表示

        //１ヶ月前
        $sub = Carbon::createFromDate($dt->year,$dt->month,$dt->day);
        $subMonth = $sub->subMonth();
        $subY = $subMonth->year;
        $subM = $subMonth->month;

        //1ヶ月後
        $add = Carbon::createFromDate($dt->year,$dt->month,$dt->day);
        $addMonth = $add->addMonth();
        $addY = $addMonth->year;
        $addM = $addMonth->month; 

        //今月
        $today = Carbon::createFromDate();
        $todayY = $today->year;
        $todayM = $today->month;

        //リンク
        $title = '<h4>'.$dt->format('F Y').'</h4>';//月と年を表示
        $title .= '<div class="month"><caption><a class="left" href="./calendar.php?y='.$todayY.'&&m='.$todayM.'">今月　</a>';
        $title .= '<a class="left" href="./calendar.php?y='.$subY.'&&m='.$subM.'"><<前月 </a>';//前月のリンク
        $title .= '<a class="right" href="./calendar.php?y='.$addY.'&&m='.$addM.'"> 来月>></a></caption></div>';//来月リンク
        
        //曜日の配列作成
        $headings = ['月','火','水','木','金','土','日'];
    
        $calendar = '<table class="calendar-table">';
        $calendar .= '<thead >';
        foreach($headings as $heading){
            $calendar .= '<th class="header">'.$heading.'</th>';
        }
        $calendar .= '</thead>';
        $calendar .= '<tbody><tr>';


        //今月は何日まであるか
        $daysInMonth = $dt->daysInMonth;
        
        for ($i = 1; $i <= $daysInMonth; $i++) {
            if($i==1){
                if ($dt->format('N')!= 1) {
                    $calendar .= '<td colspan="'.($dt->format('N')-1).'"></td>'; //1日が月曜じゃない場合はcospanでその分あける
                }
            }

            if($dt->format('N') == 1){
                $calendar .= '</tr><tr>'; //月曜日だったら改行
            }
            $comp = new Carbon($dt->year."-".$dt->month."-".$dt->day); //ループで表示している日
           $comp_now = Carbon::today(); //今日

           //ループの日と今日を比較
           if ($comp->eq($comp_now)) {
               //同じなので緑色の背景にする
               $calendar .= '<td class="day" style="background-color:#008b8b;">'.$dt->day.'</td>';
           }else{
                switch ($dt->format('N')) {
                    case 6:
                        $calendar .= '<td class="day" style="background-color:#b0e0e6">'.$dt->day.'</td>';
                        break;
                    case 7:
                        $calendar .= '<td class="day" style="background-color:#f08080">'.$dt->day.'</td>';
                        break;
                    default:
                        $calendar .= '<td class="day" >'.$dt->day.'</td>';
                        break;
                }
            }
            $dt->addDay();
        }

        $calendar .= '</tr></tbody>';
        $calendar .= '</table>';

        return $title.$calendar;
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

        <title>無料ご相談会予約｜SQUARE, inc.</title>
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
            <div class="breadcrumbs">
                <div class="container">
                    <ul>
                        <li><a href="index.php">TOP</a></li>
                        <li>無料ご相談会予約</li>
                    </ul>
                </div>
            </div>
            <div class="wrapper last-wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>無料ご相談会予約</h3>
                    </div>
                    <?php echo renderCalendar($dt); ?>
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