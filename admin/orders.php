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
    $stmt = $dbh->prepare("SELECT * FROM orders");
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>受注管理</title>

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
                        <h3>受注管理</h3>
                    </div>
                    <div class="list">
                        <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>氏名</th>
                                <th>電話番号</th>
                                <th>合計金額</th>
                                <th>注文日時</th>
                                <th>更新日時</th>
                                <th>注文ステータス</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $order): ?>
                            <tr>
                                <td><?php echo $order['id']; ?></td>
                                <td><?php echo $order['name']; ?></td>
                                <td><?php echo $order['tel']; ?></td>
                                <td><?php echo $order['total']; ?></td>
                                <td><?php echo $order['created_at']; ?></td>
                                <td><?php echo $order['updated_at']; ?></td>
                                <td>
                                    <?php if($order['order_status']==0): ?>
                                    　　　<button type="button" class="btn btn-red">受付中</button>
                                    <?php else: ?>
                                    　　　<button type="button" class="btn btn-blue">発送済</a></button>
                                    <?php endif;?>
                                </td>
                                <td>
                                   <button type="button" class="btn btn-green" onclick="location.href='order_products.php?id=<?php echo $order['id']; ?>'">詳細</button>
                                </td>
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
    </body>
</html>