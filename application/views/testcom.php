<li class="media">
    <div class="comment" id="comment_'$id'">
        <div class="media-body">
            <h4><b><?=$comment->theme_name?>: <?=$comment->title?></b></h4>
            <strong><a href="/users/profile/<?=$comment->user_id?>" id="user_com_<?=$comment->id?>"><?=$comment->name?></a></strong>
            <span class="text-muted">
                                <small class="text-muted"><?=date("d.m.Y  H:i:s", strtotime($comment->date))?></small>
                <? if ($comment->user_id == $this->session->userdata('id')) : ?>
                    <button class="btn btn-link btn-sm" id="delete_<?=$comment->id?>">Удалить</button>
                <? endif; ?>
                            </span>
            <p id="t_<?=$comment->id?>"><?=$comment->text?></p>
            <button id="reply_<?=$comment->id?>" class="btn btn-info btn-sm">Ответить</button>
            <button id="quote_<?=$comment->id?>" class="btn btn-info btn-sm">Цитировать</button>
            <!-- Вывод блока комментировать комментарий-->
            <div id="add_comment_<?=$comment->id?>" style='display: none;'> <!-- id = box -->
                <?if($this->session->userdata('is_logged_in')) :?>
                    <div class="form-group">
                        <p><textarea class="form-control wysiwyg" id="text_<?=$comment->id?>" placeholder="Оставьте Ваш комментарий" rows="6"></textarea></p>
                    </div>
                    <button class="btn btn-info pull-right btn-sm" id="send_comment_<?=$comment->id?>">Отправить</button>
                <?else:?>
                    <p><a href="/auth/login/">Войдите</a> или <a href="/auth/register/">зарегистрируйтесь</a>, чтобы оставлять комментарии</p>
                <?endif;?>
                <button class="btn btn-danger pull-right btn-sm" id="cancel_comment_<?=$comment->id?>">Отмена</button>
            </div>
        </div>
    </div>
    <!-- Вывод дочерних комментариев-->
    <ul class="media-list" id="comments_<?=$comment->id?>">
        <?if(isset($comment->subComments)):?>
            <?foreach ($comment->subComments as $subComment) :?>
                <li class="media">
                    <div class="comment" id="comment_<?=$subComment->id?>">
                        <div class="media-body">
                            <strong><a href="/users/profile/<?=$subComment->user_id?>" id="user_com_<?=$subComment->id?>"><?=$subComment->name?></a></strong>
                            <span class="text-muted">
                                            <small class="text-muted"><?=date("d.m.Y  H:i:s", strtotime($subComment->date))?></small>
                                <? if ($subComment->user_id == $this->session->userdata('id')) : ?>
                                    <button class="btn-link btn-sm" id="delete_<?=$subComment->id?>">Удалить</button>
                                <? endif; ?>
                                    </span>
                            <p id="t_<?=$subComment->id?>"><?=$subComment->text?></p>
                            <button id="reply_<?=$subComment->id?>" class="btn btn-link btn-sm">Ответить</button>
                            <button id="quote_<?=$subComment->id?>" class="btn btn-link btn-sm">Цитировать</button>
                            <div id="add_comment_<?=$subComment->id?>" style='display: none;'> <!-- id = box -->
                                <?if($this->session->userdata('is_logged_in')) :?>
                                    <div class="form-group">
                                        <p><textarea class="form-control wysiwyg" id="text_<?=$subComment->id?>" placeholder="Оставьте Ваш комментарий" rows="6"></textarea></p>
                                    </div>
                                    <button class="btn btn-info pull-right btn-sm" id="send_comment_<?=$subComment->id?>">Отправить</button>
                                <?else:?>
                                    <p><a href="/auth/login/">Войдите</a> или <a href="/auth/register/">зарегистрируйтесь</a>, чтобы оставлять комментарии</p>
                                <?endif;?>
                                <button class="btn btn-danger pull-right btn-sm" id="cancel_comment_<?=$subComment->id?>">Отмена</button>
                            </div>
                        </div>
                    </div>
                </li>
            <?endforeach;?>
        <?endif;?>
    </ul>
</li>