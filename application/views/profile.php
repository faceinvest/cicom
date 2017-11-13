<input type="hidden" id="<?= $this->security->get_csrf_token_name(); ?>" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

<br>
<div class="card">
    <div class="card-block">
        <?php if (isset($profile)) : ?>
            <div class="row">
                <div class="col-md-3">
                    <p><b>Логин: </b></p>
                    <p><b>Дата регистрации: </b></p>
                    <p><b>Email: </b></p>
                </div>
                <div class="col-md-9">
                    <p><?=$profile->login?></p>
                    <p><?=date("d.m.Y  H:i:s", strtotime($profile->date))?></p>
                    <p><?=$profile->email?></p>
                </div>
            </div>
        <?php else : ?>
            <p>Такого пользователя нет</p>
        <?php endif; ?>
    </div>
</div>

<?if(!$this->uri->segment(3)) :?>
    <?php $this->load->view('template/t_new_comment'); ?>
<?endif?>

<div class="card">
    <div class="card-block">
        <? if (isset($comments)) : ?>
        <div class="comments">
            <ul class="media-list" id="comments">
                <?=$comments?>
            </ul>
        </div>
        <?php if ($count_comments > 5) : ?>
        <button type="button" class="btn btn-light btn-block all_comments" id="<?=$profile->id?>" data-id="users">Все комментарии <i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
        <? endif; ?>
        <? else : ?>
            <div>Комментариев нет</div>
        <? endif; ?>
    </div>
</div>