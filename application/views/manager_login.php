<div class="center login-form">
    <div class="inner-left">
        <div class="inner-right">
            <h1 class="form-title manager-icon">Manager</h1>
            <?php 
            echo form_open('thuky/login');
            echo form_label('Username', 'username');
            echo form_input($username_input);
            echo form_label('Password', 'password');
            echo form_password($password_input);
            echo br();
            echo form_submit(array('class' => 'btn'), 'Đăng nhập');
            echo form_close();
            ?>
        </div>
    </div>
</div>
