<div class="top-full">
<?php
echo '<h1 class="title" id="title">'.$this->session->userdata('username').'</h1>';
echo anchor('mc/logout', 'Log out!', 'title="Log out"');
?>
</div>
<div class="left-col" id="question-tbl">
    <?php $this->load->view('mc_ajax_index', $data) ?>
</div>
<div class="right-col">
    <div id="chat-panel">
        <div id="chat-box">
            <div class="inner">
                <div class="chat-screen" id="chat-screen">
                    <?php 
                
                    foreach (array_reverse($chats) as $chat) {
                        echo '<p><strong>'.$chat->nickname.': </strong>'.$chat->content.'</p>';
                    }
                    ?>
                </div>
                <div class="chat-input">
                    <textarea id="chat-input"></textarea>
                </div>
            </div>
        </div>
        <div id="chat-box2">
            <div class="inner">
                <div class="chat-screen" id="chat-screen2">
                <?php 
                
                foreach (array_reverse($chats2) as $chat) {
                    echo '<p><strong>'.$chat->nickname.': </strong>'.$chat->content.'</p>';
                }
                ?>
                    
                </div>
                <div class="chat-input">
                    <textarea id="chat-input2"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var mcID = 4;
$('a.done').live('click', function() {
    var questionID = $(this).parent().attr('id').match(/\d+/)[0];    
    //ajax code set status of question to 1
    //1 = unsolved, 2=solved, 3=removed
    $.post('<?php echo base_url() ?>index.php/mc/solve', {question : questionID});    
});
setInterval(function() {
    $.post('<?php echo base_url() ?>index.php/mc/ajax_load',{}, function(data) {
        $('#question-tbl').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/adviser/ajax_chat',{}, function(data) {
        $('#chat-screen').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/manager/ajax_chat/2',{}, function(data) {
        $('#chat-screen2').html(data);
    });
},1000);
$('#chat-input').bind('keydown', function(e) {
    if(e.keyCode==13) {
        //ajax function to upload question
        e.preventDefault();
        var txtChat = $(this).val();
        $.post('<?php echo base_url() ?>index.php/mc/insert_chat', {content: txtChat, mcID: mcID, box: 1});
        $(this).val('');
    }
});
$('#chat-input2').bind('keydown', function(e) {
    if(e.keyCode==13) {
        //ajax function to upload question
        e.preventDefault();
        var txtChat = $(this).val();
        $.post('<?php echo base_url() ?>index.php/mc/insert_chat', {content: txtChat, mcID: mcID, box: 2});
        $(this).val('');
    }
});
</script>
