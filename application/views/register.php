<br>
<?php if (isset($_SESSION['success'])) {?>
    <div class="alert alert-success"><?php echo $_SESSION['success']?></div>
<?php }?>
<?php echo validation_errors('<div class="alert alert-danger form-signin">', '</div>'); ?>

<?php echo form_open(base_url().'auth/register/', ['class'=>'form-signin']); ?>
    <h4 class="form-signin-heading">Регистрация</h4>
    <label for="inputLogin" class="sr-only">Введите Логин</label>
    <input type="text" id="inputLogin" name="login" class="form-control" placeholder="Введите Логин" value="<?php echo set_value('login'); ?>" required autofocus>
    <label for="inputEmail" class="sr-only">Введите Email</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Введите Email" value="<?php echo set_value('email'); ?>" required>
    <label for="inputPassword" class="sr-only">Введите пароль</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Введите пароль" value="<?php echo set_value('password'); ?>" required>
    <label for="inputConfirmPassword" class="sr-only">Повторите пароль</label>
    <input type="password" id="inputConfirmPassword" name="passconf" class="form-control" placeholder="Повторите пароль" value="<?php echo set_value('passconf'); ?>" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Зарегистрироваться</button>
</form>