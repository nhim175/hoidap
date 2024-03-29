<div class="top-full">
<?php
echo '<h1 class="title" id="title">'.$this->session->userdata('username').'</h1>';
echo anchor('adviser/logout', 'Log out!', 'title="Log out"');
?>
<input type="hidden" id="adviser" value="<?php echo $this->session->userdata['userid']?>" />
</div>
<div class="left-col" id="question-tbl">
    <?php $this->load->view('adviser_ajax_index', $data)?>
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
    </div>
</div>
<script type="text/javascript">
var adviserID = $('#adviser').val();
var adviser = 'adviser'+adviserID;
$('input.now').live('click', function() {
    var questionID = $(this).parent().parent().find('p.question').attr('id').match(/\d+/)[0];
    attach(adviserID, questionID);
    answerNow(questionID);
});
$('a.undo').live('click', function() {
    var questionID = $(this).parent().attr('id').match(/\d+/)[0];
    deattach(adviserID, questionID);   
});
$('input.later').live('click', function() {
    var tr = $(this).parent().parent();
    var p = tr.find('p.question');
    var questionID = p.attr('id').match(/\d+/)[0];
    attach(adviserID, questionID);
    answerLater(questionID);
});
$('input.next').live('click', function() {
    var questionID = $(this).parent().parent().find('p.question').attr('id').match(/\d+/)[0];
    answerNext(questionID);
});
function attach(adviserID, questionID) {
    $.post('<?php echo base_url() ?>index.php/adviser/choose_question', {adviser: adviserID, question: questionID});
}
function deattach(adviserID, questionID) {
    $.post('<?php echo base_url() ?>index.php/adviser/unchoose_question', {adviser: adviserID, question: questionID});
}
function answerLater(questionID) {
    $.post('<?php echo base_url() ?>index.php/adviser/answer_later', {question: questionID});
}
function answerNow(questionID) {
    $.post('<?php echo base_url() ?>index.php/adviser/answer_now', {question: questionID});
}
function answerNext(questionID) {
    $.post('<?php echo base_url() ?>index.php/adviser/answer_next', {question: questionID});
}
setInterval(function() {
    $.post('<?php echo base_url() ?>index.php/adviser/ajax_load',{}, function(data) {
        $('#question-tbl').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/adviser/ajax_chat',{}, function(data) {
        $('#chat-screen').html(data);
    });
},1000);
$('#chat-input').bind('keydown', function(e) {
    if(e.keyCode==13) {
        //ajax function to upload question
        e.preventDefault();
        var txtChat = $(this).val();
        $.post('<?php echo base_url() ?>index.php/adviser/insert_chat', {content: txtChat, adviserID: adviserID});
        $(this).val('');
    }
});
</script>
