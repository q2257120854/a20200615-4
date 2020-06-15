<?php
return array(
			//'配置项'=>'配置值'
			'APP_GROUP_LIST' 		=>	'Wchat,Manage',
			'DEFAULT_GROUP'  		=>	'Wchat',
			'URL_MODEL'		 		=>	0,
			'URL_HTML_SUFFIX'		=>	'.shtml',
			'URL_404_REDIRECT'		=>	'404.html',
			'OUTPUT_ENCODE'			=>	true,
			'TMPL_ACTION_ERROR'		=>	APP_PATH . 'Tpl/error.php',
			'TMPL_ACTION_SUCCESS'	=>	APP_PATH . 'Tpl/success.php',
			'TMPL_EXCEPTION_FILE'   =>	APP_PATH . 'Tpl/phpfeid.php',

			'TMPL_PARSE_STRING' 	=>	array(
			    '__PUBLIC__' 	=> 	'/Public',
			    '__UPLOAD__' 	=> 	'/Uploads',
			),
			'LOAD_EXT_CONFIG' 		=>	'database,domain,site,api,loan,contract',
			'SHOW_PAGE_TRACE' 		=>	false,
			'TMPL_FILE_DEPR'		=>	'_',
			
			'TAGLIB_LOAD'			=>	true,
			'APP_AUTOLOAD_PATH'		=>	'@.TagLib',
			'TAGLIB_BUILD_IN'		=>	'Cx,Cvphp',
			//------------------------------------
			//分页部分设置
			//------------------------------------
			'PAGE_NUM_ONE'			=>	25,
			'PAGE_STYLE'			=>	'<div class="pagination-info">共 %totalRow% %header%</div>%upPage% %linkPage% %downPage%',
			
);