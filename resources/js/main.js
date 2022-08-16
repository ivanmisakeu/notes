
var _app = {

    lang : {
    
        /* List of translations, this will be overwriten in HTML */
        translations : {},
        
        /**
         * Translate text in users language
         * 
         * @param {String} text
         * @returns {String}
         */
        l : function( text ){
            
            if( typeof( _app.lang.translations[text] ) !== 'undefined' ){
                
                return _app.lang.translations[text];
            }
            else{
                
                return text;
            }
        }
    },
    
    flashes: {

        /* Main flash element handler */
        el: '#flash-message',
        
        /* Time to show flash message */
        show_timeout: 2000,
        
        /**
         * Flash message init function
         * If message exists, begin countdown process..
         * 
         * @returns {Void}
         */
        init: function () {

            if ($(_app.flashes.el).length) {

                setTimeout(function () {
                    _app.flashes.hide();
                }, _app.flashes.show_timeout);
            }
        },
        
        /**
         * Hide flash message, what else have you expected?
         * 
         * @returns {Void}
         */
        hide: function () {

            $(_app.flashes.el).fadeOut(1000);
        },
        
        /**
         * Show new flash message
         * In other message exists, it will be removed
         * 
         * @param {String} text
         * @param {String} type
         * @returns {Void}
         */
        show: function (text, type) {

            if ($(_app.flashes.el).length) {
                $(_app.flashes.el).remove();
            }

            if (typeof (type) === 'undefined') {
                type = 'success';
            }

            var flash = $('<div>')
                    .attr('id', _app.flashes.el.replace('#', ''))
                    .addClass('alert')
                    .addClass('alert-' + type)
                    .text(text);

            $('body').append(flash);

            setTimeout(function () {
                _app.flashes.hide();
            }, _app.flashes.show_timeout);
        }
    },
    
    captcha : {
        
        /**
         * Recount captcha fields in all forms
         * 
         * @returns {Void}
         */
        init : function() {
            
            $('form input[name^=__cc]').each( function() { 
                
                $(this).val( $(this).attr('name').substring(4).split('').sort().join('') );
            });
            
        }
    },
    
    form : {
        
        /**
         * Forms init function
         * 
         * @returns {Void}
         */
        init: function() {
            
            /* Create UI handler for errors */
            _app.form.error.init();
            
            /* Check if all required fields are filled up */
            $(document).on('submit','form', function( e ) {
                
                var required_input_size = $('input.required,select.required,textarea.required', $(this) ).length;
                var form_el = $(this);
                
                if( form_el.hasClass('verified') ){
                    
                    return true;
                }
                else{
                    
                    e.preventDefault();

                    if( required_input_size ){ 

                        var i = 0;
                        $('input.required,select.required,textarea.required', $(this) ).each(function(){

                            if( !$(this).val().length ){

                                _app.form.error.show( $(this) );
                                _app.flashes.show( _app.lang.l( 'Please fill all required fields' ) , 'danger' );
                                return false;
                            }

                            if( ++i == required_input_size ){

                                form_el.addClass('verified').submit();
                                return true;
                            }
                        });
                    }
                    else{

                        form_el.addClass('verified').submit();
                        return true;
                    }
                }
                
            });
            
        },
        
        /* Form errors easy peasy UI */
        error : {
            
            /**
             * Form erros init function
             * After error field focus remove error css..
             * 
             * @returns {Void}
             */
            init : function(){
                
                $(document).on('change focus','.error',function(){
                   
                    _app.form.error.hide( $(this) );
                });
            },
            
            /**
             * Show error on given input
             * 
             * @param {Object} el
             * @returns {Void}
             */
            show : function( el ){
                
                el.addClass('error');
            },
            
            /**
             * Removes error on given input
             * 
             * @param {Object} el
             * @returns {Void}
             */
            hide : function ( el ){
                
                el.removeClass('error');
            }
        }
        
    },
    
    modals : {
        
        /**
         * Modals init function
         * 
         * @returns {Void}
         */
        init: function(){
          
            /* close modal after Esc key */
            $(document).keyup(function(e) {
                
                if (e.key === "Escape") { 
                    
                    $('.modal').each(function(){
                        
                        if( $(this).css('display') == 'block' ){
                            $(this).hide();
                        }
                    });
                }
            });

            /* close modal on click outside main content */
            $(document).on('click','.modal',function(e){

                if( $(e.target).hasClass('modal') ){
                    $(e.target).hide();
                }
            });

            /* new note auto modal */
            $(document).on('click','#new-note-btn',function(e){
                
                e.preventDefault();
                _app.modals.addNewNoteModal();
            })
        },
        
        /** 
         * Add new note modal
         * 
         * @returns {Boolean}
         */
        addNewNoteModal : function(){
            
            $('#newNoteModal').show()
            return false;
        },
         
    },
      
    string : {
        
        /**
         * Generate random string
         * 
         * @param {Int} length
         * @returns {String}
         */
        random_string: function( length ) {

            if (typeof (length) === 'undefined') {
                length = 10;
            }

            var result = '';
            var characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt( Math.floor( Math.random() * characters.length ) );
            }
            
            return result;
        },
        
        /**
         * Update string as URL address
         * 
         * @param {String} text
         * @returns {String}
         */
        make_url: function( text ){
            
            text = text.toLowerCase();
            text = text.replace(/[^0-9a-zA-Z\.\-_]/gm, "-");
            text = text.replace(/-{2,}/gm, "-");
            text = text.replace(/^[-|\/\/]/gm, "");
            text = text.replace(/[-|\/\/]$/gm, "");
            
            return text;
        }
    },
    
    /**
     * App init function - agregates all other init funcitons
     * 
     * @returns {Void}
     */
    init: function () {

        _app.flashes.init();
        _app.captcha.init();
        _app.form.init();
        _app.modals.init();
    }

};

var _quill = {
    
    el: '#quill-editor-container',
    
    editor: null,
    
    options : {
        debug: false,
        modules: {
            toolbar: '#toolbar-container'
        },
        placeholder: _app.lang.l('Write your note..'),
        readOnly: false,
        theme: 'snow'
    },

    init : function(){
        
        _quill.editor = new Quill( _quill.el , _quill.options );
    }
    
}

$(function () {

    /* 
     * Here we go..
     * Show your magic powerful wizard!
     */
    _app.init();

    /**
     * Quill JS editor for notes
     */
    _quill.init();
})