<?php

if(!defined('IN_IA')) {
    exit('Access Denied');
}
return array(
    'version'=>'1.0',
    'id'=>'chongdianzhuang',
    'name'=>'充电桩',
    'v3'=>true,
    'menu'=>array(
        'title'=>'页面',
        'plugincom'=>1,
        'icon'=>'page',
        'items'=>array(
            array(
                'title'=>'首页',
                'items'=>array(
                    array(
                        'title'=>'系统首页',
                        'route'=>'bonus.status5'
                    ),
                    array(
                        'title'=>'账户设置',
                        'route'=>'bonus.status6'
                    ),
                    array(
                        'title'=>'系统消息',
                        'route'=>'bonus.status7'
                    ),
                )
            ),
            array(
                'title'=>'库存',
                'items'=>array(
                    array(
                        'title'=>'设备库存',
                        'route'=>'bonus.status8'
                    ),
                    array(
                        'title'=>'添加库存',
                        'route'=>'bonus.status9'
                    ),
                )
            ),
            array(
                'title'=>'商户',
                'items'=>array(
                    array(
                        'title'=>'运营商家',
                        'route'=>'bonus.status12'
                    ),
                    array(
                        'title'=>'添加商家',
                        'route'=>'bonus.status13'
                    ),
                )
            ),
            array(
                'title'=>'设备',
                'items'=>array(
                    array(
                        'title'=>'十路充电桩',
                        'route'=>'bonus.status0'
                    ),
                    array(
                        'title'=>'阿里云充电桩',
                        'route'=>'bonus.status1'
                    ),
                    array(
                        'title'=>'家和充电桩',
                        'route'=>'bonus.status2'
                    ),
                )
            ),
            array(
                'title'=>'用户',
                'items'=>array(
                    array(
                        'title'=>'会员/分佣管理',
                        'route'=>'bonus.status14'
                    ),
                    array(
                        'title'=>'用户列表',
                        'route'=>'bonus.status15'
                    ),
                )
            ),
            array(
                'title'=>'订单',
                'items'=>array(
                    array(
                        'title'=>'订单列表',
                        'route'=>'bonus.status20'
                    ),
                )
            ),
            array(
                'title'=>'商城',
                'items'=>array(
                    array(
                        'title'=>'商品分类',
                        'route'=>'bonus.status16'
                    ),
                    array(
                        'title'=>'商品管理',
                        'route'=>'bonus.status17'
                    ),

                )
            ),
            array(
                'title'=>'数据',
                'items'=>array(
                    array(
                        'title'=>'财务报表',
                        'route'=>'bonus.status22'
                    ),
                ),
            ),

        )
    )
);

