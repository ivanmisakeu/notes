
<div  id="removeCategoryModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
           
            <form action="<?= APP_URL ?>/doNoteCategories/removeCategory/" method="post">
                
                <?= Helper::captcha_get(); ?>
                
                <div class="modal-header">
                    <button type="button" class="close" onClick="$('#removeCategoryModal').hide();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <i class="fa fa-trash-o" aria-hidden="true"></i> <strong><?= _l( 'Realy delete category?' ) ?></strong>
                    </h4>
                    <br />
                    <p>-- category name --</p>
                    <br />
                    <div class="form-group">
                        <label><?= _l('What with notes in this category?') ?></label>
                        <select class="form-control" name="after-delete" onChange="_showHideTransferCategoriesSelect();">
                            <option value="0"><?= _l('Do nothing, leavve notes as they are (with category archived)') ?></option>
                            <option value="1"><?= _l('Transfer notes to another category') ?></option>
                        </select>
                    </div>
                    <div class="form-group id_transfer_category_wrapper">
                        <label><?= _l('Transfer to category') ?></label>
                        <select class="form-control" name="id_transfer_category">
                            <?php 
                                // if there is any other category, list is empty
                                $transfer_categories = NoteCategories::_getAll( true , NoteCategories::TABLE_NAME );
                                if( 1 >= count( $transfer_categories ) ):
                            ?>
                                <option value="0" disabled="disabled" selected="selected">-- <?= _l('nothing to select') ?> --</option>
                            <?php 
                                // if there is at least one other category
                                // user can transfer all notes from current category
                                // to the another one
                                else: 
                                    foreach( $transfer_categories as $transfer_category ): 
                                    ?>
                                    <option value="<?= $transfer_category['id'] ?>"><?= $transfer_category['name'] ?></option>
                                    <?php 
                                    endforeach; 
                                endif;
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button class="btn btn-primary">
                        <i class="fa fa-check" aria-hidden="true"></i> <?= _l( 'Yes, delete' ) ?>
                    </button>
                    <button type="button" class="btn btn-success pull-left" onClick="$('#removeCategoryModal').hide();">
                        <i class="fa fa-times" aria-hidden="true"></i> <?= _l( 'No' ) ?>
                    </button>
                </div>
            
                <input type="hidden" name="redirect_url" value="<?= APP_URL . '/note-categories' ?>" />
                <input type="hidden" name="id_note_category" value="" />
            </form>
            
        </div>
    </div>
</div>

<script>
    
var _showHideTransferCategoriesSelect = function(){
    
    if(  1 == parseInt( $('#removeCategoryModal [name=after-delete] option:selected').val() ) ){
        
        $('#removeCategoryModal .id_transfer_category_wrapper').show();
    }
    else{
        
        $('#removeCategoryModal .id_transfer_category_wrapper').hide();
    }
}
    
/**
 * Remove current category from list to "transfer to" categories
 * 
 * @param {int} id_current_category
 * @returns {void}
 */
var _showCategoriesToTransfer = function( id_current_category ){

    $('#removeCategoryModal [name=id_transfer_category] option').each(function(){

        if( parseInt( $(this).attr('value') ) == id_current_category ){
            $(this).hide();
        }
        else{
            $(this).show();
        }
    });
}    
</script>