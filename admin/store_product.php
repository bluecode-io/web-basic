<?php

    //sessionでログイン制限
    session_start();

    if($_SESSION['admin_login'] == false){
        header("Location:./index.html");
        exit;
    }

    //値受け取り
    $product_name = isset($_POST['product_name'])? htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'utf-8'):'';
    $text = isset($_POST['text'])? htmlspecialchars($_POST['text'], ENT_QUOTES, 'utf-8'):'';
    $text = nl2br($text);
    $price = isset($_POST['price'])? htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8'):''; 

    if (is_uploaded_file($_FILES["img"]["tmp_name"])) {
        //HTTP POST OK;

        $file_name = date('YmdHis')."_".$_FILES["img"]["name"];
    
        if (pathinfo($file_name, PATHINFO_EXTENSION) == 'jpg' || pathinfo($file_name, PATHINFO_EXTENSION) == 'png') {
            //拡張子OK
            //元のアップロード先
            $file_tmp_name = $_FILES["img"]["tmp_name"];
            if (move_uploaded_file($file_tmp_name, "./products/" . $file_name)) {
                //アップロード完了
                //DB接続
                try{
                    $dbh = new PDO("mysql:host=localhost;dbname=corporate_db","root","root");
                }catch(PDOException $e){
                    var_dump($e->getMessage());
                    exit;
                }
                    
                $stmt = $dbh->prepare("INSERT INTO products(
                    product_name,
                    text,
                    price,
                    img_path,
                    created_at,
                    updated_at
                ) VALUES(
                    :product_name,
                    :text,
                    :price,
                    :img_path,
                    now(),
                    now()
                )");
                $stmt->bindParam(':product_name',$product_name);
                $stmt->bindParam(':text',$text);
                $stmt->bindParam(':price',$price);
                $stmt->bindParam(':img_path',$file_name);
                $stmt->execute();
                    
                header('location:./products.php');
            } else {
                echo "画像をアップロードできません。";
                exit;
            }
        } else {
            echo "ファイル形式はjpg/pngのみです";
            exit;
        }

    } else {
        echo "何らからの攻撃をうけました";
        exit;
    }