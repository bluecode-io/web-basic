<?php

    //sessionでログイン制限
    session_start();

    if($_SESSION['admin_login'] == false){
        header("Location:./index.html");
        exit;
    }

    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    $stmt = $dbh->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $fp = fopen('./users.csv','w');

    //BOMあり
    fwrite($fp, "\xEF\xBB\xBF");

    $header = ['ID','名前','メールアドレス','パスワード','住所','DM配信','登録日時','更新日時'];
    fputcsv($fp,$header);

    foreach($users as $user){
        fputcsv($fp,$user);
    }

    fclose($fp);

    header('Location:./users.csv');