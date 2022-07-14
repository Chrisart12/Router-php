
<div style="margin-top:30px">
<div style="margin-bottom: 20px"><a href="/post/create" class="btn btn-primary">Ajouter un post</a></div>
    <?php 
        foreach ($posts as $post) {
    ?>
        <div class="card">
                <div class="card-header">
                        <?= $post->author;?>
                        <div style="font-size: 0.7em"><?= formateDate($post->created_at);?></div> 
                        
                </div>
                <div  class="card-body">
                        <h5 class="card-title"><?= $post->title;?></h5>
                        <!-- cutString($post->description, 0, 100) -->
                        <p class="card-text"><?= cutString($post->description, 0, 150);?></p>
                        <div style="display:flex;">
                        <a href="/post/<?= $post->id; ?>" class="btn btn-primary" style="margin-right: 10px;">Détail</a>
                        <a href="/post/<?= $post->id; ?>/edit" class="btn btn-success" style="margin-right: 10px;">Editer</a>
                        <form action="/post/<?= $post->id;?>/destroy" method="post">
                            <input type="hidden" class="form-control" name="id" value="<?= htmlentities($post->id ) ?>" >
                            <a onclick="this.closest('form').submit();return false;" class="btn btn-danger">Efface</a>
                        </form>
                        </div>
                        
                        
                </div>
        </div>
    <?php
        } 
    ?>
</div>
    

