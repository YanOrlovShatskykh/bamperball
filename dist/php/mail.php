<?php
        if(isset($_POST['sendedOrder'])) {
                $sendedOrder = $_POST['sendedOrder'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $comment = $_POST['comment'];
                $admSubject = "Надійшло нове замовлення!";
                $admMessage = "<h2>Вітаю! Надійшло нове замовлення.</h2>";
                $admMessage .= "<h3>$sendedOrder.</h3>";
                $admMessage .= "<h3>Ім'я замовника - $username, номер телефону - <a href='tel:$phone'>$phone</a>, email - $email.</h3>";
                $admMessage .= "<h3>Коментар від замовника: $comment</h3>";
                $admEmail = "ukrainekava@gmail.com";
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $headers .= 'From: bumperball@new-project2.zzz.com.ua' . "\r\n";
                mail($admEmail, $admSubject, $admMessage, $headers);
                $token = "1228077523:AAFfhn0Fh-dP8lu037gvQ9DclQcd7OZ4CzM";
                $chat_id = "-391821362";
                $arr = array(
                        'Заказана услуга:' => $sendedOrder,
                        'Имя пользователя: ' => $username,
                        'Телефон: ' => $phone,
                        'Email:' => $email,
                        'Комментарий:' => $comment
                );
                foreach($arr as $key => $value) {
                        $txt .= "<b>".$key."</b> ".$value."%0A";
                };
                $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
        }                