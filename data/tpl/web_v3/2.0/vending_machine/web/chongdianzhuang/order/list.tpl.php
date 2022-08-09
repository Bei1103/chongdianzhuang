<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_header', TEMPLATE_INCLUDEPATH)) : (include template('_header', TEMPLATE_INCLUDEPATH));?>
<style type='text/css'>
    .trhead td {  background:#efefef;text-align: center}
    .trbody td {  text-align: center; vertical-align:top;border-left:1px solid #f2f2f2;overflow: hidden; font-size:12px;}
    .trbody{border:1px solid #f2f2f2;}
    .trorder { background:#f8f8f8;border:1px solid #f2f2f2;text-align:left;}
    .ops { border-right:1px solid #f2f2f2; text-align: center;}
</style>

<div class="page-header">
    当前位置：<span class="text-primary">订单管理</span>
    <span>订单数:  <span class='text-danger'><?php  echo $total;?></span> 订单金额:  <span class='text-danger'>￥<?php  echo $totalmoney;?></span></span>

</div>
<div class="page-content">
    <form action="" method="get" class="form-horizontal table-search" role="form">

        <input type="hidden" name="c" value="site">
        <input type="hidden" name="a" value="entry">
        <input type="hidden" name="m" value="vending_machine">
        <input type="hidden" name="do" value="web">
        <input type="hidden" name="r" value="<?php  echo $_GPC['r'];?>">
        <input type="hidden" name="status" value="<?php  echo $status;?>">

        <div class="page-toolbar m-b-sm m-t-sm">
            <div class="col-sm-6">
                <?php  echo tpl_form_field_shop_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>
            </div>
            <div class="col-sm-6 pull-right">
                <div class="input-group">
                    <div class="input-group-select">
                        <select name="paytype" class="form-control" >
                            <option value="" <?php  if($_GPC['paytype']=='') { ?>selected<?php  } ?>>支付方式</option>
                            <?php  if(is_array($paytype)) { foreach($paytype as $key => $type) { ?>
                            <option value="<?php  echo $key;?>" <?php  if($_GPC['paytype'] == "$key") { ?> selected="selected" <?php  } ?>><?php  echo $type['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                    <div class="input-group-select">
                        <select name='searchtime'  class='form-control'   >
                            <option value=''>不按时间</option>
                            <option value='create' <?php  if($_GPC['searchtime']=='create') { ?>selected<?php  } ?>>下单时间</option>
                            <option value='pay' <?php  if($_GPC['searchtime']=='pay') { ?>selected<?php  } ?>>付款时间</option>
                        </select>
                    </div>
                    <div class="input-group-select">
                        <select name='searchfield'  class='form-control'  >
                            <option value='ordersn' <?php  if($_GPC['searchfield']=='ordersn') { ?>selected<?php  } ?>>订单号</option>
                            <option value='member' <?php  if($_GPC['searchfield']=='member') { ?>selected<?php  } ?>>会员信息</option>
                        </select>
                    </div>
                    <input type="text" class="form-control input-sm"  name="keyword" value="<?php  echo $_GPC['keyword'];?>" placeholder="请输入关键词"/>
                    <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit"> 搜索</button>
                    <button type="submit" name="export" value="1" class="btn btn-success ">导出</button>


                </span>
                </div>

            </div>
        </div>

    </form>


    <?php  if(count($list)>0) { ?>
    <table class='table table-responsive' style='table-layout: fixed;'>
        <tr style='background:#f8f8f8'>
            <td style='border-left:1px solid #f2f2f2;text-align: center;'>订单号</td>
            <td style='text-align: center;'>下单会员</td>
            <td style='text-align: center;'>端口</td>
            <td style='text-align: center;'>时长</td>
            <td style='text-align: center;'>价格</td>
            <td style='text-align: center;'>下单时间</td>
            <td style='width:90px;text-align: center'>状态</td>
            <td style='width:100px;text-align: center;'>操作</td>

        </tr>
        <?php  if(is_array($list)) { foreach($list as $item) { ?>
        <tr class='trbody'>
            <td><?php  echo $item['ordersn'];?></td>
            <td style='overflow:hidden;'><img src="<?php  echo tomedia($item['member']['thumb'])?>" style='width:50px;height:50px;border:1px solid #ccc; padding:1px;' onerror="this.src='../addons/vending_machine/static/images/nopic.png'"><br>【<?php  echo $item['member']['nickname'];?>】 <?php  echo $item['member']['mobile'];?></td>
            <td><?php  echo $item['por'];?></td>
            <td><?php  echo $item['otime'];?></td>
            <td>￥<?php  echo number_format($item['money'],2)?></td>
            <td><?php  echo date("Y-m-d H:i:s", $item['createtime'])?></td>

            <td  style='line-height:20px;text-align:center' >
                <span class='text-<?php  echo $item['statuscss'];?>'><?php  echo $item['status'];?></span><br /><?php  if($item['merchid'] == 0) { ?><?php  } ?>
            </td>
            <td  style='text-align:center' >
                <a class='op text-primary'  href="<?php  echo webUrl('order/detail', array('id' => $item['id']))?>" >查看详情</a><br/>
                <?php  if(!empty($item['refundid'])) { ?>
                <a class='op text-primary'  href="<?php  echo webUrl('order/op/refund', array('id' => $item['id']))?>" >维权<?php  if($item['refundstate']>0) { ?>处理<?php  } else { ?>详情<?php  } ?></a><br/>
                <?php  } ?>
                <?php  if($item['addressid']!=0 && $item['statusvalue']>=2) { ?>
                <a class='op text-primary'  data-toggle="ajaxModal" href="<?php  echo webUrl('util/express', array('id' => $item['id'],'express'=>$item['express'],'expresssn'=>$item['expresssn'],'mobile'=>$item['addressdata']['mobile']))?>"   >物流信息</a>
                <?php  } ?>

            </td>
        </tr>
        <?php  } } ?>
        <tr></tr>
    </table>
    <div style="text-align:right;width:100%;">
        <?php  echo $pager;?>
    </div>
    <?php  } else { ?>

    <div class='panel panel-default'>
        <div class='panel-body' style='text-align: center;padding:30px;'>
            暂时没有任何订单!
        </div>
    </div>
    <?php  } ?>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('_footer', TEMPLATE_INCLUDEPATH)) : (include template('_footer', TEMPLATE_INCLUDEPATH));?>
