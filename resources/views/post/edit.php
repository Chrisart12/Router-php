<form action="/post/<?= $post->id ?>/update" method="post" >
    <input type="hidden" class="form-control" name="id" value="<?= htmlentities($post->id ) ?>" >
    <div class="mb-3">
        <label for="author" class="form-label">Auteur</label>
        <input type="text" class="form-control" id="author" name="author" value="<?= htmlentities($post->author) ?>" >
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= htmlentities($post->title); ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea  id="description" name="description" class="form-control"  required="required"><?= htmlentities($post->description); ?> </textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
