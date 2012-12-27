<div class="top-full">
<?php
echo '<h1 class="title" id="title">'.$this->session->userdata('username').'</h1>';
echo anchor('adviser/logout', 'Log out!', 'title="Log out"');
?>
<input type="hidden" id="adviser" value="<?php echo $this->session->userdata['userid']?>" />
</div>
<div class="left-col" id="question-tbl">
    <div id="adviser1-tbl" class="adviser-tbl block left">
        <p class="title-bar"><?php echo $adviser1->name?></p>
        <?php 
        foreach($adviser1_questions as $question) {
            $date = strtotime($question->date);
            $now = time();
            $sec_diff = $now - $date;
            $min_diff = floor($sec_diff/60)+360;
            echo '<p class="chosen question';
            if($question->later==1) {
                echo ' later';
            }
            echo ' adviser'.$question->adviser.'" id="question'.$question->id.'">'.$question->content.'<span class="minutes"> - '.$min_diff.' phút trước</span>'.'</p>';
        }
        ?>
    </div>
    <div id="adviser2-tbl" class="adviser-tbl block left">
        <p class="title-bar"><?php echo $adviser2->name?></p>
        <?php 
        foreach($adviser2_questions as $question) {
            $date = strtotime($question->date);
            $now = time();
            $sec_diff = $now - $date;
            $min_diff = floor($sec_diff/60)+360;
            echo '<p class="chosen question';
            if($question->later==1) {
                echo ' later';
            }
            echo ' adviser'.$question->adviser.'" id="question'.$question->id.'">'.$question->content.'<span class="minutes"> - '.$min_diff.' phút trước</span>'.'</p>';
        }
        ?>
    </div>
    <div id="adviser3-tbl" class="adviser-tbl block left">
        <p class="title-bar"><?php echo $adviser3->name?></p>
        <?php 
        foreach($adviser3_questions as $question) {
            $date = strtotime($question->date);
            $now = time();
            $sec_diff = $now - $date;
            $min_diff = floor($sec_diff/60)+360;
            echo '<p class="chosen question';
            if($question->later==1) {
                echo ' later';
            }
            echo ' adviser'.$question->adviser.'" id="question'.$question->id.'">'.$question->content.'<span class="minutes"> - '.$min_diff.' phút trước</span>'.'</p>';
        }
        ?>
    </div>
    <div id="question-list" class="block left">
        <p><strong>Danh sách câu hỏi</strong></p>
        <table>
    <?php
    foreach($unchosen_questions_arr as $question) {
        $date = strtotime($question->date);
        $now = time();
        $sec_diff = $now - $date;
        $min_diff = floor($sec_diff/60)+360;        
        echo '<tr><td><p class="question" id="question'.$question->id.'">'.$question->id.' - '.$question->content.'<span class="minutes"> - '.$min_diff.' phút trước</span>'.'</p></td><td class="buttons"><input class="next" type="button" value="Sau"/><input class="later" type="button" value="Ít phút"/><input class="now" type="button" value="Chọn"/></td></tr>';
        
    }
    ?>
        </table>    
    </div>
    <div id="question-next" class="block left">
        <p><strong>Câu hỏi để lại lần sau</strong></p>
        <table>
        <?php
        foreach($next_questions as $question) {
            $date = strtotime($question->date);
            $now = time();
            $sec_diff = $now - $date;
            $min_diff = floor($sec_diff/60)+360;            
            echo '<tr><td><p class="question" id="question'.$question->id.'">'.$question->id.' - '.$question->content.'<span class="minutes"> - '.$min_diff.' phút trước</span>'.'</p></td></tr>';
            
        }
        ?>
        </table> 
    </div>
</div>
<div class="right-col">
    <div id="chat-box">
        <div class="inner">
            <div class="chat-screen" id="chat-screen">
            <?php 
            
            foreach (array_reverse($chats) as $chat) {
                echo '<p><strong>'.$chat->name.': </strong>'.$chat->content.'</p>';
            }
            ?>
                
            </div>
            <div class="chat-input">
                <textarea id="chat-input"></textarea>
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
$('p.chosen').live('click', function() {
    if($(this).hasClass(adviser)) {
        var questionID = $(this).attr('id').match(/\d+/)[0];
        $(this).removeClass(adviser);
        deattach(adviserID, questionID);
    } else{
        return false;
    }
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
$('div.chat-screen').scrollTop(500);
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
