<div class="card">
    <div class="card-block">
        <div class="text-left text-muted">
            <h4>Добавить комментарий: </h4>
        </div>
        <?php if($this->session->userdata('is_logged_in')) :?>
            <label>Заголовок: </label>
            <input type="text" class="form-control" name="new_title" id="new_title" placeholder="Заголовок комментария">
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
                <textarea class="form-control wysiwyg" name="text" id="new_text" placeholder="Оставьте Ваш комментарий" rows="3"></textarea>
            </div>
            <button class="btn btn-info pull-right btn-sm" id="new_send_comment">Отправить</button>
            <br><br>
            <hr>
        <?else:?>
            <p><a href="/auth/login">Войдите</a> или <a href="/auth/register">зарегистрируйтесь</a>, чтобы оставлять комментарии</p>
            <hr>
        <?endif;?>
    </div>
</div>