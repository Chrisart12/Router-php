<div style="margin-top:30px">
    <div class="card">
        <div class="card-header">
            <?= $post->author;?>
            <div style="font-size: 0.7em"><?= formateDate($post->created_at);?></div> 
        </div>
        <div class="card-body">
            <h5 class="card-title"><?= $post->title;?></h5>
            <p class="card-text"><?= $post->description;?></p>
            <a href="/post/<?= $post->id ?>/edit" class="btn btn-info" role="button">Modifier</a>
        </div>
    </div>
</div>
