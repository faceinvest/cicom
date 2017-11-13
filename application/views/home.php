<br>
<div class="card">
    <div class="card-block">
        <div class="text-left text-muted">
            <h4>Список пользователей: </h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <? foreach($users as $user) : ?>
                    <p><a href="/users/profile/<?=$user->id?>"><?=$user->name?></a></p>
                    <hr>
                <? endforeach; ?>
            </div>
        </div>

    </div>
</div>