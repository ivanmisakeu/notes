
<a href="#" id="new-note-btn" title="<?= _l('Add new note') ?>">
    <i class="fa fa-plus" aria-hidden="true"></i>
</a>

<div  id="newNoteModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           
            <div class="modal-header">
                <button type="button" class="close" onClick="$('#newNoteModal').hide();">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">
                    <i class="fa fa-clipboard" aria-hidden="true"></i> <strong><?= _l('New note') ?></strong>
                </h4>
                <br />
                <p>
                    <?= _l('You are going to add new note.') ?> 
                    <br /><br />
                    <?= _l('All unsaved changes will be lost.') ?> 
                    <?= _l('Are you sure?') ?>
                </p>
            </div>

            <div class="modal-footer">
                <a href="<?= APP_URL . '/notes/add' ?>" class="btn btn-success">
                    <i class="fa fa-clipboard" aria-hidden="true"></i> <?= _l( 'Go for it!' ) ?>
                </a>
                <button type="button" class="btn btn-secondary pull-left" onClick="$('#newNoteModal').hide();">
                    <i class="fa fa-times" aria-hidden="true"></i> <?= _l( 'Cancel' ) ?>
                </button>
            </div>
            
        </div>
    </div>
</div>