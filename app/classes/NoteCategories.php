<?php

if ( !defined( 'APP_VERSION' ) ) {
    exit();
}

class NoteCategories extends Core {

    const TABLE_NAME            = 'note_categories';
    const TEMPLATE_FOLDER       = 'note-categories';
    
    const NOTE_CATEGORY_DELETED = 1;
    const NOTE_CATEGORY_ACTIVE  = 0; // not deleted
    
    /* ------- ** TEMPLATE FUNCTIONS ** ------- */

    public static function actionIndex() {
     
        $categories = self::_getAll( true , self::TABLE_NAME );
        
        Template::assign( 'categories' , $categories );
        Template::generate_front( self::TEMPLATE_FOLDER . '/index' );
        
    }
}