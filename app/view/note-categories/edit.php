
<h1>
    <i class="fa fa-folder-open-o color" aria-hidden="true"></i>
    <?= _l( 'Edit category' ) . ' <small>' . $category['name'] . '</small>' ?>
</h1>

<div class="clearfix"></div>

<?php 
    Template::assign( 'category' , $category );
    Template::render('note-categories/@form'); 
?>