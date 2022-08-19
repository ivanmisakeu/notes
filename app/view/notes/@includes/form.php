
<form action="<?= APP_URL ?>/doUser/addNewUser" method="post" autocomplete="off">
    
    <?= Helper::captcha_get(); ?>
     
    <div class="form-group">
        <label for="title" class="required"><?= _l('Title'); ?></label>
        <input type="text" name="title" class="form-control required" autocomplete="nope" />
    </div>
    
    <div id="quill-editor" class="m-b-md">
        <?php Template::render('@includes/quill-toolbar'); ?>
        <div id="quill-editor-container"></div>
    </div>
    
    <button class="btn btn-success pull-right">
        <i class="fa fa-plus" aria-hidden="true"></i> <?= _l( 'Create' ) ?>
    </button>
    
    <div class="clearfix"></div>
    
</form>