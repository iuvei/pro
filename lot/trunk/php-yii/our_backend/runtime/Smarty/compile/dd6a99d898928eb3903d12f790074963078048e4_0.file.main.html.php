<?php
/* Smarty version 3.1.31, created on 2018-02-10 10:57:06
  from "/Users/frank/www/newproject/trunk/php-yii/our_backend/views/layouts/main.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a7ed0029ad369_55562470',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd6a99d898928eb3903d12f790074963078048e4' => 
    array (
      0 => '/Users/frank/www/newproject/trunk/php-yii/our_backend/views/layouts/main.html',
      1 => 1517801693,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a7ed0029ad369_55562470 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>PK后台管理系统</title>
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="<?php echo Yii::getAlias('@css');?>
/pack/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@css');?>
/pack/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@css');?>
/pack/ace.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@css');?>
/pack/ace-rtl.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@css');?>
/pack/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@css');?>
/pack/combo.select.css" />
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@css');?>
/pack/clock/style.css" />
        <link rel="stylesheet" href="<?php echo Yii::getAlias('@css');?>
/pack/toastr/toastr.min.css" />

        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/ace-extra.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/jquery-2.1.4.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/bootstrap.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/ace.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/layer/layer.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/jquery.combo.select.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/laydate/laydate.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/jquery.pjax.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/clock/moment.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/clock/script.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/pack/toastr/toastr.min.js"><?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/common.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo Yii::getAlias('@js');?>
/push.js"><?php echo '</script'; ?>
>

    </head>
    <style>
        .menu-ul a{cursor: pointer}
        #btn-float-top{
            position:fixed;
            bottom:20px;
            right:5px;
            display:none
        }
        body .btn{border-radius: 4px !important}
        body input[type="text"]{border-radius: 4px !important}
        td{vertical-align:middle !important;}
    </style>
    <body class="skin-2">
        <div class="navbar navbar-default" id="navbar">
            <div class="navbar-container" id="navbar-container">
                <div class="navbar-header pull-left">
                    <a href="#" class="navbar-brand">
                        <small>
                            <i class="icon-leaf"></i>
                            PK-后台管理
                        </small>
                    </a>
                </div>

                <div class="navbar-header pull-left" style="margin-left:100px !important">
                    <a href="#" class="navbar-brand">
                        <small style="font-size:15px;">
                            <i class="icon-user"></i>
                            在线会员人数：<span id="online_user"> </span>
                        </small>
                    </a>
                </div>

                <div class="navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li>
                            <div id="clock" class="dark">
                                <div class="clock_date">
                                    <div class="display_week"></div>
                                    <div class="display_date" ></div>
                                </div>
                                <div class="display">
                                    <div class="digits">
                                    </div>

                                </div>
                            </div>
                        </li>
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <span class="user-info">
                                    <small>欢迎您,</small>
                                    <?php echo Yii::$app->session->get('login_user');?>

                                </span>

                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="/admin/center">
                                        <i class="icon-user"></i>
                                        个人中心
                                    </a>
                                    <a href="javascript::void" id='pwdForm'>
                                        <i class="icon-pencil"></i>
                                        修改密码
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="/login/loginout">
                                        <i class="icon-off"></i>
                                        退出登录
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-container" id="main-container">
            <div class="main-container-inner">
                <a class="menu-toggler" id="menu-toggler" href="#">
                    <span class="menu-text"></span>
                </a>
                <div class="sidebar" id="sidebar">
                    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                            <button class="btn btn-success">
                                <i class="icon-signal"></i>
                            </button>

                            <button class="btn btn-info">
                                <i class="icon-pencil"></i>
                            </button>

                            <button class="btn btn-warning">
                                <i class="icon-group"></i>
                            </button>

                            <button class="btn btn-danger">
                                <i class="icon-cogs"></i>
                            </button>
                        </div>

                        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                            <span class="btn btn-success"></span>

                            <span class="btn btn-info"></span>

                            <span class="btn btn-warning"></span>

                            <span class="btn btn-danger"></span>
                        </div>
                    </div>
                    <ul class="nav nav-list menu-ul">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, Yii::$app->session->get('menu'), 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                        <li class="oneLevel">
                            <a data="<?php echo Yii::$app->request->hostInfo;?>
/<?php echo $_smarty_tpl->tpl_vars['v']->value['menuUrl'];?>
" class="dropdown-toggle">
                                <i class="icon-list <?php echo $_smarty_tpl->tpl_vars['v']->value['icon_class'];?>
"></i>
                                <span class="menu-text"><?php echo $_smarty_tpl->tpl_vars['v']->value['menuName'];?>
</span>
                                <b class="arrow icon-angle-down"></b>
                            </a>
                            <ul class="submenu">
                                <?php if (isset($_smarty_tpl->tpl_vars['v']->value['twoLevelMenu'])) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['v']->value['twoLevelMenu'], 'vv', false, 'kk');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['kk']->value => $_smarty_tpl->tpl_vars['vv']->value) {
?>
                                <li class="
                                    <?php if ($_smarty_tpl->tpl_vars['vv']->value['menuUrl'] == $_smarty_tpl->tpl_vars['this']->value->params['route'] || (isset($_smarty_tpl->tpl_vars['vv']->value['threeLevel']) && in_array($_smarty_tpl->tpl_vars['this']->value->params['route'],$_smarty_tpl->tpl_vars['vv']->value['threeLevel']))) {?>
                                    active
                                    <?php }?>"
                                    >
                                    <a class='pjax-href' data="/<?php echo $_smarty_tpl->tpl_vars['vv']->value['menuUrl'];?>
">
                                        <i class="icon-double-angle-right"></i>
                                        <?php echo $_smarty_tpl->tpl_vars['vv']->value['menuName'];?>

                                    </a>
                                </li>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                                <?php }?>
                            </ul>
                        </li>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
?>

                    </ul>
                    <div class="sidebar-collapse" id="sidebar-collapse">
                        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
                    </div>
                </div>
                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="icon-home home-icon"></i>
                                <a href="/admin/center">主页</a>
                            </li>
                        </ul>
                    </div>

                    <div class="page-content" id="container">
                        <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

                    </div>
                </div>
            </div>
            <div id="btn-float-top">
                <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="icon-double-angle-up icon-only bigger-110"></i>
                </a>
            </div>
        </div>

        <div class="isHide layui-layer-wrap"id="pwd-layer" style="display: none;">
            <div class="modal-body">
                <form  class="form-horizontal"   >
                    <fieldset>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">原始密码</label>
                            <div class="col-sm-9">
                                <input  type="password" id="oldPwd" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> 新密码 </label>
                            <div class="col-sm-9">
                                <input  type="password" id="newPwd" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"> 确认密码 </label>
                            <div class="col-sm-9">
                                <input  type="password" id="confirmPwd" class="form-control ">
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <input type="hidden" name="nowtime" value="<?php echo Yii::$app->view->params['time'];?>
" />
            <div class="modal-footer">
                <label>
                    <input id='updatePwd' type="submit" class="btn btn-info" value = "保存">
                </label>
            </div>
        </div>
    </body>
</html>
<?php echo '<script'; ?>
 type="text/javascript">
    window.onload = function(){
    var isSafari = navigator.userAgent.indexOf("Safari") > - 1 && navigator.userAgent.indexOf("Chrome") < 1;
    var scrollObj = $("#btn-float-top");
    var clientHeight = document.documentElement.clientHeight;
    var scrolltop = document.documentElement.scrollTop;
    if (isSafari){   //判断是否为safari浏览器
    scrolltop = document.body.scrollTop
    }
    //按钮初始的状态
    if (scrolltop > (clientHeight / 2)){
    scrollObj.show();
    }
    //页面滚动监控
    window.onscroll = function(){
    //重新获取窗口高度和滚动高度
    scrolltop = document.documentElement.scrollTop; //获取滚动高度
    clientHeight = window.innerHeight

            if (isSafari){
    scrolltop = document.body.scrollTop
            clientHeight = window.innerHeight
    }

    if (scrolltop > (clientHeight / 2)){
    scrollObj.fadeIn(500);
    } else{
    scrollObj.fadeOut(500);
    }
    }
    }


    //------------------在线会员人数---------------------
    $(function(){
    $.ajax({
    type: "post",
            url: '/other/online',
            data: '',
            async: true,
            beforeSend: function () {
            $('#online_user').html('加载中');
            },
            error: function () {
            $('#online_user').html('加载失败');
            },
            dataType: 'json',
            success: function (res) {
            if (res.ErrorCode == 2){
            $('#online_user').html('无权限查看');
            } else{
            var str = res + ' 人';
            $('#online_user').html(str);
            }
            }
    });
    })


            //在线会员推送
                    function connect() {
                    var host = 'ws://<?php echo Yii::$app->params['app_push_host_ws'];?>
';
                    ws = new WebSocket(host); //连接服务器

                    ws.onopen = function () {
                    var data = {};
                    data.cmd = 'join';
                    data.group_list = ['online'];
                    data.uid = "<?php echo Yii::$app->session->get('unikey');?>
";
                    ws.send(JSON.stringify(data));
                    };
                    ws.onmessage = function (event) {
                    var data = JSON.parse(event.data);
                    if (data.cmd == 'ping') {
                    var data = {};
                    data.cmd = 'pong';
                    ws.send(JSON.stringify(data));
                    } else if (data.cmd == 'online'){
                    $('#online_user').html(data.count + '人');
                    }
                    };
                    ws.onclose = function (event) {

                    };
                    }

            $(document).ready(function () {
            document.ws = connect();
            });








<?php echo '</script'; ?>
>
<?php }
}
