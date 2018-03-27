<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

	use think\Route;

    //前台傻狗子的用户路由

    //后台傻狗子的用户路由

    //前台御用视屏路由
    Route::rule('/', 'index/index/index');//主页
    Route::rule('list/:id', 'index/video/list');//视频板块
    Route::rule('videoin', 'index/video/videoInsert');
    Route::rule('videoindo', 'index/video/videoInsertDo');
    Route::rule('videoplay/:vid', 'index/video/videoPlay');//视频播放页面
    Route::rule('getdanmu/:vid', 'index/video/getDanmu');//视频播放页面
    Route::rule('adddanmu/:vid', 'index/video/addDanmu');//视频播放页面
    Route::rule('detail/:tid', 'index/detail/detail');//视频播放页面
    Route::rule('postadd', 'index/post/postAdd');//增加评论页面
    Route::rule('backadd', 'index/back/backAdd');//增加评论页面
    /*Route::rule('postselect', 'index/post/postSelect');//查询评论页面
    Route::rule('postadda', 'index/post/postAdd');//查询评论回复页面*/
     Route::rule('markadd', 'index/mark/markAdd');//增加评分页面
     Route::rule('search', 'index/search/search');//增加评分页面

    
    //后台御用视屏路由
    //Route::rule('admin/', 'admin/index/index');//后台首页页面
    //Route::rule('adminvadd/', 'admin/video/videoAdd');//视频添加页面
    //Route::rule('adminvadddo/', 'admin/video/videoAddDo');//视频添加页面
    //Route::rule('tovideo_manage/', 'admin/manage/tovideoManage');//视频管理页面->1
    //Route::rule('video_manage/', 'admin/manage/videoManage');//视频管理页面->3


    //后台ajax
    //Route::rule('adminajax/', 'admin/videoajax/videoajax');
    //Route::rule('adminajaxtov/', 'admin/tovideoajax/tovideoajax');
    //Route::rule('adminajaxvnum/', 'admin/videoajax/videonumajax');
    //Route::rule('selmanageajax/', 'admin/videoajax/manageajax');//管理视频查询tovideo没有被隐藏的
//资源路由
	
	//Route::resource('video', 'index/video');

/*return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];*/
