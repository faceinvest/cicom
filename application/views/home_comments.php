<br>
<div class="card">
    <div class="card-block">
        <div class="text-left text-muted">
            <h6>
                Комментарии:
            </h6>
        </div>
        <?php if($this->session->userdata('is_logged_in')) :?>
            <input type="hidden" id="<?= $this->security->get_csrf_token_name(); ?>" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            <label>Заголовок: </label>
            <input type="text" class="form-control" name="title" id="title_" placeholder="Заголовок комментария">
            <label>Выберите тему: </label>
            <select class="form-control" name="theme_id" id="theme_id">
                <? if(isset($themes)) :?>
                    <? foreach ($themes as $theme) :?>
                        <option value="<?=$theme->id?>"><?=$theme->theme_name?></option>
                    <? endforeach; ?>
                <? endif; ?>
            </select>
            <div class="form-group">
                <label>Комментарий:</label>
                <textarea class="form-control" name="text" id="text_" placeholder="Оставьте Ваш комментарий" rows="3"></textarea>
            </div>
            <button class="btn btn-info pull-right btn-sm" id="send_comment_">Отправить</button>
            <br><br>
            <hr>
        <?else:?>
            <p><a href="/auth/login">Войдите</a> или <a href="/auth/register">зарегистрируйтесь</a>, чтобы оставлять комментарии</p>
            <hr>
        <?endif;?>
        <br>

        <div class="comments">
            <ul class="media-list" id="comments_">
                <?foreach ($comments as $comment) :?>
                <li class="media">
                    <div class="comment" id="comment_<?=$comment->id?>">
                        <div class="media-body">
                            <span>
                                <b><?=$comment->theme_name?>: <?=$comment->title?></b><br>
                            </span>
                            <a href="/users/profile/<?=$comment->user_id?>"><strong><?=$comment->name?></strong></a>
                            <span class="text-muted">
                                <small class="text-muted"><?=date("d.m.Y  H:i:s", strtotime($comment->date))?></small>
                                <? if ($comment->user_id == $this->session->userdata('id')) : ?>
                                <button class="btn-link btn-sm" id="delete_<?=$comment->id?>">Удалить</button>
                                <? endif; ?>
                            </span>
                            <p><?=$comment->text?></p>
                            <button id="reply_<?=$comment->id?>" class=" btn-link">Ответить</button> <!--id = slideComment-->
                            <div id="add_comment_<?=$comment->id?>" style='display: none;'> <!-- id = box -->
                                <?if($this->session->userdata('is_logged_in')) :?>
                                    <input type="text" class="form-control" name="title" id="title_<?=$comment->id?>" placeholder="Заголовок комментария"><br>
                                    <div class="form-group">
                                        <textarea class="form-control" id="text_<?=$comment->id?>" placeholder="Оставьте Ваш комментарий" rows="2"><?=$comment->name?></textarea>
                                    </div>
                                    <button class="btn btn-info pull-right btn-sm" id="send_comment_<?=$comment->id?>">Отправить</button>
                                <?else:?>
                                    <p><a href="/auth/login/">Войдите</a> или <a href="/auth/register/">зарегистрируйтесь</a>, чтобы оставлять комментарии</p>
                                <?endif;?>
                                <button class="btn btn-danger pull-right btn-sm" id="cancel_comment_<?=$comment->id?>">Отмена</button>
                            </div>
                        </div>
                    </div>
                    <ul class="media-list" id="comments_<?=$comment->id?>">
                    <?if(isset($comment->subComments)):?>
                        <?foreach ($comment->subComments as $subComment) :?>
                            <li class="media">
                                <div class="comment" id="comment_<?=$subComment->id?>">
                                    <div class="media-body">
                                         <span>
                                            <b><?=$subComment->title?></b><br>
                                        </span>
                                        <a href="/users/profile/<?=$subComment->user_id?>"><strong><?=$subComment->name?></strong></a>
                                        <span class="text-muted">
                                            <small class="text-muted"><?=date("d.m.Y  H:i:s", strtotime($subComment->date))?></small>
                                            <? if ($subComment->user_id == $this->session->userdata('id')) : ?>
                                                <button class="btn-link btn-sm" id="delete_<?=$subComment->id?>">Удалить</button>
                                            <? endif; ?>
                                        </span>
                                        <p>
                                            <?=$subComment->text?>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        <?endforeach;?>
                    <?endif;?>
                    </ul>
                </li>
                <?endforeach;?>
            </ul>
        </div>
    </div>
</div>