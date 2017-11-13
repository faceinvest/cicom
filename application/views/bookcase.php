<br>

    <?php if (isset($book)) : ?>
    <div class="card">
        <div class="card-block">
        <?echo $book;?>
        </div>
    </div>
    <? else : ?>
    <div class="card">
        <div class="card-block">
            <div class="text-danger">Записей в книге нет</div>
        </div>
    </div>
    <? endif; ?>


<div class="card">
    <div class="card-block">
    <form method="post" action="<?=base_url()?>bookcase/add_to_book">
        <input type="hidden" id="<?= $this->security->get_csrf_token_name(); ?>" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
        <p>Дописать в книгу: <textarea class="form-control" name="text" rows="5"></textarea>
                <input type="submit" value="Дописать в книгу"></p>
    </form>