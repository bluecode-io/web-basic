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

    $stmt = $dbh->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>商品管理</title>

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
                        <h3>商品管理</h3>
                    </div>
                    <button type="button" class="btn btn-blue" onclick="location.href='create_news.php'">投稿する</button>
                    <div class="list">
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>商品名</th>
                                    <th>説明文</th>
                                    <th>単価</th>
                                    <th>画像パス</th>
                                    <th>更新日時</th>
                                    <th>作成日時</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td><?php echo $product['product_name']; ?></td>
                                    <td><?php echo $product['text']; ?></td>
                                    <td><?php echo $product['price']; ?></td>
                                    <td><?php echo $product['img_path']; ?></td>
                                    <td><?php echo $product['updated_at']; ?></td>
                                    <td><?php echo $product['created_at']; ?></td>
                                    <td>
                                        <button class="btn btn-green">編集</button>
                                        <button class="btn btn-red" >削除</button>
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