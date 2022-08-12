<?php

if ( !defined( 'APP_VERSION' ) ) {
    exit();
}

class NoteCategories extends Core {

    const TABLE_NAME = 'note_categories';
 
    const NOTE_CATEGORY_DELETED = 1;
    const NOTE_CATEGORY_ACTIVE = 0; // not deleted
    
}