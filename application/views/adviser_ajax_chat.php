<?php 

foreach (array_reverse($chats) as $chat) {
    echo '<p><strong>'.$chat->name.': </strong>'.$chat->content.'</p>';
}
?>
<script>
$('div.chat-screen').scrollTop(500);
</script>