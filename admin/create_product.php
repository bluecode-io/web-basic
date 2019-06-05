<?php
    session_start();

    if($_SESSION['admin_login'] == false){
        header("Location:./index.html");
        exit;
    }

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>商品登録</title>

        <link rel="icon" href="favicon.ico">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- css -->
        <link rel="stylesheet" href="styles.css">
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
                        <h3>新規作成</h3>
                    </div>
                    <form class="edit-form" method="POST" action="store_product.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <p>商品名</p>
                            <input type="text" name="product_name" required>
                        </div>
                        <div class="form-group">
                            <p>説明文</p>
                            <input type="text" name="text" maxlength="8">
                        </div>
                        <div class="form-group">
                            <p>単価</p>
                            <input type="text" name="price" required>
                        </div>
                        <div class="form-group">
                            <p>アイテム画像</p>
                            <input type="file" name="img" class="imgform">
                        </div>
                        <button type="submit" class="btn btn-blue">登録</button>
                    </form>
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