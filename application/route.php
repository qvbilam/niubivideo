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
    Route::rule('/', 'index/index/index');//主页
    Route::rule('register', 'index/user/register');//注册
    Route::rule('login', 'index/user/login');//登陆
    Route::rule('forgot', 'index/user/forgot');//忘记密码
    Route::rule('info', 'index/info/info');//个人中心
    Route::rule('safety', 'index/info/safety');//安全设置
    Route::rule('password', 'index/info/password');//修改密码
    Route::rule('bindphone', 'index/info/bindphone');//手机验证
    Route::rule('email', 'index/info/email');//邮箱验证
    Route::rule('bonus', 'index/jifen/bonus');//积分兑换
    Route::rule('points', 'index/jifen/points');//积分页面
    Route::rule('collection', 'index/jifen/collection');//收藏
    Route::rule('foot', 'index/jifen/foot');//观看历史 
    Route::rule('suggest', 'index/jifen/suggest');//意见反馈 
    Route::rule('news', 'index/jifen/news');//我的消息 
    Route::rule('coupon', 'index/jifen/coupon');//ViP 
    Route::rule('blog', 'index/jifen/blog');//ViP 
    //后台傻狗子的用户路由

    //前台傻狗子deu视屏路由
    Route::rule('/', 'index/index/index');//主页
    Route::rule('list/:id', 'index/video/list');//视频板块
    Route::rule('videoin', 'index/video/videoInsert');
    Route::rule('videoindo', 'index/video/videoInsertDo');
    Route::rule('videoplay/:vid', 'index/video/videoplay');//视频播放页面
    Route::rule('getdanmu/:vid', 'index/video/getDanmu');//视频播放页面
    Route::rule('adddanmu/:vid', 'index/video/addDanmu');//视频播放页面
    Route::rule('detail/:tid', 'index/detail/detail');//视频播放页面
    Route::rule('postadd', 'index/post/postAdd');//增加评论页面
    Route::rule('backadd', 'index/back/backAdd');//增加评论页面
    /*Route::rule('postselect', 'index/post/postSelect');//查询评论页面
    Route::rule('postadda', 'index/post/postAdd');//查询评论回复页面*/
     Route::rule('markadd', 'index/mark/markAdd');//增加评分页面
     Route::rule('search', 'index/search/search');//增加评分页面

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
