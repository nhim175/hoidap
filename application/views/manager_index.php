<div class="top-full">
<?php
echo '<h1 class="title" id="title">'.$this->session->userdata('name').'</h1>';
echo anchor('thuky/logout', 'Log out!', 'title="Log out"');
?>
<input type="hidden" id="manager" value="<?php echo $this->session->userdata('userid') ?>"/>
</div>
<div class="left-col">
    <div id="question-tbl">
        <div id="adviser1-tbl" class="adviser-tbl block left">
            <p class="title-bar"><?php echo $adviser1->name?></p>
            <?php 
            foreach($adviser1_questions as $question) {
                $date = strtotime($question->date);
                $now = time();
                $sec_diff = $now - $date;
                $min_diff = floor($sec_diff/60)+420;
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
                $min_diff = floor($sec_diff/60)+420;
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
                $min_diff = floor($sec_diff/60)+420;
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
            $min_diff = floor($sec_diff/60)+420;
            
            echo '<tr><td><p class="question" id="question'.$question->id.'">'.$question->id.' - '.$question->content.'<span class="minutes"> - '.$min_diff.' phút trước</span>'.'</p></td></tr>';
            
        }
        ?>
            </table>    
        </div>
    </div><!--#question-list-->
    <div>
        <textarea id="question-txt"></textarea>
    </div>
</div><!--.left-col-->
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
var managerID = $('#manager').val();
$('p.question').live('click', function() {
    var questionID = $(this).attr('id').match(/\d+/)[0];
    if($(this).hasClass('solved')) {
        $(this).removeClass('solved');
        //ajax code set status of question to 1
        //1 = unsolved, 2=solved, 3=removed
        $.post('<?php echo base_url() ?>index.php/manager/unsolve', {question : questionID});
    } else {
        $(this).addClass('solved');
        //ajax code set status of question to 2
        $.post('<?php echo base_url() ?>index.php/manager/solve', {question : questionID});
    }
});
$('#question-txt').bind('keydown', function(e) {
    if(e.keyCode==13) {
        //ajax function to upload question
        e.preventDefault();
        var txtQuestion = $(this).val();
        $.post('<?php echo base_url() ?>index.php/manager/upload_question', {question: txtQuestion});
        $(this).val('');
    }
});
setInterval(function() {
    $.post('<?php echo base_url() ?>index.php/manager/ajax_load',{}, function(data) {
        $('#question-tbl').html(data);
    });
    $.post('<?php echo base_url() ?>index.php/manager/ajax_chat',{}, function(data) {
        $('#chat-screen').html(data);
    });
},1000);
$('div.chat-screen').scrollTop(500);
$('#chat-input').bind('keydown', function(e) {
    if(e.keyCode==13) {
        //ajax function to upload question
        e.preventDefault();
        var txtChat = $(this).val();
        $.post('<?php echo base_url() ?>index.php/manager/insert_chat', {content: txtChat, managerID: managerID});
        $(this).val('');
    }
});
</script>
