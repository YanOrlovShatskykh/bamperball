<?php

        if(isset($_POST['sendedOrder'])) {

                $sendedOrder = $_POST['sendedOrder'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $comment = $_POST['comment'];


                // $data = $_POST;
                
                

//        create email message for admin
                $admSubject = "Надійшло нове замовлення!";
                $admMessage = "<h2>Вітаю! Надійшло нове замовлення.</h2>";
                $admMessage .= "<h3>$sendedOrder</h3>";
                $admMessage .= "<h3>Ім'я замовника - $username, номер телефону - $phone, email - $email.</h3>";
                $admEmail = "yan.orlov.shatskykh@gmail.com";
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                
                //        send messages for user and admin
                mail($admEmail, $admSubject, $admMessage, $headers);
                
                
                // echo json_encode($admMessage, JSON_UNESCAPED_UNICODE);
                
        
// $data = $_POST['username'];
// echo json_encode($data, JSON_UNESCAPED_UNICODE);
// echo $data;
        }