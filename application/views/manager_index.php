<div class="top-full">
<?php
echo '<h1 class="title" id="title">'.$this->session->userdata('name').'</h1>';
echo anchor('thuky/logout', 'Log out!', 'title="Log out"');
?>
<input type="hidden" id="manager" value="<?php echo $this->session->userdata('userid') ?>"/>
</div>
<div class="left-col">
    <div>
        
        <textarea id="question-txt"></textarea>
    </div>
    <div id="question-tbl">
        <?php $this->load->view('manager_ajax_index', $data)?>
    </div><!--#question-list-->
    
</div><!--.left-col-->
<div id="adviser-list">
    <div class="inner">
        <p id="adviser1" class="adviser-option">Chuyên gia thủy sản</p>
        <p id="adviser2" class="adviser-option">Chuyên gia trồng trọt</p>
        <p id="adviser3" class="adviser-option">Chuyên gia chăn nuôi</p>
    </div>
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
var managerID = $('#manager').val();
var txtQuestion = '';
var adviserChoice = null;
$('a.done').live('click', function() {
    var questionID = $(this).parent().attr('id').match(/\d+/)[0];
    $.post('<?php echo base_url() ?>index.php/manager/solve', {question : questionID});
});
$('#question-txt').bind('keydown', function(e) {
    if(e.keyCode==13) {
        //ajax function to upload question
        e.preventDefault();
        txtQuestion = $(this).val();
		$('#adviser-list').hide().fadeIn('slow');
        //$.post('<?php echo base_url() ?>index.php/manager/upload_question', {question: txtQuestion});
        //$(this).val('');
    }
});
$('.adviser-option').live('click', function() {
    adviserChoice = $(this).attr('id').match(/\d+/)[0];
    $.post('<?php echo base_url() ?>index.php/manager/upload_question', {question: txtQuestion, adviserChoice: adviserChoice});
    $('#adviser-list').fadeOut('slow');
    $('#question-txt').val('');
});
setInterval(function() {
    $.post('<?php echo base_url() ?>index.php/manager/ajax_load',{}, function(data) {
        $('#question-tbl').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/manager/ajax_chat/1',{}, function(data) {
        $('#chat-screen').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/manager/ajax_chat/2',{}, function(data) {
        $('#chat-screen2').html(data);
    });
},1000);
$('div.chat-screen').scrollTop(500);
$('#chat-input').bind('keydown', function(e) {
    if(e.keyCode==13) {
        //ajax function to upload question
        e.preventDefault();
        var txtChat = $(this).val();
        $.post('<?php echo base_url() ?>index.php/manager/insert_chat', {content: txtChat, managerID: managerID, box: 1});
        $(this).val('');
    }
});
$('#chat-input2').bind('keydown', function(e) {
    if(e.keyCode==13) {
        //ajax function to upload question
        e.preventDefault();
        var txtChat = $(this).val();
        $.post('<?php echo base_url() ?>index.php/manager/insert_chat', {content: txtChat, managerID: managerID, box: 2});
        $(this).val('');
    }
});
$('#delete-q').live('click', function(e) {
    e.preventDefault();
    var questionID = $(this).parent().attr('id').match(/\d+/)[0];
    $.post('<?php echo base_url() ?>index.php/manager/remove', {question : questionID});
});
</script>
