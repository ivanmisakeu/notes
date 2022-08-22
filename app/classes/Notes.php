<?php

if ( !defined( 'APP_VERSION' ) ) {
    exit();
}

class Notes extends Core {

    const TABLE_NAME        = 'notes';
    const TEMPLATE_FOLDER   = 'notes';
    
    const NOTE_DELETED      = 1;
    const NOTE_ACTIVE       = 0; // not deleted
    
    /* ------- ** TEMPLATE FUNCTIONS ** ------- */

    public static function actionIndex() {
        
        /** @note Not used for now
        
        Template::setPageTitle( Lang::l( 'My notes' ) );
        
        Template::assign( 'notes' , self::getAll( true , self::TABLE_NAME ) );
        Template::assign( 'categories' , NoteCategories::_getAll( true , NoteCategories::TABLE_NAME ) );
        Template::assign( 'tags' , NoteTags::getAll( true , NoteTags::TABLE_NAME ) );
        
        Template::generate_front( 'user/auth' );
        */
    }
    
    /* ------- ** TEMPLATE FUNCTIONS ** ------- */

    public static function actionAdd() {

        Template::setPageTitle( Lang::l( 'Add new note' ) );
        Template::generate_front( self::TEMPLATE_FOLDER . '/add' );
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
    
    /* ------- ** DATABASE FUNCTIONS ** ------- */
    
    /**
     * Fill note element with related data
     * 
     * @param array $note
     */
    public static function fillElementData( array $note ){
        
        $note['category'] = NoteCategories::_get( $note['id_note_category'] , NoteCategories::TABLE_NAME );
        $note['tags'] = NoteTags::getTagsForNote( $note['id'] );
        
    }
    
    /**
     * Get all notes related to category
     * 
     * @param int $id_category
     * @param bool $active_only (opt.)
     * @return array
     */
    public static function getAllNotesByCategory( int $id_category, bool $active_only = true ){
        
        $sql = '
            SELECT 
                * 
            FROM ' . self::TABLE_NAME . ' 
            WHERE id_note_category = ' . (int) $id_category;
        
        if( $active_only ){
            $sql .= ' AND deleted = ' . (int) self::NOTE_ACTIVE; 
        }
        
        $sql .= ' ORDER BY name';
        
        return APP::$DB->query($sql)->fetchAll();
    }
    
}