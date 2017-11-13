<div class="comment" id="<?=$comment->id?>">
    <div class="media-body">
        <?if($comment->del_com == 1) : ?>
        <? if ($comment->title != '') : ?>
        <h4><b><?=$comment->theme_name?>: <?=$comment->title?></b></h4>
        <? endif; ?>
        <strong><a href="/users/profile/<?=$comment->user_id?>" id="user"><?=$comment->name?></a></strong>
        <small class="text-muted"><?=date("d.m.Y  H:i:s", strtotime($comment->date))?></small>
        <? if ($comment->user_id == $this->session->userdata('id')) : ?>
            <a href="" class="btn btn-link btn-sm delete" id="<?=$comment->id?>" data-id="<?=$comment->parent_id?>">Удалить</a>
        <? endif; ?>
        <div id="text"><?=$comment->text?></div>
        <? else : ?>
            <div class="text-danger">Комментарий удален</div>
        <? endif; ?>
        <?php if($this->session->userdata('is_logged_in')) :?>
            <a href="" id="<?=$comment->id?>" data-id="<?=$comment->parent_id?>" class="btn btn-link btn-sm reply">Ответить</a>
            <a href="" id="<?=$comment->id?>" data-id="<?=$comment->parent_id?>" class="btn btn-link btn-sm quote">Цитировать</a>
            <? if ($comment->parent_id == 0) : ?>
            <div id="add_comment" data-id="<?=$comment->id?>" style="display: none;"></div>
            <? else : ?>
            <div id="add_comment" data-id="<?=$comment->parent_id?>" style="display: none;"></div>
            <? endif; ?>
        <?endif;?>
    </div>
</div>