

<form action="<?= APP_URL ?>/doNoteCategories/<?= isset($category) ? 'editCategory' : 'addCategory' ?>" method="post" autocomplete="off">
    
    <?= Helper::captcha_get(); ?>
     
    <div class="form-group">
        <label for="name" class="required"><?= _l('Name'); ?></label>
        <input type="text" name="name" class="form-control required" autocomplete="nope" value="<?= isset($category) ? $category['name'] : '' ?>" />
    </div>
    
    <div class="form-group">
        <label for="description"><?= _l('Description') ?></label>
        <textarea name="description" class="form-control"><?= isset($category) ? $category['description'] : ''?></textarea>
    </div>
    
    <input type="hidden" name="redirect_url" value="<?= APP_URL ?>/note-categories" />
    <input type="hidden" name="id_note_category" value="<?= isset($category) ? $category['id'] : ''?>" />
    
    <a href="<?= APP_URL ?>/note-categories" class="btn btn-default">
        <i class="fa fa-arrow-left" aria-hidden="true"></i> <?= _l('Back') ?>
    </a>
    
    <button class="btn btn-success">
        <?php if( isset($category) ): ?>
        <i class="fa fa-floppy-o" aria-hidden="true"></i> <?= _l('Save') ?>
        <?php else: ?>
        <i class="fa fa-plus" aria-hidden="true"></i> <?= _l( 'Create' ) ?>
        <?php endif; ?>
    </button>
    
</form>