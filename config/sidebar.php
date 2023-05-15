<?php

return [

	/*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

	'menu' => [
        [
			'icon' => 'fas fa-cog fa-fw',
			'title' => 'Шаблон',
			'url' => '/template',
		],
        [
			'icon' => 'fas fa-book fa-fw',
			'title' => 'Документ',
			'url' => '/doc',
		],
		[
			'icon' => 'fa fa-th-large',
			'title' => 'Пользователь',
			'url' => '/',
		],
		// [
		// 	'icon' => 'fa fa-align-left',
		// 	'title' => 'Menu Level',
		// 	'url' => 'javascript:;',
		// 	'caret' => true,
		// 	'sub_menu' => [[
		// 		'url' => 'javascript:;',
		// 		'title' => 'Menu 1.1',
		// 		'sub_menu' => [[
		// 			'url' => 'javascript:;',
		// 			'title' => 'Menu 2.1',
		// 			'sub_menu' => [[
		// 				'url' => 'javascript:;',
		// 				'title' => 'Menu 3.1',
		// 			], [
		// 				'url' => 'javascript:;',
		// 				'title' => 'Menu 3.2'
		// 			]]
		// 		], [
		// 			'url' => 'javascript:;',
		// 			'title' => 'Menu 2.2'
		// 		], [
		// 			'url' => 'javascript:;',
		// 			'title' => 'Menu 2.3'
		// 		]]
		// 	], [
		// 		'url' => 'javascript:;',
		// 		'title' => 'Menu 1.2'
		// 	], [
		// 		'url' => 'javascript:;',
		// 		'title' => 'Menu 1.3'
		// 	]]
		// ]
	]
];
