<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2">
		<title>elFinder</title>

		<!-- Require JS (REQUIRED) -->
		<!-- Require JS (REQUIRED) -->
		<!-- Rename "main.default.js" to "main.js" and edit it if you need configure elFInder options or any things -->
		<script data-main="<?= base_url('extra-assets/elFinder/main.default.js') ?>" 
        	src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>

		<script>


			// Функція для отримання параметрів з URL
			function getUrlParam(paramName) {
				var reParam = new RegExp('(?:[?&]|&)' + paramName + '=([^&]+)', 'i');
				var match = window.location.search.match(reParam);
				return (match && match.length > 1) ? match[1] : null;
			}
			define('elFinderConfig', {
				// elFinder options (REQUIRED)
				// Documentation for client options:
				// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
				defaultOpts : {
					url : '<?=base_url('admin/filemanager/connector');?>', // or connector.maximal.php : connector URL (REQUIRED)
					commandsOptions : {
						edit : {
							extraOptions : {
								// set API key to enable Creative Cloud image editor
								// see https://console.adobe.io/
								creativeCloudApiKey : '',
								// browsing manager URL for CKEditor, TinyMCE
								// uses self location with the empty value
								managerUrl : ''
							}
						},
						quicklook : {
							// to enable CAD-Files and 3D-Models preview with sharecad.org
							sharecadMimes : ['image/vnd.dwg', 'image/vnd.dxf', 'model/vnd.dwf', 'application/vnd.hp-hpgl', 'application/plt', 'application/step', 'model/iges', 'application/vnd.ms-pki.stl', 'application/sat', 'image/cgm', 'application/x-msmetafile'],
							// to enable preview with Google Docs Viewer
							googleDocsMimes : ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/postscript', 'application/rtf'],
							// to enable preview with Microsoft Office Online Viewer
							// these MIME types override "googleDocsMimes"
							officeOnlineMimes : ['application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.oasis.opendocument.presentation']
						}
					},
					// bootCalback calls at before elFinder boot up 
					bootCallback : function(fm, extraObj) {
						/* any bind functions etc. */
						fm.bind('init', function() {
							// any your code
						});
						// for example set document.title dynamically.
						var title = document.title;
						fm.bind('open', function() {
							var path = '',
								cwd  = fm.cwd();
							if (cwd) {
								path = fm.path(cwd.hash) || null;
							}
							document.title = path? path + ':' + title : title;
						}).bind('destroy', function() {
							document.title = title;
						});
					},
					getFileCallback: function(url) {
						 // Отримуємо параметр CKEditorFuncNum з URL
						var funcNum = getUrlParam('CKEditorFuncNum');

						// Передаємо URL зображення назад у CKEditor
						if (window.opener && funcNum) {
							window.opener.CKEDITOR.tools.callFunction(funcNum, url.url);
						}

						// Закриваємо вікно файлового менеджера
						window.close();
					}
					
				},
				managers : {
					// 'DOM Element ID': { /* elFinder options of this DOM Element */ }
					'elfinder': {}
				}
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>
