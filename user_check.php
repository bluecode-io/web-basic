<?php

    $email = (isset($_POST['email']))? htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8') : '';
    $password = (isset($_POST['password']))? htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8'): '';

    if($email==''|$password==''){
        header('location:./login.php');
    }

    //DB接続
    try{
        $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
    }catch(PDOException $e){
        var_dump($e->getMessage());
        exit;
    }

    $stmt = $dbh->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':password',$password);
    $stmt->execute();
    $count = $stmt->rowCount();

    if($count==0){
        header('location:./login.php');
    }else{
        //ログインOK
        //ユーザー情報は$usersに配列で格納
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //session開始
        session_start();
        $_SESSION['user_login']=true;
        $_SESSION['user_id']=$users[0]['id'];
        $_SESSION['user_name']=$users[0]['name'];

        //リダイレクト
        header("Location:./index.php");
    }
?>