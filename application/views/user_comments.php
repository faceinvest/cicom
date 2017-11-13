<br>
<?php if (isset($comments)) : ?>
    <input type="hidden" id="<?= $this->security->get_csrf_token_name(); ?>" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <?php foreach ($comments as $comment) : ?>
        <div class="card" id="comment">
            <div class="card-block">
                <div class="comment" id="<?=$comment->id?>">
                    <div class="media-body">
                        <span>
                            <b><?=$comment->title?></b>
                            <button class="btn btn-danger pull-right btn-sm delete" id="<?=$comment->id?>" data-id="<?=$comment->parent_id?>">Удалить</button><br>
                        </span>
                        <span class="text-muted">
                            <small class="text-muted"><?=date("d.m.Y  H:i:s", strtotime($comment->date))?> </small>
                        </span>
                        <p><?=$comment->text?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="card">
        <div class="card-block">
            <p>Комментариев нет</p>
        </div>
    </div>
<?php endif; ?>
