<br>
<?php if (isset($_SESSION['success'])) {?>
    <div class="alert alert-success form-signin"><?php echo $_SESSION['success']?></div>
<?php }?>
<?php if (isset($_SESSION['error'])) {?>
    <div class="alert alert-danger form-signin"><?php echo $_SESSION['error']?></div>
<?php }?>
<?php echo validation_errors('<div class="alert alert-danger form-signin">', '</div>'); ?>
<?php echo form_open(base_url().'auth/login/', ['class'=>'form-signin']); ?>
    <h4 class="form-signin-heading">Авторизация</h4>
    <label for="inputEmail" class="sr-only">Введите Email</label>
    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Введите Email" required autofocus>
    <label for="inputPassword" class="sr-only">Введите пароль</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Введите пароль" required>
    <div class="text-right"><p><a href="/auth/register">Регистрация</a></p></div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Войти</button>
</form>