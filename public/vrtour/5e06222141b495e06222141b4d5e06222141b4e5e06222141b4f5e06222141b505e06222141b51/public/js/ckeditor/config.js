/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fa';
	// config.uiColor = '#7b88ff';
    config.contentsCss = '/js/editor/ckeditor/fonts.css';
    config.font_names = 'B Nazanin;' + config.font_names;
    config.font_names = 'Yekan;' + config.font_names;
    config.font_defaultLabel = 'B Nazanin';
    config.toolbar = [
        {name: 'clipboard',items:['Cut', 'Copy', 'Paste', 'CreatePlaceholder', 'Find', 'Undo', 'Redo']},
        {name: 'links',items:['Link', 'Unlink']},
        {name: 'textalign',items:['Bold', 'Italic', 'Underline', 'JustifyBlock', 'JustifyCenter', 'JustifyLeft', 'JustifyRight', 'Strike', 'Subscript', 'Superscript']},
        {name: 'direction',items:['BidiLtr', 'BidiRtl']},
        {name: 'font',items:['Font', 'FontSize', 'Format', 'Styles', 'TextColor','BGColor']},
        {name: 'list',items:['NumberedList', 'BulletedList']},
        {name: 'indent',items:['Indent', 'Outdent']},
        {name: 'image',items:['PickImage', 'Image', 'Table', 'PageBreak', 'HorizontalRule', 'Smiley', 'SpecialChar']},
    ];
};
