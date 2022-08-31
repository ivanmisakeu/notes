
<form action="<?= APP_URL ?>/doNotes/<?= isset($note) ? 'editNote' : 'addNewNote' ?>" method="post" autocomplete="off" id="note-submit-form">
    
    <?= Helper::captcha_get(); ?>
     
    <div class="form-group">
        <label for="title" class="required"><?= _l('Title'); ?></label>
        <input type="text" name="title" class="form-control required" autocomplete="nope" value="<?= isset($note['name']) ? $note['name'] : '' ?>" />
    </div>
    
    <div class="form-group">
        <label for="id_note_category"><?= _l('Category') ?></label>
        <select name="id_note_category" size="1" class="form-control">
            <?php foreach( NoteCategories::_getAll( true, NoteCategories::TABLE_NAME, 'name ASC') as $category ): ?>
                <option value="<?= $category['id'] ?>" <?php if(isset($note['id_note_category']) && $category['id'] == $note['id_note_category']): ?>checked="checked"<?php endif; ?>><?= $category['name'] ?>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div id="quill-editor" class="m-b-md">
        <?php Template::render('@includes/quill-toolbar'); ?>
        <div id="quill-editor-container" onChange="_copy_note_content();"><?= isset($note['content']) ? $note['content'] : '' ?></div>
    </div>
    
    <button class="btn btn-success pull-right">
        <i class="fa fa-plus" aria-hidden="true"></i> <?= _l( 'Create' ) ?>
    </button>
    
    <div class="clearfix"></div>
    
    <textarea name="content" type="hidden" class="hidden"><?= isset($note['content']) ? $note['content'] : '' ?></textarea>
    <input name="note-redirect-url" type="hidden" value="<?= isset($note['id']) ? (APP_URL . '/notes/edit/' . $note['id']) : 'NEW'  ?>" />
    <input type="hidden" name="id_note" value="<?= isset($note['id']) ? $note['id'] : '' ?>" />
    
</form>
