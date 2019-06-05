<?php
    //sessionでログイン制限
    session_start();

    if($_SESSION['admin_login'] == false){
        header("Location:./index.html");
        exit;
    }

    //PHPMailerソースを読み込む
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    require '../PHPMailer/src/POP3.php';
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/OAuth.php';
    require '../PHPMailer/language/phpmailer.lang-ja.php';

    //使う
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $title = isset($_POST['title'])? htmlspecialchars($_POST['title']):'';
    $content = isset($_POST['content'])? htmlspecialchars($_POST['content']):'';
    $content = nl2br($content);

    //送信設定
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0; //デバックモード 0にすると表示されない 
    $mail->isSMTP();
    $mail->Host='smtp.mailtrap.io';
    $mail->SMTPAuth= true;
    $mail->Username = 'xxxxxxxxx';
    $mail->Password = 'xxxxxxxx';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;
    $mail->Charset = 'utf-8';
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8'; //文字化け防止

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    $stmt = $dbh->prepare("SELECT * FROM users WHERE dm=1");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    try{
        foreach($users as $user){
            $mail->setFrom('<送信者のメールアドレス>','test');
            $mail->addAddress($user['email'],$user['name']);
            $mail->Subject = mb_encode_mimeheader($title,'ISO-2022-JP');
            $mail->Body = $user['name']."さま<br>".$content;
            $mail->send();
        }
        $result = 'メルマガ送信完了しました。';
    }catch(Exception $e){
        $result = '送信できませんでした。';
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>メルマガ配信</title>

        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- css -->
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="header-logo">
                    <h1><a href="dashboard.html">管理画面</a></h1>
                </div>

                <nav class="menu-right menu">
                    <a href="logout.php">ログアウト</a>
                </nav>
            </div>
        </header>
        <main>
            <div class="wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3><?php echo $result; ?></h3>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="container">
                <p>Copyright @ 2018 SQUARE, inc</p>
            </div>
        </footer>
    </body>
</html>