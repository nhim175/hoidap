<?php 

foreach (array_reverse($chats) as $chat) {
    echo '<p><strong>'.$chat->nickname.': </strong>'.$chat->content.'</p>';
}
?>
<script>
$('div.chat-screen').scrollTop(500);
</script>