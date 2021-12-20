(function($) {

  /* globals _, fieldVisualJS, quicktags, tinymce, wp */

  "use strict";

  var MfnFieldVisual = (function() {

    var __editorSettings = {};
    var newEditor = true;

    function init() {

      if ( typeof window.wpEditorL10n === "undefined" ) {
        newEditor = false;
      }

      bind();

      if (newEditor) {
        mergeSettings();
      }

    }

    /**
     * Bind events
     */

    function bind() {

      // event fired after popup created, before show

      $(document).on('mfn:builder:edit', function( $this, modal ) {
        create( $(modal) );
      });

      // event fired after popup close, before destroy

      $(document).on('mfn:builder:close', function( $this, modal ) {
        destroy( $(modal) );
      });

    }

    /**
     * Merge Settings
     */

    function mergeSettings() {
      __editorSettings = {
        tinymce: _.extend(
          window.wpEditorL10n.tinymce.settings, {
            menubar: false,
            statusbar: false,
            external_plugins: {
              'mfnsc': fieldVisualJS.mfnsc,
            },
            toolbar1: "formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,dfw,wp_adv,mfnsc",
            toolbar2: "strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
          }
        ),
      };
    }

    /**
     * Create Tiny MCE instance
     * https://developer.wordpress.org/reference/functions/wp_editor/
     */

    function create( $modal ) {

      var $editor = $( 'textarea[data-visual]', $modal );

      if( ! $editor.length ){
        return false;
      }

      try {

        $editor.attr( 'id', 'mfn-editor' ); // add index when change used inside $.each

        $('#content-tmce.wp-switch-editor').click();

        quicktags({
          id: 'mfn-editor'
        });

        if ( newEditor ) {
          wp.oldEditor.initialize('mfn-editor', __editorSettings);
        } else {
          tinymce.execCommand('mceAddEditor', true, 'mfn-editor');
        }

        $('.switch-html', $modal).click(function() {
          $(this).closest('.wp-editor-wrap').removeClass('tmce-active').addClass('html-active');
        });

        $('.switch-tmce', $modal).click(function() {
          $(this).closest('.wp-editor-wrap').removeClass('html-active').addClass('tmce-active');
        });

        setTimeout(function(){
          $('#mfn-editor_ifr').contents().find('body').attr('style','background-color:#F2F6FA');
        }, 500);

      } catch (err) {}

    }

    /**
     * Destroy Tiny MCE instance
     * Prepare data to save in WP friendly format
     */

    function destroy( $modal ) {

      var $editor = $('#mfn-editor');

      var editorContent = '';

      if( ! $editor.length ){
        return false;
      }

      try {
        // try/catch: tinymce or quicktags may not exist in WP 5.0+

        if ( ! tinymce.getContent ) {
          tinymce.execCommand( 'mceToggleEditor', false, 'mfn-editor' );
        }

        /*
         * Do NOT change order of below lines
         * Get editor content, save it to variable, destroy editor, set textarea content
         */

        editorContent = tinymce.get( 'mfn-editor' ).getContent();

        $( '.wp-editor-wrap', $modal ).removeClass( 'html-active' ).addClass( 'tmce-active' );

        if ( newEditor ) {
          wp.oldEditor.remove( 'mfn-editor' );
        } else {
          tinymce.execCommand( 'mceRemoveEditor', false, 'mfn-editor' );
        }

        $editor.val( editorContent );

      } catch (err) {}

      $editor.removeAttr('id');

    }

    /**
     * Return
     * Method to start the closure
     */

    return {
      init: init
    };

  })();

  /**
   * $(document).ready
   * Specify a function to execute when the DOM is fully loaded.
   */

  $(function() {
    MfnFieldVisual.init();
  });

})(jQuery);
