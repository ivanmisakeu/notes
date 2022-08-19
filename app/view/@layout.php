<!DOCTYPE html>
<html lang="<?= Lang::getLang(); ?>">
    <head>
        <?= Template::include( 'head' ) ?>
    </head>
    <body>
        <?= Template::include( 'header' ) ?>
        
        <?php if( !Template::$FULL_VIEW ): ?>
            
            <div class="main-container main-container-basic">
        
                <!-- page sidebar menu -->
                <div class="page-menu-wrapper">
                    <ul>
                        <?php foreach(Template::$MENU as $class_name => $row ): ?>
                        <?php if( !isset($row['name']) ){ continue; } ?>
                        <li class="<?= Router::$ROUTES[0] == $class_name ? 'active' : '' ?>">
                            <a href="<?= APP_URL . '/' . $class_name . ( isset($row['method']) ? ('/' . $row['method']) : '' ) ?>" 
                               id="<?= Helper::str_clean('menuitem-' . $class_name . ( isset($row['method']) ? ('-' . $row['method']) : '' )) ?>" 
                               class="nowrap"
                            >
                                <?php if( isset($row['icon']) ):?>
                                <i class="fa <?= $row['icon'] ?>" aria-hidden="true"></i>
                                <?php endif; ?> 
                                <?= $row['name'] ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                        <li class="bt-1 nowrap">
                            <a href="<?= APP_URL . '/user/logout' ?>">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> <?= _l('Sign out') ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- main content -->
                <div class="page-content-wrapper">
                    
                    <?php Template::renderHTMLContent(); ?>
                    
                    <!-- footer and copyright -->
                    <div class="copyright-wrapper p-b-sm">
                        <hr />

                        <div class="copyright">
                            &copy;<?= date('Y') ?> Ivan Mišák | <?= _l('Version') . ' ' . APP_VERSION ?> 
                        </div>
                    </div>
                    
                </div>
                
            </div>
        
        <?php else: ?>
                
            <!-- main content -->
            <?php Template::renderHTMLContent(); ?>
                
        <?php endif; ?>
            
        <?= Template::include( 'footer' ) ?>
    </body>
</html>