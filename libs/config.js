CKEDITOR.editorConfig = function( config ) {
	config.language = 'ru';
	config.uiColor = '#F7B42C';
	config.height = 200;
	config.width = 600;
	config.toolbar = 'Basic';
	config.toolbar_Basic = //индивидуальная настройка режима Basic
    	[
     		['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','Table','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']
    	];
	config.toolbarCanCollapse = true;
};
