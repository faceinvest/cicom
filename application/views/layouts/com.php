<?php
function get_comment($row)
{

}
?>

<ul id="comments">
    <? foreach ($comments as $comment) : ?>
        <li class="coment">
            <div class="author"><?=$comment->author?></div>
            <div class="text"><?=$comment->text>?></div>
            <a href="#comment_from" class="reply" id=".$comment->id.">Ответить</a>
        </li>
    <? endforeach; ?>
</ul>