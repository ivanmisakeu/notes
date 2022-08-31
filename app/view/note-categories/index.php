
<a href="<?= APP_URL . '/note-categories/add' ?>" class="pull-right btn btn-primary btn-sm m-t-sm">
    <i class="fa fa-plus" aria-hidden="true"></i> <?= _l('Add') ?>
</a>

<h1>
    <i class="fa fa-folder-open-o color" aria-hidden="true"></i>
    <?= _l( 'Categories' ) ?>
</h1>

<div class="clearfix"></div>

<?php if( count($categories) ): ?>

    <table class="table table-admin table-bordered table-striped">
        <thead>
            <tr>
                <th><?= _l('Name') ?></th>
                <th><?= _l('Notes') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach( $categories as $category): ?>
            <tr>
                <td>
                    <strong><?= $category['name'] ?>
                </td>
                <td width="80" align="center" class="<?= $user['admin'] ? 'text-success' : '' ?>">
                    <i class="fa fa-clipboard" aria-hidden="true"></i> <?= count(Notes::getAllNotesByCategory( $category['id'] )) ?>
                </td>
                <td  class="nowrap">
                    
                    <a class="btn btn-xs btn-primary m-r-sm" href="<?= APP_URL . '/note-categories/edit/' . $category['id'] ?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i> <?= _l('Edit') ?>
                    </a>
                    
                    <a onClick="
                        return _app.modals.removeCategoryModal(<?= $category['id'] ?>,
                            '<?= $category['name'] ?>');" 
                        class="btn btn-xs btn-danger" 
                        href="#">
                            <i class="fa fa-trash" aria-hidden="true"></i> <?= _l('Delete') ?>
                    </a>
                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php Template::render('note-categories/modals/delete'); ?>

<?php else: ?>

    <p><em><?= _l('List is empty'); ?></em></p>
    
<?php endif; ?>
