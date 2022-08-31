<?php

if ( !defined( 'APP_VERSION' ) ) {
    exit();
}

class NoteCategories extends Core {

    const TABLE_NAME            = 'note_categories';
    const TEMPLATE_FOLDER       = 'note-categories';
    
    const NOTE_CATEGORY_DELETED = 1;
    const NOTE_CATEGORY_ACTIVE  = 0; // not deleted
    
    const TRANSFER_NOTES_TO_CAT = 1; // after delete will be notes assigned to other category
    
    /* ------- ** TEMPLATE FUNCTIONS ** ------- */

    public static function actionIndex() {
     
        $categories = self::_getAll( true , self::TABLE_NAME );
        
        Template::assign( 'categories' , $categories );
        Template::generate_front( self::TEMPLATE_FOLDER . '/index' );
        
    }
    
    public static function actionAdd(){
        
        Template::generate_front( self::TEMPLATE_FOLDER . '/add' ); 
        
    }
    
    public static function actionEdit(){
        
        if( !isset(Router::$ROUTES[2]) || 
                !$note_category = NoteCategories::_get( Router::$ROUTES[2] , self::TABLE_NAME ) ){
            
            Helper::flash_set( Lang::l('Category not found') , Helper::FLASH_DANGER );
            Helper::redirect( ADMIN_URL . '/note-categories' );
        }
        
        Template::assign( 'category' , $note_category );
        Template::generate_front( self::TEMPLATE_FOLDER . '/edit' ); 
        
    }
    
    /* ------- ** DATABASE FUNCTIONS ** ------- */
    
    
    /**
     * Transfer all notes from one category to another
     * 
     * @param int $id_from_category
     * @param int $id_to_category
     * @return boolean
     */
    public function transferNotesCategory( int $id_from_category , int $id_to_category ){
        
        // testing human stupidity
        if( $id_from_category == $id_to_category ){
            return false;
        }
        
        $to_category = self::_get( $id_to_category, self::TABLE_NAME );
        
        // cannot transfer to deleted category
        if( !$to_category || $to_category['deleted'] == self::NOTE_CATEGORY_DELETED ){
            return false;
        }
        
        // jop, here we go
        $sql = '
            UPDATE ' . Notes::TABLE_NAME . ' 
            SET 
                id_note_category = ' . (int) $id_to_category . ' 
            WHERE id_note_category = ' . (int) $id_from_category . ' 
            AND deleted = ' . Notes::NOTE_ACTIVE; 
    
        return App::$DB->query( $sql ) ? true : false;
        
    }
    
    /* ------- ** OTHER FUNCTIONS ** ------- */
    
    
    /**
     * Get category name in display format
     * 
     * @param int|array $category
     * @return string
     */
    public static function displayCategoryName( $category ){
        
        if( is_int($category) ){
            
            $category = self::_get($category, self::TABLE_NAME );
        }
        
        if( $category && 
                isset($category['name']) && 
                isset($category['id']) ){
            
            $name = '<a href="' . WWW_DIR . '/category-' . $category['id'] . '">' . $category['name'] . '</a>';
            
            if( !isset($category['deleted']) || $category['deleted'] == self::NOTE_CATEGORY_DELETED ){
                $name .= '<span class="archived">' . Lang::l('archived') . '</span>';
            }
            
            return '<span class="note-category-name" data-id="' . $category['id'] . '">' . $name . '</span>';
        }
        
        return null;
        
    }
    
    public static function editCategory(){
        
        Helper::captcha_verify();
        
        if( !isset($_POST['id_note_category']) || !isset($_POST['name']) ){
            
            Helper::redirect_error_home();
        }
        
        $note_category = self::_get( $_POST['id_note_category'], self::TABLE_NAME);
        if( !$note_category ){
            
            Helper::flash_set( Lang::l('Note category does not exist'), Helper::FLASH_DANGER );
            Helper::redirect_error_home();
        }
        
        App::$DB->query('UPDATE ' . self::TABLE_NAME . ' SET %a', array(
            'name' => $_POST['name'],
            'description' => isset($_POST['description']) ? $_POST['description'] : '',
            'updated' => Core::now()
        ));
        
        Helper::flash_set( Lang::l('Category has been updated') );
        Helper::redirect_to_posted_url();
        
        
    }
    
    /**
     * Remove category, yeah! Fuck this category!
     */
    public static function removeCategory(){
        
        Helper::captcha_verify();
        
        if( !isset($_POST['id_note_category']) ){
            
            Helper::redirect_error_home();
        }
        
        // transfer active notes to another category before delete
        if( isset($_POST['after-delete']) && 
                self::TRANSFER_NOTES_TO_CAT == $_POST['after-delete'] && 
                isset($_POST['id_transfer_category']) ){
            
            $this->transferNotesCategory( $_POST['id_note_category'] , $_POST['id_transfer_category'] );
        }
        
        $sql = '
            UPDATE ' . self::TABLE_NAME . ' 
            SET 
                deleted = ' . self::NOTE_CATEGORY_DELETED . ', 
                updated = "' . Core::now() . '"';
        
        App::$DB->query( $sql );
        
        Helper::flash_set( Lang::l( 'Category has been removed' ) );
        Helper::redirect_to_posted_url();
        
    }
}