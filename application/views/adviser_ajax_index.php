    <div id="adviser1-tbl" class="adviser-tbl block left">
        <p class="title-bar">Câu hỏi đã chọn<?php //echo $this->session->userdata('username')?></p>
        <?php 
        foreach($adviser_questions as $question) {
            $date = strtotime($question->date);
            $now = time();
            $sec_diff = $now - $date;
            $min_diff = floor($sec_diff/60)+360;
            echo '<p class="chosen question';
            if($question->later==1) {
                echo ' later';
            }
            echo ' adviser'.$question->adviser.'" id="question'.$question->id.'">'.$question->id.'. '.$question->content.'<span class="minutes"> - '.$min_diff.'p trước</span> - <a class="undo" href="#">Chọn lại</a>'.'</p>';
        }
        ?>
    </div>
    <div class="question-tbl adviser-q">
        <div id="advquestion-list" class="block left">
            <p><strong>Danh sách câu hỏi</strong></p>
            <table>
        <?php
        foreach($unchosen_questions_arr as $question) {
            $date = strtotime($question->date);
            $now = time();
            $sec_diff = $now - $date;
            $min_diff = floor($sec_diff/60)+360;        
            echo '<tr><td><p class="question" id="question'.$question->id.'">'.$question->id.'. '.$question->content.'<span class="minutes"> - '.$min_diff.'p trước</span>'.'</p></td><td class="buttons"><input class="next" type="button" value="Sau"/><input class="later" type="button" value="Ít phút"/><input class="now" type="button" value="Chọn"/></td></tr>';
            
        }
        ?>
            </table>    
        </div>
        <div id="advquestion-next" class="block left">
            <p><strong>Câu hỏi để lại lần sau</strong></p>
            <?php
            foreach($next_questions as $question) {
                $date = strtotime($question->date);
                $now = time();
                $sec_diff = $now - $date;
                $min_diff = floor($sec_diff/60)+360;            
                echo '<p class="question" id="question'.$question->id.'">'.$question->id.'. '.$question->content.'<span class="minutes"> - '.$min_diff.'p trước</span>'.'</p>';
                
            }
            ?>
        </div>
    </div>