<?php
        if(isset($_POST['sendedOrder'])) {
                $sendedOrder = $_POST['sendedOrder'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $comment = $_POST['comment'];

                //create email message for admin
                $admSubject = "Надійшло нове замовлення!";
                $admMessage = "<h2>Вітаю! Надійшло нове замовлення.</h2>";
                $admMessage .= "<h3>$sendedOrder.</h3>";
                $admMessage .= "<h3>Ім'я замовника - $username, номер телефону - <a href='tel:$phone'>$phone</a>, email - $email.</h3>";
                $admMessage .= "<h3>Коментар від замовника: $comment</h3>";
                $admEmail = "ukrainekava@gmail.com";
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

                //from
                $headers .= 'From: bumperball@new-project2.zzz.com.ua' . "\r\n";
                
                //        send messages for user and admin
                mail($admEmail, $admSubject, $admMessage, $headers);
                
                // echo json_encode($admMessage, JSON_UNESCAPED_UNICODE);

                /* https://api.telegram.org/botXXXXXXXXXXXXXXXXXXXXXXX/getUpdates,
                где, XXXXXXXXXXXXXXXXXXXXXXX - токен вашего бота, полученный ранее */
                
                //в переменную $token нужно вставить токен, который нам прислал @botFather
                $token = "";
                
                //нужна вставить chat_id (Как получить chad id, читайте ниже)
                $chat_id = "";
                
                //Далее создаем переменную, в которую помещаем PHP массив
                $arr = array(
                        'Заказана услуга:' => $sendedOrder,
                        'Имя пользователя: ' => $username,
                        'Телефон: ' => $phone,
                        'Email:' => $email,
                        'Комментарий:' => $comment
                );
                
                //При помощи цикла перебираем массив и помещаем переменную $txt текст из массива $arr
                foreach($arr as $key => $value) {
                        $txt .= "<b>".$key."</b> ".$value."%0A";
                };
                
                //Осуществляется отправка данных в переменной $sendToTelegram
                $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
                
                //Если сообщение отправлено, напишет "Thank you", если нет - "Error"
                if ($sendToTelegram) {
                        echo "Thank you";
                } else {
                        echo "Error";
                }
        }                