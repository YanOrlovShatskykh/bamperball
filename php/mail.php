<?php
    session_start();
    require_once '../db/db.php';

    if(isset($_POST['order'])) {
        $username = $_POST['username'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $connect->query("INSERT INTO `order` (`username`, `email`, `phone`) VALUES ('$username', '$email', '$tel')");
        $lastId = $connect->query("SELECT MAX(id) FROM `order`")->fetch(PDO::FETCH_ASSOC);
        $lastId = $lastId['MAX(id)'];

        foreach ($_SESSION['cart'] as $key => $product) {
            $prod = $connect->query("SELECT * FROM products WHERE id='$key'")->fetch(PDO::FETCH_ASSOC);
            $price = $product['price'] * $product['quantity'];
            $connect->query("INSERT INTO `goods` (`title`, `rus_name`, `price`, `total_price`, `quantity`, `id_of_good`, `buyer`) VALUES ('{$prod['title']}', '{$prod['rus_name']}', '{$prod['price']}', '$price', '{$_SESSION['cart'][$product['id']]['quantity']}', '{$product['id']}', '$username')");
            $lastIdGoods = $connect->query("SELECT MAX(id) FROM `goods`")->fetch(PDO::FETCH_ASSOC);
            $lastIdGoods = $lastIdGoods['MAX(id)'];
            $connect->query("UPDATE `goods` SET `id_of_order` = '$lastId' WHERE id='$lastIdGoods'");
        }

        $message = "<h2>Здравствуйте $username, Ваш заказ под номером $lastId принят.</h2>";
        $message .= "<h3>Состав заказа:</h3>";

        foreach ($_SESSION['cart'] as $product) {
            $message .= "<p>{$product['rus_name']}, в количестве {$product['quantity']} шт.</p>";
        }

        $message .= "<p>Сумма заказа: {$_SESSION['totalPrice']} гривен.</p>";
        $subject = "Ваш заказ под номером $lastId принят.";

//        create email message for admin
        $admSubject = "Поступил новый заказ под номером $lastId.";
        $admMessage = "<h2>Здравствуйте, поступил новый заказ под номером $lastId.</h2>";
        $admMessage .= "<h3>Состав заказа:</h3>";

        foreach ($_SESSION['cart'] as $product) {
            $admMessage .= "<p>{$product['rus_name']}, в количестве {$product['quantity']} шт.</p>";
        }

        $admMessage .= "<p>Сумма заказа: {$_SESSION['totalPrice']} гривен.</p>";
        $admMessage .= "<h3>Имя клиента - $username, номер телефона - $tel, почта - $email.</h3>";
        $admMessage .= "<h2>Номер заказа - $lastId.</h2>";
        $admEmail = "yan.orlov.shatskykh@gmail.com";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

//        send messages for user and admin
        mail($email, $subject, $message, $headers);
        mail($admEmail, $admSubject, $admMessage, $headers);

        unset($_SESSION['totalQuantity']);
        unset($_SESSION['totalPrice']);
        unset($_SESSION['cart']);
        $_SESSION['order'] = $lastId;
        header("Location: {$_SERVER['HTTP_REFERER']}");



        
// $data = $_POST['username'];
// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// echo $data;
    }