<?php

if ( !defined( 'APP_VERSION' ) ) {
    exit();
}

class NoteTags extends Core {

    const TABLE_NAME        = 'note_tags';
    const TABLE_REL_NAME    = 'note_tag_rels';
    const TEMPLATE_FOLDER   = 'note-tags';
    
    const NOTE_TAG_DELETED  = 1;
    const NOTE_TAG_ACTIVE   = 0; // not deleted
    
    /**
     * All tags for given note
     * 
     * @param int $id_note
     * @return array
     */
    public static function getTagsForNote( int $id_note ){
        
        $sql = '
            SELECT 
                * 
            FROM ' . self::TABLE_NAME . ' a 
            JOIN ' . self::TABLE_REL_NAME . ' b 
                ON a.id = b.id_note_tag AND b.id_note = ' . (int) $id_note . ' 
            WHERE 
                deleted = ' . (int) self::NOTE_TAG_ACTIVE;
                
        return APP::$DB->query($sql)->fetch();
        
    }
}