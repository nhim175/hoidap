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
    <div id="question-list" class="block left" style="width: 50%">
        <p><strong>Danh sách câu hỏi</strong></p>
        <table>
    <?php
    foreach($unchosen_questions_arr as $question) {
        $date = strtotime($question->date);
        $now = time();
        $sec_diff = $now - $date;
        $min_diff = floor($sec_diff/60)+360;
        
        echo '<tr><td><p class="unanswered-question" id="question'.$question->id.'">'.$question->id.'. '.$question->content.'<span class="minutes"> - '.$min_diff.' phút trước</span>'.'</p></td></tr>';
        
    }
    ?>
        </table>    
    </div>
    <div id="answered-questions" class="block left">
        <p><strong>Các câu hỏi đã trả lời</strong></p>
        <ol>
    <?php
    foreach($answered_questions as $question) {
        $date = strtotime($question->date);
        $now = time();
        $sec_diff = $now - $date;
        $min_diff = floor($sec_diff/60)+360;
        
        echo '<li class="question" id="question'.$question->id.'">'.$question->content.'</li>';
        
    }
    ?>
        </ol>  
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