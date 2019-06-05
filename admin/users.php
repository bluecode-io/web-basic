<?php

    //sessionでログイン制限
    session_start();

    if($_SESSION['admin_login'] == false){
        header("Location:./index.html");
        exit;
    }

    $name = isset($_GET['name'])? htmlspecialchars($_GET['name'], ENT_QUOTES, 'utf-8'):'';

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    if($name == '')
    {
        $stmt = $dbh->prepare("SELECT * FROM users");

    }else{
        $stmt = $dbh->prepare("SELECT * FROM users WHERE name like :name");
        $stmt->bindValue(":name",'%'.$name.'%');     
    }

    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>会員管理</title>

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
                    <a href="index.html">ログアウト</a>
                </nav>
            </div>
        </header>
        <main>
            <div class="wrapper">
                <div class="container">
                    <div class="wrapper-title">
                        <h3>会員管理</h3>
                    </div>
                    <form class="serch" action="users.php" method="GET">
                        <input type="text" name="name" placeholder="名前検索">
                        <button type="submit" class="btn btn-blue">検索</button>
                    </form>
                    <div class="list">
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>名前</th>
                                    <th>メールアドレス</th>
                                    <th>DM配信</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td>
                                        <?php if($user['dm']=='0'): ?>
                                        -
                                        <?php else: ?>
                                        受信する
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-green">編集</button>
                                        <button type="button" class="btn btn-red">削除</button>
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
    </body>
</html>