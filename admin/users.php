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

    //ページング設定
    //1. 何件ずつ表示させるか（固定。今回は10件ずつ）
    $rows = 10; 

    //2. 現在表示しているページ数（GETで取得。初回など送られてこなければ1を設定する）
    $page = isset($_GET['page'])? $_GET['page'] : 1;  

    //3. 表示するページに応じたレコード取得開始位置（2ページ目は、10件目から表示なので、10*(2-1)で$offset=10）
    $offset = $rows * ($page-1);

    //4. 全件のレコード数。
    if($name == '')
    {
        //変数の割当が必要無いのでqueryで実行し、fetchColumn()で取得したcountを返す。
        $all_rows = $dbh->query("SELECT COUNT(*) FROM users")->fetchColumn();

    }else{
        //検索条件を考慮
        $all_rows_stmt = $dbh->prepare("SELECT * FROM users WHERE name like :name");
        $all_rows_stmt->bindValue(":name",'%'.$name.'%');
        $all_rows_stmt->execute();
        $all_rows = $all_rows_stmt->rowCount();
    }

    //5.  全件を10件ずつ表示させた場合のページ数。全件÷表示件数をして、0以下の場合は、ページ数は1に固定。
    if(($all_rows % $rows) <= 0){
        $pages = (int)($all_rows/$rows);
    }else{
        $pages = (int)($all_rows/$rows)+1;
    }

    //6.  次のページ数（基本的に現在ページ+1。現在ページ+1が全ページ数より大きくなってしまうとページが無いのでその場合は''とする）
    $next = ($page+1 > $pages)? '' : $page+1;

    //7.  一つ前のページ数（基本的に現在ページ-1。現在ページ-1が0になってしまうとページが無いのでその場合は''とする）
    $prev = ($page-1 <= 0)? '' : $page-1;
    //ページング設定終わり

    if($name == '')
    {
        $stmt = $dbh->prepare("SELECT * FROM users limit :offset,:rows");

    }else{
        $stmt = $dbh->prepare("SELECT * FROM users WHERE name like :name limit :offset,:rows");
        $stmt->bindValue(":name",'%'.$name.'%');     
    }

    $stmt->bindParam(":offset",$offset,PDO::PARAM_INT);
    $stmt->bindParam(":rows",$rows,PDO::PARAM_INT);
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
                    <button type="button" class="btn btn-gray" onclick="location.href='download.php'">CSV出力</button>
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
                        <ul class="paging">
                            <li><a href="./users.php?name=<?php echo $name; ?>">« 最初</a></li>
                            <?php if ($prev != ''): ?>
                                <li><a href="./users.php?page=<?php echo $prev; ?>&name=<?php echo $name; ?>"><?php echo $page-1; ?></a></li>
                            <?php endif; ?>
                            <li><span><?php echo $page; ?></span></li>
                            <?php if ($next != ''):  ?>
                                <li><a href="./users.php?page=<?php echo $next; ?>&name=<?php echo $name; ?>"><?php echo $page+1; ?></a></li>
                            <?php endif; ?>
                            <li><a href="./users.php?page=<?php echo $pages; ?>&name=<?php echo $name; ?>">最後 »</a></li>
                        </ul>
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