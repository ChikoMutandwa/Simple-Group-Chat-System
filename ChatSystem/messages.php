<?php
    include('config.php');

    switch ($_REQUEST['action']) {
        case 'sendMessage':
            // echo 'sending response back php';
            // global $db;

            session_start();
            $query = $db->prepare("INSERT INTO messages SET user=?, message=?");
            $run = $query->execute([$_SESSION['username'], $_REQUEST['message']]);

            if ($run) {
              echo 1;
              exit;  
            }
        break;
        case 'getMessage':
            // echo 'working';

            $query = $db->prepare("SELECT * FROM messages");
            $run = $query->execute();

            $result = $query->fetchALL(PDO::FETCH_OBJ);
            // echo var_dump($result);

            // collecting every single message one by one 
            $chat = '';
            foreach ($result as $message) {
                // $chat .= $message->message.'<br/>';
                
                $chat .= '<div class="single-message">
                            <strong>From: </strong>'.$message->user.'<br/> 
                            <strong>Message: </strong>'.$message->message.'<br/> 
                            <span>'.date('d-m-Y h:i a', strtotime($message->date)).'</span>
                        </div>';
            }
            echo $chat;
        break;
    }
?>