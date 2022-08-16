
<?php if( User::$CURRENT_USER ): ?>
    <?php Template::render('@includes/new-note-btn'); ?>
<?php endif ?>

<?php Helper::flash_show(); ?>

<script src="<?= APP_URL ?>/resources/js/jquery-2.2.4.min.js"></script>

<script src="//cdn.quilljs.com/1.2.3/quill.core.js"></script>
<script src="//cdn.quilljs.com/1.2.3/quill.js"></script>
<script src="//cdn.quilljs.com/1.2.3/quill.min.js"></script>

<script src="<?= APP_URL ?>/resources/js/main.js<?= Helper::res_timestamp( 'js/main.js' ); ?>"></script>

<script>
    _app.lang.translations = {
        'Please fill all required fields': '<?= _l( 'Please fill all required fields' ) ?>',
        'Write your note..' : '<?= _l('Write your note..') ?>',
    };
    
    <?php if( Template::$HTML_TITLE ): ?>$('title').text('<?= Template::$HTML_TITLE ?>');<?php endif; ?>
</script>