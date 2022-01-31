/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html


	// The toolbar groups arrangement, optimized for a single toolbar row.
	config.toolbarGroups = [
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'forms' },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }
	];

	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';

	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';
	config.extraPlugins = 'wordcount,htmlwriter';
	
	config.wordcount = {
        // Whether or not you want to show the Paragraphs Count, Default Value: true
        showParagraphs: true,
        // Whether or not you want to show the Word Count, Default Value: true
        showWordCount: true,
        // Whether or not you want to show the Char Count, Default Value: false
        showCharCount: true,
        // Whether or not you want to count Spaces as Chars, Default Value: false
        countSpacesAsChars: false,
        // Whether or not to include Html chars in the Char Count, Default Value: false
        countHTML: true,
        // Maximum allowed Word Count that can be entered in the editor, Default Value: -1 (unlimited)
        maxWordCount: 1000,
        // Maximum allowed Chararcater Count entered be in the editor, Default Value: -1 (unlimited)
        //maxCharCount: 100,
        // Add filter to add or remove element before counting (see CKEDITOR.htmlParser.filter), Default value : null (no filter)
        filter: new CKEDITOR.htmlParser.filter({
            elements: {
                div: function (element) {
                    if (element.attributes.class == 'mediaembed') {
                        return false;
                    }
                }
            }
        })
    };
};
