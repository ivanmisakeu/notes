
<?php if( User::$CURRENT_USER ): ?>
<div class="admin-header-wrapper">
    <div class="pull-right">
        <a href="<?= APP_URL . '/user/logout' ?>" class="no-underline">
            <i class="fa fa-sign-out" aria-hidden="true"></i> <?= _l('Sign out') ?>
        </a>
    </div>
    
    <a href="<?= ADMIN_URL ?>" class="logo-wrapper">
        <div class="logo"></div> <?= _l( 'Notes' ) ?>
    </a>
</div>
<?php endif; ?>