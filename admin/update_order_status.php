<?php
    session_start();

    //ログインチェック
    if($_SESSION['admin_login'] == false){
        header("Location:./index.html");
        exit;
    }

    //id受け取り
    $id = isset($_GET['id'])? htmlspecialchars($_GET['id'], ENT_QUOTES, 'utf-8'):'';

    //idなかったらorders.phpにリダイレクト
    if($id==''){
        header('location:./orders.php');
    }

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    //update
    $stmt = $dbh->prepare("UPDATE orders SET order_status = 1 WHERE id=:id");
    $stmt->bindParam(":id",$id);
    $stmt->execute();

    header('location:./orders.php');