<?php

if ( !defined( 'APP_VERSION' ) ) {
    exit();
}

class Notes extends Core {

    const TABLE_NAME = 'notes';
 
    const NOTE_DELETED = 1;
    const NOTE_ACTIVE = 0; // not deleted
    
    /* ------- ** TEMPLATE FUNCTIONS ** ------- */

    public static function actionIndex() {

        Template::setPageTitle( Lang::l( 'My notes' ) );
        
        Template::assign( 'notes' , self::getAll( true , self::TABLE_NAME ) );
        Template::assign( 'categories' , NoteCategories::_getAll( true , NoteCategories::TABLE_NAME ) );
        Template::assign( 'tags' , NoteTags::getAll( true , NoteTags::TABLE_NAME ) );
        
        Template::generate_front( 'user/auth' );
        
    }
    
    /**
     * All notes
     * 
     * @param bool $only_active (opt.)
     * @return type
     */
    public static function getAll( bool $only_active = true ){
        
        $notes = self::_getAll( $only_active , self::TABLE_NAME );
        foreach( $notes as &$note ){
            
            $note = self::fillElementData( $note );
        }
        
        return $notes;
    }
    
    /**
     * Fill note element with related data
     * 
     * @param array $note
     */
    public static function fillElementData( array $note ){
        
        $note['category'] = NoteCategories::_get( $note['id_note_category'] , NoteCategories::TABLE_NAME );
        $note['tags'] = NoteTags::getTagsForNote( $note['id'] );
        
    }
    
}