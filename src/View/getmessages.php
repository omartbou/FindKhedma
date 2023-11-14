<?php
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
if(isset($_SESSION['role'])&&($_SESSION['role']==='manager'||$_SESSION['role']==='searcher')) {

$data = new MessagesController();
$messages = $data->receiveMessages();

foreach ($messages as $message) {
    if ($message['sender_id'] == $_SESSION['id']) {
        echo '<div class="message-container-sender">';

        // This message was sent by the current user
        echo '<span class="sender">' . $_SESSION['fname'] . ': </span>';
        echo '<span class="message-text sender-message">' . $message['message'] . '</span>';
        echo '</div>';

    }

else {
    echo '<div class="message-container-receiver">';

    if ($_SESSION['role'] === 'manager') {
            // This message was received by the current user (manager)
            echo '<span class="receiver">' . $message['fname'] . ': </span>';
            echo '<span class="message-text receiver-message">' . $message['message'] . '</span>';
        } else {
            // This message was received by the current user (non-manager)
            echo '<span class="receiver">' . $message['company_name'] . ': </span>';
            echo '<span class="message-text receiver-message">' . $message['message'] . '</span>';
        }
    echo '</div>';
    }

}
?>


<style>
    .message-container-sender {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #1d1919;
        background-color: #f7f7f7;
        position: relative;
        left:70%;
        width: 30%;
        border-radius:30px ;

    }
    .message-container-receiver {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #1d1919;
        background-color: #f7f7f7;
        width: 30%;
        border-radius:30px ;

    }

    .sender {
        font-weight: bold;
        margin-right: 5px;
    }
    .receiver {
        color:red;
        font-weight: bold;
        margin-right: 5px;
    }

    .message-text {
        font-size: 16px;

    }
</style>
<?php } } else Redirect::to('login'); ?>