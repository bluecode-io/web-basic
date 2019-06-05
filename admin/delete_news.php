<?php
    session_start();

    if($_SESSION['admin_login'] == false){
        header("Location:./index.php");
        exit;
    }

    $id = isset($_POST['id'])? htmlspecialchars($_POST['id'], ENT_QUOTES, 'utf-8'):'';

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }
        
    $stmt = $dbh->prepare("DELETE FROM news WHERE id=:id");
    $stmt->bindParam(":id",$id);
    $stmt->execute();
        
    header('location:./news.php');