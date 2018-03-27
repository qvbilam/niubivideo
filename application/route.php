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
    //123
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




    //gouyi

    Route::rule('list/:id', 'index/video/list');//视频板块
    Route::rule('videoin', 'index/video/videoInsert');
    Route::rule('videoindo', 'index/video/videoInsertDo');
    Route::rule('videoplay/:vid', 'index/video/videoPlay');//视频播放页面
    Route::rule('getdanmu/:vid', 'index/video/getDanmu');//视频播放页面

    //后台
    Route::rule('indexadmin/', 'admin/video/index');//视频播放页面  
    Route::rule('dmadmin/', 'admin/video/dmadmin');//视频播放页面

    //123
    // Route::rule('admin/', 'admin/index/index');//后台首页
   // Route::rule('article_list/', 'admin/index/articleList');//后台资讯管理
   // Route::rule('admin_permission/', 'admin/adminList/adminPermission');//后台权限管理
   // Route::rule('admin_role/', 'admin/adminList/adminRole');//后台角色管理
    //Route::rule('admin_role_add/', 'admin/adminList/adminRoleAdd');//后台角色添加
    //Route::rule('admin_list/', 'admin/adminList/adminList');//后台管理员列表
    //Route::rule('member_list/', 'admin/member/memberList');//用户管理
    //Route::rule('member_del/', 'admin/member/memberDel');//删除的用户
    ////Route::rule('member_scoreoperation/', 'admin/member/memberScoreoperation');//用户积分
    //Route::rule('member_record_browse/', 'admin/member/memberRecordBrowse');//用户积分
    ////Route::rule('feedback_list/', 'admin/lists/feedbackList');//意见反馈
    //Route::rule('delfeed/', 'admin/lists/delfeed');//意见反馈


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
