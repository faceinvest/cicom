

<input type="hidden" id="<?= $this->security->get_csrf_token_name(); ?>" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

<br>

<?php $this->load->view('template/t_new_comment'); ?>

<div class="card">
    <div class="card-block">
        <div class="comments">
            <ul class="media-list" id="comments">
                <?= $comments ?>
            </ul>
        </div>
        <button type="button" class="btn btn-light btn-block all_comments" id="" data-id="comments">Все комментарии <i class="fa fa-angle-double-down" aria-hidden="true"></i></button>
    </div>
</div>