<br>
<!--Добавление новых комментариев-->
<div class="card">
    <div class="card-block">
        <div class="text-left text-muted">
            <h4>Добавить комментарий: </h4>
        </div>

        <?php if($this->session->userdata('is_logged_in')) :?>
            <input type="hidden" id="<?= $this->security->get_csrf_token_name(); ?>" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            <label>Заголовок: </label>
            <input type="text" class="form-control" name="title" id="title_0" placeholder="Заголовок комментария">
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
                <textarea class="form-control wysiwyg" name="text" id="text_0" placeholder="Оставьте Ваш комментарий" rows="3"></textarea>
            </div>
            <button class="btn btn-info pull-right btn-sm" id="send_comment_">Отправить</button>
            <br><br>
            <hr>
        <?else:?>
            <p><a href="/auth/login">Войдите</a> или <a href="/auth/register">зарегистрируйтесь</a>, чтобы оставлять комментарии</p>
            <hr>
        <?endif;?>
    </div>
</div>

<!--Вывод комментариев-->
<div class="card">
    <div class="card-block">
        <div class="text-left text-muted">
            <h4>Комментариев: </h4>
        </div>
        <div class="comments">
            <ul class="media-list" id="comments_0">
                <?foreach ($comments as $comment) :?>
                <li class="media">
                    <div class="comment" id="comment_<?=$comment->id?>">
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
                <?endforeach;?>
            </ul>
        </div>
        <button type="button" class="btn btn-light btn-block" id="all_comments">Все комментарии <i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
    </div>
</div>