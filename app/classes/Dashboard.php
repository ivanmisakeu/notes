<?php

if ( !defined( 'APP_VERSION' ) ) {
    exit();
}

class Dashboard{

    public static function actionIndex() {

        Template::render( 'dashboard' );
    }
    
}
    