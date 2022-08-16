<!DOCTYPE html>
<html lang="<?= Lang::getLang(); ?>">
    <head>
        <?= Template::include( 'head' ) ?>
    </head>
    <body>
        <?= Template::include( 'header' ) ?>
        
        <?php if( !Template::$FULL_VIEW ): ?><div class="main-container"><?php endif; ?>
            
            <!-- main content -->
            <?php Template::renderHTMLContent(); ?>

            <!-- footer and copyright -->
            <?php if( !Template::$FULL_VIEW ): ?>
                <hr />

                <div class="copyright">
                    &copy;<?= date('Y') ?> Ivan Mišák | <?= _l('Version') . ' ' . APP_VERSION ?> 
                </div>
            <?php endif; ?>
            
        <?php if( !Template::$FULL_VIEW ): ?></div><?php endif; ?>

        <?= Template::include( 'footer' ) ?>
    </body>
</html>