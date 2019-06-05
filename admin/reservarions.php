<?php
    session_start();

    if($_SESSION['admin_login'] == false){
        header("Location:./index.html");
        exit;
    }

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    $stmt = $dbh->prepare("SELECT * FROM reservations");
    $stmt->execute();
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>記事管理</title>

        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- css -->
        <link rel="stylesheet" href="./styles.css">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="header-logo">
                    <h1><a href="dashboard.php">管理画面</a></h1>
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
                        <h3>記事管理</h3>
                    </div>
                    <button type="button" class="btn btn-blue" onclick="location.href='create_news.php'">投稿する</button>
                    <div class="list">
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>予約日時</th>
                                    <th>予約者名</th>
                                    <th>電話番号</th>
                                    <th>メールアドレス</th>
                                    <th>予約人数</th>
                                    <th>更新日時</th>
                                    <th>作成日時</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reservations as $reservation): ?>
                                <tr>
                                    <td><?php echo $reservation['id']; ?></td>
                                    <td><?php echo $reservation['reserve_date']; ?></td>
                                    <td><?php echo $reservation['name']; ?></td>
                                    <td><?php echo $reservation['tel']; ?></td>
                                    <td><?php echo $reservation['email']; ?></td>
                                    <td><?php echo $reservation['number']; ?></td>
                                    <td><?php echo $reservation['updated_at']; ?></td>
                                    <td><?php echo $reservation['created_at']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <div class="container">
                <p>Copyright @ 2018 SQUARE, inc</p>
            </div>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(".delete").click(function(){
                var id = this.dataset.id;
                if(confirm("ID:"+id+"番の記事を本当に削除していいですか？")){
                    //OK
                    $("#delete_form_"+id).submit();
                }else{
                    //キャンセル
                    return false;
                }
            })
        </script>
    </body>
</html>