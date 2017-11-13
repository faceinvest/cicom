<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Комментарии пользователей</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php base_url();?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php base_url();?>/assets/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php base_url();?>/assets/signin.css" rel="stylesheet">
    <link href="<?php base_url();?>/assets/css/main.css" rel="stylesheet">
    <link href="<?php base_url();?>/assets/plugins/summernote/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php base_url();?>/assets/font-awesome/css/font-awesome.min.css">
    <script src="<?php base_url();?>/assets/js/jquery.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header col-md-3 text-center">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand col-md-3 col-sm-6" href="/">CiCom</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li ><a href="/">Главная </a></li>
                <li ><a href="/comments">Комментарии</a></li>
                <li ><a href="/plane">Самолеты</a></li>
                <li ><a href="/bookcase">Книжный шкаф</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($this->session->userdata('is_logged_in')) { ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <b><?=$this->session->userdata('login')?></b>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="/users/profile">Профайл</a></li>
                            <li><a class="dropdown-item" href="/users/comments">Комментарии</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="dropdown-item" href="/auth/logout">Выход</a> </li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="/auth/login">Авторизация</a>
                    </li>
                <?php } ?>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<main role="main" class="container">
    <?php $this->load->view($content)?>
</main><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php base_url();?>/assets/js/popper.min.js"></script>
<script src="<?php base_url();?>/assets/js/bootstrap.min.js"></script>
<script src="<?php base_url();?>/assets/plugins/summernote/summernote.js"></script>
<script src="<?php base_url();?>/assets/js/main.js"></script>

</body>
</html>