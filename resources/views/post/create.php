<form action="/post/store" method="post" >
    <div class="mb-3">
        <label for="author" class="form-label">Auteur</label>
        <input type="text" class="form-control" id="author" name="author" >
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title" >
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea  id="description" name="description" class="form-control" rows="3" required="required"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
