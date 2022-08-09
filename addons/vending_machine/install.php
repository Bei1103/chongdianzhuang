<?php

$sql = "
    DROP TABLE IF EXISTS `ims_vending_machine_abonus_bill`;
CREATE TABLE `ims_vending_machine_abonus_bill` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `billno` varchar(100) DEFAULT '',
  `paytype` int(11) DEFAULT '0',
  `year` int(11) DEFAULT '0',
  `month` int(11) DEFAULT '0',
  `week` int(11) DEFAULT '0',
  `ordercount` int(11) DEFAULT '0',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `paytime` int(11) DEFAULT '0',
  `aagentcount1` int(11) DEFAULT '0',
  `aagentcount2` int(11) DEFAULT '0',
  `aagentcount3` int(11) DEFAULT '0',
  `bonusmoney1` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send1` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay1` decimal(10,2) DEFAULT '0.00',
  `bonusmoney2` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send2` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay2` decimal(10,2) DEFAULT '0.00',
  `bonusmoney3` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send3` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay3` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `confirmtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_abonus_billp`;
CREATE TABLE `ims_vending_machine_abonus_billp` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `payno` varchar(255) DEFAULT '',
  `paytype` tinyint(3) DEFAULT '0',
  `bonus1` decimal(10,4) DEFAULT '0.0000',
  `bonus2` decimal(10,4) DEFAULT '0.0000',
  `bonus3` decimal(10,4) DEFAULT '0.0000',
  `money1` decimal(10,2) DEFAULT '0.00',
  `realmoney1` decimal(10,2) DEFAULT '0.00',
  `paymoney1` decimal(10,2) DEFAULT '0.00',
  `money2` decimal(10,2) DEFAULT '0.00',
  `realmoney2` decimal(10,2) DEFAULT '0.00',
  `paymoney2` decimal(10,2) DEFAULT '0.00',
  `money3` decimal(10,2) DEFAULT '0.00',
  `realmoney3` decimal(10,2) DEFAULT '0.00',
  `paymoney3` decimal(10,2) DEFAULT '0.00',
  `chargemoney1` decimal(10,2) DEFAULT '0.00',
  `chargemoney2` decimal(10,2) DEFAULT '0.00',
  `chargemoney3` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `status` tinyint(3) DEFAULT '0',
  `reason` varchar(255) DEFAULT '',
  `paytime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_abonus_level`;
CREATE TABLE `ims_vending_machine_abonus_level` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `levelname` varchar(50) DEFAULT '',
  `bonus1` decimal(10,4) DEFAULT '0.0000',
  `bonus2` decimal(10,4) DEFAULT '0.0000',
  `bonus3` decimal(10,4) DEFAULT '0.0000',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(11) DEFAULT '0',
  `bonusmoney` decimal(10,2) DEFAULT '0.00',
  `downcount` int(11) DEFAULT '0',
  `commissionmoney` decimal(10,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_address_applyfor`;
CREATE TABLE `ims_vending_machine_address_applyfor` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(11) DEFAULT NULL,
  `data` text,
  `orderid` int(11) DEFAULT NULL,
  `ordersn` varchar(255) DEFAULT NULL,
  `isdispose` tinyint(1) DEFAULT '0',
  `message` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `ispass` tinyint(1) DEFAULT '0',
  `isdelete` tinyint(4) DEFAULT '0',
  `isall` tinyint(4) DEFAULT '0',
  `old_address` text,
  `cycleid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_adv`;
CREATE TABLE `ims_vending_machine_adv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `shopid` int(11) DEFAULT '0',
  `iswxapp` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_area_config`;
CREATE TABLE `ims_vending_machine_area_config` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `new_area` tinyint(3) NOT NULL DEFAULT '0',
  `address_street` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_article`;
CREATE TABLE `ims_vending_machine_article` (
`id` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL DEFAULT '',
  `resp_desc` text NOT NULL,
  `resp_img` text NOT NULL,
  `article_content` longtext,
  `article_category` int(11) NOT NULL DEFAULT '0',
  `article_date_v` varchar(20) NOT NULL DEFAULT '',
  `article_date` varchar(20) NOT NULL DEFAULT '',
  `article_mp` varchar(50) NOT NULL DEFAULT '',
  `article_author` varchar(20) NOT NULL DEFAULT '',
  `article_readnum_v` int(11) NOT NULL DEFAULT '0',
  `article_readnum` int(11) NOT NULL DEFAULT '0',
  `article_likenum_v` int(11) NOT NULL DEFAULT '0',
  `article_likenum` int(11) NOT NULL DEFAULT '0',
  `article_linkurl` varchar(300) NOT NULL DEFAULT '',
  `article_rule_daynum` int(11) NOT NULL DEFAULT '0',
  `article_rule_allnum` int(11) NOT NULL DEFAULT '0',
  `article_rule_credit` int(11) NOT NULL DEFAULT '0',
  `article_rule_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `page_set_option_nocopy` int(1) NOT NULL DEFAULT '0',
  `page_set_option_noshare_tl` int(1) NOT NULL DEFAULT '0',
  `page_set_option_noshare_msg` int(1) NOT NULL DEFAULT '0',
  `article_keyword` varchar(255) NOT NULL DEFAULT '',
  `article_keyword2` varchar(255) NOT NULL DEFAULT '',
  `article_report` int(1) NOT NULL DEFAULT '0',
  `product_advs_type` int(1) NOT NULL DEFAULT '0',
  `product_advs_title` varchar(255) NOT NULL DEFAULT '',
  `product_advs_more` varchar(255) NOT NULL DEFAULT '',
  `product_advs_link` varchar(255) NOT NULL DEFAULT '',
  `product_advs` text NOT NULL,
  `article_state` int(1) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `network_attachment` varchar(255) DEFAULT '',
  `article_rule_credittotal` int(11) DEFAULT '0',
  `article_rule_moneytotal` decimal(10,2) DEFAULT '0.00',
  `article_rule_credit2` int(11) NOT NULL DEFAULT '0',
  `article_rule_money2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `article_rule_creditm` int(11) NOT NULL DEFAULT '0',
  `article_rule_moneym` decimal(10,2) NOT NULL DEFAULT '0.00',
  `article_rule_creditm2` int(11) NOT NULL DEFAULT '0',
  `article_rule_moneym2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `article_readtime` int(11) DEFAULT '0',
  `article_areas` varchar(255) DEFAULT '',
  `article_endtime` int(11) DEFAULT '0',
  `article_hasendtime` tinyint(3) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `article_advance` int(11) DEFAULT '0',
  `article_virtualadd` tinyint(3) DEFAULT '0',
  `article_visit` tinyint(3) DEFAULT '0',
  `article_visit_level` text,
  `article_visit_tip` varchar(500) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='营销文章' ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_article_category`;
CREATE TABLE `ims_vending_machine_article_category` (
`id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL DEFAULT '',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `isshow` tinyint(1) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='营销表单分类' ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_article_log`;
CREATE TABLE `ims_vending_machine_article_log` (
`id` int(11) NOT NULL,
  `aid` int(11) NOT NULL DEFAULT '0',
  `read` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `uniacid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='点赞/阅读记录' ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_article_report`;
CREATE TABLE `ims_vending_machine_article_report` (
`id` int(11) NOT NULL,
  `mid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `aid` int(11) DEFAULT '0',
  `cate` varchar(255) NOT NULL DEFAULT '',
  `cons` varchar(255) NOT NULL DEFAULT '',
  `uniacid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户举报记录' ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_article_share`;
CREATE TABLE `ims_vending_machine_article_share` (
`id` int(11) NOT NULL,
  `aid` int(11) NOT NULL DEFAULT '0',
  `share_user` int(11) NOT NULL DEFAULT '0',
  `click_user` int(11) NOT NULL DEFAULT '0',
  `click_date` varchar(20) NOT NULL DEFAULT '',
  `add_credit` int(11) NOT NULL DEFAULT '0',
  `add_money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `uniacid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户分享数据' ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_article_sys`;
CREATE TABLE `ims_vending_machine_article_sys` (
`uniacid` int(11) NOT NULL DEFAULT '0',
  `article_message` varchar(255) NOT NULL DEFAULT '',
  `article_title` varchar(255) NOT NULL DEFAULT '',
  `article_image` varchar(300) NOT NULL DEFAULT '',
  `article_shownum` int(11) NOT NULL DEFAULT '0',
  `article_keyword` varchar(255) NOT NULL DEFAULT '',
  `article_source` varchar(255) NOT NULL DEFAULT '',
  `article_temp` int(11) NOT NULL DEFAULT '0',
  `article_close_advanced` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章设置' ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_banner`;
CREATE TABLE `ims_vending_machine_banner` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `bannername` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `shopid` int(11) DEFAULT '0',
  `iswxapp` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_bargain_account`;
CREATE TABLE `ims_vending_machine_bargain_account` (
`id` int(11) NOT NULL,
  `mall_name` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `mall_title` varchar(255) DEFAULT NULL,
  `mall_content` varchar(255) DEFAULT NULL,
  `mall_logo` varchar(255) DEFAULT NULL,
  `message` int(11) DEFAULT '0',
  `partin` int(11) DEFAULT '0',
  `rule` text,
  `end_message` int(11) DEFAULT '0',
  `follow_swi` tinyint(1) NOT NULL DEFAULT '0',
  `sharestyle` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_bargain_actor`;
CREATE TABLE `ims_vending_machine_bargain_actor` (
`id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `now_price` decimal(9,2) NOT NULL,
  `created_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `bargain_times` int(10) NOT NULL,
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(20) NOT NULL,
  `head_image` varchar(200) NOT NULL,
  `bargain_price` decimal(9,2) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `account_id` int(11) NOT NULL,
  `initiate` tinyint(4) NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_bargain_goods`;
CREATE TABLE `ims_vending_machine_bargain_goods` (
`id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `goods_id` varchar(20) NOT NULL,
  `end_price` decimal(10,2) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` tinyint(2) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `user_set` text,
  `rule` text,
  `act_times` int(11) NOT NULL,
  `mode` tinyint(4) NOT NULL,
  `total_time` int(11) NOT NULL,
  `each_time` int(11) NOT NULL,
  `time_limit` int(11) NOT NULL,
  `probability` text NOT NULL,
  `custom` varchar(255) DEFAULT NULL,
  `maximum` int(11) DEFAULT NULL,
  `initiate` tinyint(4) NOT NULL DEFAULT '0',
  `myself` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_bargain_record`;
CREATE TABLE `ims_vending_machine_bargain_record` (
`id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL,
  `bargain_price` decimal(9,2) NOT NULL,
  `openid` varchar(50) NOT NULL DEFAULT '',
  `nickname` varchar(20) NOT NULL,
  `head_image` varchar(200) NOT NULL,
  `bargain_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_category`;
CREATE TABLE `ims_vending_machine_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `parentid` int(11) DEFAULT '0',
  `isrecommand` int(10) DEFAULT '0',
  `description` varchar(500) DEFAULT NULL,
  `displayorder` tinyint(3) UNSIGNED DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `ishome` tinyint(3) DEFAULT '0',
  `level` tinyint(3) DEFAULT NULL,
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_city_express`;
CREATE TABLE `ims_vending_machine_city_express` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `start_fee` decimal(10,2) DEFAULT '0.00',
  `start_km` int(11) DEFAULT '0',
  `pre_km` int(11) DEFAULT '0',
  `pre_km_fee` decimal(10,2) DEFAULT '0.00',
  `fixed_km` int(11) DEFAULT '0',
  `fixed_fee` decimal(10,2) DEFAULT '0.00',
  `receive_goods` int(11) DEFAULT NULL,
  `lng` varchar(255) DEFAULT '',
  `lat` varchar(255) DEFAULT '',
  `range` int(11) DEFAULT '0',
  `zoom` int(11) NOT NULL DEFAULT '13',
  `express_type` int(11) NOT NULL DEFAULT '0',
  `config` varchar(255) NOT NULL DEFAULT '',
  `tel1` varchar(255) DEFAULT '',
  `tel2` varchar(255) DEFAULT '',
  `is_sum` tinyint(1) DEFAULT '0',
  `is_dispatch` tinyint(1) DEFAULT '1',
  `enabled` tinyint(1) DEFAULT '0',
  `geo_key` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_apply`;
CREATE TABLE `ims_vending_machine_commission_apply` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `applyno` varchar(255) DEFAULT '',
  `mid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `orderids` longtext,
  `commission` decimal(10,2) DEFAULT '0.00',
  `commission_pay` decimal(10,2) DEFAULT '0.00',
  `content` text,
  `status` tinyint(3) DEFAULT '0',
  `applytime` int(11) DEFAULT '0',
  `checktime` int(11) DEFAULT '0',
  `paytime` int(11) DEFAULT '0',
  `invalidtime` int(11) DEFAULT '0',
  `refusetime` int(11) DEFAULT '0',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `deductionmoney` decimal(10,2) DEFAULT '0.00',
  `beginmoney` decimal(10,2) DEFAULT '0.00',
  `endmoney` decimal(10,2) DEFAULT '0.00',
  `alipay` varchar(50) NOT NULL DEFAULT '',
  `bankname` varchar(50) NOT NULL DEFAULT '',
  `bankcard` varchar(50) NOT NULL DEFAULT '',
  `alipay1` varchar(50) NOT NULL DEFAULT '',
  `bankname1` varchar(50) NOT NULL DEFAULT '',
  `bankcard1` varchar(50) NOT NULL DEFAULT '',
  `repurchase` decimal(10,2) DEFAULT '0.00',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `sendmoney` decimal(10,2) DEFAULT '0.00',
  `senddata` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_bank`;
CREATE TABLE `ims_vending_machine_commission_bank` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `bankname` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_clickcount`;
CREATE TABLE `ims_vending_machine_commission_clickcount` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `from_openid` varchar(255) DEFAULT '',
  `clicktime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_level`;
CREATE TABLE `ims_vending_machine_commission_level` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `levelname` varchar(50) DEFAULT '',
  `commission1` decimal(10,2) DEFAULT '0.00',
  `commission2` decimal(10,2) DEFAULT '0.00',
  `commission3` decimal(10,2) DEFAULT '0.00',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(11) DEFAULT '0',
  `downcount` int(11) DEFAULT '0',
  `commissionmoney` decimal(10,2) DEFAULT '0.00',
  `goodsids` varchar(1000) DEFAULT '',
  `goodsids_text` varchar(2000) NOT NULL DEFAULT '',
  `level` int(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_log`;
CREATE TABLE `ims_vending_machine_commission_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `applyid` int(11) DEFAULT '0',
  `mid` int(11) DEFAULT '0',
  `commission` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `commission_pay` decimal(10,2) DEFAULT '0.00',
  `type` tinyint(3) DEFAULT '0',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `deductionmoney` decimal(10,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_rank`;
CREATE TABLE `ims_vending_machine_commission_rank` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `num` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_relation`;
CREATE TABLE `ims_vending_machine_commission_relation` (
`id` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `level` tinyint(1) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_repurchase`;
CREATE TABLE `ims_vending_machine_commission_repurchase` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `year` int(4) DEFAULT '0',
  `month` tinyint(2) DEFAULT '0',
  `repurchase` decimal(10,2) DEFAULT '0.00',
  `applyid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_commission_shop`;
CREATE TABLE `ims_vending_machine_commission_shop` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `mid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `img` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT '',
  `selectgoods` tinyint(3) DEFAULT '0',
  `selectcategory` tinyint(3) DEFAULT '0',
  `goodsids` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon`;
CREATE TABLE `ims_vending_machine_coupon` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `catid` int(11) DEFAULT '0',
  `couponname` varchar(255) DEFAULT '',
  `gettype` tinyint(3) DEFAULT '0',
  `getmax` int(11) DEFAULT '0',
  `usetype` tinyint(3) DEFAULT '0',
  `returntype` tinyint(3) DEFAULT '0',
  `bgcolor` varchar(255) DEFAULT '',
  `enough` decimal(10,2) DEFAULT '0.00',
  `timelimit` tinyint(3) DEFAULT '0',
  `coupontype` tinyint(3) DEFAULT '0',
  `timedays` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `discount` decimal(10,2) DEFAULT '0.00',
  `deduct` decimal(10,2) DEFAULT '0.00',
  `backtype` tinyint(3) DEFAULT '0',
  `backmoney` varchar(50) DEFAULT '',
  `backcredit` varchar(50) DEFAULT '',
  `backredpack` varchar(50) DEFAULT '',
  `backwhen` tinyint(3) DEFAULT '0',
  `thumb` varchar(255) DEFAULT '',
  `desc` text,
  `createtime` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `respdesc` text,
  `respthumb` varchar(255) DEFAULT '',
  `resptitle` varchar(255) DEFAULT '',
  `respurl` varchar(255) DEFAULT '',
  `credit` int(11) DEFAULT '0',
  `usecredit2` tinyint(3) DEFAULT '0',
  `remark` varchar(1000) DEFAULT '',
  `descnoset` tinyint(3) DEFAULT '0',
  `pwdkey` varchar(255) DEFAULT '',
  `pwdkey2` varchar(255) DEFAULT '',
  `pwdsuc` text,
  `pwdfail` text,
  `pwdurl` varchar(255) DEFAULT '',
  `pwdask` text,
  `pwdstatus` tinyint(3) DEFAULT '0',
  `pwdtimes` int(11) DEFAULT '0',
  `pwdfull` text,
  `pwdwords` text,
  `pwdopen` tinyint(3) DEFAULT '0',
  `pwdown` text,
  `pwdexit` varchar(255) DEFAULT '',
  `pwdexitstr` text,
  `displayorder` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `limitgoodtype` tinyint(1) DEFAULT '0',
  `limitgoodcatetype` tinyint(1) DEFAULT '0',
  `limitgoodcateids` varchar(500) DEFAULT '',
  `limitgoodids` varchar(500) DEFAULT '',
  `islimitlevel` tinyint(1) DEFAULT '0',
  `limitmemberlevels` varchar(500) DEFAULT '',
  `limitagentlevels` varchar(500) DEFAULT '',
  `limitpartnerlevels` varchar(500) DEFAULT '',
  `limitaagentlevels` varchar(500) DEFAULT '',
  `tagtitle` varchar(20) DEFAULT '',
  `settitlecolor` tinyint(1) DEFAULT '0',
  `titlecolor` varchar(10) DEFAULT '',
  `limitdiscounttype` tinyint(1) DEFAULT '1',
  `quickget` tinyint(1) DEFAULT '0',
  `templateid` varchar(60) DEFAULT '0',
  `isfriendcoupon` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_category`;
CREATE TABLE `ims_vending_machine_coupon_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_data`;
CREATE TABLE `ims_vending_machine_coupon_data` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `couponid` int(11) DEFAULT '0',
  `gettype` tinyint(3) DEFAULT '0',
  `used` int(11) DEFAULT '0',
  `usetime` int(11) DEFAULT '0',
  `gettime` int(11) DEFAULT '0',
  `senduid` int(11) DEFAULT '0',
  `ordersn` varchar(255) DEFAULT '',
  `back` tinyint(3) DEFAULT '0',
  `backtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `isnew` tinyint(1) DEFAULT '1',
  `nocount` tinyint(1) DEFAULT '1',
  `shareident` varchar(50) DEFAULT NULL,
  `textkey` int(11) DEFAULT NULL,
  `friendcouponid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_goodsendtask`;
CREATE TABLE `ims_vending_machine_coupon_goodsendtask` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `goodsid` int(11) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `sendnum` int(11) DEFAULT '1',
  `num` int(11) DEFAULT '0',
  `sendpoint` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_guess`;
CREATE TABLE `ims_vending_machine_coupon_guess` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `times` int(11) DEFAULT '0',
  `pwdkey` varchar(255) DEFAULT '',
  `ok` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_log`;
CREATE TABLE `ims_vending_machine_coupon_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `logno` varchar(255) DEFAULT '',
  `openid` varchar(255) DEFAULT '',
  `couponid` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `paystatus` tinyint(3) DEFAULT '0',
  `creditstatus` tinyint(3) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `paytype` tinyint(3) DEFAULT '0',
  `getfrom` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_sendshow`;
CREATE TABLE `ims_vending_machine_coupon_sendshow` (
`id` int(11) NOT NULL,
  `showkey` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `coupondataid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_sendtasks`;
CREATE TABLE `ims_vending_machine_coupon_sendtasks` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `enough` decimal(10,2) DEFAULT '0.00',
  `couponid` int(11) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `sendnum` int(11) DEFAULT '1',
  `num` int(11) DEFAULT '0',
  `sendpoint` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_taskdata`;
CREATE TABLE `ims_vending_machine_coupon_taskdata` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  `taskid` int(11) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `sendnum` int(11) DEFAULT '0',
  `tasktype` tinyint(1) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `parentorderid` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `sendpoint` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_coupon_usesendtasks`;
CREATE TABLE `ims_vending_machine_coupon_usesendtasks` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `usecouponid` int(11) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `sendnum` int(11) DEFAULT '1',
  `num` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_adv`;
CREATE TABLE `ims_vending_machine_creditshop_adv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_category`;
CREATE TABLE `ims_vending_machine_creditshop_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` tinyint(3) UNSIGNED DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT '',
  `isrecommand` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_comment`;
CREATE TABLE `ims_vending_machine_creditshop_comment` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `logid` int(11) NOT NULL DEFAULT '0',
  `logno` varchar(50) NOT NULL DEFAULT '',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `headimg` varchar(255) DEFAULT NULL,
  `level` tinyint(3) NOT NULL DEFAULT '0',
  `content` varchar(255) DEFAULT NULL,
  `images` text,
  `time` int(11) NOT NULL DEFAULT '0',
  `reply_content` varchar(255) DEFAULT NULL,
  `reply_images` text,
  `reply_time` int(11) NOT NULL DEFAULT '0',
  `append_content` varchar(255) DEFAULT NULL,
  `append_images` text,
  `append_time` int(11) NOT NULL DEFAULT '0',
  `append_reply_content` varchar(255) DEFAULT NULL,
  `append_reply_images` text,
  `append_reply_time` int(11) NOT NULL DEFAULT '0',
  `istop` tinyint(3) NOT NULL DEFAULT '0',
  `checked` tinyint(3) NOT NULL DEFAULT '0',
  `append_checked` tinyint(3) NOT NULL DEFAULT '0',
  `virtual` tinyint(3) NOT NULL DEFAULT '0',
  `deleted` tinyint(3) NOT NULL DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_goods`;
CREATE TABLE `ims_vending_machine_creditshop_goods` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `cate` int(11) DEFAULT '0',
  `thumb` varchar(255) DEFAULT '',
  `price` decimal(10,2) DEFAULT '0.00',
  `type` tinyint(3) DEFAULT '0',
  `credit` int(11) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `totalday` int(11) DEFAULT '0',
  `chance` int(11) DEFAULT '0',
  `chanceday` int(11) DEFAULT '0',
  `detail` text,
  `rate1` int(11) DEFAULT '0',
  `rate2` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `joins` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `showlevels` text,
  `buylevels` text,
  `showgroups` text,
  `buygroups` text,
  `vip` tinyint(3) DEFAULT '0',
  `istop` tinyint(3) DEFAULT '0',
  `isrecommand` tinyint(3) DEFAULT '0',
  `istime` tinyint(3) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `share_title` varchar(255) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `share_desc` varchar(500) DEFAULT '',
  `followneed` tinyint(3) DEFAULT '0',
  `followtext` varchar(255) DEFAULT '',
  `subtitle` varchar(255) DEFAULT '',
  `subdetail` text,
  `noticedetail` text,
  `usedetail` varchar(255) DEFAULT '',
  `goodsdetail` text,
  `isendtime` tinyint(3) DEFAULT '0',
  `usecredit2` tinyint(3) DEFAULT '0',
  `area` varchar(255) DEFAULT '',
  `dispatch` decimal(10,2) DEFAULT '0.00',
  `storeids` text,
  `noticeopenid` varchar(255) DEFAULT '',
  `noticetype` tinyint(3) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `goodstype` tinyint(3) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `productprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `mincredit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `minmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maxcredit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maxmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dispatchtype` tinyint(3) NOT NULL DEFAULT '0',
  `dispatchid` int(11) NOT NULL DEFAULT '0',
  `verifytype` tinyint(3) NOT NULL DEFAULT '0',
  `verifynum` int(11) NOT NULL DEFAULT '0',
  `grant1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `grant2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goodssn` varchar(255) NOT NULL,
  `productsn` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `showtotal` tinyint(3) NOT NULL,
  `totalcnf` tinyint(3) NOT NULL DEFAULT '0',
  `usetime` int(11) NOT NULL DEFAULT '0',
  `hasoption` tinyint(3) NOT NULL DEFAULT '0',
  `noticedetailshow` tinyint(3) NOT NULL DEFAULT '0',
  `detailshow` tinyint(3) NOT NULL DEFAULT '0',
  `packetmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `surplusmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `packetlimit` decimal(10,2) NOT NULL DEFAULT '0.00',
  `packettype` tinyint(3) NOT NULL DEFAULT '0',
  `minpacketmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `packettotal` int(11) NOT NULL DEFAULT '0',
  `packetsurplus` int(11) NOT NULL DEFAULT '0',
  `maxpacketmoney` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_log`;
CREATE TABLE `ims_vending_machine_creditshop_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `logno` varchar(255) DEFAULT '',
  `eno` varchar(255) DEFAULT '',
  `openid` varchar(255) DEFAULT '',
  `goodsid` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `paystatus` tinyint(3) DEFAULT '0',
  `paytype` tinyint(3) DEFAULT '-1',
  `dispatchstatus` tinyint(3) DEFAULT '0',
  `creditpay` tinyint(3) DEFAULT '0',
  `addressid` int(11) DEFAULT '0',
  `dispatchno` varchar(255) DEFAULT '',
  `usetime` int(11) DEFAULT '0',
  `express` varchar(255) DEFAULT '',
  `expresssn` varchar(255) DEFAULT '',
  `expresscom` varchar(255) DEFAULT '',
  `verifyopenid` varchar(255) DEFAULT '',
  `transid` varchar(255) DEFAULT '',
  `dispatchtransid` varchar(255) DEFAULT '',
  `storeid` int(11) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `couponid` int(11) DEFAULT '0',
  `dupdate1` tinyint(3) DEFAULT '0',
  `address` text,
  `optionid` int(11) NOT NULL DEFAULT '0',
  `time_send` int(11) NOT NULL DEFAULT '0',
  `time_finish` int(11) NOT NULL DEFAULT '0',
  `iscomment` tinyint(3) NOT NULL DEFAULT '0',
  `dispatchtime` int(11) NOT NULL DEFAULT '0',
  `verifynum` int(11) NOT NULL DEFAULT '1',
  `verifytime` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `remarksaler` text,
  `dispatch` decimal(10,2) DEFAULT '0.00',
  `money` decimal(10,2) DEFAULT '0.00',
  `credit` int(11) DEFAULT '0',
  `goods_num` int(11) DEFAULT '0',
  `merchapply` tinyint(4) NOT NULL DEFAULT '0',
  `pay_time` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_option`;
CREATE TABLE `ims_vending_machine_creditshop_option` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `credit` int(10) NOT NULL DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  `skuId` varchar(255) DEFAULT '',
  `goodssn` varchar(255) DEFAULT '',
  `productsn` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0',
  `exchange_stock` int(11) NOT NULL DEFAULT '-1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_spec`;
CREATE TABLE `ims_vending_machine_creditshop_spec` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `description` varchar(1000) DEFAULT '',
  `displaytype` tinyint(3) DEFAULT '0',
  `content` text,
  `displayorder` int(11) DEFAULT '0',
  `propId` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_spec_item`;
CREATE TABLE `ims_vending_machine_creditshop_spec_item` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `valueId` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_creditshop_verify`;
CREATE TABLE `ims_vending_machine_creditshop_verify` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(45) DEFAULT '0',
  `logid` int(11) DEFAULT '0',
  `verifycode` varchar(45) DEFAULT NULL,
  `storeid` int(11) DEFAULT '0',
  `verifier` varchar(45) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `verifytime` int(11) DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_datatransfer`;
CREATE TABLE `ims_vending_machine_datatransfer` (
`id` int(11) NOT NULL,
  `fromuniacid` int(11) DEFAULT NULL,
  `touniacid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_device`;
CREATE TABLE `ims_vending_machine_device` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `enabled` tinyint(1) DEFAULT '0',
  `is_reg` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1已入库',
  `imei` varchar(128) NOT NULL,
  `createtime` int(11) NOT NULL,
  `province` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `area` varchar(128) NOT NULL,
  `address` varchar(255) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `onlinetime` int(11) NOT NULL COMMENT '上线时间',
  `project` varchar(64) NOT NULL COMMENT '产品代号',
  `version` varchar(32) NOT NULL COMMENT '软件版本',
  `rssi` varchar(32) NOT NULL COMMENT '信号强度',
  `offlinetime` int(11) NOT NULL COMMENT '离线时间',
  `msgtime` int(11) NOT NULL COMMENT '最后通讯时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_device` (`id`, `uniacid`, `name`, `enabled`, `is_reg`, `imei`, `createtime`, `province`, `city`, `area`, `address`, `online`, `onlinetime`, `project`, `version`, `rssi`, `offlinetime`, `msgtime`) VALUES
(1, 1, '按时发放的', 1, 1, '866714045155099', 1600021543, '', '', '', 'asdfasdfasdf', 0, 0, '', '', '', 0, 0),
(2, 1, '金龙鱼理想1号', 1, 1, '866714045143194', 1600021741, '', '', '', '', 1, 0, '', '', '16', 0, 1601231217),
(3, 1, '世贸1号', 1, 1, '866262049473894', 1600182852, '', '', '', '', 1, 1600884372, 'GSFT', '1.0.01', '24', 1600884204, 1601231237);

DROP TABLE IF EXISTS `ims_vending_machine_device_lock`;
CREATE TABLE `ims_vending_machine_device_lock` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `device_id` int(11) NOT NULL,
  `senid` int(11) NOT NULL COMMENT '传感器序列号',
  `action` int(11) NOT NULL COMMENT '当前动作:0-空闲,1-购物,2-补货,3-维护,4-禁用',
  `orderid` int(11) NOT NULL COMMENT '订单id',
  `status_l` tinyint(1) NOT NULL COMMENT '锁状态',
  `status_m` tinyint(1) NOT NULL COMMENT '磁状态',
  `locktime_l` int(11) NOT NULL COMMENT '关门上锁时间',
  `locktime_m` int(11) NOT NULL COMMENT '未开门上锁时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_device_lock` (`id`, `uniacid`, `name`, `device_id`, `senid`, `action`, `orderid`, `status_l`, `status_m`, `locktime_l`, `locktime_m`) VALUES
(5, 1, 'asdf', 1, 2293765, 0, 0, 0, 0, 0, 0),
(6, 1, '噶是否阿斯蒂芬', 2, 2293765, 0, 0, 0, 0, 0, 0);

DROP TABLE IF EXISTS `ims_vending_machine_device_remote`;
CREATE TABLE `ims_vending_machine_device_remote` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `imei` varchar(128) NOT NULL,
  `online` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_device_remote` (`id`, `uniacid`, `name`, `imei`, `online`) VALUES
(1, 1, '未知设备2', '866714041467514', 0),
(2, 1, '未知设备', '866714043049146', 0),
(3, 1, '123123', '123456789012345', 0),
(4, 1, '创C4测', '866262048355571', 0),
(5, 1, '测创C4', '866262049473894', 1),
(6, 1, '55099', '866714045155099', 0),
(7, 1, '创客城2号', '866714043049104', 0),
(8, 1, '嗨畅酒吧双门', '866714043049138', 0),
(9, 1, '金龙理想1号', '866714045143194', 1),
(10, 1, '福建厦门', '866714045149233', 0),
(11, 1, '福建厦门', '866714045143079', 0),
(12, 1, '嗨畅酒吧', '866714045149159', 0),
(13, 1, '麻将馆', '866714045149225', 0),
(14, 1, '广州样机开达', '866714045149274', 0),
(15, 1, '开达工业园', '866714045155131', 1);

DROP TABLE IF EXISTS `ims_vending_machine_device_scales`;
CREATE TABLE `ims_vending_machine_device_scales` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '屏显',
  `device_id` int(11) NOT NULL,
  `senid` int(11) NOT NULL COMMENT '传感器序列号',
  `lock_id` int(11) NOT NULL COMMENT '门锁id',
  `goodsid` int(11) NOT NULL COMMENT '产品id',
  `gravity_now` int(11) NOT NULL COMMENT '当前重力值',
  `gravity_init` int(11) NOT NULL COMMENT '去皮重力值',
  `coefficient` float(8,2) NOT NULL COMMENT '重力系数',
  `sensitivity` int(11) NOT NULL COMMENT '灵敏度',
  `sensitivity_time` int(11) NOT NULL COMMENT '灵敏度浮动时间',
  `bindtime` int(11) NOT NULL COMMENT '绑定时间',
  `level` int(11) NOT NULL COMMENT '所在层'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_device_scales` (`id`, `uniacid`, `title`, `device_id`, `senid`, `lock_id`, `goodsid`, `gravity_now`, `gravity_init`, `coefficient`, `sensitivity`, `sensitivity_time`, `bindtime`, `level`) VALUES
(42, 1, '', 2, 1146883, 0, 0, 9349049, 0, 0.00, 0, 0, 0, 2),
(43, 1, '', 2, 1507365, 0, 0, 8710535, 0, 0.00, 0, 0, 0, 0),
(44, 1, '', 2, 2687014, 0, 0, 9044128, 0, 0.00, 0, 0, 0, 0),
(45, 1, '', 2, 2490399, 0, 0, 9881408, 0, 0.00, 0, 0, 0, 0),
(46, 1, 'asdf', 2, 524325, 6, 2, 9438914, 12312, 19101.04, 0, 0, 0, 1),
(47, 1, '', 2, 1376305, 0, 0, 8613393, 0, 0.00, 0, 0, 0, 0),
(48, 1, '', 2, 2621488, 0, 0, 8825664, 0, 0.00, 0, 0, 0, 0),
(49, 1, '', 2, 3473435, 0, 0, 9762640, 0, 0.00, 0, 0, 0, 0),
(50, 1, '', 2, 3276812, 0, 0, 8681855, 0, 0.00, 0, 0, 0, 0),
(51, 1, '', 2, 2228226, 0, 0, 9335324, 0, 0.00, 0, 0, 0, 0),
(52, 1, '', 2, 1638416, 0, 0, 8671222, 0, 0.00, 0, 0, 0, 0),
(53, 1, '', 2, 1769510, 0, 0, 8628900, 0, 0.00, 0, 0, 0, 0),
(54, 1, '', 2, 1966116, 0, 0, 9519196, 0, 0.00, 0, 0, 0, 0);

DROP TABLE IF EXISTS `ims_vending_machine_dispatch`;
CREATE TABLE `ims_vending_machine_dispatch` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `dispatchname` varchar(50) DEFAULT '',
  `dispatchtype` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `firstprice` decimal(10,2) DEFAULT '0.00',
  `secondprice` decimal(10,2) DEFAULT '0.00',
  `firstweight` int(11) DEFAULT '0',
  `secondweight` int(11) DEFAULT '0',
  `express` varchar(250) DEFAULT '',
  `areas` longtext,
  `carriers` text,
  `enabled` int(11) DEFAULT '0',
  `calculatetype` tinyint(1) DEFAULT '0',
  `firstnum` int(11) DEFAULT '0',
  `secondnum` int(11) DEFAULT '0',
  `firstnumprice` decimal(10,2) DEFAULT '0.00',
  `secondnumprice` decimal(10,2) DEFAULT '0.00',
  `isdefault` tinyint(1) DEFAULT '0',
  `shopid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `nodispatchareas` text,
  `nodispatchareas_code` longtext,
  `isdispatcharea` tinyint(3) NOT NULL DEFAULT '0',
  `freeprice` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_dividend_apply`;
CREATE TABLE `ims_vending_machine_dividend_apply` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `applyno` varchar(255) DEFAULT '',
  `mid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `orderids` longtext,
  `dividend` decimal(10,2) DEFAULT '0.00',
  `dividend_pay` decimal(10,2) DEFAULT '0.00',
  `content` text,
  `status` tinyint(3) DEFAULT '0',
  `applytime` int(11) DEFAULT '0',
  `checktime` int(11) DEFAULT '0',
  `paytime` int(11) DEFAULT '0',
  `invalidtime` int(11) DEFAULT '0',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `deductionmoney` decimal(10,2) DEFAULT '0.00',
  `beginmoney` decimal(10,2) DEFAULT '0.00',
  `endmoney` decimal(10,2) DEFAULT '0.00',
  `alipay` varchar(50) NOT NULL DEFAULT '',
  `bankname` varchar(50) NOT NULL DEFAULT '',
  `bankcard` varchar(50) NOT NULL DEFAULT '',
  `alipay1` varchar(50) NOT NULL DEFAULT '',
  `bankname1` varchar(50) NOT NULL DEFAULT '',
  `bankcard1` varchar(50) NOT NULL DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `sendmoney` decimal(10,2) DEFAULT '0.00',
  `senddata` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_dividend_bank`;
CREATE TABLE `ims_vending_machine_dividend_bank` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `bankname` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_dividend_init`;
CREATE TABLE `ims_vending_machine_dividend_init` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `headsid` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

DROP TABLE IF EXISTS `ims_vending_machine_dividend_log`;
CREATE TABLE `ims_vending_machine_dividend_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `applyid` int(11) DEFAULT '0',
  `mid` int(11) DEFAULT '0',
  `dividend` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `dividend_pay` decimal(10,2) DEFAULT '0.00',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `deductionmoney` decimal(10,2) DEFAULT '0.00',
  `type` tinyint(3) DEFAULT '0',
  `type1` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

DROP TABLE IF EXISTS `ims_vending_machine_diyform_category`;
CREATE TABLE `ims_vending_machine_diyform_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_diyform_data`;
CREATE TABLE `ims_vending_machine_diyform_data` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `typeid` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) DEFAULT '0',
  `diyformfields` text,
  `fields` text NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(2) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_diyform_temp`;
CREATE TABLE `ims_vending_machine_diyform_temp` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `typeid` int(11) DEFAULT '0',
  `cid` int(11) NOT NULL DEFAULT '0',
  `diyformfields` text,
  `fields` text NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(1) DEFAULT '0',
  `diyformid` int(11) DEFAULT '0',
  `diyformdata` text,
  `carrier_realname` varchar(255) DEFAULT '',
  `carrier_mobile` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_diyform_type`;
CREATE TABLE `ims_vending_machine_diyform_type` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `fields` text NOT NULL,
  `usedata` int(11) NOT NULL DEFAULT '0',
  `alldata` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `savedata` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_diypage`;
CREATE TABLE `ims_vending_machine_diypage` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `diymenu` int(11) NOT NULL DEFAULT '0',
  `diyadv` int(11) NOT NULL DEFAULT '0',
  `merch` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_diypage_menu`;
CREATE TABLE `ims_vending_machine_diypage_menu` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0',
  `merch` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_diypage_plu`;
CREATE TABLE `ims_vending_machine_diypage_plu` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0',
  `merch` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_diypage_template`;
CREATE TABLE `ims_vending_machine_diypage_template` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  `preview` varchar(255) NOT NULL DEFAULT '',
  `tplid` int(11) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `merch` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_diypage_template` (`id`, `uniacid`, `type`, `name`, `data`, `preview`, `tplid`, `cate`, `deleted`, `merch`) VALUES
(1, 0, 2, '系统模板01', 'eyJwYWdlIjp7InR5cGUiOiIyIiwidGl0bGUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwMSIsIm5hbWUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwMSIsImRlc2MiOiIiLCJpY29uIjoiIiwia2V5d29yZCI6IiIsImJhY2tncm91bmQiOiIjZmFmYWZhIiwiZGl5bWVudSI6Ii0xIn0sIml0ZW1zIjp7Ik0xNDY1ODAyOTg0ODg1Ijp7InN0eWxlIjp7ImRvdHN0eWxlIjoicm91bmQiLCJkb3RhbGlnbiI6ImNlbnRlciIsImJhY2tncm91bmQiOiIjZmZmZmZmIiwibGVmdHJpZ2h0IjoiNSIsImJvdHRvbSI6IjEwIiwib3BhY2l0eSI6IjAuOCJ9LCJkYXRhIjp7IkMxNDY1ODAyOTg0ODg1Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQxXC9iYW5uZXJfMS5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODAyOTg0ODg2Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQxXC9iYW5uZXJfMi5qcGciLCJsaW5rdXJsIjoiIn0sIk0xNDY1ODAzMDE0ODM3Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQxXC9iYW5uZXJfMy5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6ImJhbm5lciJ9LCJNMTQ2NTgwMzY5MjkzMiI6eyJzdHlsZSI6eyJoZWlnaHQiOiIxMCIsImJhY2tncm91bmQiOiIjZmZmZmZmIn0sImlkIjoiYmxhbmsifSwiTTE0NjU4MDMzMTk4NTMiOnsic3R5bGUiOnsibmF2c3R5bGUiOiIiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInJvd251bSI6IjUifSwiZGF0YSI6eyJDMTQ2NTgwMzMxOTg1MyI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0MVwvbWVudV8xLnBuZyIsImxpbmt1cmwiOiIiLCJ0ZXh0IjoiXHU2NWIwXHU1NGMxIiwiY29sb3IiOiIjNjY2NjY2In0sIkMxNDY1ODAzMzE5ODU0Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQxXC9tZW51XzIucG5nIiwibGlua3VybCI6IiIsInRleHQiOiJcdTcwZWRcdTUzNTYiLCJjb2xvciI6IiM2NjY2NjYifSwiQzE0NjU4MDMzMTk4NTUiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDFcL21lbnVfMy5wbmciLCJsaW5rdXJsIjoiIiwidGV4dCI6Ilx1NGZjM1x1OTUwMCIsImNvbG9yIjoiIzY2NjY2NiJ9LCJDMTQ2NTgwMzMxOTg1NiI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0MVwvbWVudV80LnBuZyIsImxpbmt1cmwiOiIiLCJ0ZXh0IjoiXHU4YmEyXHU1MzU1IiwiY29sb3IiOiIjNjY2NjY2In0sIk0xNDY1ODAzMzQ3MDQ1Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQxXC9tZW51XzUucG5nIiwibGlua3VybCI6IiIsInRleHQiOiJcdTdiN2VcdTUyMzAiLCJjb2xvciI6IiM2NjY2NjYifX0sImlkIjoibWVudSJ9LCJNMTQ2NTgwMzM1OTEwMCI6eyJzdHlsZSI6eyJuYXZzdHlsZSI6IiIsImJhY2tncm91bmQiOiIjZmZmZmZmIiwicm93bnVtIjoiNSJ9LCJkYXRhIjp7IkMxNDY1ODAzMzU5MTAwIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQxXC9tZW51XzYucG5nIiwibGlua3VybCI6IiIsInRleHQiOiJcdTRlMGFcdTg4NjMiLCJjb2xvciI6IiM2NjY2NjYifSwiQzE0NjU4MDMzNTkxMDEiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDFcL21lbnVfNy5wbmciLCJsaW5rdXJsIjoiIiwidGV4dCI6Ilx1NGUwYlx1ODg2MyIsImNvbG9yIjoiIzY2NjY2NiJ9LCJDMTQ2NTgwMzM1OTEwMiI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0MVwvbWVudV84LnBuZyIsImxpbmt1cmwiOiIiLCJ0ZXh0IjoiXHU5NzhiXHU1YjUwIiwiY29sb3IiOiIjNjY2NjY2In0sIkMxNDY1ODAzMzU5MTAzIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQxXC9tZW51XzkucG5nIiwibGlua3VybCI6IiIsInRleHQiOiJcdTUxODVcdTg4NjMiLCJjb2xvciI6IiM2NjY2NjYifSwiTTE0NjU4MDM0NTA4MjciOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDFcL21lbnVfMTAucG5nIiwibGlua3VybCI6IiIsInRleHQiOiJcdTUxNjhcdTkwZTgiLCJjb2xvciI6IiM2NjY2NjYifX0sImlkIjoibWVudSJ9LCJNMTQ2NTgwMzcwMDEzMiI6eyJzdHlsZSI6eyJoZWlnaHQiOiIxMCIsImJhY2tncm91bmQiOiIjZmZmZmZmIn0sImlkIjoiYmxhbmsifSwiTTE0NjU4MDM2MjE5ODAiOnsicGFyYW1zIjp7Imljb251cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2Mlwvc3RhdGljXC9pbWFnZXNcL2hvdGRvdC5qcGciLCJub3RpY2VkYXRhIjoiMSIsInNwZWVkIjoiNCIsIm5vdGljZW51bSI6IjUifSwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJpY29uY29sb3IiOiIjZmQ1NDU0IiwiY29sb3IiOiIjNjY2NjY2In0sImRhdGEiOnsiQzE0NjU4MDM2MjE5ODAiOnsidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTdiMmNcdTRlMDBcdTY3NjFcdTgxZWFcdTViOWFcdTRlNDlcdTUxNmNcdTU0NGFcdTc2ODRcdTY4MDdcdTk4OTgiLCJsaW5rdXJsIjoiaHR0cDpcL1wvd3d3LmJhaWR1LmNvbSJ9LCJDMTQ2NTgwMzYyMTk4MSI6eyJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1N2IyY1x1NGU4Y1x1Njc2MVx1ODFlYVx1NWI5YVx1NGU0OVx1NTE2Y1x1NTQ0YVx1NzY4NFx1NjgwN1x1OTg5OCIsImxpbmt1cmwiOiJodHRwOlwvXC93d3cuYmFpZHUuY29tIn19LCJpZCI6Im5vdGljZSJ9LCJNMTQ2NTgwMzkzMjQ2MCI6eyJwYXJhbXMiOnsicm93IjoiMiJ9LCJkYXRhIjp7IkMxNDY1ODAzOTMyNDYwIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQxXC9waWN0dXJld18xLmpwZyIsImxpbmt1cmwiOiIifSwiQzE0NjU4MDM5MzI0NjMiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDFcL3BpY3R1cmV3XzIuanBnIiwibGlua3VybCI6IiJ9fSwiaWQiOiJwaWN0dXJldyIsInN0eWxlIjp7InBhZGRpbmd0b3AiOiIxNiIsInBhZGRpbmdsZWZ0IjoiNCJ9fSwiTTE0NjU4MDQwMjU1MDgiOnsicGFyYW1zIjp7InRpdGxlIjoiXHU2NWIwXHU1NGMxXHU0ZTBhXHU1ZTAyIiwiaWNvbiI6Imljb24tbmV3In0sInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIiwiY29sb3IiOiIjZjA2MjkyIiwidGV4dGFsaWduIjoiY2VudGVyIiwiZm9udHNpemUiOiIxOCIsInBhZGRpbmd0b3AiOiI1IiwicGFkZGluZ2xlZnQiOiI1In0sImlkIjoidGl0bGUifSwiTTE0NjU4MTMzNjgwODUiOnsicGFyYW1zIjp7InNob3d0aXRsZSI6IjEiLCJzaG93cHJpY2UiOiIxIiwiZ29vZHNkYXRhIjoiMCIsImNhdGVpZCI6IiIsImNhdGVuYW1lIjoiIiwiZ3JvdXBpZCI6IiIsImdyb3VwbmFtZSI6IiIsImdvb2Rzc29ydCI6IjAiLCJnb29kc251bSI6IjYiLCJzaG93aWNvbiI6IjAiLCJpY29ucG9zaXRpb24iOiJsZWZ0IHRvcCJ9LCJzdHlsZSI6eyJsaXN0c3R5bGUiOiJibG9jayIsImJ1eXN0eWxlIjoiYnV5YnRuLTEiLCJnb29kc2ljb24iOiJyZWNvbW1hbmQiLCJwcmljZWNvbG9yIjoiI2VkMjgyMiIsImljb25wYWRkaW5ndG9wIjoiMCIsImljb25wYWRkaW5nbGVmdCI6IjAiLCJidXlidG5jb2xvciI6IiNmZTU0NTUiLCJpY29uem9vbSI6IjEwMCIsInRpdGxlY29sb3IiOiIjMjYyNjI2In0sImRhdGEiOnsiQzE0NjU4MTMzNjgwODUiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMS5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MTMzNjgwODYiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMi5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MTMzNjgwODciOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMy5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MTMzNjgwODgiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtNC5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifX0sImlkIjoiZ29vZHMifSwiTTE0NjU4MDU4MjEwNjciOnsicGFyYW1zIjp7InRpdGxlIjoiXHU3MGVkXHU1MzU2XHU1NTQ2XHU1NGMxIiwiaWNvbiI6Imljb24taG90In0sInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIiwiY29sb3IiOiIjZmFjMDQyIiwidGV4dGFsaWduIjoiY2VudGVyIiwiZm9udHNpemUiOiIxOCIsInBhZGRpbmd0b3AiOiI1IiwicGFkZGluZ2xlZnQiOiI1In0sImlkIjoidGl0bGUifSwiTTE0NjU4MTMzNzY4OTIiOnsicGFyYW1zIjp7InNob3d0aXRsZSI6IjEiLCJzaG93cHJpY2UiOiIxIiwiZ29vZHNkYXRhIjoiMCIsImNhdGVpZCI6IiIsImNhdGVuYW1lIjoiIiwiZ3JvdXBpZCI6IiIsImdyb3VwbmFtZSI6IiIsImdvb2Rzc29ydCI6IjAiLCJnb29kc251bSI6IjYiLCJzaG93aWNvbiI6IjEiLCJpY29ucG9zaXRpb24iOiJsZWZ0IHRvcCJ9LCJzdHlsZSI6eyJsaXN0c3R5bGUiOiJibG9jayIsImJ1eXN0eWxlIjoiYnV5YnRuLTEiLCJnb29kc2ljb24iOiJyZWNvbW1hbmQiLCJwcmljZWNvbG9yIjoiI2VkMjgyMiIsImljb25wYWRkaW5ndG9wIjoiMCIsImljb25wYWRkaW5nbGVmdCI6IjAiLCJidXlidG5jb2xvciI6IiNmZTU0NTUiLCJpY29uem9vbSI6IjEwMCIsInRpdGxlY29sb3IiOiIjMjYyNjI2In0sImRhdGEiOnsiQzE0NjU4MTMzNzY4OTIiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMS5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MTMzNzY4OTMiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMi5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MTMzNzY4OTQiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMy5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MTMzNzY4OTUiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtNC5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifX0sImlkIjoiZ29vZHMifX19', '../addons/ewei_shopv2/plugin/diypage/static/template/default1/preview.jpg', 1, 0, 0, 0),
(2, 0, 1, '系统模板02', 'eyJwYWdlIjp7InR5cGUiOiIxIiwidGl0bGUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwMiIsIm5hbWUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwMiIsImRlc2MiOiIiLCJpY29uIjoiIiwia2V5d29yZCI6IiIsImJhY2tncm91bmQiOiIjZmFmYWZhIiwiZGl5bWVudSI6Ii0xIn0sIml0ZW1zIjp7Ik0xNDY1ODA4NTU2MDAxIjp7InN0eWxlIjp7ImRvdHN0eWxlIjoicm91bmQiLCJkb3RhbGlnbiI6InJpZ2h0IiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJsZWZ0cmlnaHQiOiIxMCIsImJvdHRvbSI6IjEwIiwib3BhY2l0eSI6IjAuOCJ9LCJkYXRhIjp7IkMxNDY1ODA4NTU2MDAxIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQyXC9iYW5uZXJfMS5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODA4NTU2MDAyIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQyXC9iYW5uZXJfMi5qcGciLCJsaW5rdXJsIjoiIn0sIk0xNDY1ODA4NTc1MTIyIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQyXC9iYW5uZXJfMy5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6ImJhbm5lciJ9LCJNMTQ2NTgwODcwNTA2NCI6eyJzdHlsZSI6eyJoZWlnaHQiOiIyMCIsImJhY2tncm91bmQiOiIjZmZmZmZmIn0sImlkIjoiYmxhbmsifSwiTTE0NjU4MDg2NzMwNDAiOnsicGFyYW1zIjp7InJvdyI6IjIifSwiZGF0YSI6eyJDMTQ2NTgwODY3MzA0MCI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0MlwvcGljdHVyZXdfMS5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODA4NjczMDQxIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQyXC9waWN0dXJld18yLmpwZyIsImxpbmt1cmwiOiIifX0sImlkIjoicGljdHVyZXciLCJzdHlsZSI6eyJwYWRkaW5ndG9wIjoiMCIsInBhZGRpbmdsZWZ0IjoiMCJ9fSwiTTE0NjU4MDg3MDkyODAiOnsic3R5bGUiOnsiaGVpZ2h0IjoiMjAiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiJ9LCJpZCI6ImJsYW5rIn0sIk0xNDY1ODA4NzY2NTY3Ijp7InBhcmFtcyI6eyJyb3ciOiIyIn0sImRhdGEiOnsiQzE0NjU4MDg3NjY1NzAiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDJcL3BpY3R1cmV3XzMuanBnIiwibGlua3VybCI6IiJ9LCJDMTQ2NTgwODc2NjU3MSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0MlwvcGljdHVyZXdfNC5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6InBpY3R1cmV3Iiwic3R5bGUiOnsicGFkZGluZ3RvcCI6IjAiLCJwYWRkaW5nbGVmdCI6IjAifX0sIk0xNDY1ODA4NzkxMDcyIjp7InN0eWxlIjp7ImhlaWdodCI6IjIwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYifSwiaWQiOiJibGFuayJ9LCJNMTQ2NTgwODg3MDY4MCI6eyJkYXRhIjp7IkMxNDY1ODA4ODcwNjgwIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQyXC9iYW5uZXJfMy5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6InBpY3R1cmUiLCJzdHlsZSI6eyJwYWRkaW5ndG9wIjoiMCIsInBhZGRpbmdsZWZ0IjoiMCJ9fSwiTTE0NjU4MDkwMTA0MTUiOnsic3R5bGUiOnsiaGVpZ2h0IjoiMjAiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiJ9LCJpZCI6ImJsYW5rIn0sIk0xNDY1ODA4OTgxNTk5Ijp7InBhcmFtcyI6eyJyb3ciOiIyIn0sImRhdGEiOnsiQzE0NjU4MDg5ODE1OTkiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDJcL3BpY3R1cmV3XzUuanBnIiwibGlua3VybCI6IiJ9LCJDMTQ2NTgwODk4MTYwMCI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0MlwvcGljdHVyZXdfNi5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6InBpY3R1cmV3Iiwic3R5bGUiOnsicGFkZGluZ3RvcCI6IjAiLCJwYWRkaW5nbGVmdCI6IjAifX0sIk0xNDY1ODg5MzczNTY3Ijp7InBhcmFtcyI6eyJzaG93dGl0bGUiOiIxIiwic2hvd3ByaWNlIjoiMSIsImdvb2RzZGF0YSI6IjAiLCJjYXRlaWQiOiIiLCJjYXRlbmFtZSI6IiIsImdyb3VwaWQiOiIiLCJncm91cG5hbWUiOiIiLCJnb29kc3NvcnQiOiIwIiwiZ29vZHNudW0iOiI2Iiwic2hvd2ljb24iOiIxIiwiaWNvbnBvc2l0aW9uIjoibGVmdCB0b3AifSwic3R5bGUiOnsibGlzdHN0eWxlIjoiYmxvY2siLCJidXlzdHlsZSI6ImJ1eWJ0bi0xIiwiZ29vZHNpY29uIjoicmVjb21tYW5kIiwicHJpY2Vjb2xvciI6IiNlZDI4MjIiLCJpY29ucGFkZGluZ3RvcCI6IjAiLCJpY29ucGFkZGluZ2xlZnQiOiIwIiwiYnV5YnRuY29sb3IiOiIjZmU1NDU1IiwiaWNvbnpvb20iOiIxMDAiLCJ0aXRsZWNvbG9yIjoiIzI2MjYyNiJ9LCJkYXRhIjp7IkMxNDY1ODg5MzczNTY3Ijp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTEuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIn0sIkMxNDY1ODg5MzczNTY4Ijp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTIuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIn0sIkMxNDY1ODg5MzczNTY5Ijp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTMuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIn0sIkMxNDY1ODg5MzczNTcwIjp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTQuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIn19LCJpZCI6Imdvb2RzIn0sIk0xNDY1ODg5Mzc3NDIzIjp7InBhcmFtcyI6eyJjb250ZW50IjoiUEhBZ2MzUjViR1U5SW5SbGVIUXRZV3hwWjI0NklHTmxiblJsY2pzaVB1V2J2dWVKaCthZHBlYTZrT1M2anVlOWtlZTduTys4ak9lSmlPYWRnK1c5a3VXT24rUzluT2lBaGVhSmdPYWNpVHd2Y0Q0PSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInBhZGRpbmciOiIyMCJ9LCJpZCI6InJpY2h0ZXh0In19fQ==', '../addons/ewei_shopv2/plugin/diypage/static/template/default2/preview.jpg', 2, 0, 0, 0),
(3, 0, 2, '系统模板03', 'eyJwYWdlIjp7InR5cGUiOiIyIiwidGl0bGUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwMyIsIm5hbWUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwMyIsImRlc2MiOiIiLCJpY29uIjoiIiwia2V5d29yZCI6IiIsImJhY2tncm91bmQiOiIjZmFmYWZhIiwiZGl5bWVudSI6Ii0xIn0sIml0ZW1zIjp7Ik0xNDY1ODA5MjQyOTc2Ijp7InN0eWxlIjp7ImRvdHN0eWxlIjoicm91bmQiLCJkb3RhbGlnbiI6ImxlZnQiLCJiYWNrZ3JvdW5kIjoiIzM0YmVkYyIsImxlZnRyaWdodCI6IjEwIiwiYm90dG9tIjoiMTAiLCJvcGFjaXR5IjoiMC43In0sImRhdGEiOnsiQzE0NjU4MDkyNDI5NzYiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDNcL2Jhbm5lcl8xLmpwZyIsImxpbmt1cmwiOiIifSwiQzE0NjU4MDkyNDI5NzciOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDNcL2Jhbm5lcl8yLmpwZyIsImxpbmt1cmwiOiIifSwiTTE0NjU4MDkyNjU5OTIiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDNcL2Jhbm5lcl8zLmpwZyIsImxpbmt1cmwiOiIifX0sImlkIjoiYmFubmVyIn0sIk0xNDY1ODA5NTQxNTM1Ijp7InBhcmFtcyI6eyJyb3ciOiIxIn0sImRhdGEiOnsiQzE0NjU4MDk1NDE1MzUiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDNcL3BpY3R1cmV3XzEuanBnIiwibGlua3VybCI6IiJ9LCJDMTQ2NTgwOTU0MTUzNiI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0M1wvcGljdHVyZXdfMi5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODA5NTQxNTM3Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQzXC9waWN0dXJld18zLmpwZyIsImxpbmt1cmwiOiIifX0sImlkIjoicGljdHVyZXciLCJzdHlsZSI6eyJwYWRkaW5ndG9wIjoiNSIsInBhZGRpbmdsZWZ0IjoiNSIsImJhY2tncm91bmQiOiIjZmFmYWZhIn19LCJNMTQ2NTgwOTc2MzQxNSI6eyJzdHlsZSI6eyJoZWlnaHQiOiI1IiwiYmFja2dyb3VuZCI6IiNmYWZhZmEifSwiaWQiOiJibGFuayJ9LCJNMTQ2NTgwOTcwOTA0MCI6eyJwYXJhbXMiOnsidGl0bGUiOiJcdTY1YjBcdTU0YzFcdTRlMGFcdTVlMDIiLCJpY29uIjoiaWNvbi1uZXcifSwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiMyOGMxOTIiLCJjb2xvciI6IiNmZmZmZmYiLCJ0ZXh0YWxpZ24iOiJsZWZ0IiwiZm9udHNpemUiOiIxOCIsInBhZGRpbmd0b3AiOiI1IiwicGFkZGluZ2xlZnQiOiI1In0sImlkIjoidGl0bGUifSwiTTE0NjU4MDk3OTEyMzEiOnsicGFyYW1zIjp7InNob3d0aXRsZSI6IjEiLCJzaG93cHJpY2UiOiIxIiwiZ29vZHNkYXRhIjoiMCIsImNhdGVpZCI6IiIsImNhdGVuYW1lIjoiIiwiZ3JvdXBpZCI6IiIsImdyb3VwbmFtZSI6IiIsImdvb2Rzc29ydCI6IjAiLCJnb29kc251bSI6IjYiLCJzaG93aWNvbiI6IjAiLCJpY29ucG9zaXRpb24iOiJsZWZ0IHRvcCJ9LCJzdHlsZSI6eyJsaXN0c3R5bGUiOiJibG9jayIsImJ1eXN0eWxlIjoiYnV5YnRuLTMiLCJnb29kc2ljb24iOiJyZWNvbW1hbmQiLCJwcmljZWNvbG9yIjoiIzI4YzE5MiIsImljb25wYWRkaW5ndG9wIjoiMCIsImljb25wYWRkaW5nbGVmdCI6IjAiLCJidXlidG5jb2xvciI6IiMyOGMxOGYiLCJpY29uem9vbSI6IjEwMCIsInRpdGxlY29sb3IiOiIjMjhjMTkyIn0sImRhdGEiOnsiQzE0NjU4MDk3OTEyMzEiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMS5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MDk3OTEyMzIiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMi5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MDk3OTEyMzMiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMy5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MDk3OTEyMzQiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtNC5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifX0sImlkIjoiZ29vZHMifSwiTTE0NjU4MDk5NTA4NDciOnsicGFyYW1zIjp7InRpdGxlIjoiXHU2MzhjXHU2N2RjXHU2M2E4XHU4MzUwIiwiaWNvbiI6Imljb24tYXBwcmVjaWF0ZSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmYmQzMyIsImNvbG9yIjoiI2ZmZmZmZiIsInRleHRhbGlnbiI6InJpZ2h0IiwiZm9udHNpemUiOiIxOCIsInBhZGRpbmd0b3AiOiI1IiwicGFkZGluZ2xlZnQiOiI1In0sImlkIjoidGl0bGUifSwiTTE0NjU4MDk5NDMyMzEiOnsicGFyYW1zIjp7InNob3d0aXRsZSI6IjEiLCJzaG93cHJpY2UiOiIxIiwiZ29vZHNkYXRhIjoiMCIsImNhdGVpZCI6IiIsImNhdGVuYW1lIjoiIiwiZ3JvdXBpZCI6IiIsImdyb3VwbmFtZSI6IiIsImdvb2Rzc29ydCI6IjAiLCJnb29kc251bSI6IjYiLCJzaG93aWNvbiI6IjEiLCJpY29ucG9zaXRpb24iOiJsZWZ0IHRvcCJ9LCJzdHlsZSI6eyJsaXN0c3R5bGUiOiJibG9jayIsImJ1eXN0eWxlIjoiYnV5YnRuLTEiLCJnb29kc2ljb24iOiJyZWNvbW1hbmQiLCJwcmljZWNvbG9yIjoiI2VkMjgyMiIsImljb25wYWRkaW5ndG9wIjoiMCIsImljb25wYWRkaW5nbGVmdCI6IjAiLCJidXlidG5jb2xvciI6IiNmZTU0NTUiLCJpY29uem9vbSI6IjEwMCIsInRpdGxlY29sb3IiOiIjMjYyNjI2In0sImRhdGEiOnsiQzE0NjU4MDk5NDMyMzEiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMS5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MDk5NDMyMzIiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMi5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MDk5NDMyMzMiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMy5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifSwiQzE0NjU4MDk5NDMyMzQiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtNC5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIifX0sImlkIjoiZ29vZHMifSwiTTE0NjU4MTAwNTk2OTQiOnsicGFyYW1zIjp7ImNvbnRlbnQiOiJQSEFnYzNSNWJHVTlJblJsZUhRdFlXeHBaMjQ2SUdObGJuUmxjanNpUGp4aWNpOCtQQzl3UGp4d0lITjBlV3hsUFNKMFpYaDBMV0ZzYVdkdU9pQmpaVzUwWlhJN0lqN25pWWptbllQbWlZRG1uSWtvWXlsWVdPV1ZodVdmamp3dmNENDhjRDRtYm1KemNEczhZbkl2UGp3dmNEND0ifSwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYifSwiaWQiOiJyaWNodGV4dCJ9fX0=', '../addons/ewei_shopv2/plugin/diypage/static/template/default3/preview.jpg', 3, 0, 0, 0),
(4, 0, 1, '系统模板04', 'eyJwYWdlIjp7InR5cGUiOiIxIiwidGl0bGUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwNCIsIm5hbWUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwNCIsImRlc2MiOiIiLCJpY29uIjoiIiwia2V5d29yZCI6IiIsImJhY2tncm91bmQiOiIjZmFmYWZhIiwiZGl5bWVudSI6Ii0xIn0sIml0ZW1zIjp7Ik0xNDY1ODEwMzUyODk0Ijp7ImRhdGEiOnsiQzE0NjU4MTAzNTI4OTQiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDRcL3BpY3R1cmVfMS5wbmciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODEwMzUyODk1Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ0XC9waWN0dXJlXzIucG5nIiwibGlua3VybCI6IiJ9LCJNMTQ2NTgxMDM3MDM5OSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NFwvcGljdHVyZV8zLnBuZyIsImxpbmt1cmwiOiIifSwiTTE0NjU4MTAzNzE3MDEiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDRcL3BpY3R1cmVfNC5wbmciLCJsaW5rdXJsIjoiIn0sIk0xNDY1ODEwMzcyNzkxIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ0XC9waWN0dXJlXzUucG5nIiwibGlua3VybCI6IiJ9fSwiaWQiOiJwaWN0dXJlIiwic3R5bGUiOnsicGFkZGluZ3RvcCI6IjAiLCJwYWRkaW5nbGVmdCI6IjAifX0sIk0xNDY1ODg5OTQ0NzY5Ijp7InBhcmFtcyI6eyJjb250ZW50IjoiUEhBZ2MzUjViR1U5SW5SbGVIUXRZV3hwWjI0NklHTmxiblJsY2pzaVB1V2J2dWVKaCthZHBlYTZrT1M2anVlOWtlZTduTys4ak9lSmlPYWRnK1c5a3VXT24rUzluT2lBaGVhSmdPYWNpVHd2Y0Q0PSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInBhZGRpbmciOiIyMCJ9LCJpZCI6InJpY2h0ZXh0In19fQ==', '../addons/ewei_shopv2/plugin/diypage/static/template/default4/preview.jpg', 4, 0, 0, 0),
(5, 0, 2, '系统模板05', 'eyJwYWdlIjp7InR5cGUiOiIyIiwidGl0bGUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwNSIsIm5hbWUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwNSIsImRlc2MiOiIiLCJpY29uIjoiIiwia2V5d29yZCI6InQ1IiwiYmFja2dyb3VuZCI6IiNmYWZhZmEiLCJkaXltZW51IjoiLTEifSwiaXRlbXMiOnsiTTE0NjU4MTA3NTE4MDciOnsic3R5bGUiOnsiZG90c3R5bGUiOiJyb3VuZCIsImRvdGFsaWduIjoibGVmdCIsImJhY2tncm91bmQiOiIjZmZmZmZmIiwibGVmdHJpZ2h0IjoiMTAiLCJib3R0b20iOiIxMCIsIm9wYWNpdHkiOiIwLjcifSwiZGF0YSI6eyJDMTQ2NTgxMDc1MTgwNyI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NVwvYmFubmVyXzEuanBnIiwibGlua3VybCI6IiJ9LCJDMTQ2NTgxMDc1MTgwOCI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NVwvYmFubmVyXzIuanBnIiwibGlua3VybCI6IiJ9LCJNMTQ2NTgxMDc2NjQ4NiI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NVwvYmFubmVyXzMuanBnIiwibGlua3VybCI6IiJ9fSwiaWQiOiJiYW5uZXIifSwiTTE0NjU4MTA5NzA0OTQiOnsic3R5bGUiOnsibmF2c3R5bGUiOiIiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInJvd251bSI6IjQifSwiZGF0YSI6eyJDMTQ2NTgxMDk3MDQ5NCI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NVwvbWVudV8xLnBuZyIsImxpbmt1cmwiOiIiLCJ0ZXh0IjoiSE9NRSIsImNvbG9yIjoiIzY2NjY2NiJ9LCJDMTQ2NTgxMDk3MDQ5NSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NVwvbWVudV8yLnBuZyIsImxpbmt1cmwiOiIiLCJ0ZXh0IjoiTkVXIiwiY29sb3IiOiIjNjY2NjY2In0sIkMxNDY1ODEwOTcwNDk2Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ1XC9tZW51XzMucG5nIiwibGlua3VybCI6IiIsInRleHQiOiJIT1QiLCJjb2xvciI6IiM2NjY2NjYifSwiQzE0NjU4MTA5NzA0OTciOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDVcL21lbnVfNC5wbmciLCJsaW5rdXJsIjoiIiwidGV4dCI6IkxJU1QiLCJjb2xvciI6IiM2NjY2NjYifX0sImlkIjoibWVudSJ9LCJNMTQ2NTgxMTA5OTI0MCI6eyJwYXJhbXMiOnsicm93IjoiMyJ9LCJkYXRhIjp7IkMxNDY1ODExMDk5MjQwIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ1XC9waWN0dXJld18xLmpwZyIsImxpbmt1cmwiOiIifSwiQzE0NjU4MTEwOTkyNDEiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDVcL3BpY3R1cmV3XzQuanBnIiwibGlua3VybCI6IiJ9LCJDMTQ2NTgxMTA5OTI0MyI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NVwvcGljdHVyZXdfMS5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6InBpY3R1cmV3Iiwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJwYWRkaW5ndG9wIjoiNSIsInBhZGRpbmdsZWZ0IjoiNSJ9fSwiTTE0NjU4MTIzOTAxNzQiOnsicGFyYW1zIjp7InJvdyI6IjIifSwiZGF0YSI6eyJDMTQ2NTgxMjM5MDE3NSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NVwvcGljdHVyZXdfMy5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODEyMzkwMTc2Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ1XC9waWN0dXJld18zLmpwZyIsImxpbmt1cmwiOiIifX0sImlkIjoicGljdHVyZXciLCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInBhZGRpbmd0b3AiOiIwIiwicGFkZGluZ2xlZnQiOiI1In19LCJNMTQ2NTg3MjQ4NTQ4NiI6eyJzdHlsZSI6eyJoZWlnaHQiOiIxMCIsImJhY2tncm91bmQiOiIjZmFmYWZhIn0sImlkIjoiYmxhbmsifSwiTTE0NjU4MTExNzQ5NTgiOnsiZGF0YSI6eyJDMTQ2NTgxMTE3NDk1OSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NVwvcGljdHVyZV8xLmpwZyIsImxpbmt1cmwiOiIifX0sImlkIjoicGljdHVyZSIsInN0eWxlIjp7InBhZGRpbmd0b3AiOiIwIiwicGFkZGluZ2xlZnQiOiIwIn19LCJNMTQ2NTgxMjQxMTM4MSI6eyJwYXJhbXMiOnsic2hvd3RpdGxlIjoiMSIsInNob3dwcmljZSI6IjEiLCJnb29kc2RhdGEiOiIwIiwiY2F0ZWlkIjoiIiwiY2F0ZW5hbWUiOiIiLCJncm91cGlkIjoiIiwiZ3JvdXBuYW1lIjoiIiwiZ29vZHNzb3J0IjoiMCIsImdvb2RzbnVtIjoiNiIsInNob3dpY29uIjoiMSIsImljb25wb3NpdGlvbiI6ImxlZnQgdG9wIn0sInN0eWxlIjp7Imxpc3RzdHlsZSI6ImJsb2NrIiwiYnV5c3R5bGUiOiJidXlidG4tMSIsImdvb2RzaWNvbiI6InJlY29tbWFuZCIsInByaWNlY29sb3IiOiIjZWQyODIyIiwiaWNvbnBhZGRpbmd0b3AiOiIwIiwiaWNvbnBhZGRpbmdsZWZ0IjoiMCIsImJ1eWJ0bmNvbG9yIjoiI2ZlNTQ1NSIsImljb256b29tIjoiMTAwIiwidGl0bGVjb2xvciI6IiMyNjI2MjYifSwiZGF0YSI6eyJDMTQ2NTgxMjQxMTM4MSI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy0xLmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiJ9LCJDMTQ2NTgxMjQxMTM4MiI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy0yLmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiJ9LCJDMTQ2NTgxMjQxMTM4MyI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy0zLmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiJ9LCJDMTQ2NTgxMjQxMTM4NCI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy00LmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiJ9fSwiaWQiOiJnb29kcyJ9LCJNMTQ2NTgxMjQ2Njg5MyI6eyJwYXJhbXMiOnsiY29udGVudCI6IlBIQWdjM1I1YkdVOUluUmxlSFF0WVd4cFoyNDZJR05sYm5SbGNqc2lQanhpY2k4K1BDOXdQanh3SUhOMGVXeGxQU0owWlhoMExXRnNhV2R1T2lCalpXNTBaWEk3SWo3a3U2WGt1SXJsbTc3bmlZZmxuWWZtbmFYbXVwRGt1bzdudlpIbnU1enZ2SXpuaVlqbW5ZUGx2WkxsanBcL2t2WnpvZ0lYbWlZRG1uSW5qZ0lJOEwzQStQSEErUEdKeUx6NDhMM0ErIn0sInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIn0sImlkIjoicmljaHRleHQifX19', '../addons/ewei_shopv2/plugin/diypage/static/template/default5/preview.jpg', 5, 0, 0, 0),
(6, 0, 1, '系统模板06', 'eyJwYWdlIjp7InR5cGUiOiIxIiwidGl0bGUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwNiIsIm5hbWUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwNiIsImRlc2MiOiIiLCJpY29uIjoiIiwia2V5d29yZCI6IiIsImJhY2tncm91bmQiOiIjZmFmYWZhIiwiZGl5bWVudSI6Ii0xIn0sIml0ZW1zIjp7Ik0xNDY1ODEyNjAyOTMzIjp7ImRhdGEiOnsiQzE0NjU4MTI2MDI5MzMiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDZcL3BpY3R1cmVfMS5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODEyNjAyOTM0Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ2XC9waWN0dXJlXzIuanBnIiwibGlua3VybCI6IiJ9LCJNMTQ2NTgxMjYwNDQ5NCI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NlwvcGljdHVyZV8zLmpwZyIsImxpbmt1cmwiOiIifSwiTTE0NjU4MTI2MDUyNDUiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDZcL3BpY3R1cmVfNC5qcGciLCJsaW5rdXJsIjoiIn0sIk0xNDY1ODEyNjA1OTgwIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ2XC9waWN0dXJlXzUuanBnIiwibGlua3VybCI6IiJ9LCJNMTQ2NTgxMjYwNzA0NSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0NlwvcGljdHVyZV82LmpwZyIsImxpbmt1cmwiOiIifX0sImlkIjoicGljdHVyZSIsInN0eWxlIjp7InBhZGRpbmd0b3AiOiIwIiwicGFkZGluZ2xlZnQiOiIwIn19LCJNMTQ2NTg5MDE4NDY1MCI6eyJwYXJhbXMiOnsiY29udGVudCI6IlBIQWdjM1I1YkdVOUluUmxlSFF0WVd4cFoyNDZJR05sYm5SbGNqc2lQdVdidnVlSmgrYWRwZWE2a09TNmp1ZTlrZWU3bk8rOGpPZUppT2FkZytXOWt1V09uK1M5bk9pQWhlYUpnT2FjaVR3dmNEND0ifSwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJwYWRkaW5nIjoiMjAifSwiaWQiOiJyaWNodGV4dCJ9fX0=', '../addons/ewei_shopv2/plugin/diypage/static/template/default6/preview.jpg', 6, 0, 0, 0),
(7, 0, 2, '系统模板07', 'eyJwYWdlIjp7InR5cGUiOiIyIiwidGl0bGUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwNyIsIm5hbWUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwNyIsImRlc2MiOiIiLCJpY29uIjoiIiwia2V5d29yZCI6IiIsImJhY2tncm91bmQiOiIjZmFmYWZhIiwiZGl5bWVudSI6Ii0xIn0sIml0ZW1zIjp7Ik0xNDY1ODEyNjkxMzg5Ijp7ImRhdGEiOnsiQzE0NjU4MTI2OTEzODkiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDdcL3BpY3R1cmVfMS5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6InBpY3R1cmUiLCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInBhZGRpbmd0b3AiOiIwIiwicGFkZGluZ2xlZnQiOiIwIn19LCJNMTQ2NTgxMjcyODgyMSI6eyJwYXJhbXMiOnsicGxhY2Vob2xkZXIiOiJcdThiZjdcdThmOTNcdTUxNjVcdTUxNzNcdTk1MmVcdTViNTdcdThmZGJcdTg4NGNcdTY0MWNcdTdkMjIifSwic3R5bGUiOnsiaW5wdXRiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImJhY2tncm91bmQiOiIjZjFmMWYyIiwiaWNvbmNvbG9yIjoiI2I0YjRiNCIsImNvbG9yIjoiIzk5OTk5OSIsInBhZGRpbmd0b3AiOiIxMCIsInBhZGRpbmdsZWZ0IjoiMTAiLCJ0ZXh0YWxpZ24iOiJsZWZ0Iiwic2VhcmNoc3R5bGUiOiIifSwiaWQiOiJzZWFyY2gifSwiTTE0NjU4MTI3MzkxOTciOnsicGFyYW1zIjp7InJvdyI6IjMifSwiZGF0YSI6eyJDMTQ2NTgxMjczOTE5NyI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0N1wvcGljdHVyZXdfMS5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODEyNzM5MTk4Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ3XC9waWN0dXJld18yLmpwZyIsImxpbmt1cmwiOiIifSwiQzE0NjU4MTI3MzkxOTkiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDdcL3BpY3R1cmV3XzMuanBnIiwibGlua3VybCI6IiJ9fSwiaWQiOiJwaWN0dXJldyIsInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIiwicGFkZGluZ3RvcCI6IjAiLCJwYWRkaW5nbGVmdCI6IjUifX0sIk0xNDY1ODEyNzg0NTY1Ijp7ImRhdGEiOnsiQzE0NjU4MTI3ODQ1NjUiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDdcL3BpY3R1cmVfMy5qcGciLCJsaW5rdXJsIjoiIn0sIk0xNDY1ODEyODE5OTQ4Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ3XC9waWN0dXJlXzIuanBnIiwibGlua3VybCI6IiJ9fSwiaWQiOiJwaWN0dXJlIiwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJwYWRkaW5ndG9wIjoiNCIsInBhZGRpbmdsZWZ0IjoiMCJ9fSwiTTE0NjU4MTI4NzU5ODgiOnsicGFyYW1zIjp7InJvdyI6IjIifSwiZGF0YSI6eyJDMTQ2NTgxMjg3NTk4OCI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0N1wvcGljdHVyZXdfNC5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODEyODc1OTg5Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ3XC9waWN0dXJld181LmpwZyIsImxpbmt1cmwiOiIifSwiQzE0NjU4MTI4NzU5OTAiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDdcL3BpY3R1cmV3XzYuanBnIiwibGlua3VybCI6IiJ9LCJDMTQ2NTgxMjg3NTk5MSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0N1wvcGljdHVyZXdfNy5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6InBpY3R1cmV3Iiwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJwYWRkaW5ndG9wIjoiMCIsInBhZGRpbmdsZWZ0IjoiMCJ9fSwiTTE0NjU4NzI4OTQxMjAiOnsic3R5bGUiOnsiaGVpZ2h0IjoiMTAiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiJ9LCJpZCI6ImJsYW5rIn0sIk0xNDY1ODcyODMyODk1Ijp7InBhcmFtcyI6eyJ0aXRsZSI6Ilx1NzBlZFx1OTUwMFx1NTU0Nlx1NTRjMSIsImljb24iOiIifSwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmMjMyNGMiLCJjb2xvciI6IiNmZmZmZmYiLCJ0ZXh0YWxpZ24iOiJjZW50ZXIiLCJmb250c2l6ZSI6IjE4IiwicGFkZGluZ3RvcCI6IjUiLCJwYWRkaW5nbGVmdCI6IjUifSwiaWQiOiJ0aXRsZSJ9LCJNMTQ2NTgxMjkwNDA1MyI6eyJwYXJhbXMiOnsic2hvd3RpdGxlIjoiMSIsInNob3dwcmljZSI6IjEiLCJnb29kc2RhdGEiOiIwIiwiY2F0ZWlkIjoiIiwiY2F0ZW5hbWUiOiIiLCJncm91cGlkIjoiIiwiZ3JvdXBuYW1lIjoiIiwiZ29vZHNzb3J0IjoiMCIsImdvb2RzbnVtIjoiNiIsInNob3dpY29uIjoiMSIsImljb25wb3NpdGlvbiI6ImxlZnQgdG9wIn0sInN0eWxlIjp7Imxpc3RzdHlsZSI6ImJsb2NrIiwiYnV5c3R5bGUiOiJidXlidG4tMSIsImdvb2RzaWNvbiI6InJlY29tbWFuZCIsInByaWNlY29sb3IiOiIjZWQyODIyIiwiaWNvbnBhZGRpbmd0b3AiOiIwIiwiaWNvbnBhZGRpbmdsZWZ0IjoiMCIsImJ1eWJ0bmNvbG9yIjoiI2ZlNTQ1NSIsImljb256b29tIjoiMTAwIiwidGl0bGVjb2xvciI6IiMyNjI2MjYifSwiZGF0YSI6eyJDMTQ2NTgxMjkwNDA1MyI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy0xLmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiJ9LCJDMTQ2NTgxMjkwNDA1NCI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy0yLmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiJ9LCJDMTQ2NTgxMjkwNDA1NSI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy0zLmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiJ9LCJDMTQ2NTgxMjkwNDA1NiI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy00LmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiJ9fSwiaWQiOiJnb29kcyJ9LCJNMTQ2NTg4ODU1MjYwNiI6eyJwYXJhbXMiOnsiY29udGVudCI6IlBIQWdjM1I1YkdVOUluUmxlSFF0WVd4cFoyNDZJR05sYm5SbGNqc2lQdVdidnVlSmgrYWRwZWE2a09TNmp1ZTlrZWU3bk8rOGpPZUppT2FkZytXOWt1V09uK1M5bk9pQWhlYUpnT2FjaVR3dmNEND0ifSwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJwYWRkaW5nIjoiMjAifSwiaWQiOiJyaWNodGV4dCJ9fX0=', '../addons/ewei_shopv2/plugin/diypage/static/template/default7/preview.jpg', 7, 0, 0, 0),
(8, 0, 2, '系统模板08', 'eyJwYWdlIjp7InR5cGUiOiIyIiwidGl0bGUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwOCIsIm5hbWUiOiJcdTMwMTBcdTZhMjFcdTY3N2ZcdTMwMTFcdTdjZmJcdTdlZGZcdTZhMjFcdTY3N2YwOCIsImRlc2MiOiIiLCJpY29uIjoiIiwia2V5d29yZCI6IiIsImJhY2tncm91bmQiOiIjZmFmYWZhIiwiZGl5bWVudSI6Ii0xIn0sIml0ZW1zIjp7Ik0xNDY1ODEyOTk3MDQ1Ijp7ImRhdGEiOnsiQzE0NjU4MTI5OTcwNDUiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDhcL3BpY3R1cmVfMS5qcGciLCJsaW5rdXJsIjoiIn19LCJpZCI6InBpY3R1cmUiLCJzdHlsZSI6eyJwYWRkaW5ndG9wIjoiMCIsInBhZGRpbmdsZWZ0IjoiMCJ9fSwiTTE0NjU4MTMwMTc1NDkiOnsicGFyYW1zIjp7InJvdyI6IjMifSwiZGF0YSI6eyJDMTQ2NTgxMzAxNzU1MCI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0OFwvcGljdHVyZXdfMS5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODEzMDE3NTUxIjp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ4XC9waWN0dXJld18yLmpwZyIsImxpbmt1cmwiOiIifSwiQzE0NjU4MTMwMTc1NTIiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDhcL3BpY3R1cmV3XzMuanBnIiwibGlua3VybCI6IiJ9fSwiaWQiOiJwaWN0dXJldyIsInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIiwicGFkZGluZ3RvcCI6IjAiLCJwYWRkaW5nbGVmdCI6IjAifX0sIk0xNDY1ODEzMDQyODc2Ijp7ImRhdGEiOnsiQzE0NjU4MTMwNDI4NzYiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDhcL3BpY3R1cmVfMi5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODEzMDQyODc3Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ4XC9waWN0dXJlXzMuanBnIiwibGlua3VybCI6IiJ9fSwiaWQiOiJwaWN0dXJlIiwic3R5bGUiOnsicGFkZGluZ3RvcCI6IjAiLCJwYWRkaW5nbGVmdCI6IjAifX0sIk0xNDY1ODEzMDg4ODA0Ijp7InBhcmFtcyI6eyJyb3ciOiI0In0sImRhdGEiOnsiQzE0NjU4MTMwODg4MDQiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDhcL3BpY3R1cmV3XzQuanBnIiwibGlua3VybCI6IiJ9LCJDMTQ2NTgxMzA4ODgwNSI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9kZWZhdWx0OFwvcGljdHVyZXdfNS5qcGciLCJsaW5rdXJsIjoiIn0sIkMxNDY1ODEzMDg4ODA2Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2RlZmF1bHQ4XC9waWN0dXJld182LmpwZyIsImxpbmt1cmwiOiIifSwiQzE0NjU4MTMwODg4MDciOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvZGVmYXVsdDhcL3BpY3R1cmV3XzcuanBnIiwibGlua3VybCI6IiJ9fSwiaWQiOiJwaWN0dXJldyIsInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIiwicGFkZGluZ3RvcCI6IjAiLCJwYWRkaW5nbGVmdCI6IjAifX0sIk0xNDY1ODEzMTMxMzgwIjp7InBhcmFtcyI6eyJzaG93dGl0bGUiOiIxIiwic2hvd3ByaWNlIjoiMSIsImdvb2RzZGF0YSI6IjAiLCJjYXRlaWQiOiIiLCJjYXRlbmFtZSI6IiIsImdyb3VwaWQiOiIiLCJncm91cG5hbWUiOiIiLCJnb29kc3NvcnQiOiIwIiwiZ29vZHNudW0iOiI2Iiwic2hvd2ljb24iOiIxIiwiaWNvbnBvc2l0aW9uIjoibGVmdCB0b3AifSwic3R5bGUiOnsibGlzdHN0eWxlIjoiYmxvY2siLCJidXlzdHlsZSI6ImJ1eWJ0bi0xIiwiZ29vZHNpY29uIjoicmVjb21tYW5kIiwicHJpY2Vjb2xvciI6IiNlZDI4MjIiLCJpY29ucGFkZGluZ3RvcCI6IjAiLCJpY29ucGFkZGluZ2xlZnQiOiIwIiwiYnV5YnRuY29sb3IiOiIjZmU1NDU1IiwiaWNvbnpvb20iOiIxMDAiLCJ0aXRsZWNvbG9yIjoiIzI2MjYyNiJ9LCJkYXRhIjp7IkMxNDY1ODEzMTMxMzgwIjp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTEuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIn0sIkMxNDY1ODEzMTMxMzgxIjp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTIuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIn0sIkMxNDY1ODEzMTMxMzgyIjp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTMuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIn0sIkMxNDY1ODEzMTMxMzgzIjp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTQuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIn19LCJpZCI6Imdvb2RzIn0sIk0xNDY1ODg4ODMxMjc4Ijp7InBhcmFtcyI6eyJjb250ZW50IjoiUEhBZ2MzUjViR1U5SW5SbGVIUXRZV3hwWjI0NklHTmxiblJsY2pzaVB1V2J2dWVKaCthZHBlYTZrT1M2anVlOWtlZTduTys4ak9lSmlPYWRnK1c5a3VXT24rUzluT2lBaGVhSmdPYWNpVHd2Y0Q0PSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInBhZGRpbmciOiIyMCJ9LCJpZCI6InJpY2h0ZXh0In19fQ==', '../addons/ewei_shopv2/plugin/diypage/static/template/default8/preview.jpg', 8, 0, 0, 0),
(9, 0, 3, '会员中心01', 'eyJwYWdlIjp7InR5cGUiOiIzIiwidGl0bGUiOiJcdTRmMWFcdTU0NThcdTRlMmRcdTVmYzMiLCJuYW1lIjoiXHU0ZjFhXHU1NDU4XHU0ZTJkXHU1ZmMzbm9ybWFsIiwiZGVzYyI6IiIsImljb24iOiIiLCJrZXl3b3JkIjoiIiwiYmFja2dyb3VuZCI6IiNmYWZhZmEiLCJkaXltZW51IjoiMCIsImZvbGxvd2JhciI6IjAiLCJ2aXNpdCI6IjAiLCJ2aXNpdGxldmVsIjp7Im1lbWJlciI6IiIsImNvbW1pc3Npb24iOiIifSwibm92aXNpdCI6eyJ0aXRsZSI6IiIsImxpbmsiOiIifX0sIml0ZW1zIjp7Ik0xNDc0NTI2MTM0ODE0Ijp7InBhcmFtcyI6eyJzdHlsZSI6ImRlZmF1bHQxIiwibGV2ZWxsaW5rIjoiIiwic2V0aWNvbiI6Imljb24tc2hlemhpIiwic2V0bGluayI6IiIsImxlZnRuYXYiOiJcdTUxNDVcdTUwM2MiLCJsZWZ0bmF2bGluayI6IiIsInJpZ2h0bmF2IjoiXHU1MTUxXHU2MzYyIiwicmlnaHRuYXZsaW5rIjoiIn0sInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmU1NDU1IiwidGV4dGNvbG9yIjoiI2ZmZmZmZiIsInRleHRsaWdodCI6IiNmZWYzMWYiLCJoZWFkc3R5bGUiOiIifSwiaW5mbyI6eyJhdmF0YXIiOiIiLCJuaWNrbmFtZSI6IiIsImxldmVsbmFtZSI6IiIsInRleHRtb25leSI6IiIsInRleHRjcmVkaXQiOiIiLCJtb25leSI6IiIsImNyZWRpdCI6IiJ9LCJpZCI6Im1lbWJlciJ9LCJNMTQ3NDUyNjEzODkxMCI6eyJwYXJhbXMiOnsibGlua3VybCI6IiIsInRpdGxlIjoiXHU3ZWQxXHU1YjlhXHU2MjRiXHU2NzNhXHU1M2Y3IiwidGV4dCI6Ilx1NTk4Mlx1Njc5Y1x1NjBhOFx1NzUyOFx1NjI0Ylx1NjczYVx1NTNmN1x1NmNlOFx1NTE4Y1x1OGZjN1x1NGYxYVx1NTQ1OFx1NjIxNlx1NjBhOFx1NjBmM1x1OTAxYVx1OGZjN1x1NWZhZVx1NGZlMVx1NTkxNlx1OGQyZFx1NzI2OVx1OGJmN1x1N2VkMVx1NWI5YVx1NjBhOFx1NzY4NFx1NjI0Ylx1NjczYVx1NTNmN1x1NzgwMSIsImljb25jbGFzcyI6Imljb24tc2hvdWppIn0sInN0eWxlIjp7Im1hcmdpbnRvcCI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJ0aXRsZWNvbG9yIjoiI2ZmMDAxMSIsInRleHRjb2xvciI6IiM5OTk5OTkiLCJpY29uY29sb3IiOiIjOTk5OTk5In0sImlkIjoiYmluZG1vYmlsZSJ9LCJNMTQ3NDUyNjE0MzQ4NyI6eyJzdHlsZSI6eyJtYXJnaW50b3AiOiIxMCIsImJhY2tncm91bmQiOiIjZmZmZmZmIiwiaWNvbmNvbG9yIjoiIzk5OTk5OSIsInRleHRjb2xvciI6IiMzMzMzMzMiLCJyZW1hcmtjb2xvciI6IiM4ODg4ODgifSwiZGF0YSI6eyJDMTQ3NDUyNjE0MzQ4OSI6eyJ0ZXh0IjoiXHU2MjExXHU3Njg0XHU4YmEyXHU1MzU1IiwibGlua3VybCI6IiIsImljb25jbGFzcyI6Imljb24tZGluZ2RhbjEiLCJyZW1hcmsiOiJcdTY3ZTVcdTc3MGJcdTUxNjhcdTkwZTgiLCJkb3RudW0iOiIifX0sImlkIjoibGlzdG1lbnUifSwiTTE0NzQ1MjYxODE0MzEiOnsicGFyYW1zIjp7InJvd251bSI6IjQiLCJib3JkZXIiOiIxIiwiYm9yZGVydG9wIjoiMCIsImJvcmRlcmJvdHRvbSI6IjEifSwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJib3JkZXJjb2xvciI6IiNlYmViZWIiLCJ0ZXh0Y29sb3IiOiIjN2E3YTdhIiwiaWNvbmNvbG9yIjoiI2FhYWFhYSIsImRvdGNvbG9yIjoiI2ZmMDAxMSJ9LCJkYXRhIjp7IkMxNDc0NTI2MTgxNDMxIjp7Imljb25jbGFzcyI6Imljb24tZGFpZnVrdWFuMSIsInRleHQiOiJcdTVmODVcdTRlZDhcdTZiM2UiLCJsaW5rdXJsIjoiIiwiZG90bnVtIjoiMCJ9LCJDMTQ3NDUyNjE4MTQzMiI6eyJpY29uY2xhc3MiOiJpY29uLWRhaWZhaHVvMSIsInRleHQiOiJcdTVmODVcdTUzZDFcdThkMjciLCJsaW5rdXJsIjoiIiwiZG90bnVtIjoiMCJ9LCJDMTQ3NDUyNjE4MTQzMyI6eyJpY29uY2xhc3MiOiJpY29uLWRhaXNob3VodW8xIiwidGV4dCI6Ilx1NWY4NVx1NjUzNlx1OGQyNyIsImxpbmt1cmwiOiIiLCJkb3RudW0iOiIwIn0sIkMxNDc0NTI2MTgxNDM0Ijp7Imljb25jbGFzcyI6Imljb24tZGFpdHVpa3VhbjIiLCJ0ZXh0IjoiXHU5MDAwXHU2MzYyXHU4ZDI3IiwibGlua3VybCI6IiIsImRvdG51bSI6IjAifX0sImlkIjoiaWNvbmdyb3VwIn0sIk0xNDc0NTI2MTk5MTAyIjp7InN0eWxlIjp7Im1hcmdpbnRvcCI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJpY29uY29sb3IiOiIjOTk5OTk5IiwidGV4dGNvbG9yIjoiIzMzMzMzMyIsInJlbWFya2NvbG9yIjoiIzg4ODg4OCJ9LCJkYXRhIjp7IkMxNDc0NTI2MTk5MTAyIjp7InRleHQiOiJcdTUyMDZcdTk1MDBcdTRlMmRcdTVmYzMiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1mZW54aWFvIiwicmVtYXJrIjoiXHU2N2U1XHU3NzBiIiwiZG90bnVtIjoiIn0sIkMxNDc0NTI2MTk5MTAzIjp7InRleHQiOiJcdTc5ZWZcdTUyMDZcdTdiN2VcdTUyMzAiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1xaWFuZGFvIiwicmVtYXJrIjoiXHU2N2U1XHU3NzBiIiwiZG90bnVtIjoiIn0sIkMxNDc0NTI2MTk5MTA0Ijp7InRleHQiOiJcdTc5ZWZcdTUyMDZcdTU1NDZcdTU3Y2UiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1zaGFuZ2NoZW5nMSIsInJlbWFyayI6Ilx1NjdlNVx1NzcwYiIsImRvdG51bSI6IiJ9fSwiaWQiOiJsaXN0bWVudSJ9LCJNMTQ3NDUyNjIyMjIwNiI6eyJzdHlsZSI6eyJtYXJnaW50b3AiOiIxMCIsImJhY2tncm91bmQiOiIjZmZmZmZmIiwiaWNvbmNvbG9yIjoiIzk5OTk5OSIsInRleHRjb2xvciI6IiMzMzMzMzMiLCJyZW1hcmtjb2xvciI6IiM4ODg4ODgifSwiZGF0YSI6eyJDMTQ3NDUyNjIyMjIwNiI6eyJ0ZXh0IjoiXHU5ODg2XHU1M2Q2XHU0ZjE4XHU2MGUwXHU1MjM4IiwibGlua3VybCI6IiIsImljb25jbGFzcyI6Imljb24td29kZXlvdWh1aXF1YW4iLCJyZW1hcmsiOiJcdTY3ZTVcdTc3MGIiLCJkb3RudW0iOiIifSwiQzE0NzQ1MjYyMjIyMDciOnsidGV4dCI6Ilx1NjIxMVx1NzY4NFx1NGYxOFx1NjBlMFx1NTIzOCIsImxpbmt1cmwiOiIiLCJpY29uY2xhc3MiOiJpY29uLWxpbmdxdXlvdWh1aXF1YW4xIiwicmVtYXJrIjoiXHU2N2U1XHU3NzBiIiwiZG90bnVtIjoiIn19LCJpZCI6Imxpc3RtZW51In0sIk0xNDc0NTI2MjUzNjE0Ijp7InN0eWxlIjp7Im1hcmdpbnRvcCI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJpY29uY29sb3IiOiIjOTk5OTk5IiwidGV4dGNvbG9yIjoiIzMzMzMzMyIsInJlbWFya2NvbG9yIjoiIzg4ODg4OCJ9LCJkYXRhIjp7IkMxNDc0NTI2MjUzNjE0Ijp7InRleHQiOiJcdTc5ZWZcdTUyMDZcdTYzOTJcdTg4NGMiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1wYWloYW5nIiwicmVtYXJrIjoiXHU2N2U1XHU3NzBiIiwiZG90bnVtIjoiIn0sIkMxNDc0NTI2MjUzNjE1Ijp7InRleHQiOiJcdTZkODhcdThkMzlcdTYzOTJcdTg4NGMiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi14aWFvZmVpIiwicmVtYXJrIjoiXHU2N2U1XHU3NzBiIiwiZG90bnVtIjoiIn19LCJpZCI6Imxpc3RtZW51In0sIk0xNDc0NTI2MjgxNzYwIjp7InN0eWxlIjp7Im1hcmdpbnRvcCI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJpY29uY29sb3IiOiIjOTk5OTk5IiwidGV4dGNvbG9yIjoiIzMzMzMzMyIsInJlbWFya2NvbG9yIjoiIzg4ODg4OCJ9LCJkYXRhIjp7IkMxNDc0NTI2MjgxNzYwIjp7InRleHQiOiJcdTYyMTFcdTc2ODRcdThkMmRcdTcyNjlcdThmNjYiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1jYXJ0IiwicmVtYXJrIjoiXHU2N2U1XHU3NzBiIiwiZG90bnVtIjoiIn0sIkMxNDc0NTI2MjgxNzYxIjp7InRleHQiOiJcdTYyMTFcdTc2ODRcdTUxNzNcdTZjZTgiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1saWtlIiwicmVtYXJrIjoiXHU2N2U1XHU3NzBiIiwiZG90bnVtIjoiIn0sIkMxNDc0NTI2MjgxNzYyIjp7InRleHQiOiJcdTYyMTFcdTc2ODRcdThkYjNcdThmZjkiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1mb290cHJpbnQiLCJyZW1hcmsiOiJcdTY3ZTVcdTc3MGIiLCJkb3RudW0iOiIifX0sImlkIjoibGlzdG1lbnUifSwiTTE0NzQ1MjYzMDcyNzAiOnsic3R5bGUiOnsibWFyZ2ludG9wIjoiMTAiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImljb25jb2xvciI6IiM5OTk5OTkiLCJ0ZXh0Y29sb3IiOiIjMzMzMzMzIiwicmVtYXJrY29sb3IiOiIjODg4ODg4In0sImRhdGEiOnsiQzE0NzQ1MjYzMDcyNzAiOnsidGV4dCI6Ilx1NjUzNlx1OGQyN1x1NTczMFx1NTc0MFx1N2JhMVx1NzQwNiIsImxpbmt1cmwiOiIiLCJpY29uY2xhc3MiOiJpY29uLWRpbmd3ZWkxIiwicmVtYXJrIjoiXHU2N2U1XHU3NzBiIiwiZG90bnVtIjoiIn0sIkMxNDc0NTI2MzA3MjcxIjp7InRleHQiOiJcdTVlMmVcdTUyYTlcdTRlMmRcdTVmYzMiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1iYW5nemh1MSIsInJlbWFyayI6Ilx1NjdlNVx1NzcwYiIsImRvdG51bSI6IiJ9fSwiaWQiOiJsaXN0bWVudSJ9LCJNMTUwNDE2MDU0ODA5OSI6eyJ0eXBlIjoiMyIsInBhcmFtcyI6eyJiaW5kdXJsIjoiIiwibG9nb3V0dXJsIjoiIn0sInN0eWxlIjp7InN1YmNvbG9yIjoiI2ZmZmZmZiIsIm1haW5jb2xvciI6IiNmZjU1NTUiLCJtYXJnaW50b3AiOiIxMCJ9LCJpZCI6ImxvZ291dCJ9LCJNMTQ3NDU5Nzk3MTIxOCI6eyJwYXJhbXMiOnsiY29udGVudCI6IlBIQWdjM1I1YkdVOUluUmxlSFF0WVd4cFoyNDZJR05sYm5SbGNqc2lQdWVKaU9hZGcrYUpnT2FjaVNBb1l5a2dlSGg0NVpXRzVaK09QQzl3UGc9PSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInBhZGRpbmciOiIyMCJ9LCJpZCI6InJpY2h0ZXh0In19fQ==', '../addons/ewei_shopv2/plugin/diypage/static/template/member1/preview.jpg', 9, 0, 0, 0),
(10, 0, 4, '分销中心01', 'eyJwYWdlIjp7InR5cGUiOiI0IiwidGl0bGUiOiJcdThiZjdcdThmOTNcdTUxNjVcdTk4NzVcdTk3NjJcdTY4MDdcdTk4OTgiLCJuYW1lIjoiXHU2NzJhXHU1NDdkXHU1NDBkXHU5ODc1XHU5NzYyIiwiZGVzYyI6IiIsImljb24iOiIiLCJrZXl3b3JkIjoiIiwiYmFja2dyb3VuZCI6IiNmYWZhZmEiLCJkaXltZW51IjoiLTEiLCJmb2xsb3diYXIiOiIwIiwidmlzaXQiOiIwIiwidmlzaXRsZXZlbCI6eyJtZW1iZXIiOiIiLCJjb21taXNzaW9uIjoiIn0sIm5vdmlzaXQiOnsidGl0bGUiOiIiLCJsaW5rIjoiIn19LCJpdGVtcyI6eyJNMTQ3NTk3NjIxMDU0NiI6eyJwYXJhbXMiOnsic3R5bGUiOiJkZWZhdWx0MSIsInNldGljb24iOiJpY29uLXNldHRpbmdzIiwic2V0bGluayI6IiIsImxlZnRuYXYiOiJcdTYzZDBcdTczYjAxIiwibGVmdG5hdmxpbmsiOiIiLCJyaWdodG5hdiI6Ilx1NjNkMFx1NzNiMDIiLCJyaWdodG5hdmxpbmsiOiIiLCJjZW50ZXJuYXYiOiJcdTYzZDBcdTczYjAiLCJjZW50ZXJuYXZsaW5rIjoiIn0sInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmU1NDU1IiwidGV4dGNvbG9yIjoiI2ZmZmZmZiIsInRleHRsaWdodCI6IiNmZWYzMWYifSwiaWQiOiJtZW1iZXJjIn0sIk0xNDc1OTc2MjEyMzA1Ijp7InBhcmFtcyI6eyJyb3dudW0iOiIzIn0sInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIiwidGlwY29sb3IiOiIjZmViMzEyIn0sImRhdGEiOnsiQzE0NzU5NzYyMTIzMDUiOnsiaWNvbmNsYXNzIjoiaWNvbi1tb25leSIsImljb25jb2xvciI6IiNmZWIzMTIiLCJ0ZXh0IjoiXHU1MjA2XHU5NTAwXHU0ZjYzXHU5MWQxIiwidGV4dGNvbG9yIjoiIzY2NjY2NiIsImxpbmt1cmwiOiIiLCJ0aXBudW0iOiIwLjAwIiwidGlwdGV4dCI6Ilx1NTE0MyJ9LCJDMTQ3NTk3NjIxMjMwNiI6eyJpY29uY2xhc3MiOiJpY29uLWxpc3QiLCJpY29uY29sb3IiOiIjNTBiNmZlIiwidGV4dCI6Ilx1NGY2M1x1OTFkMVx1NjYwZVx1N2VjNiIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJsaW5rdXJsIjoiIiwidGlwbnVtIjoiNTAiLCJ0aXB0ZXh0IjoiXHU3YjE0In0sIkMxNDc1OTc2MjEyMzA4Ijp7Imljb25jbGFzcyI6Imljb24tbWFuYWdlb3JkZXIiLCJpY29uY29sb3IiOiIjZmY3NDFkIiwidGV4dCI6Ilx1NjNkMFx1NzNiMFx1NjYwZVx1N2VjNiIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJsaW5rdXJsIjoiIiwidGlwbnVtIjoiMTAiLCJ0aXB0ZXh0IjoiXHU3YjE0In0sIkMxNDc1OTc2MjEyMzA5Ijp7Imljb25jbGFzcyI6Imljb24tZ3JvdXAiLCJpY29uY29sb3IiOiIjZmY3NDFkIiwidGV4dCI6Ilx1NjIxMVx1NzY4NFx1NGUwYlx1N2ViZiIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJsaW5rdXJsIjoiIiwidGlwbnVtIjoiMiIsInRpcHRleHQiOiJcdTRlYmEifSwiQzE0NzU5NzYyMTIzMTAiOnsiaWNvbmNsYXNzIjoiaWNvbi1xcmNvZGUiLCJpY29uY29sb3IiOiIjZmViMzEyIiwidGV4dCI6Ilx1NjNhOFx1NWU3Zlx1NGU4Y1x1N2VmNFx1NzgwMSIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJsaW5rdXJsIjoiIiwidGlwbnVtIjoiIiwidGlwdGV4dCI6IiJ9LCJDMTQ3NTk3NjIxMjMxMSI6eyJpY29uY2xhc3MiOiJpY29uLXNob3BmaWxsIiwiaWNvbmNvbG9yIjoiIzUwYjZmZSIsInRleHQiOiJcdTVjMGZcdTVlOTdcdThiYmVcdTdmNmUiLCJ0ZXh0Y29sb3IiOiIjNjY2NjY2IiwibGlua3VybCI6IiIsInRpcG51bSI6IiIsInRpcHRleHQiOiIifSwiQzE0NzU5NzYyMTIzMTIiOnsiaWNvbmNsYXNzIjoiaWNvbi1yYW5rIiwiaWNvbmNvbG9yIjoiI2ZmNzQxZCIsInRleHQiOiJcdTRmNjNcdTkxZDFcdTYzOTJcdTU0MGQiLCJ0ZXh0Y29sb3IiOiIjNjY2NjY2IiwibGlua3VybCI6IiIsInRpcG51bSI6IiIsInRpcHRleHQiOiIifX0sImlkIjoiYmxvY2tncm91cCJ9fX0=', '../addons/ewei_shopv2/plugin/diypage/static/template/commission1/preview.jpg', 10, 0, 0, 0);
INSERT INTO `ims_vending_machine_diypage_template` (`id`, `uniacid`, `type`, `name`, `data`, `preview`, `tplid`, `cate`, `deleted`, `merch`) VALUES
(11, 0, 5, '商品详情', 'eyJwYWdlIjp7InR5cGUiOiI1IiwidGl0bGUiOiJcdTU1NDZcdTU0YzFcdThiZTZcdTYwYzUiLCJuYW1lIjoiXHU1NTQ2XHU1NGMxXHU4YmU2XHU2MGM1XHU5ODc1IiwiZGVzYyI6IiIsImljb24iOiIiLCJrZXl3b3JkIjoiIiwiYmFja2dyb3VuZCI6IiNmYWZhZmEiLCJkaXltZW51IjoiLTEiLCJmb2xsb3diYXIiOiIwIiwidmlzaXQiOiIwIiwidmlzaXRsZXZlbCI6eyJtZW1iZXIiOiIiLCJjb21taXNzaW9uIjoiIn0sIm5vdmlzaXQiOnsidGl0bGUiOiIiLCJsaW5rIjoiIn19LCJpdGVtcyI6eyJNMTQ3NzUzOTc2NzU4MyI6eyJ0eXBlIjoiNSIsIm1heCI6IjEiLCJwYXJhbXMiOnsiZ29vZHN0ZXh0IjoiXHU1NTQ2XHU1NGMxIiwiZGV0YWlsdGV4dCI6Ilx1OGJlNlx1NjBjNSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2Y3ZjdmNyIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJhY3RpdmVjb2xvciI6IiNlZjRmNGYifSwiaWQiOiJkZXRhaWxfdGFiIn0sIk0xNDc3NTM5NzY4MDkzIjp7InR5cGUiOiI1IiwibWF4IjoiMSIsInN0eWxlIjp7ImRvdHN0eWxlIjoicm91bmQiLCJkb3RhbGlnbiI6ImxlZnQiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImxlZnRyaWdodCI6IjEwIiwiYm90dG9tIjoiMTAiLCJvcGFjaXR5IjoiMC44In0sImlkIjoiZGV0YWlsX3N3aXBlIn0sIk0xNDgwNTg2MTg5Njc1Ijp7InR5cGUiOiI1IiwibWF4IjoiMSIsInBhcmFtcyI6eyJidXlidG50ZXh0IjoiXHU1MzlmXHU0ZWY3XHU4ZDJkXHU0ZTcwIn0sInN0eWxlIjp7ImJnbGVmdCI6IiNlZjRmNGYiLCJiZ3JpZ2h0IjoiI2ZmZWYzMiIsInByaWNlY29sb3IiOiIjZmZmZmZmIiwibWFya2V0cHJpY2Vjb2xvciI6IiNmZmZmZmYiLCJ0YWdjb2xvciI6IiNmZmZmZmYiLCJzdGF0dXNjb2xvciI6IiNlZjRmNGYiLCJwcm9jZXNzdGV4dGNvbG9yIjoiI2ZmZmZmZmYiLCJwcm9jZXNzY29sb3IiOiIjZmZlZjMyIiwiYmdsZWZ0d2FpdCI6IiMwMGI5NTAiLCJiZ3JpZ2h0d2FpdCI6IiMwMGI5NTAiLCJ0aW1lY29sb3IiOiIjZmZmZmZmIiwidGltZWJnY29sb3IiOiIjNTgyZTE5IiwicHJpY2Vjb2xvcndhaXQiOiIjZmZmZmZmIiwibWFya2V0cHJpY2Vjb2xvcndhaXQiOiIjZmZmZmZmIiwidGFnY29sb3J3YWl0IjoiI2ZmZmZmZiIsInN0YXR1c2NvbG9yd2FpdCI6IiNmZmZmZmYiLCJ0aW1lY29sb3J3YWl0IjoiI2ZmZmZmZiIsInRpbWViZ2NvbG9yd2FpdCI6IiMwMDM3MTgiLCJidXlidG50ZXh0d2FpdCI6IiNmZmZmZmYiLCJidXlidG5iZ3dhaXQiOiIjMDBiOTUwIn0sImlkIjoiZGV0YWlsX3NlY2tpbGwifSwiTTE0Nzc1Mzk3Njg2OTQiOnsidHlwZSI6IjUiLCJtYXgiOiIxIiwicGFyYW1zIjp7InNoYXJlIjoiXHU1MjA2XHU0ZWFiIiwic2hhcmVfbGluayI6IiJ9LCJzdHlsZSI6eyJtYXJnaW50b3AiOiIwIiwibWFyZ2luYm90dG9tIjoiMCIsImJhY2tncm91bmQiOiIjZmZmZmZmIiwidGl0bGVjb2xvciI6IiMzMzMzMzMiLCJzdWJ0aXRsZWNvbG9yIjoiI2VmNGY0ZiIsInByaWNlY29sb3IiOiIjZWY0ZjRmIiwidGV4dGNvbG9yIjoiI2MwYzBjMCIsInRpbWVjb2xvciI6IiNmZmYyZTIiLCJ0aW1ldGV4dGNvbG9yIjoiI2ZmODAwMCJ9LCJpZCI6ImRldGFpbF9pbmZvIn0sIk0xNDc3NTM5NzY5MzY2Ijp7InR5cGUiOiI1IiwibWF4IjoiMSIsInN0eWxlIjp7Im1hcmdpbnRvcCI6IjAiLCJtYXJnaW5ib3R0b20iOiIwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJ0ZXh0Y29sb3IiOiIjNjY2NjY2IiwidGV4dGNvbG9yaGlnaCI6IiNlZjRmNGYifSwiZGF0YSI6eyJDMTQ3NzUzOTc2OTM2NiI6eyJuYW1lIjoiXHU0ZThjXHU2YjIxXHU4ZDJkXHU0ZTcwIiwidHlwZSI6ImVyY2kifSwiQzE0Nzc1Mzk3NjkzNjciOnsibmFtZSI6Ilx1NGYxYVx1NTQ1OFx1NGVmNyIsInR5cGUiOiJodWl5dWFuIn0sIkMxNDc3NTM5NzY5MzY4Ijp7Im5hbWUiOiJcdTRmMThcdTYwZTAiLCJ0eXBlIjoieW91aHVpIn0sIkMxNDc3NTM5NzY5MzY5Ijp7Im5hbWUiOiJcdTc5ZWZcdTUyMDYiLCJ0eXBlIjoiamlmZW4ifSwiQzE0Nzc1Mzk3NjkzNzAiOnsibmFtZSI6Ilx1NGUwZFx1OTE0ZFx1OTAwMVx1NTMzYVx1NTdkZiIsInR5cGUiOiJidXBlaXNvbmcifSwiQzE0Nzc1Mzk3NjkzNzEiOnsibmFtZSI6Ilx1NTU0Nlx1NTRjMVx1NjgwN1x1N2I3ZSIsInR5cGUiOiJiaWFvcWlhbiJ9fSwiaWQiOiJkZXRhaWxfc2FsZSJ9LCJNMTQ3NzUzOTc3MDA3OSI6eyJ0eXBlIjoiNSIsIm1heCI6IjEiLCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInRleHRjb2xvciI6IiMzMzMzMzMiLCJtYXJnaW50b3AiOiIxMCIsIm1hcmdpbmJvdHRvbSI6IjAifSwiaWQiOiJkZXRhaWxfc3BlYyJ9LCJNMTQ3NzUzOTc3MDc5MCI6eyJ0eXBlIjoiNSIsIm1heCI6IjEiLCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsIm1hcmdpbnRvcCI6IjEwIiwibWFyZ2luYm90dG9tIjoiMCIsInRleHRjb2xvciI6IiM3YzdjN2MifSwiaWQiOiJkZXRhaWxfcGFja2FnZSJ9LCJNMTQ3NzUzOTc3MTczNSI6eyJ0eXBlIjoiNSIsIm1heCI6IjEiLCJwYXJhbXMiOnsic2hvcGxvZ28iOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2Mlwvc3RhdGljXC9pbWFnZXNcL2Rlc2lnbmVyLmpwZyIsInNob3BuYW1lIjoiIiwic2hvcGRlc2MiOiIiLCJoaWRlbnVtIjoiMCIsImxlZnRuYXZ0ZXh0IjoiXHU1MTY4XHU5MGU4XHU1NTQ2XHU1NGMxIiwibGVmdG5hdmxpbmsiOiIiLCJyaWdodG5hdnRleHQiOiJcdThmZGJcdTVlOTdcdTkwMWJcdTkwMWIiLCJyaWdodG5hdmxpbmsiOiIifSwic3R5bGUiOnsibWFyZ2ludG9wIjoiMTAiLCJtYXJnaW5ib3R0b20iOiIwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJnb29kc251bWNvbG9yIjoiIzMzMzMzMyIsImdvb2RzdGV4dGNvbG9yIjoiIzdjN2M3YyIsInJpZ2h0bmF2Y29sb3IiOiIjN2M3YzdjIiwic2hvcG5hbWVjb2xvciI6IiMzMzMzMzMiLCJzaG9wZGVzY2NvbG9yIjoiIzQ0NDQ0NCJ9LCJpZCI6ImRldGFpbF9zaG9wIn0sIk0xNDc3NTM5NzcyOTU5Ijp7InR5cGUiOiI1IiwibWF4IjoiMSIsInN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIiwibWFyZ2ludG9wIjoiMTAiLCJtYXJnaW5ib3R0b20iOiIwIiwidGl0bGVjb2xvciI6IiMzMzMzMzMiLCJzaG9wbmFtZWNvbG9yIjoiIzMzMzMzMyIsInNob3BpbmZvY29sb3IiOiIjNjY2NjY2IiwibmF2dGVsY29sb3IiOiIjMDA4MDAwIiwibmF2bG9jYXRpb25jb2xvciI6IiNmZjk5MDAifSwiaWQiOiJkZXRhaWxfc3RvcmUifSwiTTE0Nzc1Mzk3NzM3OTkiOnsidHlwZSI6IjUiLCJtYXgiOiIxIiwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJtYXJnaW50b3AiOiIxMCIsIm1hcmdpbmJvdHRvbSI6IjAifSwiaWQiOiJkZXRhaWxfYnV5c2hvdyJ9LCJNMTQ3NzUzOTc3NDY3OSI6eyJ0eXBlIjoiNSIsIm1heCI6IjEiLCJzdHlsZSI6eyJtYXJnaW50b3AiOiIxMCIsIm1hcmdpbmJvdHRvbSI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJtYWluY29sb3IiOiIjZmQ1NDU0Iiwic3ViY29sb3IiOiIjN2M3YzdjIiwidGV4dGNvbG9yIjoiIzMzMzMzMyJ9LCJpZCI6ImRldGFpbF9jb21tZW50In0sIk0xNDc3NTM5Nzc2NjE1Ijp7InR5cGUiOiI1IiwibWF4IjoiMSIsInN0eWxlIjp7Im1hcmdpbnRvcCI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJ0ZXh0Y29sb3IiOiIjMzMzMzMzIn0sImlkIjoiZGV0YWlsX3B1bGx1cCJ9LCJNMTQ3NzUzOTc3NzM5OSI6eyJ0eXBlIjoiNSIsIm1heCI6IjEiLCJwYXJhbXMiOnsiaGlkZWxpa2UiOiIwIiwiaGlkZXNob3AiOiIwIiwiaGlkZWNhcnQiOiIwIiwiaGlkZWNhcnRidG4iOiIwIiwidGV4dGJ1eSI6Ilx1N2FjYlx1NTIzYlx1OGQyZFx1NGU3MCJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInRleHRjb2xvciI6IiM5OTk5OTkiLCJpY29uY29sb3IiOiIjOTk5OTk5IiwiY2FydGNvbG9yIjoiI2ZlOTQwMiIsImJ1eWNvbG9yIjoiI2ZkNTU1NSIsImRvdGNvbG9yIjoiI2ZmMDAxMSJ9LCJpZCI6ImRldGFpbF9uYXZiYXIifX19', '../addons/ewei_shopv2/plugin/diypage/static/template/detail1/preview.jpg', 11, 0, 0, 0),
(12, 0, 7, '整点秒杀', 'eyJwYWdlIjp7InR5cGUiOiI3IiwidGl0bGUiOiJcdTY1NzRcdTcwYjlcdTc5ZDJcdTY3NDAiLCJuYW1lIjoiXHU2NTc0XHU3MGI5XHU3OWQyXHU2NzQwIiwiZGVzYyI6IiIsImljb24iOiIiLCJrZXl3b3JkIjoiIiwiYmFja2dyb3VuZCI6IiNmYWZhZmEiLCJkaXltZW51IjoiLTEiLCJmb2xsb3diYXIiOiIwIiwidmlzaXQiOiIwIiwidmlzaXRsZXZlbCI6eyJtZW1iZXIiOiIiLCJjb21taXNzaW9uIjoiIn0sIm5vdmlzaXQiOnsidGl0bGUiOiIiLCJsaW5rIjoiIn19LCJpdGVtcyI6eyJNMTQ4MDQ5ODExNTc4MCI6eyJ0eXBlIjoiNyIsIm1heCI6IjEiLCJzdHlsZSI6eyJtYXJnaW50b3AiOiIwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJjb2xvciI6IiMzMzMzMzMiLCJiZ2NvbG9yIjoiI2ZmZmZmZiIsInNlbGVjdGVkY29sb3IiOiIjZmYzMzAwIiwic2VsZWN0ZWRiZ2NvbG9yIjoiI2ZmZmZmZiJ9LCJpZCI6InNlY2tpbGxfdGltZXMifSwiTTE0ODA0OTgxMTgwMTkiOnsidHlwZSI6IjciLCJtYXgiOiIxIiwic3R5bGUiOnsibWFyZ2ludG9wIjoiMTAiLCJtYXJnaW5ib3R0b20iOiIwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYifSwiaWQiOiJzZWNraWxsX2FkdnMifSwiTTE0ODA0OTgxMTcwNDMiOnsidHlwZSI6IjciLCJtYXgiOiIxIiwic3R5bGUiOnsibWFyZ2ludG9wIjoiMTAiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImNvbG9yIjoiIzMzMzMzMyIsImJnY29sb3IiOiIjZmZmZmZmIiwic2VsZWN0ZWRjb2xvciI6IiNlZjRmNGYiLCJzZWxlY3RlZGJnY29sb3IiOiIjZmZmZmZmIn0sImlkIjoic2Vja2lsbF9yb29tcyJ9LCJNMTQ4MDQ5ODExODQ1MyI6eyJ0eXBlIjoiNyIsIm1heCI6IjEiLCJwYXJhbXMiOnsidGl0bGV0ZXh0IjoiXHU1MTQ4XHU0ZTBiXHU1MzU1XHU1MTQ4XHU1Zjk3XHU1NGU2fiIsInRpdGxlb3ZlcnRleHQiOiJcdThmZDhcdTUzZWZcdTRlZTVcdTdlZTdcdTdlZWRcdTYyYTJcdThkMmRcdTU0ZTZ+IiwidGl0bGV3YWl0dGV4dCI6Ilx1NTM3M1x1NWMwNlx1NWYwMFx1NTljYiBcdTUxNDhcdTRlMGJcdTUzNTVcdTUxNDhcdTVmOTdcdTU0ZTYiLCJidG50ZXh0IjoiXHU2MmEyXHU4ZDJkXHU0ZTJkIiwiYnRub3ZlcnRleHQiOiJcdTVkZjJcdTYyYTJcdTViOGMiLCJidG53YWl0dGV4dCI6Ilx1N2I0OVx1NWY4NVx1NjJhMlx1OGQyZCJ9LCJzdHlsZSI6eyJtYXJnaW50b3AiOiIxMCIsIm1hcmdpbmJvdHRvbSI6IjAiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInRvcGJnY29sb3IiOiIjZjBmMmY1IiwidG9wY29sb3IiOiIjMzMzMzMzIiwidGltZWJnY29sb3IiOiIjNDY0NTUzIiwidGltZWNvbG9yIjoiI2ZmZmZmZiIsInRpdGxlY29sb3IiOiIjMzMzMzMzIiwicHJpY2Vjb2xvciI6IiNlZjRmNGYiLCJtYXJrZXRwcmljZWNvbG9yIjoiIzk0OTU5OCIsImJ0bmJnY29sb3IiOiIjZWY0ZjRmIiwiYnRub3ZlcmJnY29sb3IiOiIjZjdmN2Y3IiwiYnRud2FpdGJnY29sb3IiOiIjMDRiZTAyIiwiYnRuY29sb3IiOiIjZmZmZmZmIiwiYnRub3ZlcmNvbG9yIjoiIzMzMzMzMyIsImJ0bndhaXRjb2xvciI6IiNmZmZmZmYiLCJwcm9jZXNzdGV4dGNvbG9yIjoiI2QwZDFkMiIsInByb2Nlc3NiZ2NvbG9yIjoiI2ZmOGY4ZiJ9LCJpZCI6InNlY2tpbGxfbGlzdCJ9fX0=', '../addons/ewei_shopv2/plugin/diypage/static/template/seckill/preview.png', 12, 0, 0, 0),
(13, 0, 6, '积分商城', 'eyJwYWdlIjp7InR5cGUiOiI2IiwidGl0bGUiOiJcdTc5ZWZcdTUyMDZcdTU1NDZcdTU3Y2UiLCJuYW1lIjoiXHU2ZDRiXHU4YmQ1XHU3OWVmXHU1MjA2XHU1NTQ2XHU1N2NlXHU5ODc1XHU5NzYyIiwiZGVzYyI6IiIsImljb24iOiIiLCJrZXl3b3JkIjoiIiwiYmFja2dyb3VuZCI6IiNmYWZhZmEiLCJkaXltZW51IjoiLTEiLCJmb2xsb3diYXIiOiIwIiwidmlzaXQiOiIwIiwidmlzaXRsZXZlbCI6eyJtZW1iZXIiOiIiLCJjb21taXNzaW9uIjoiIn0sIm5vdmlzaXQiOnsidGl0bGUiOiIiLCJsaW5rIjoiIn19LCJpdGVtcyI6eyJNMTQ3OTI2MTA2MTY0NSI6eyJzdHlsZSI6eyJkb3RzdHlsZSI6InJvdW5kIiwiZG90YWxpZ24iOiJjZW50ZXIiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImxlZnRyaWdodCI6IjUiLCJib3R0b20iOiI1Iiwib3BhY2l0eSI6IjAuOCJ9LCJkYXRhIjp7IkMxNDc5MjYxMDYxNjQ1Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2NyZWRpdHNob3BcL2Jhbm5lcjEucG5nIiwibGlua3VybCI6IiJ9LCJDMTQ3OTI2MTA2MTY0NiI6eyJpbWd1cmwiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL3RlbXBsYXRlXC9jcmVkaXRzaG9wXC9iYW5uZXIyLnBuZyIsImxpbmt1cmwiOiIifX0sImlkIjoiYmFubmVyIn0sIk0xNDc5MjY4MTE0MTYxIjp7InN0eWxlIjp7Im1hcmdpbnRvcCI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYifSwiZGF0YSI6eyJDMTQ3OTI2ODExNDE2MSI6eyJ0ZXh0IjoiXHU2MjExXHU3Njg0XHU3OWVmXHU1MjA2IiwiaWNvbmNsYXNzIjoiaWNvbi1qaWZlbiIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJpY29uY29sb3IiOiIjNjY2NjY2IiwibGlua3VybCI6IiJ9LCJDMTQ3OTI2ODExNDE2MiI6eyJ0ZXh0IjoiXHU1MTUxXHU2MzYyXHU4YmIwXHU1ZjU1IiwiaWNvbmNsYXNzIjoiaWNvbi1saXN0IiwidGV4dGNvbG9yIjoiIzY2NjY2NiIsImljb25jb2xvciI6IiM2NjY2NjYiLCJsaW5rdXJsIjoiIn19LCJpZCI6Im1lbnUyIn0sIk0xNDc5MjkwNzk1NDI3Ijp7InBhcmFtcyI6eyJwbGFjZWhvbGRlciI6Ilx1OGJmN1x1OGY5M1x1NTE2NVx1NTE3M1x1OTUyZVx1NWI1N1x1OGZkYlx1ODg0Y1x1NjQxY1x1N2QyMiIsImdvb2RzdHlwZSI6IjEifSwic3R5bGUiOnsiaW5wdXRiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImJhY2tncm91bmQiOiIjZjFmMWYyIiwiaWNvbmNvbG9yIjoiI2I0YjRiNCIsImNvbG9yIjoiIzk5OTk5OSIsInBhZGRpbmd0b3AiOiI2IiwicGFkZGluZ2xlZnQiOiIxMCIsInRleHRhbGlnbiI6ImxlZnQiLCJzZWFyY2hzdHlsZSI6IiJ9LCJpZCI6InNlYXJjaCJ9LCJNMTQ3OTU0NDYxOTQ0MCI6eyJzdHlsZSI6eyJoZWlnaHQiOiIxMCIsImJhY2tncm91bmQiOiIjZmFmYWZhIn0sImlkIjoiYmxhbmsifSwiTTE0NzkyNjEwNzYzMzMiOnsic3R5bGUiOnsibmF2c3R5bGUiOiIiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInJvd251bSI6IjQiLCJzaG93dHlwZSI6IjAiLCJzaG93ZG90IjoiMSIsInBhZ2VudW0iOiI4In0sImRhdGEiOnsiQzE0NzkyNjEwNzYzMzMiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvY3JlZGl0c2hvcFwveGlhbmppbmhvbmdiYW8ucG5nIiwibGlua3VybCI6IiIsInRleHQiOiJcdTczYjBcdTkxZDFcdTdlYTJcdTUzMDUiLCJjb2xvciI6IiM2NjY2NjYifSwiQzE0NzkyNjEwNzYzMzQiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvY3JlZGl0c2hvcFwvamluZ21laXNoaXd1LnBuZyIsImxpbmt1cmwiOiIiLCJ0ZXh0IjoiXHU3Y2JlXHU3ZjhlXHU1YjllXHU3MjY5IiwiY29sb3IiOiIjNjY2NjY2In0sIkMxNDc5MjYxMDc2MzM1Ijp7ImltZ3VybCI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvdGVtcGxhdGVcL2NyZWRpdHNob3BcL3lvdWh1aXF1YW4ucG5nIiwibGlua3VybCI6IiIsInRleHQiOiJcdTRmMThcdTYwZTBcdTUyMzgiLCJjb2xvciI6IiM2NjY2NjYifSwiQzE0NzkyNjEwNzYzMzYiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC90ZW1wbGF0ZVwvY3JlZGl0c2hvcFwveXVlamlhbmdsaS5wbmciLCJsaW5rdXJsIjoiIiwidGV4dCI6Ilx1NGY1OVx1OTg5ZFx1NTk1Nlx1NTJiMSIsImNvbG9yIjoiIzY2NjY2NiJ9fSwiaWQiOiJtZW51In0sIk0xNDc5MjYxNDUwNzM0Ijp7InN0eWxlIjp7Im1hcmdpbnRvcCI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJpY29uY29sb3IiOiIjOTk5OTk5IiwidGV4dGNvbG9yIjoiIzMzMzMzMyIsInJlbWFya2NvbG9yIjoiIzg4ODg4OCJ9LCJkYXRhIjp7IkMxNDc5MjYxNDUwNzM0Ijp7InRleHQiOiJcdTdjYmVcdTdmOGVcdTViOWVcdTcyNjlcdTYyYmRcdTU5NTYiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1naWZ0cyIsInJlbWFyayI6Ilx1NjZmNFx1NTkxYSIsImRvdG51bSI6IiJ9fSwiaWQiOiJsaXN0bWVudSJ9LCJNMTQ3OTU0Mzc4MTg2NyI6eyJwYXJhbXMiOnsiZ29vZHN0eXBlIjoiMSIsInNob3d0aXRsZSI6IjEiLCJzaG93cHJpY2UiOiIxIiwic2hvd3RhZyI6IjIiLCJnb29kc2RhdGEiOiI1IiwiY2F0ZWlkIjoiIiwiY2F0ZW5hbWUiOiIiLCJncm91cGlkIjoiIiwiZ3JvdXBuYW1lIjoiIiwiZ29vZHNzb3J0IjoiMCIsImdvb2RzbnVtIjoiNiIsInNob3dpY29uIjoiMSIsImljb25wb3NpdGlvbiI6ImxlZnQgdG9wIiwicHJvZHVjdHByaWNlIjoiMSIsImdvb2Rzc2Nyb2xsIjoiMSJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImxpc3RzdHlsZSI6ImJsb2NrIiwiYnV5c3R5bGUiOiJidXlidG4tMSIsImdvb2RzaWNvbiI6InJlY29tbWFuZCIsInByaWNlY29sb3IiOiIjZWQyODIyIiwiaWNvbnBhZGRpbmd0b3AiOiIwIiwiaWNvbnBhZGRpbmdsZWZ0IjoiMCIsImJ1eWJ0bmNvbG9yIjoiI2ZlNTQ1NSIsImljb256b29tIjoiMTAwIiwidGl0bGVjb2xvciI6IiMyNjI2MjYiLCJ0YWdiYWNrZ3JvdW5kIjoiI2ZlNTQ1NSJ9LCJkYXRhIjp7IkMxNDc5NTQzNzgxODY3Ijp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTEuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIiwiYmFyZ2FpbiI6IjAiLCJjcmVkaXQiOiIwIiwiY3R5cGUiOiIxIn0sIkMxNDc5NTQzNzgxODY4Ijp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTIuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIiwiYmFyZ2FpbiI6IjAiLCJjcmVkaXQiOiIwIiwiY3R5cGUiOiIxIn0sIkMxNDc5NTQzNzgxODY5Ijp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTMuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIiwiYmFyZ2FpbiI6IjAiLCJjcmVkaXQiOiIwIiwiY3R5cGUiOiIwIn0sIkMxNDc5NTQzNzgxODcwIjp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTQuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIiwiYmFyZ2FpbiI6IjAiLCJjcmVkaXQiOiIwIiwiY3R5cGUiOiIwIn19LCJpZCI6Imdvb2RzIn0sIk0xNDc5MjYxNTk0MDc3Ijp7InN0eWxlIjp7Im1hcmdpbnRvcCI6IjEwIiwiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJpY29uY29sb3IiOiIjOTk5OTk5IiwidGV4dGNvbG9yIjoiIzMzMzMzMyIsInJlbWFya2NvbG9yIjoiIzg4ODg4OCJ9LCJkYXRhIjp7IkMxNDc5MjYxNTk0MDc3Ijp7InRleHQiOiJcdTU1NDZcdTU3Y2VcdTRmMThcdTYwZTBcdTUyMzgiLCJsaW5rdXJsIjoiIiwiaWNvbmNsYXNzIjoiaWNvbi1naWZ0cyIsInJlbWFyayI6Ilx1NjZmNFx1NTkxYSIsImRvdG51bSI6IiJ9fSwiaWQiOiJsaXN0bWVudSJ9LCJNMTQ3OTI2MTY1NTkxOSI6eyJwYXJhbXMiOnsic2hvd3RpdGxlIjoiMSIsInNob3dwcmljZSI6IjEiLCJnb29kc2RhdGEiOiIxIiwiY2F0ZWlkIjoiOTAiLCJjYXRlbmFtZSI6Ilx1NmQ0Ylx1OGJkNVx1NTIwNlx1N2M3YjAxMCIsImdyb3VwaWQiOiIiLCJncm91cG5hbWUiOiIiLCJnb29kc3NvcnQiOiIwIiwiZ29vZHNudW0iOiI2Iiwic2hvd2ljb24iOiIxIiwiaWNvbnBvc2l0aW9uIjoibGVmdCB0b3AiLCJnb29kc3R5cGUiOiIxIiwiZ29vZHNzY3JvbGwiOiIwIn0sInN0eWxlIjp7Imxpc3RzdHlsZSI6IiIsImJ1eXN0eWxlIjoiYnV5YnRuLTEiLCJnb29kc2ljb24iOiJyZWNvbW1hbmQiLCJwcmljZWNvbG9yIjoiI2VkMjgyMiIsImljb25wYWRkaW5ndG9wIjoiMCIsImljb25wYWRkaW5nbGVmdCI6IjAiLCJidXlidG5jb2xvciI6IiNmZTU0NTUiLCJpY29uem9vbSI6IjEwMCIsInRpdGxlY29sb3IiOiIjMjYyNjI2In0sImRhdGEiOnsiQzE0NzkyNjE2NTU5MTkiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtMS5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIiLCJiYXJnYWluIjoiMCJ9LCJDMTQ3OTI2MTY1NTkyMCI6eyJ0aHVtYiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9nb29kcy0yLmpwZyIsInByaWNlIjoiMjAuMDAiLCJ0aXRsZSI6Ilx1OGZkOVx1OTFjY1x1NjYyZlx1NTU0Nlx1NTRjMVx1NjgwN1x1OTg5OCIsImdpZCI6IiIsImJhcmdhaW4iOiIwIn0sIkMxNDc5MjYxNjU1OTIxIjp7InRodW1iIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2dvb2RzLTMuanBnIiwicHJpY2UiOiIyMC4wMCIsInRpdGxlIjoiXHU4ZmQ5XHU5MWNjXHU2NjJmXHU1NTQ2XHU1NGMxXHU2ODA3XHU5ODk4IiwiZ2lkIjoiIiwiYmFyZ2FpbiI6IjAifSwiQzE0NzkyNjE2NTU5MjIiOnsidGh1bWIiOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvZ29vZHMtNC5qcGciLCJwcmljZSI6IjIwLjAwIiwidGl0bGUiOiJcdThmZDlcdTkxY2NcdTY2MmZcdTU1NDZcdTU0YzFcdTY4MDdcdTk4OTgiLCJnaWQiOiIiLCJiYXJnYWluIjoiMCJ9fSwiaWQiOiJnb29kcyJ9fX0=', '../addons/ewei_shopv2/plugin/diypage/static/template/creditshop/preview.png', 13, 0, 0, 0),
(15, 0, 4, '新分销中心', 'eyJwYWdlIjp7InR5cGUiOiI0IiwidGl0bGUiOiJcdTUyMDZcdTk1MDBcdTRlMmRcdTVmYzMiLCJuYW1lIjoiXHU1MjA2XHU5NTAwXHU0ZTJkXHU1ZmMzIiwiZGVzYyI6IiIsImljb24iOiIiLCJrZXl3b3JkIjoiIiwiYmFja2dyb3VuZCI6IiNmM2YzZjMiLCJkaXltZW51IjoiLTEiLCJmb2xsb3diYXIiOiIwIiwidmlzaXQiOiIwIiwidmlzaXRsZXZlbCI6eyJtZW1iZXIiOiIiLCJjb21taXNzaW9uIjoiIn0sIm5vdmlzaXQiOnsidGl0bGUiOiIiLCJsaW5rIjoiIn19LCJpdGVtcyI6eyJNMTQ3NTk3NjIxMDU0NiI6eyJwYXJhbXMiOnsic3R5bGUiOiJkZWZhdWx0MyIsInNldGljb24iOiJpY29uLXNldHRpbmdzIiwic2V0bGluayI6Ii5cL2luZGV4LnBocD9pPTEyJmM9ZW50cnkmbT1ld2VpX3Nob3B2MiZkbz1tb2JpbGUmcj1nb29kcyZpc3RpbWU9MSIsImxlZnRuYXYiOiJcdTYzZDBcdTczYjAxIiwibGVmdG5hdmxpbmsiOiIiLCJyaWdodG5hdiI6Ilx1NjNkMFx1NzNiMDIiLCJyaWdodG5hdmxpbmsiOiIiLCJjZW50ZXJuYXYiOiJcdTYzZDBcdTczYjAiLCJjZW50ZXJuYXZsaW5rIjoiIiwiaGlkZXVwIjoiMCJ9LCJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZlYTIzZCIsInRleHRjb2xvciI6IiNmZmZmZmYiLCJ0ZXh0bGlnaHQiOiIjZmZmZmZmIn0sImlkIjoibWVtYmVyYyJ9LCJNMTUyNjYyMTY5MzUxNyI6eyJzdHlsZSI6eyJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsInRleHRjb2xvciI6IiMwMDAwMDAiLCJpY29uY29sb3IiOiIjZmY4MDAwIn0sInBhcmFtcyI6eyJpY29uY2xhc3MiOiJpY29uLWxpbmsifSwidHlwZSI6IjQiLCJpZCI6ImNvbW1pc3Npb25fc2hhcmVjb2RlIn0sIk0xNTI2ODcwNDk3MjQwIjp7InN0eWxlIjp7ImJhY2tncm91bmQiOiIjZmZmZmZmIiwicHJpY2Vjb2xvciI6IiNmZjgwMDAiLCJ0ZXh0Y29sb3IiOiIjMDAwMDAwIiwiYnRuY29sb3IiOiIjZmY4MDAwIn0sInR5cGUiOiI0IiwibWF4IjoiMSIsImlkIjoiY29tbWlzc2lvbl9ibG9jayJ9LCJNMTUyNjYxNTc2ODY3MiI6eyJzdHlsZSI6eyJoZWlnaHQiOiIxMCIsImJhY2tncm91bmQiOiIjZjNmM2YzIn0sImlkIjoiYmxhbmsifSwiTTE0NzU5NzYyMTIzMDUiOnsicGFyYW1zIjp7InJvd251bSI6IjIiLCJuZXdzdHlsZSI6IjEifSwic3R5bGUiOnsiYmFja2dyb3VuZCI6IiNmZmZmZmYiLCJ0aXBjb2xvciI6IiNmZWIzMTIifSwiZGF0YSI6eyJDMTQ3NTk3NjIxMjMwNSI6eyJpY29uY2xhc3MiOiJpY29uLXFpYW4iLCJpY29uY29sb3IiOiIjZmViMzEyIiwidGV4dCI6Ilx1NTIwNlx1OTUwMFx1NGY2M1x1OTFkMSIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJ0aXBudW0iOiIwLjAwIiwidGlwdGV4dCI6Ilx1NTE0MyJ9LCJDMTQ3NTk3NjIxMjMwNiI6eyJpY29uY2xhc3MiOiJpY29uLWRpbmdkYW4yIiwiaWNvbmNvbG9yIjoiIzUwYjZmZSIsInRleHQiOiJcdTRmNjNcdTkxZDFcdTY2MGVcdTdlYzYiLCJ0ZXh0Y29sb3IiOiIjNjY2NjY2IiwibGlua3VybCI6IiIsInRpcG51bSI6IjUwIiwidGlwdGV4dCI6Ilx1N2IxNCJ9LCJDMTQ3NTk3NjIxMjMwOCI6eyJpY29uY2xhc3MiOiJpY29uLXRpeGlhbjEiLCJpY29uY29sb3IiOiIjZmY3NDFkIiwidGV4dCI6Ilx1NjNkMFx1NzNiMFx1NjYwZVx1N2VjNiIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJsaW5rdXJsIjoiIiwidGlwbnVtIjoiMTAiLCJ0aXB0ZXh0IjoiXHU3YjE0In0sIkMxNDc1OTc2MjEyMzA5Ijp7Imljb25jbGFzcyI6Imljb24taGVpbG9uZ2ppYW5ndHViaWFvMTEiLCJpY29uY29sb3IiOiIjZmY3NDFkIiwidGV4dCI6Ilx1NjIxMVx1NzY4NFx1NGUwYlx1N2ViZiIsInRleHRjb2xvciI6IiM2NjY2NjYiLCJsaW5rdXJsIjoiIiwidGlwbnVtIjoiMiIsInRpcHRleHQiOiJcdTRlYmEifX0sImlkIjoiYmxvY2tncm91cCJ9LCJNMTUyNjYxNDU1MzE1MSI6eyJzdHlsZSI6eyJtYXJnaW50b3AiOiIxMCIsImJhY2tncm91bmQiOiIjZmZmZmZmIiwiaWNvbmNvbG9yIjoiI2ZmODAwMCIsInRleHRjb2xvciI6IiMwMDAwMDAiLCJyZW1hcmtjb2xvciI6IiM4ODg4ODgifSwiZGF0YSI6eyJDMTUyNjYxNDU1MzE1MiI6eyJ0ZXh0IjoiXHU2M2E4XHU1ZTdmXHU0ZThjXHU3ZWY0XHU3ODAxIiwibGlua3VybCI6IiIsImljb25jbGFzcyI6Imljb24tZXJ3ZWltYTEiLCJyZW1hcmsiOiIiLCJkb3RudW0iOiIifX0sImlkIjoibGlzdG1lbnUifSwiTTE1MjY2MTQ1NzUyMTIiOnsic3R5bGUiOnsibWFyZ2ludG9wIjoiMTAiLCJiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImljb25jb2xvciI6IiNmZjgwMDAiLCJ0ZXh0Y29sb3IiOiIjMDAwMDAwIiwicmVtYXJrY29sb3IiOiIjODg4ODg4In0sImRhdGEiOnsiQzE1MjY2MTQ1NzUyMTIiOnsidGV4dCI6Ilx1NWMwZlx1NWU5N1x1OGJiZVx1N2Y2ZSIsImxpbmt1cmwiOiIiLCJpY29uY2xhc3MiOiJpY29uLXNob3AiLCJyZW1hcmsiOiIiLCJkb3RudW0iOiIifX0sImlkIjoibGlzdG1lbnUifX19', '', 15, 0, 0, 0),
(14, 0, 8, '兑换中心', 'eyJwYWdlIjp7InR5cGUiOiI4IiwidGl0bGUiOiJcdTUxNTFcdTYzNjJcdTRlMmRcdTVmYzMiLCJuYW1lIjoiXHU1MTUxXHU2MzYyXHU0ZTJkXHU1ZmMzXHU2YTIxXHU2NzdmIiwiZGVzYyI6IiIsImljb24iOiIiLCJrZXl3b3JkIjoiIiwiYmFja2dyb3VuZCI6IiNmYWZhZmEiLCJkaXltZW51IjoiLTEiLCJkaXlsYXllciI6IjAiLCJkaXlnb3RvcCI6IjAiLCJmb2xsb3diYXIiOiIwIiwidmlzaXQiOiIwIiwidmlzaXRsZXZlbCI6eyJtZW1iZXIiOiIiLCJjb21taXNzaW9uIjoiIn0sIm5vdmlzaXQiOnsidGl0bGUiOiIiLCJsaW5rIjoiIn19LCJpdGVtcyI6eyJNMTQ4MjM3Mjk0MjA3NSI6eyJtYXgiOiIxIiwidHlwZSI6IjgiLCJwYXJhbXMiOnsiZGF0YXR5cGUiOiIwIn0sInN0eWxlIjp7ImRvdHN0eWxlIjoicm91bmQiLCJkb3RhbGlnbiI6ImNlbnRlciIsImJhY2tncm91bmQiOiIjZmZmZmZmIiwibGVmdHJpZ2h0IjoiNSIsImJvdHRvbSI6IjUiLCJvcGFjaXR5IjoiMC44In0sImRhdGEiOnsiQzE0ODIzNzI5NDIwNzUiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2Jhbm5lci0xLmpwZyIsImxpbmt1cmwiOiIifSwiQzE0ODIzNzI5NDIwNzYiOnsiaW1ndXJsIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2Jhbm5lci0yLmpwZyIsImxpbmt1cmwiOiIifX0sImlkIjoiZXhjaGFuZ2VfYmFubmVyIn0sIk0xNDgyMzcyOTQyNTE1Ijp7Im1heCI6IjEiLCJ0eXBlIjoiOCIsInBhcmFtcyI6eyJwcmV2aWV3IjoiMCIsInRpdGxlIjoiXHU1MTUxXHU2MzYyXHU3ODAxXHU1MTUxXHU2MzYyIiwicGxhY2Vob2xkZXIiOiJcdThiZjdcdThmOTNcdTUxNjVcdTUxNTFcdTYzNjJcdTc4MDEiLCJidG50ZXh0IjoiXHU3YWNiXHU1MzczXHU1MTUxXHU2MzYyIiwiYmFja2J0biI6Ilx1OGZkNFx1NTZkZVx1OTFjZFx1NjViMFx1OGY5M1x1NTE2NVx1NTE1MVx1NjM2Mlx1NzgwMSIsImV4YnRudGV4dCI6Ilx1NTE1MVx1NjM2MiIsImV4YnRuMnRleHQiOiJcdTVkZjJcdTUxNTFcdTYzNjIiLCJjcmVkaXRpY29uIjoiLi5cL2FkZG9uc1wvZXdlaV9zaG9wdjJcL3BsdWdpblwvZGl5cGFnZVwvc3RhdGljXC9pbWFnZXNcL2RlZmF1bHRcL2ljb25fY3JlZGl0LnBuZyIsIm1vbmV5aWNvbiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9pY29uX21vbmV5LnBuZyIsImNvdXBvbmljb24iOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvaWNvbl9jb3Vwb24ucG5nIiwicmVkYmFnaWNvbiI6Ii4uXC9hZGRvbnNcL2V3ZWlfc2hvcHYyXC9wbHVnaW5cL2RpeXBhZ2VcL3N0YXRpY1wvaW1hZ2VzXC9kZWZhdWx0XC9pY29uX3JlZGJhZy5wbmciLCJnb29kc2ljb24iOiIuLlwvYWRkb25zXC9ld2VpX3Nob3B2MlwvcGx1Z2luXC9kaXlwYWdlXC9zdGF0aWNcL2ltYWdlc1wvZGVmYXVsdFwvaWNvbl9nb29kcy5wbmcifSwic3R5bGUiOnsidGl0bGVjb2xvciI6IiM0NDQ0NDQiLCJidG5jb2xvciI6IiNmZmZmZmYiLCJidG5iYWNrZ3JvdW5kIjoiI2VkNTU2NSIsImlucHV0Y29sb3IiOiIjNjY2NjY2IiwiaW5wdXRiYWNrZ3JvdW5kIjoiI2ZmZmZmZiIsImlucHV0Ym9yZGVyIjoiI2VmZWZlZiIsImNvZGVjb2xvciI6IiM0NDQ0NDQiLCJudW1jb2xvciI6IiM5OTk5OTkiLCJleGJ0bmNvbG9yIjoiI2ZmZmZmZiIsImV4YnRuYmFja2dyb3VuZCI6IiNlZDU1NjUiLCJleGJ0bjJjb2xvciI6IiNmZmZmZmYiLCJleGJ0bjJiYWNrZ3JvdW5kIjoiI2NjY2NjYyIsImJhY2tidG5jb2xvciI6IiM0NDQ0NDQiLCJiYWNrYnRuYm9yZGVyIjoiI2U3ZWFlYyIsImJhY2tidG5iYWNrZ3JvdW5kIjoiI2Y3ZjdmNyIsImdvb2RzdGl0bGUiOiIjNDQ0NDQ0IiwiZ29vZHNwcmljZSI6IiNhYWFhYWEifSwiaWQiOiJleGNoYW5nZV9pbnB1dCJ9LCJNMTQ4MjM3Mjk0MzE3MyI6eyJtYXgiOiIxIiwidHlwZSI6IjgiLCJwYXJhbXMiOnsicnVsZXRpdGxlIjoiXHU1MTUxXHU2MzYyXHU4OWM0XHU1MjE5In0sInN0eWxlIjp7InJ1bGV0aXRsZWNvbG9yIjoiIzU1NTU1NSJ9LCJpZCI6ImV4Y2hhbmdlX3J1bGUifX19', '../addons/ewei_shopv2/plugin/diypage/static/template/exchange/preview.png', 14, 0, 0, 0);

DROP TABLE IF EXISTS `ims_vending_machine_diypage_template_category`;
CREATE TABLE `ims_vending_machine_diypage_template_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `merch` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exchange_cart`;
CREATE TABLE `ims_vending_machine_exchange_cart` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(100) DEFAULT NULL,
  `goodsid` int(11) DEFAULT NULL,
  `total` int(10) DEFAULT '1',
  `marketprice` decimal(10,2) DEFAULT NULL,
  `optionid` int(11) DEFAULT NULL,
  `selected` tinyint(1) DEFAULT '1',
  `deleted` tinyint(1) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `serial` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exchange_code`;
CREATE TABLE `ims_vending_machine_exchange_code` (
`id` int(11) NOT NULL,
  `groupid` int(11) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `endtime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00',
  `status` int(2) NOT NULL DEFAULT '1',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `count` int(11) NOT NULL DEFAULT '0',
  `key` varchar(255) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '0',
  `scene` int(11) NOT NULL DEFAULT '0',
  `qrcode_url` varchar(255) NOT NULL DEFAULT '',
  `serial` varchar(255) NOT NULL DEFAULT '',
  `balancestatus` int(11) DEFAULT '1',
  `redstatus` int(11) DEFAULT '1',
  `scorestatus` int(11) DEFAULT '1',
  `couponstatus` int(11) DEFAULT '1',
  `goodsstatus` int(11) DEFAULT NULL,
  `repeatcount` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exchange_group`;
CREATE TABLE `ims_vending_machine_exchange_group` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `type` int(2) NOT NULL DEFAULT '0',
  `endtime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00',
  `mode` int(2) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `max` int(2) NOT NULL DEFAULT '0',
  `value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `starttime` datetime NOT NULL DEFAULT '2016-10-01 00:00:00',
  `goods` text,
  `score` int(11) NOT NULL DEFAULT '0',
  `coupon` text,
  `use` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  `red` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance_left` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balance_right` decimal(10,2) NOT NULL DEFAULT '0.00',
  `red_left` decimal(10,2) NOT NULL DEFAULT '0.00',
  `red_right` decimal(10,2) NOT NULL DEFAULT '0.00',
  `score_left` int(11) NOT NULL DEFAULT '0',
  `score_right` int(11) NOT NULL DEFAULT '0',
  `balance_type` int(11) NOT NULL,
  `red_type` int(11) NOT NULL,
  `score_type` int(11) NOT NULL,
  `title_reply` varchar(255) NOT NULL DEFAULT '',
  `img` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `rule` text NOT NULL,
  `coupon_type` varchar(255) DEFAULT NULL,
  `basic_content` varchar(500) NOT NULL DEFAULT '',
  `reply_type` int(11) NOT NULL DEFAULT '0',
  `code_type` int(11) NOT NULL DEFAULT '0',
  `binding` int(11) NOT NULL DEFAULT '0',
  `showcount` int(11) DEFAULT '0',
  `postage` decimal(10,2) DEFAULT '0.00',
  `postage_type` int(11) DEFAULT '0',
  `banner` varchar(800) DEFAULT '',
  `keyword_reply` int(11) DEFAULT '0',
  `reply_status` int(11) DEFAULT '1',
  `reply_keyword` varchar(255) DEFAULT '',
  `input_banner` varchar(255) DEFAULT '',
  `diypage` int(11) NOT NULL DEFAULT '0',
  `sendname` varchar(255) DEFAULT '',
  `wishing` varchar(255) DEFAULT '',
  `actname` varchar(255) DEFAULT '',
  `remark` varchar(255) DEFAULT '',
  `repeat` int(11) NOT NULL DEFAULT '0',
  `koulingstart` varchar(255) NOT NULL DEFAULT '',
  `koulingend` varchar(255) NOT NULL DEFAULT '',
  `kouling` tinyint(1) NOT NULL DEFAULT '0',
  `chufa` varchar(255) NOT NULL DEFAULT '',
  `chufaend` varchar(255) NOT NULL DEFAULT '',
  `goods_native` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exchange_query`;
CREATE TABLE `ims_vending_machine_exchange_query` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `querykey` varchar(255) NOT NULL DEFAULT '',
  `querytime` int(11) NOT NULL DEFAULT '0',
  `unfreeze` int(11) NOT NULL DEFAULT '0',
  `errorcount` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exchange_record`;
CREATE TABLE `ims_vending_machine_exchange_record` (
`id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL DEFAULT '',
  `uniacid` int(11) DEFAULT NULL,
  `goods` text,
  `orderid` varchar(255) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '',
  `mode` int(11) NOT NULL DEFAULT '0',
  `balance` decimal(10,2) DEFAULT '0.00',
  `red` decimal(10,2) NOT NULL DEFAULT '0.00',
  `coupon` text,
  `score` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `groupid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `serial` varchar(255) NOT NULL DEFAULT '',
  `ordersn` varchar(255) NOT NULL DEFAULT '',
  `goods_title` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exchange_setting`;
CREATE TABLE `ims_vending_machine_exchange_setting` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `freeze` int(11) NOT NULL DEFAULT '0',
  `mistake` int(11) NOT NULL DEFAULT '0',
  `grouplimit` int(11) NOT NULL DEFAULT '0',
  `alllimit` int(11) NOT NULL DEFAULT '0',
  `no_qrimg` tinyint(3) NOT NULL DEFAULT '1',
  `rule` text,
  `coupon_templateid` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exhelper_esheet`;
CREATE TABLE `ims_vending_machine_exhelper_esheet` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `express` varchar(50) DEFAULT '',
  `code` varchar(20) NOT NULL DEFAULT '',
  `datas` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_exhelper_esheet` (`id`, `name`, `express`, `code`, `datas`) VALUES
(1, '顺丰', 'shunfeng', 'SF', 'a:2:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}i:1;a:4:{s:5:\"style\";s:9:\"三联210\";s:4:\"spec\";s:38:\"（宽100mm 高210mm 切点90/60/60）\";s:4:\"size\";s:3:\"210\";s:9:\"isdefault\";i:0;}}'),
(2, '百世快递', 'huitongkuaidi', 'HTKY', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联183\";s:4:\"spec\";s:37:\"（宽100mm 高183mm 切点87/5/91）\";s:4:\"size\";s:3:\"183\";s:9:\"isdefault\";i:1;}}'),
(3, '韵达', 'yunda', 'YD', 'a:3:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:0;}i:1;a:4:{s:5:\"style\";s:9:\"二联203\";s:4:\"spec\";s:36:\"（宽100mm 高203mm 切点152/51）\";s:4:\"size\";s:3:\"203\";s:9:\"isdefault\";i:1;}i:2;a:4:{s:5:\"style\";s:9:\"一联130\";s:4:\"spec\";s:35:\"（宽76mm 高130mm 切点152/51）\";s:4:\"size\";s:3:\"130\";s:9:\"isdefault\";i:0;}}'),
(4, '申通', 'shentong', 'STO', 'a:2:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}i:1;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:35:\"（宽100mm 高150mm 切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:0;}}'),
(5, '圆通', 'yuantong', 'YTO', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}'),
(6, 'EMS', 'ems', 'EMS', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}'),
(7, '中通', 'zhongtong', 'ZTO', 'a:1:{i:0;a:4:{s:5:\"style\";s:8:\"单联76\";s:4:\"spec\";s:17:\"(宽76mm高130mm)\";s:4:\"size\";s:2:\"76\";s:9:\"isdefault\";i:0;}}'),
(8, '德邦', 'debangwuliu', 'DBL', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联177\";s:4:\"spec\";s:34:\"（宽100mm高177mm切点107/70）\";s:4:\"size\";s:3:\"177\";s:9:\"isdefault\";i:1;}}'),
(9, '优速', 'youshuwuliu', 'UC', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}'),
(10, '宅急送', 'zhaijisong', 'ZJS', 'a:2:{i:0;a:4:{s:5:\"style\";s:9:\"二联120\";s:4:\"spec\";s:33:\"（宽100mm高116mm切点98/18）\";s:4:\"size\";s:3:\"120\";s:9:\"isdefault\";i:1;}i:1;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:0;}}'),
(11, '京东', 'jd', 'JD', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联110\";s:4:\"spec\";s:33:\"（宽100mm高110mm切点60/50）\";s:4:\"size\";s:3:\"110\";s:9:\"isdefault\";i:1;}}'),
(12, '信丰', 'xinfengwuliu', 'XFEX', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}'),
(13, '全峰', 'quanfengkuaidi', 'QFKD', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}'),
(14, '跨越速运', 'kuayue', 'KYSY', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联137\";s:4:\"spec\";s:34:\"（宽100mm高137mm切点101/36）\";s:4:\"size\";s:3:\"137\";s:9:\"isdefault\";i:1;}}'),
(15, '安能', 'annengwuliu', 'ANE', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"三联180\";s:4:\"spec\";s:37:\"（宽100mm高180mm切点110/30/40）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}'),
(16, '快捷', 'kuaijiesudi', 'FAST', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}'),
(17, '国通', 'guotongkuaidi', 'GTO', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}'),
(18, '天天', 'tiantian', 'HHTT', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}'),
(19, '中铁快运', 'zhongtiekuaiyun', 'ZTKY', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}'),
(20, '邮政快递包裹', 'youzhengguonei', 'YZPY', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}'),
(21, '邮政国内标快', 'youzhengguonei', 'YZBK', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}'),
(22, '全一快递', 'quanyikuaidi', 'UAPEX', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:32:\"（宽90mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}'),
(23, '速尔快递', 'sue', 'SURE', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}'),
(24, '顺丰(陆运)', 'shunfeng', 'SF', 'a:2:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}i:1;a:4:{s:5:\"style\";s:9:\"三联210\";s:4:\"spec\";s:38:\"（宽100mm 高210mm 切点90/60/60）\";s:4:\"size\";s:3:\"210\";s:9:\"isdefault\";i:0;}}');

DROP TABLE IF EXISTS `ims_vending_machine_exhelper_esheet_temp`;
CREATE TABLE `ims_vending_machine_exhelper_esheet_temp` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `esheetid` int(11) NOT NULL DEFAULT '0',
  `esheetname` varchar(255) NOT NULL DEFAULT '',
  `customername` varchar(50) NOT NULL DEFAULT '',
  `customerpwd` varchar(50) NOT NULL DEFAULT '',
  `monthcode` varchar(50) NOT NULL DEFAULT '',
  `sendsite` varchar(50) NOT NULL DEFAULT '',
  `paytype` tinyint(3) NOT NULL DEFAULT '1',
  `templatesize` varchar(10) NOT NULL DEFAULT '',
  `isnotice` tinyint(3) NOT NULL DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `issend` tinyint(3) NOT NULL DEFAULT '1',
  `isdefault` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exhelper_express`;
CREATE TABLE `ims_vending_machine_exhelper_express` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `type` int(1) NOT NULL DEFAULT '1',
  `expressname` varchar(255) DEFAULT '',
  `expresscom` varchar(255) NOT NULL DEFAULT '',
  `express` varchar(255) NOT NULL DEFAULT '',
  `width` decimal(10,2) DEFAULT '0.00',
  `datas` text,
  `height` decimal(10,2) DEFAULT '0.00',
  `bg` varchar(255) DEFAULT '',
  `isdefault` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exhelper_senduser`;
CREATE TABLE `ims_vending_machine_exhelper_senduser` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `sendername` varchar(255) DEFAULT '',
  `sendertel` varchar(255) DEFAULT '',
  `sendersign` varchar(255) DEFAULT '',
  `sendercode` int(11) DEFAULT NULL,
  `senderaddress` varchar(255) DEFAULT '',
  `sendercity` varchar(255) DEFAULT NULL,
  `isdefault` tinyint(3) DEFAULT '0',
  `province` varchar(30) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL DEFAULT '',
  `area` varchar(30) NOT NULL DEFAULT '',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_exhelper_sys`;
CREATE TABLE `ims_vending_machine_exhelper_sys` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(20) NOT NULL DEFAULT 'localhost',
  `ip_cloud` varchar(255) NOT NULL DEFAULT '',
  `port` int(11) NOT NULL DEFAULT '8000',
  `port_cloud` int(11) NOT NULL DEFAULT '8000',
  `is_cloud` int(1) NOT NULL DEFAULT '0',
  `ebusiness` varchar(20) NOT NULL DEFAULT '',
  `apikey` varchar(50) NOT NULL DEFAULT '',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_express`;
CREATE TABLE `ims_vending_machine_express` (
`id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT '',
  `express` varchar(50) DEFAULT '',
  `status` tinyint(1) DEFAULT '1',
  `displayorder` tinyint(3) UNSIGNED DEFAULT '0',
  `code` varchar(30) NOT NULL DEFAULT '',
  `coding` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_express` (`id`, `name`, `express`, `status`, `displayorder`, `code`, `coding`) VALUES
(1, '顺丰速运', 'shunfeng', 1, 0, '', 'SF'),
(2, '申通快递', 'shentong', 1, 0, '', 'STO'),
(3, '韵达快运', 'yunda', 1, 0, '', 'YD'),
(4, '天天快递', 'tiantian', 1, 0, '', 'HHTT'),
(5, '圆通速递', 'yuantong', 1, 0, '', 'YTO'),
(6, '中通快递', 'zhongtong', 1, 0, '', 'ZTO'),
(7, 'ems快递', 'ems', 1, 0, '', 'EMS'),
(8, '百世快递', 'huitongkuaidi', 1, 0, '', 'HTKY'),
(9, '全峰快递', 'quanfengkuaidi', 1, 0, '', ''),
(10, '宅急送', 'zhaijisong', 1, 0, '', 'ZJS'),
(11, 'aae全球专递', 'aae', 1, 0, '', 'AAE'),
(12, '安捷快递', 'anjie', 1, 0, '', 'AJ'),
(13, '安信达快递', 'anxindakuaixi', 1, 0, '', ''),
(14, '彪记快递', 'biaojikuaidi', 1, 0, '', ''),
(15, 'bht', 'bht', 1, 0, '', 'BHT'),
(16, '百福东方国际物流', 'baifudongfang', 1, 0, '', ''),
(17, '中国东方（COE）', 'coe', 1, 0, '', ''),
(18, '长宇物流', 'changyuwuliu', 1, 0, '', ''),
(19, '大田物流', 'datianwuliu', 1, 0, '', 'DTWL'),
(20, '德邦快递', 'debangwuliu', 1, 0, '', 'DBL'),
(21, 'dhl', 'dhl', 1, 0, '', 'DHL'),
(22, 'dpex', 'dpex', 1, 0, '', 'DPEX'),
(23, 'd速快递', 'dsukuaidi', 1, 0, '', 'DSWL'),
(24, '递四方', 'disifang', 1, 0, '', 'D4PX'),
(25, 'fedex（国外）', 'fedex', 1, 0, '', 'FEDEX_GJ'),
(26, '飞康达物流', 'feikangda', 1, 0, '', 'FKD'),
(27, '凤凰快递', 'fenghuangkuaidi', 1, 0, '', ''),
(28, '飞快达', 'feikuaida', 1, 0, '', ''),
(29, '国通快递', 'guotongkuaidi', 1, 0, '', 'GTO'),
(30, '港中能达物流', 'ganzhongnengda', 1, 0, '', ''),
(31, '广东邮政物流', 'guangdongyouzhengwuliu', 1, 0, '', 'GDEMS'),
(32, '共速达', 'gongsuda', 1, 0, '', 'GSD'),
(33, '恒路物流', 'hengluwuliu', 1, 0, '', 'HLWL'),
(34, '华夏龙物流', 'huaxialongwuliu', 1, 0, '', 'HXLWL'),
(35, '海红', 'haihongwangsong', 1, 0, '', ''),
(36, '海外环球', 'haiwaihuanqiu', 1, 0, '', ''),
(37, '佳怡物流', 'jiayiwuliu', 1, 0, '', 'JYWL'),
(38, '京广速递', 'jinguangsudikuaijian', 1, 0, '', 'JGSD'),
(39, '急先达', 'jixianda', 1, 0, '', 'JXD'),
(40, '佳吉物流', 'jiajiwuliu', 1, 0, '', 'CNEX'),
(41, '加运美物流', 'jymwl', 1, 0, '', 'JYM'),
(42, '金大物流', 'jindawuliu', 1, 0, '', ''),
(43, '嘉里大通', 'jialidatong', 1, 0, '', ''),
(44, '晋越快递', 'jykd', 1, 0, '', 'JYKD'),
(45, '快捷速递', 'kuaijiesudi', 1, 0, '', ''),
(46, '联邦快递（国内）', 'lianb', 1, 0, '', ''),
(47, '联昊通物流', 'lianhaowuliu', 1, 0, '', 'LHT'),
(48, '龙邦物流', 'longbanwuliu', 1, 0, '', 'LB'),
(49, '立即送', 'lijisong', 1, 0, '', 'LJSKD'),
(50, '乐捷递', 'lejiedi', 1, 0, '', ''),
(51, '民航快递', 'minghangkuaidi', 1, 0, '', 'MHKD'),
(52, '美国快递', 'meiguokuaidi', 1, 0, '', ''),
(53, '门对门', 'menduimen', 1, 0, '', 'MDM'),
(54, 'OCS', 'ocs', 1, 0, '', 'OCS'),
(55, '配思货运', 'peisihuoyunkuaidi', 1, 0, '', ''),
(56, '全晨快递', 'quanchenkuaidi', 1, 0, '', 'QCKD'),
(57, '全际通物流', 'quanjitong', 1, 0, '', ''),
(58, '全日通快递', 'quanritongkuaidi', 1, 0, '', 'QRT'),
(59, '全一快递', 'quanyikuaidi', 1, 0, '', 'UAPEX'),
(60, '如风达', 'rufengda', 1, 0, '', 'RFD'),
(61, '三态速递', 'santaisudi', 1, 0, '', ''),
(62, '盛辉物流', 'shenghuiwuliu', 1, 0, '', ''),
(63, '速尔物流', 'suer', 1, 0, '', 'SURE'),
(64, '盛丰物流', 'shengfeng', 1, 0, '', 'SFWL'),
(65, '赛澳递', 'saiaodi', 1, 0, '', 'SAD'),
(66, '天地华宇', 'tiandihuayu', 1, 0, '', 'HOAU'),
(67, 'tnt', 'tnt', 1, 0, '', 'TNT'),
(68, 'ups', 'ups', 1, 0, '', 'UPS'),
(69, '万家物流', 'wanjiawuliu', 1, 0, '', 'WJWL'),
(70, '文捷航空速递', 'wenjiesudi', 1, 0, '', ''),
(71, '伍圆', 'wuyuan', 1, 0, '', ''),
(72, '万象物流', 'wxwl', 1, 0, '', 'WXWL'),
(73, '新邦物流', 'xinbangwuliu', 1, 0, '', ''),
(74, '信丰物流', 'xinfengwuliu', 1, 0, '', 'XFEX'),
(75, '亚风速递', 'yafengsudi', 1, 0, '', 'YFSD'),
(76, '一邦速递', 'yibangwuliu', 1, 0, '', ''),
(77, '优速物流', 'youshuwuliu', 1, 0, '', 'UC'),
(78, '邮政快递包裹', 'youzhengguonei', 1, 0, '', 'YZPY'),
(79, '邮政国际包裹挂号信', 'youzhengguoji', 1, 0, '', ''),
(80, '远成物流', 'yuanchengwuliu', 1, 0, '', 'YCWL'),
(81, '源伟丰快递', 'yuanweifeng', 1, 0, '', ''),
(82, '元智捷诚快递', 'yuanzhijiecheng', 1, 0, '', ''),
(83, '运通快递', 'yuntongkuaidi', 1, 0, '', 'YTKD'),
(84, '越丰物流', 'yuefengwuliu', 1, 0, '', ''),
(85, '源安达', 'yad', 1, 0, '', 'YADEX'),
(86, '银捷速递', 'yinjiesudi', 1, 0, '', ''),
(87, '中铁快运', 'zhongtiekuaiyun', 1, 0, '', 'ZTKY'),
(88, '中邮物流', 'zhongyouwuliu', 1, 0, '', 'ZYKD'),
(89, '忠信达', 'zhongxinda', 1, 0, '', ''),
(90, '芝麻开门', 'zhimakaimen', 1, 0, '', ''),
(91, '安能物流', 'annengwuliu', 1, 0, '', 'ANE'),
(92, '京东快递', 'jd', 1, 0, '', 'JD'),
(93, '微特派', 'weitepai', 1, 0, '', 'WTP'),
(94, '九曳供应链', 'jiuyescm', 1, 0, '', 'JIUYE'),
(95, '跨越速运', 'kuayue', 1, 0, '', 'KYSY'),
(96, '德邦物流', 'debangkuaidi', 1, 0, '', 'DBLKY'),
(97, '中通快运', 'zhongtongkuaiyun', 1, 0, '', 'ZTOKY');

DROP TABLE IF EXISTS `ims_vending_machine_express_cache`;
CREATE TABLE `ims_vending_machine_express_cache` (
`id` int(11) NOT NULL,
  `expresssn` varchar(50) DEFAULT NULL,
  `express` varchar(50) DEFAULT NULL,
  `lasttime` int(11) NOT NULL,
  `datas` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_feedback`;
CREATE TABLE `ims_vending_machine_feedback` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `type` tinyint(1) DEFAULT '1',
  `status` tinyint(1) DEFAULT '0',
  `feedbackid` varchar(100) DEFAULT '',
  `transid` varchar(100) DEFAULT '',
  `reason` varchar(1000) DEFAULT '',
  `solution` varchar(1000) DEFAULT '',
  `remark` varchar(1000) DEFAULT '',
  `createtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_form`;
CREATE TABLE `ims_vending_machine_form` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `isrequire` tinyint(3) DEFAULT '0',
  `key` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `type` varchar(255) DEFAULT '',
  `values` text,
  `cate` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_form_category`;
CREATE TABLE `ims_vending_machine_form_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_friendcoupon`;
CREATE TABLE `ims_vending_machine_friendcoupon` (
`id` int(10) UNSIGNED NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT '',
  `people_count` int(10) DEFAULT '0',
  `coupon_money` decimal(10,2) DEFAULT '0.00',
  `use_condition` decimal(10,2) DEFAULT NULL,
  `duration` int(11) DEFAULT '0',
  `allocate` tinyint(2) UNSIGNED DEFAULT '0',
  `upper_limit` decimal(10,2) DEFAULT '0.00',
  `launches_limit` int(11) DEFAULT '0',
  `launches_count` int(11) DEFAULT '0',
  `activity_start_time` int(11) DEFAULT '0',
  `activity_end_time` int(11) DEFAULT '0',
  `desc` text,
  `use_time_limit` int(11) DEFAULT '0',
  `use_start_time` int(11) DEFAULT '0',
  `use_end_time` int(11) DEFAULT '0',
  `limitdiscounttype` tinyint(1) DEFAULT '0',
  `limitgoodcatetype` tinyint(1) DEFAULT '0',
  `limitgoodcateids` varchar(500) DEFAULT '',
  `limitgoodtype` tinyint(1) UNSIGNED DEFAULT '0',
  `limitgoodids` varchar(500) DEFAULT '',
  `use_valid_days` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  `displayorder` int(11) DEFAULT '0',
  `deleted` tinyint(1) UNSIGNED DEFAULT '0',
  `stop_time` int(11) UNSIGNED DEFAULT '0',
  `create_time` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_friendcoupon_data`;
CREATE TABLE `ims_vending_machine_friendcoupon_data` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `headerid` int(11) NOT NULL DEFAULT '0',
  `activity_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `enough` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deduct` decimal(10,2) NOT NULL DEFAULT '0.00',
  `timestart` int(11) NOT NULL DEFAULT '0',
  `timeend` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `receive_time` int(11) NOT NULL DEFAULT '0',
  `deadline` int(11) NOT NULL DEFAULT '0',
  `is_send` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `send_failed_message` tinyint(1) NOT NULL DEFAULT '0',
  `form_id` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_fullback_goods`;
CREATE TABLE `ims_vending_machine_fullback_goods` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `titles` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `minallfullbackallprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maxallfullbackallprice` decimal(10,2) NOT NULL,
  `minallfullbackallratio` decimal(10,2) DEFAULT NULL,
  `maxallfullbackallratio` decimal(10,2) DEFAULT NULL,
  `day` int(11) NOT NULL DEFAULT '0',
  `fullbackprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `fullbackratio` decimal(10,2) DEFAULT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `hasoption` tinyint(3) NOT NULL DEFAULT '0',
  `optionid` text NOT NULL,
  `startday` int(11) NOT NULL DEFAULT '0',
  `refund` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_fullback_log`;
CREATE TABLE `ims_vending_machine_fullback_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `orderid` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `priceevery` decimal(10,2) NOT NULL,
  `day` int(10) NOT NULL,
  `fullbackday` int(10) NOT NULL,
  `createtime` int(10) NOT NULL,
  `fullbacktime` int(10) NOT NULL,
  `isfullback` tinyint(3) NOT NULL DEFAULT '0',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `optionid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_fullback_log_map`;
CREATE TABLE `ims_vending_machine_fullback_log_map` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `fullback_time` int(11) NOT NULL DEFAULT '0',
  `logid` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `optionid` int(11) NOT NULL DEFAULT '0',
  `day` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_funbar`;
CREATE TABLE `ims_vending_machine_funbar` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `datas` text,
  `uniacid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_gift`;
CREATE TABLE `ims_vending_machine_gift` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `activity` tinyint(3) NOT NULL DEFAULT '1',
  `orderprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `goodsid` varchar(255) NOT NULL,
  `giftgoodsid` varchar(255) NOT NULL,
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `share_title` varchar(255) NOT NULL,
  `share_icon` varchar(255) NOT NULL,
  `share_desc` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_globonus_bill`;
CREATE TABLE `ims_vending_machine_globonus_bill` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `billno` varchar(100) DEFAULT '',
  `paytype` int(11) DEFAULT '0',
  `year` int(11) DEFAULT '0',
  `month` int(11) DEFAULT '0',
  `week` int(11) DEFAULT '0',
  `ordercount` int(11) DEFAULT '0',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `bonusmoney` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_send` decimal(10,2) DEFAULT '0.00',
  `bonusmoney_pay` decimal(10,2) DEFAULT '0.00',
  `paytime` int(11) DEFAULT '0',
  `partnercount` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `starttime` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `confirmtime` int(11) DEFAULT '0',
  `bonusordermoney` decimal(10,2) DEFAULT '0.00',
  `bonusrate` decimal(10,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_globonus_billo`;
CREATE TABLE `ims_vending_machine_globonus_billo` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `ordermoney` decimal(10,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

DROP TABLE IF EXISTS `ims_vending_machine_globonus_billp`;
CREATE TABLE `ims_vending_machine_globonus_billp` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `billid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `payno` varchar(255) DEFAULT '',
  `paytype` tinyint(3) DEFAULT '0',
  `bonus` decimal(10,2) DEFAULT '0.00',
  `money` decimal(10,2) DEFAULT '0.00',
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `paymoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `chargemoney` decimal(10,2) DEFAULT '0.00',
  `status` tinyint(3) DEFAULT '0',
  `reason` varchar(255) DEFAULT '',
  `paytime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_globonus_level`;
CREATE TABLE `ims_vending_machine_globonus_level` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `levelname` varchar(50) DEFAULT '',
  `bonus` decimal(10,4) DEFAULT '0.0000',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(11) DEFAULT '0',
  `commissionmoney` decimal(10,2) DEFAULT '0.00',
  `bonusmoney` decimal(10,2) DEFAULT '0.00',
  `downcount` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_goods`;
CREATE TABLE `ims_vending_machine_goods` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `pcate` int(11) DEFAULT '0',
  `ccate` int(11) DEFAULT '0',
  `tcate` int(11) DEFAULT '0',
  `type` tinyint(1) DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(100) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `unit` varchar(5) DEFAULT '',
  `description` varchar(1000) DEFAULT NULL,
  `content` longtext,
  `goodssn` varchar(50) DEFAULT '',
  `productsn` varchar(50) DEFAULT '',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `costprice` decimal(10,2) DEFAULT '0.00',
  `originalprice` decimal(10,2) DEFAULT '0.00',
  `total` int(10) DEFAULT '0',
  `totalcnf` int(11) DEFAULT '0',
  `sales` int(11) DEFAULT '0',
  `salesreal` int(11) DEFAULT '0',
  `spec` varchar(5000) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `credit` varchar(255) DEFAULT '',
  `maxbuy` int(11) DEFAULT '0',
  `usermaxbuy` int(11) DEFAULT '0',
  `hasoption` int(11) DEFAULT '0',
  `dispatch` int(11) DEFAULT '0',
  `thumb_url` text,
  `isnew` tinyint(1) DEFAULT '0',
  `ishot` tinyint(1) DEFAULT '0',
  `isdiscount` tinyint(1) DEFAULT '0',
  `isdiscount_title` varchar(255) DEFAULT '',
  `isdiscount_time` int(11) DEFAULT '0',
  `isdiscount_discounts` text,
  `isrecommand` tinyint(1) DEFAULT '0',
  `issendfree` tinyint(1) DEFAULT '0',
  `istime` tinyint(1) DEFAULT '0',
  `iscomment` tinyint(1) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `viewcount` int(11) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `hascommission` tinyint(3) DEFAULT '0',
  `commission1_rate` decimal(10,2) DEFAULT '0.00',
  `commission1_pay` decimal(10,2) DEFAULT '0.00',
  `commission2_rate` decimal(10,2) DEFAULT '0.00',
  `commission2_pay` decimal(10,2) DEFAULT '0.00',
  `commission3_rate` decimal(10,2) DEFAULT '0.00',
  `commission3_pay` decimal(10,2) DEFAULT '0.00',
  `commission` text,
  `score` decimal(10,2) DEFAULT '0.00',
  `catch_id` varchar(255) DEFAULT '',
  `catch_url` varchar(255) DEFAULT '',
  `catch_source` varchar(255) DEFAULT '',
  `updatetime` int(11) DEFAULT '0',
  `share_title` varchar(255) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `cash` tinyint(3) DEFAULT '0',
  `commission_thumb` varchar(255) DEFAULT '',
  `isnodiscount` tinyint(3) DEFAULT '0',
  `showlevels` text,
  `buylevels` text,
  `showgroups` text,
  `buygroups` text,
  `isverify` tinyint(3) DEFAULT '0',
  `storeids` text,
  `noticeopenid` varchar(255) DEFAULT '',
  `noticetype` text,
  `needfollow` tinyint(3) DEFAULT '0',
  `followurl` varchar(255) DEFAULT '',
  `followtip` varchar(255) DEFAULT '',
  `deduct` decimal(10,2) DEFAULT '0.00',
  `shorttitle` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0',
  `ccates` text,
  `discounts` text,
  `nocommission` tinyint(3) DEFAULT '0',
  `hidecommission` tinyint(3) DEFAULT '0',
  `pcates` text,
  `tcates` text,
  `detail_logo` varchar(255) DEFAULT '',
  `detail_shopname` varchar(255) DEFAULT '',
  `detail_totaltitle` varchar(255) DEFAULT '',
  `detail_btntext1` varchar(255) DEFAULT '',
  `detail_btnurl1` varchar(255) DEFAULT '',
  `detail_btntext2` varchar(255) DEFAULT '',
  `detail_btnurl2` varchar(255) DEFAULT '',
  `cates` text,
  `artid` int(11) DEFAULT '0',
  `deduct2` decimal(10,2) DEFAULT '0.00',
  `ednum` int(11) DEFAULT '0',
  `edareas` text,
  `edmoney` decimal(10,2) DEFAULT '0.00',
  `diyformtype` tinyint(1) DEFAULT '0',
  `diyformid` int(11) DEFAULT '0',
  `diymode` tinyint(1) DEFAULT '0',
  `dispatchtype` tinyint(1) DEFAULT '0',
  `dispatchid` int(11) DEFAULT '0',
  `dispatchprice` decimal(10,2) DEFAULT '0.00',
  `manydeduct` tinyint(1) DEFAULT '0',
  `saleupdate37975` tinyint(3) DEFAULT '0',
  `shopid` int(11) DEFAULT '0',
  `allcates` text,
  `minbuy` int(11) DEFAULT '0',
  `invoice` tinyint(3) DEFAULT '0',
  `repair` tinyint(3) DEFAULT '0',
  `seven` tinyint(3) DEFAULT '0',
  `money` varchar(255) DEFAULT '',
  `minprice` decimal(10,2) DEFAULT '0.00',
  `maxprice` decimal(10,2) DEFAULT '0.00',
  `province` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `buyshow` tinyint(1) DEFAULT '0',
  `buycontent` text,
  `saleupdate51117` tinyint(3) DEFAULT '0',
  `virtualsend` tinyint(1) DEFAULT '0',
  `virtualsendcontent` text,
  `verifytype` tinyint(1) DEFAULT '0',
  `diyfields` text,
  `diysaveid` int(11) DEFAULT '0',
  `diysave` tinyint(1) DEFAULT '0',
  `quality` tinyint(3) DEFAULT '0',
  `groupstype` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `showtotal` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `subtitle` varchar(255) DEFAULT '',
  `sharebtn` tinyint(1) NOT NULL DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `checked` tinyint(3) DEFAULT '0',
  `thumb_first` tinyint(3) DEFAULT '0',
  `merchsale` tinyint(1) DEFAULT '0',
  `keywords` varchar(255) DEFAULT '',
  `labelname` text,
  `autoreceive` int(11) DEFAULT '0',
  `cannotrefund` tinyint(3) DEFAULT '0',
  `bargain` int(11) DEFAULT '0',
  `buyagain` decimal(10,2) DEFAULT '0.00',
  `buyagain_islong` tinyint(1) DEFAULT '0',
  `buyagain_condition` tinyint(1) DEFAULT '0',
  `buyagain_sale` tinyint(1) DEFAULT '0',
  `buyagain_commission` text,
  `buyagain_price` decimal(10,2) DEFAULT '0.00',
  `diypage` int(11) DEFAULT NULL,
  `cashier` tinyint(1) DEFAULT '0',
  `isendtime` tinyint(3) NOT NULL DEFAULT '0',
  `usetime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `merchdisplayorder` int(11) NOT NULL DEFAULT '0',
  `exchange_stock` int(11) DEFAULT '0',
  `exchange_postage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `ispresell` tinyint(3) NOT NULL DEFAULT '0',
  `presellprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `presellover` tinyint(3) NOT NULL DEFAULT '0',
  `presellovertime` int(11) NOT NULL,
  `presellstart` tinyint(3) NOT NULL DEFAULT '0',
  `preselltimestart` int(11) NOT NULL DEFAULT '0',
  `presellend` tinyint(3) NOT NULL DEFAULT '0',
  `preselltimeend` int(11) NOT NULL DEFAULT '0',
  `presellsendtype` tinyint(3) NOT NULL DEFAULT '0',
  `presellsendstatrttime` int(11) NOT NULL DEFAULT '0',
  `presellsendtime` int(11) NOT NULL DEFAULT '0',
  `edareas_code` text NOT NULL,
  `unite_total` tinyint(3) NOT NULL DEFAULT '0',
  `threen` varchar(255) DEFAULT '',
  `intervalfloor` tinyint(1) DEFAULT '0',
  `intervalprice` varchar(512) DEFAULT '',
  `isfullback` tinyint(3) NOT NULL DEFAULT '0',
  `isstatustime` tinyint(3) NOT NULL DEFAULT '0',
  `statustimestart` int(10) NOT NULL DEFAULT '0',
  `statustimeend` int(10) NOT NULL DEFAULT '0',
  `nosearch` tinyint(1) NOT NULL DEFAULT '0',
  `showsales` tinyint(3) NOT NULL DEFAULT '1',
  `islive` int(11) NOT NULL DEFAULT '0',
  `liveprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `opencard` tinyint(1) DEFAULT '0',
  `cardid` varchar(255) DEFAULT '',
  `verifygoodstype` tinyint(1) NOT NULL DEFAULT '0',
  `verifygoodsnum` int(11) DEFAULT '1',
  `verifygoodsdays` int(11) DEFAULT '1',
  `verifygoodslimittype` tinyint(1) DEFAULT '0',
  `verifygoodslimitdate` int(11) DEFAULT '0',
  `minliveprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `maxliveprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dowpayment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tempid` int(11) NOT NULL DEFAULT '0',
  `isstoreprice` tinyint(11) NOT NULL DEFAULT '0',
  `beforehours` int(11) NOT NULL DEFAULT '0',
  `newgoods` tinyint(3) NOT NULL DEFAULT '0',
  `video` varchar(512) DEFAULT '',
  `officthumb` varchar(512) DEFAULT '',
  `isforceverifystore` tinyint(1) NOT NULL DEFAULT '0',
  `manydeduct2` tinyint(1) DEFAULT '0',
  `refund` tinyint(3) NOT NULL DEFAULT '0',
  `returngoods` tinyint(3) NOT NULL DEFAULT '0',
  `exchange` tinyint(3) NOT NULL DEFAULT '0',
  `membercardpoint` int(2) NOT NULL DEFAULT '0',
  `isdiscount_time_start` int(11) NOT NULL,
  `catesinit3` text,
  `showtotaladd` tinyint(1) DEFAULT '0',
  `import_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_goods` (`id`, `uniacid`, `pcate`, `ccate`, `tcate`, `type`, `status`, `displayorder`, `title`, `thumb`, `unit`, `description`, `content`, `goodssn`, `productsn`, `productprice`, `marketprice`, `costprice`, `originalprice`, `total`, `totalcnf`, `sales`, `salesreal`, `spec`, `createtime`, `weight`, `credit`, `maxbuy`, `usermaxbuy`, `hasoption`, `dispatch`, `thumb_url`, `isnew`, `ishot`, `isdiscount`, `isdiscount_title`, `isdiscount_time`, `isdiscount_discounts`, `isrecommand`, `issendfree`, `istime`, `iscomment`, `timestart`, `timeend`, `viewcount`, `deleted`, `hascommission`, `commission1_rate`, `commission1_pay`, `commission2_rate`, `commission2_pay`, `commission3_rate`, `commission3_pay`, `commission`, `score`, `catch_id`, `catch_url`, `catch_source`, `updatetime`, `share_title`, `share_icon`, `cash`, `commission_thumb`, `isnodiscount`, `showlevels`, `buylevels`, `showgroups`, `buygroups`, `isverify`, `storeids`, `noticeopenid`, `noticetype`, `needfollow`, `followurl`, `followtip`, `deduct`, `shorttitle`, `virtual`, `ccates`, `discounts`, `nocommission`, `hidecommission`, `pcates`, `tcates`, `detail_logo`, `detail_shopname`, `detail_totaltitle`, `detail_btntext1`, `detail_btnurl1`, `detail_btntext2`, `detail_btnurl2`, `cates`, `artid`, `deduct2`, `ednum`, `edareas`, `edmoney`, `diyformtype`, `diyformid`, `diymode`, `dispatchtype`, `dispatchid`, `dispatchprice`, `manydeduct`, `saleupdate37975`, `shopid`, `allcates`, `minbuy`, `invoice`, `repair`, `seven`, `money`, `minprice`, `maxprice`, `province`, `city`, `buyshow`, `buycontent`, `saleupdate51117`, `virtualsend`, `virtualsendcontent`, `verifytype`, `diyfields`, `diysaveid`, `diysave`, `quality`, `groupstype`, `showtotal`, `subtitle`, `sharebtn`, `merchid`, `checked`, `thumb_first`, `merchsale`, `keywords`, `labelname`, `autoreceive`, `cannotrefund`, `bargain`, `buyagain`, `buyagain_islong`, `buyagain_condition`, `buyagain_sale`, `buyagain_commission`, `buyagain_price`, `diypage`, `cashier`, `isendtime`, `usetime`, `endtime`, `merchdisplayorder`, `exchange_stock`, `exchange_postage`, `ispresell`, `presellprice`, `presellover`, `presellovertime`, `presellstart`, `preselltimestart`, `presellend`, `preselltimeend`, `presellsendtype`, `presellsendstatrttime`, `presellsendtime`, `edareas_code`, `unite_total`, `threen`, `intervalfloor`, `intervalprice`, `isfullback`, `isstatustime`, `statustimestart`, `statustimeend`, `nosearch`, `showsales`, `islive`, `liveprice`, `opencard`, `cardid`, `verifygoodstype`, `verifygoodsnum`, `verifygoodsdays`, `verifygoodslimittype`, `verifygoodslimitdate`, `minliveprice`, `maxliveprice`, `dowpayment`, `tempid`, `isstoreprice`, `beforehours`, `newgoods`, `video`, `officthumb`, `isforceverifystore`, `manydeduct2`, `refund`, `returngoods`, `exchange`, `membercardpoint`, `isdiscount_time_start`, `catesinit3`, `showtotaladd`, `import_id`) VALUES
(1, 1, 0, 0, 0, 1, 0, 0, 'asdfasd', 'images/1/2020/06/zM887ZLlngXD5NNGd78GZ200B6NbdG.jpg', '', '', '', '', '', '0.00', '0.00', '0.00', '0.00', 0, 0, 0, 0, '', 1600021792, '0.00', '', 0, 0, 0, 0, 'a:0:{}', 0, 0, 0, '', 0, '{\"type\":0,\"default\":{\"option0\":\"\"}}', 0, 0, 0, 0, 1600021740, 1600626540, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '{\"type\":0}', '0.00', '', '', '', 0, '', '', 0, '', 0, '', '', '', '', 1, '', '', '', 0, '', '', '0.00', '', 0, '', '{\"type\":\"0\",\"default\":\"\",\"default_pay\":\"\"}', 0, 0, '', '', '', '', '', '', '', '', '', '', 0, '0.00', 0, '', '0.00', 0, 0, 0, 0, 0, '0.00', 0, 0, 0, NULL, 0, 0, 0, 0, '', '0.00', '0.00', '请选择省份', '请选择城市', 0, '', 0, 0, '', 0, NULL, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 'N;', 0, 1, 0, '0.00', 0, 0, 0, NULL, '0.00', 0, 0, 0, 0, 1600021740, 0, 0, '0.00', 0, '0.00', 0, 0, 0, 0, 0, 0, 0, 1600021740, 0, '', 0, '', 0, '', 0, 0, 1600021740, 1602613740, 0, 0, 0, '0.00', 0, '', 0, 1, 1, 0, 0, '0.00', '0.00', '0.00', 0, 0, 0, 0, '', '', 0, 0, 1, 1, 1, 0, 0, NULL, 0, 0),
(2, 1, 0, 0, 0, 2, 1, 0, '阿斯顿发射点阿斯蒂芬', 'images/1/2020/06/zM887ZLlngXD5NNGd78GZ200B6NbdG.jpg', 'kg', '', '', '', '', '0.00', '1.00', '0.00', '0.00', 2000, 0, 0, 0, '', 1601052910, '0.00', '', 0, 0, 1, 0, 'a:0:{}', 0, 0, 0, '', 0, '{\"type\":1,\"default\":{\"option1\":\"\",\"option2\":\"\"}}', 0, 0, 0, 0, 1601052840, 1601657640, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '{\"type\":0,\"default\":{\"option1\":[],\"option2\":[]}}', '0.00', '', '', '', 0, '', '', 0, '', 0, '', '', '', '', 1, '', '', '', 0, '', '', '0.00', '', 0, '', '{\"type\":\"0\",\"default\":\"\",\"default_pay\":\"\"}', 0, 0, '', '', '', '', '', '', '', '', '', '', 0, '0.00', 0, '', '0.00', 0, 0, 0, 0, 0, '0.00', 0, 0, 0, NULL, 0, 0, 0, 0, '', '2.00', '3.00', '请选择省份', '请选择城市', 0, '', 0, 1, '', 0, NULL, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, '', 'N;', 0, 1, 0, '0.00', 0, 0, 0, NULL, '0.00', 0, 0, 0, 0, 1601052840, 0, 0, '0.00', 0, '0.00', 0, 0, 0, 0, 0, 0, 0, 1601052840, 0, '', 0, '', 0, '', 0, 0, 1601052840, 1603644840, 0, 0, 0, '0.00', 0, '', 0, 1, 1, 0, 0, '0.00', '0.00', '0.00', 0, 0, 0, 0, '', '', 0, 0, 1, 1, 1, 0, 0, NULL, 0, 0);

DROP TABLE IF EXISTS `ims_vending_machine_goodscircle_log`;
CREATE TABLE `ims_vending_machine_goodscircle_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(65) DEFAULT '',
  `op_type` varchar(16) DEFAULT '',
  `op_id` int(11) NOT NULL DEFAULT '0',
  `is_success` tinyint(1) NOT NULL DEFAULT '1',
  `response_msg` varchar(255) NOT NULL DEFAULT '',
  `createtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_goodscode_good`;
CREATE TABLE `ims_vending_machine_goodscode_good` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `qrcode` varchar(255) NOT NULL,
  `status` tinyint(3) NOT NULL,
  `displayorder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_goods_cards`;
CREATE TABLE `ims_vending_machine_goods_cards` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `card_id` varchar(255) DEFAULT NULL,
  `card_title` varchar(255) DEFAULT NULL,
  `card_brand_name` varchar(255) DEFAULT NULL,
  `card_totalquantity` int(11) DEFAULT NULL,
  `card_quantity` int(11) DEFAULT NULL,
  `card_logoimg` varchar(255) DEFAULT NULL,
  `card_logowxurl` varchar(255) DEFAULT NULL,
  `card_backgroundtype` tinyint(1) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `card_backgroundimg` varchar(255) DEFAULT NULL,
  `card_backgroundwxurl` varchar(255) DEFAULT NULL,
  `prerogative` varchar(255) DEFAULT NULL,
  `card_description` varchar(255) DEFAULT NULL,
  `freewifi` tinyint(1) DEFAULT NULL,
  `withpet` tinyint(1) DEFAULT NULL,
  `freepark` tinyint(1) DEFAULT NULL,
  `deliver` tinyint(1) DEFAULT NULL,
  `custom_cell1` tinyint(1) DEFAULT NULL,
  `custom_cell1_name` varchar(255) DEFAULT NULL,
  `custom_cell1_tips` varchar(255) DEFAULT NULL,
  `custom_cell1_url` varchar(255) DEFAULT NULL,
  `color2` varchar(20) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_goods_comment`;
CREATE TABLE `ims_vending_machine_goods_comment` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `nickname` varchar(50) DEFAULT '',
  `headimgurl` varchar(255) DEFAULT '',
  `content` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_goods_group`;
CREATE TABLE `ims_vending_machine_goods_group` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `goodsids` text NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_goods_label`;
CREATE TABLE `ims_vending_machine_goods_label` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `label` varchar(255) NOT NULL DEFAULT '',
  `labelname` text NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_goods_labelstyle`;
CREATE TABLE `ims_vending_machine_goods_labelstyle` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `style` int(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_goods_option`;
CREATE TABLE `ims_vending_machine_goods_option` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `costprice` decimal(10,2) DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  `skuId` varchar(255) DEFAULT '',
  `goodssn` varchar(255) DEFAULT '',
  `productsn` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0',
  `exchange_stock` int(11) DEFAULT '0',
  `exchange_postage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `presellprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `day` int(3) NOT NULL,
  `allfullbackprice` decimal(10,2) NOT NULL,
  `fullbackprice` decimal(10,2) NOT NULL,
  `allfullbackratio` decimal(10,2) DEFAULT NULL,
  `fullbackratio` decimal(10,2) DEFAULT NULL,
  `isfullback` tinyint(3) NOT NULL,
  `islive` int(11) NOT NULL,
  `liveprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cycelbuy_periodic` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_goods_option` (`id`, `uniacid`, `goodsid`, `title`, `thumb`, `productprice`, `marketprice`, `costprice`, `stock`, `weight`, `displayorder`, `specs`, `skuId`, `goodssn`, `productsn`, `virtual`, `exchange_stock`, `exchange_postage`, `presellprice`, `day`, `allfullbackprice`, `fullbackprice`, `allfullbackratio`, `fullbackratio`, `isfullback`, `islive`, `liveprice`, `cycelbuy_periodic`) VALUES
(1, 1, 2, '蓝色', '', '0.00', '3.00', '0.00', 1000, '0.00', 0, '1', '', '', '', 0, 0, '0.00', '0.00', 0, '0.00', '0.00', NULL, NULL, 0, 0, '0.00', ''),
(2, 1, 2, '绿色', '', '0.00', '2.00', '0.00', 1000, '0.00', 0, '2', '', '', '', 0, 0, '0.00', '0.00', 0, '0.00', '0.00', NULL, NULL, 0, 0, '0.00', '');

DROP TABLE IF EXISTS `ims_vending_machine_goods_param`;
CREATE TABLE `ims_vending_machine_goods_param` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `value` text,
  `displayorder` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_goods_spec`;
CREATE TABLE `ims_vending_machine_goods_spec` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `description` varchar(1000) DEFAULT '',
  `displaytype` tinyint(3) DEFAULT '0',
  `content` text,
  `displayorder` int(11) DEFAULT '0',
  `propId` varchar(255) DEFAULT '',
  `iscycelbuy` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_goods_spec` (`id`, `uniacid`, `goodsid`, `title`, `description`, `displaytype`, `content`, `displayorder`, `propId`, `iscycelbuy`) VALUES
(1, 1, 2, '颜色', '', 0, 'a:2:{i:0;s:1:\"1\";i:1;s:1:\"2\";}', 0, '', 0);

DROP TABLE IF EXISTS `ims_vending_machine_goods_spec_item`;
CREATE TABLE `ims_vending_machine_goods_spec_item` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `valueId` varchar(255) DEFAULT '',
  `virtual` int(11) DEFAULT '0',
  `cycelbuy_periodic` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_goods_spec_item` (`id`, `uniacid`, `specid`, `title`, `thumb`, `show`, `displayorder`, `valueId`, `virtual`, `cycelbuy_periodic`) VALUES
(1, 1, 1, '蓝色', '', 1, 0, '', 0, ''),
(2, 1, 1, '绿色', '', 1, 1, '', 0, '');

DROP TABLE IF EXISTS `ims_vending_machine_groups_adv`;
CREATE TABLE `ims_vending_machine_groups_adv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_groups_category`;
CREATE TABLE `ims_vending_machine_groups_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` tinyint(3) UNSIGNED DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `advimg` varchar(255) DEFAULT '',
  `advurl` varchar(500) DEFAULT '',
  `isrecommand` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_groups_goods`;
CREATE TABLE `ims_vending_machine_groups_goods` (
`id` int(11) NOT NULL,
  `displayorder` int(11) UNSIGNED DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `goodssn` varchar(50) DEFAULT NULL,
  `productsn` varchar(50) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `category` int(11) DEFAULT NULL,
  `showstock` tinyint(2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `groupsprice` decimal(10,2) DEFAULT '0.00',
  `goodsnum` int(11) NOT NULL DEFAULT '1',
  `purchaselimit` int(11) NOT NULL DEFAULT '0',
  `single` tinyint(2) NOT NULL DEFAULT '0',
  `singleprice` decimal(10,2) DEFAULT '0.00',
  `units` varchar(255) NOT NULL DEFAULT '件',
  `dispatchtype` tinyint(2) NOT NULL,
  `dispatchid` int(11) NOT NULL,
  `freight` decimal(10,2) DEFAULT '0.00',
  `endtime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `groupnum` int(10) NOT NULL DEFAULT '0',
  `sales` int(10) NOT NULL DEFAULT '0',
  `thumb` varchar(255) DEFAULT '',
  `description` varchar(1000) DEFAULT NULL,
  `content` text,
  `createtime` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `isindex` tinyint(3) NOT NULL DEFAULT '0',
  `deleted` tinyint(3) NOT NULL DEFAULT '0',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `followneed` tinyint(2) NOT NULL DEFAULT '0',
  `followtext` varchar(255) DEFAULT NULL,
  `followurl` varchar(255) DEFAULT NULL,
  `share_title` varchar(255) DEFAULT NULL,
  `share_icon` varchar(255) DEFAULT NULL,
  `share_desc` varchar(500) DEFAULT NULL,
  `deduct` decimal(10,2) NOT NULL DEFAULT '0.00',
  `thumb_url` text,
  `rights` tinyint(2) NOT NULL DEFAULT '1',
  `gid` int(11) DEFAULT '0',
  `discount` tinyint(3) DEFAULT '0',
  `headstype` tinyint(3) DEFAULT NULL,
  `headsmoney` decimal(10,2) DEFAULT '0.00',
  `headsdiscount` int(11) DEFAULT '0',
  `isdiscount` tinyint(3) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `verifytype` tinyint(3) DEFAULT '0',
  `verifynum` int(11) DEFAULT '0',
  `storeids` text,
  `merchid` int(11) DEFAULT '0',
  `shorttitle` varchar(255) DEFAULT '',
  `teamnum` int(11) DEFAULT '0',
  `more_spec` tinyint(1) DEFAULT '0',
  `is_ladder` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_groups_goods_atlas`;
CREATE TABLE `ims_vending_machine_groups_goods_atlas` (
`id` int(11) NOT NULL,
  `g_id` int(11) NOT NULL,
  `thumb` varchar(145) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_groups_goods_option`;
CREATE TABLE `ims_vending_machine_groups_goods_option` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `goodsid` int(11) DEFAULT '0',
  `groups_goods_id` int(255) DEFAULT '0',
  `goods_option_id` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `marketprice` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `single_price` decimal(10,2) DEFAULT NULL,
  `specs` varchar(255) DEFAULT NULL,
  `stock` int(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_groups_ladder`;
CREATE TABLE `ims_vending_machine_groups_ladder` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT '0',
  `ladder_num` int(11) DEFAULT NULL,
  `ladder_price` decimal(10,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_groups_order`;
CREATE TABLE `ims_vending_machine_groups_order` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(45) NOT NULL,
  `orderno` varchar(45) NOT NULL,
  `groupnum` int(11) NOT NULL,
  `paytime` int(11) NOT NULL,
  `credit` int(11) DEFAULT '0',
  `creditmoney` decimal(11,2) DEFAULT '0.00',
  `price` decimal(11,2) DEFAULT '0.00',
  `freight` decimal(11,2) DEFAULT '0.00',
  `status` int(9) NOT NULL,
  `pay_type` varchar(45) DEFAULT NULL,
  `dispatchid` int(11) DEFAULT NULL,
  `addressid` int(11) NOT NULL DEFAULT '0',
  `address` varchar(1000) DEFAULT NULL,
  `goodid` int(11) NOT NULL,
  `teamid` int(11) NOT NULL,
  `is_team` int(2) NOT NULL,
  `heads` int(11) DEFAULT '0',
  `discount` decimal(10,2) DEFAULT '0.00',
  `starttime` int(11) NOT NULL,
  `canceltime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(45) NOT NULL,
  `createtime` int(11) NOT NULL,
  `finishtime` int(11) NOT NULL DEFAULT '0',
  `refundid` int(11) NOT NULL DEFAULT '0',
  `refundstate` tinyint(2) NOT NULL DEFAULT '0',
  `refundtime` int(11) NOT NULL DEFAULT '0',
  `express` varchar(45) DEFAULT NULL,
  `expresscom` varchar(100) DEFAULT NULL,
  `expresssn` varchar(45) DEFAULT NULL,
  `sendtime` int(45) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `remarkclose` text,
  `remarksend` text,
  `message` varchar(255) DEFAULT NULL,
  `success` int(2) NOT NULL DEFAULT '0',
  `deleted` int(2) NOT NULL DEFAULT '0',
  `realname` varchar(20) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `isverify` tinyint(3) DEFAULT '0',
  `verifytype` tinyint(3) DEFAULT '0',
  `verifycode` varchar(45) DEFAULT '0',
  `verifynum` int(11) DEFAULT '0',
  `printstate` int(11) NOT NULL DEFAULT '0',
  `printstate2` int(11) NOT NULL DEFAULT '0',
  `apppay` tinyint(3) NOT NULL DEFAULT '0',
  `isborrow` tinyint(1) DEFAULT '0',
  `borrowopenid` varchar(50) DEFAULT '',
  `source` tinyint(1) DEFAULT '0',
  `ladder_id` int(11) DEFAULT '0',
  `is_ladder` tinyint(1) DEFAULT '0',
  `more_spec` tinyint(1) DEFAULT '0',
  `wxapp_prepay_id` varchar(255) DEFAULT '',
  `cancel_reason` varchar(255) DEFAULT '',
  `goods_price` decimal(10,2) DEFAULT '0.00',
  `goods_option_id` int(11) DEFAULT '0',
  `specs` varchar(255) DEFAULT '',
  `diyformid` int(11) DEFAULT '0',
  `diyformdata` text,
  `diyformfields` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_groups_order_goods`;
CREATE TABLE `ims_vending_machine_groups_order_goods` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT '0',
  `groups_goods_id` int(11) DEFAULT '0',
  `groups_goods_option_id` int(11) DEFAULT '0',
  `groups_order_id` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_groups_order_refund`;
CREATE TABLE `ims_vending_machine_groups_order_refund` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(45) NOT NULL DEFAULT '',
  `orderid` int(11) NOT NULL DEFAULT '0',
  `refundno` varchar(45) NOT NULL DEFAULT '',
  `refundstatus` tinyint(3) NOT NULL DEFAULT '0',
  `refundaddressid` int(11) NOT NULL DEFAULT '0',
  `refundaddress` varchar(1000) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `images` varchar(255) NOT NULL DEFAULT '',
  `applytime` varchar(45) NOT NULL DEFAULT '',
  `applycredit` int(11) NOT NULL DEFAULT '0',
  `applyprice` decimal(11,2) NOT NULL DEFAULT '0.00',
  `reply` text NOT NULL,
  `refundtype` varchar(45) NOT NULL DEFAULT '',
  `rtype` int(3) NOT NULL DEFAULT '0',
  `refundtime` varchar(45) NOT NULL,
  `endtime` varchar(45) NOT NULL DEFAULT '',
  `message` varchar(255) NOT NULL DEFAULT '',
  `operatetime` varchar(45) NOT NULL DEFAULT '',
  `realcredit` int(11) NOT NULL DEFAULT '0',
  `realmoney` decimal(11,2) NOT NULL DEFAULT '0.00',
  `express` varchar(45) NOT NULL DEFAULT '',
  `expresscom` varchar(100) NOT NULL DEFAULT '',
  `expresssn` varchar(45) NOT NULL DEFAULT '',
  `sendtime` varchar(45) NOT NULL DEFAULT '',
  `returntime` int(11) NOT NULL DEFAULT '0',
  `rexpress` varchar(45) NOT NULL DEFAULT '',
  `rexpresscom` varchar(100) NOT NULL DEFAULT '',
  `rexpresssn` varchar(45) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_groups_paylog`;
CREATE TABLE `ims_vending_machine_groups_paylog` (
`plid` int(11) UNSIGNED NOT NULL,
  `type` varchar(20) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `acid` int(10) UNSIGNED NOT NULL,
  `openid` varchar(40) NOT NULL,
  `tid` varchar(64) NOT NULL,
  `credit` int(10) NOT NULL DEFAULT '0',
  `creditmoney` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) DEFAULT '0.00',
  `status` tinyint(4) NOT NULL,
  `module` varchar(50) NOT NULL,
  `tag` varchar(2000) NOT NULL,
  `is_usecard` tinyint(3) UNSIGNED NOT NULL,
  `card_type` tinyint(3) UNSIGNED NOT NULL,
  `card_id` varchar(50) DEFAULT '',
  `card_fee` decimal(10,2) DEFAULT '0.00',
  `encrypt_code` varchar(100) DEFAULT '',
  `uniontid` varchar(50) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_groups_set`;
CREATE TABLE `ims_vending_machine_groups_set` (
`id` int(11) NOT NULL,
  `uniacid` varchar(45) DEFAULT NULL,
  `groups` int(2) NOT NULL DEFAULT '0',
  `followurl` varchar(255) DEFAULT NULL,
  `followqrcode` varchar(255) DEFAULT NULL,
  `groupsurl` varchar(255) DEFAULT NULL,
  `share_title` varchar(255) DEFAULT NULL,
  `share_icon` varchar(255) DEFAULT NULL,
  `share_desc` varchar(255) DEFAULT NULL,
  `share_url` varchar(255) DEFAULT NULL,
  `groups_description` text,
  `description` int(2) NOT NULL DEFAULT '0',
  `creditdeduct` tinyint(2) NOT NULL DEFAULT '0',
  `groupsdeduct` tinyint(2) NOT NULL DEFAULT '0',
  `credit` int(11) NOT NULL DEFAULT '1',
  `groupsmoney` decimal(11,2) NOT NULL DEFAULT '0.00',
  `refund` int(11) NOT NULL DEFAULT '0',
  `refundday` int(11) NOT NULL DEFAULT '0',
  `goodsid` text NOT NULL,
  `rules` text,
  `receive` int(11) DEFAULT '0',
  `discount` tinyint(3) DEFAULT '0',
  `headstype` tinyint(3) DEFAULT '0',
  `headsmoney` decimal(10,2) DEFAULT '0.00',
  `headsdiscount` int(11) DEFAULT '0',
  `followbar` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_groups_verify`;
CREATE TABLE `ims_vending_machine_groups_verify` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(45) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `verifycode` varchar(45) DEFAULT '',
  `storeid` int(11) DEFAULT '0',
  `verifier` varchar(45) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `verifytime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_invitation`;
CREATE TABLE `ims_vending_machine_invitation` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `scan` int(11) NOT NULL DEFAULT '0',
  `follow` int(11) NOT NULL DEFAULT '0',
  `qrcode` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_invitation_log`;
CREATE TABLE `ims_vending_machine_invitation_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `invitation_id` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `invitation_openid` varchar(50) NOT NULL DEFAULT '',
  `scan_time` int(10) NOT NULL DEFAULT '0',
  `follow` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_invitation_qr`;
CREATE TABLE `ims_vending_machine_invitation_qr` (
`id` int(11) NOT NULL,
  `acid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(60) NOT NULL,
  `invitationid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL DEFAULT '0',
  `sceneid` int(11) NOT NULL,
  `ticket` varchar(255) NOT NULL,
  `createtime` int(11) NOT NULL,
  `expire` int(11) NOT NULL DEFAULT '0',
  `qrimg` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_lottery`;
CREATE TABLE `ims_vending_machine_lottery` (
`lottery_id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `lottery_title` varchar(150) DEFAULT NULL,
  `lottery_icon` varchar(255) DEFAULT NULL,
  `lottery_banner` varchar(255) DEFAULT NULL,
  `lottery_cannot` varchar(255) DEFAULT NULL,
  `lottery_type` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT '0',
  `addtime` int(11) DEFAULT NULL,
  `lottery_data` text,
  `is_goods` tinyint(1) DEFAULT '0',
  `lottery_days` int(11) DEFAULT '0',
  `task_type` tinyint(1) DEFAULT '0',
  `task_data` text,
  `start_time` int(11) DEFAULT NULL,
  `end_time` int(11) DEFAULT NULL,
  `award_start` int(11) DEFAULT '0',
  `award_end` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_lottery_default`;
CREATE TABLE `ims_vending_machine_lottery_default` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `data` text,
  `addtime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_lottery_join`;
CREATE TABLE `ims_vending_machine_lottery_join` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `join_user` varchar(255) DEFAULT NULL,
  `lottery_id` int(11) DEFAULT NULL,
  `lottery_num` int(10) DEFAULT '0',
  `lottery_tag` varchar(255) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_lottery_log`;
CREATE TABLE `ims_vending_machine_lottery_log` (
`log_id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `lottery_id` int(11) DEFAULT '0',
  `join_user` varchar(255) DEFAULT NULL,
  `lottery_data` text,
  `is_reward` tinyint(1) DEFAULT '0',
  `addtime` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member`;
CREATE TABLE `ims_vending_machine_member` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `groupid` varchar(1000) DEFAULT '',
  `level` int(11) DEFAULT '0',
  `agentid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `realname` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `pwd` varchar(32) DEFAULT '',
  `weixin` varchar(100) DEFAULT '',
  `content` text,
  `createtime` int(10) DEFAULT '0',
  `agenttime` int(10) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `isagent` tinyint(1) DEFAULT '0',
  `clickcount` int(11) DEFAULT '0',
  `agentlevel` int(11) DEFAULT '0',
  `noticeset` text,
  `nickname` varchar(255) DEFAULT '',
  `nickname_wechat` varchar(255) DEFAULT '',
  `credit1` decimal(10,2) DEFAULT '0.00',
  `credit2` decimal(10,2) DEFAULT '0.00',
  `diymaxcredit` tinyint(3) DEFAULT '0',
  `maxcredit` int(11) DEFAULT '0',
  `birthyear` varchar(255) DEFAULT '',
  `birthmonth` varchar(255) DEFAULT '',
  `birthday` varchar(255) DEFAULT '',
  `gender` tinyint(3) DEFAULT '0',
  `avatar` varchar(255) DEFAULT '',
  `avatar_wechat` varchar(255) DEFAULT '',
  `province` varchar(255) DEFAULT '',
  `city` varchar(255) DEFAULT '',
  `area` varchar(255) DEFAULT '',
  `childtime` int(11) DEFAULT '0',
  `agentnotupgrade` int(11) DEFAULT '0',
  `inviter` int(11) DEFAULT '0',
  `agentselectgoods` tinyint(3) DEFAULT '0',
  `agentblack` int(11) DEFAULT '0',
  `username` varchar(255) DEFAULT '',
  `fixagentid` tinyint(3) DEFAULT '0',
  `diymemberid` int(11) DEFAULT '0',
  `diymemberdataid` int(11) DEFAULT '0',
  `diymemberdata` text,
  `diycommissionid` int(11) DEFAULT '0',
  `diycommissiondataid` int(11) DEFAULT '0',
  `diycommissiondata` text,
  `isblack` int(11) DEFAULT '0',
  `diymemberfields` text,
  `diycommissionfields` text,
  `commission_total` decimal(10,2) DEFAULT '0.00',
  `endtime2` int(11) DEFAULT '0',
  `ispartner` tinyint(3) DEFAULT '0',
  `partnertime` int(11) DEFAULT '0',
  `partnerstatus` tinyint(3) DEFAULT '0',
  `partnerblack` tinyint(3) DEFAULT '0',
  `partnerlevel` int(11) DEFAULT '0',
  `partnernotupgrade` tinyint(3) DEFAULT '0',
  `diyglobonusid` int(11) DEFAULT '0',
  `diyglobonusdata` text,
  `diyglobonusfields` text,
  `isaagent` tinyint(3) DEFAULT '0',
  `aagentlevel` int(11) DEFAULT '0',
  `aagenttime` int(11) DEFAULT '0',
  `aagentstatus` tinyint(3) DEFAULT '0',
  `aagentblack` tinyint(3) DEFAULT '0',
  `aagentnotupgrade` tinyint(3) DEFAULT '0',
  `diyaagentid` int(11) DEFAULT '0',
  `diyaagentdata` text,
  `diyaagentfields` text,
  `aagenttype` tinyint(3) DEFAULT '0',
  `aagentprovinces` text,
  `aagentcitys` text,
  `aagentareas` text,
  `salt` varchar(32) DEFAULT NULL,
  `mobileverify` tinyint(3) DEFAULT '0',
  `mobileuser` tinyint(3) DEFAULT '0',
  `carrier_mobile` varchar(11) DEFAULT '0',
  `isauthor` tinyint(1) DEFAULT '0',
  `authortime` int(11) DEFAULT '0',
  `authorstatus` tinyint(1) DEFAULT '0',
  `authorblack` tinyint(1) DEFAULT '0',
  `authorlevel` int(11) DEFAULT '0',
  `authornotupgrade` tinyint(1) DEFAULT '0',
  `diyauthorid` int(11) DEFAULT '0',
  `diyauthordata` text,
  `diyauthorfields` text,
  `authorid` int(11) DEFAULT '0',
  `comefrom` varchar(20) DEFAULT NULL,
  `openid_qq` varchar(50) NOT NULL,
  `openid_wx` varchar(50) NOT NULL,
  `datavalue` varchar(50) NOT NULL DEFAULT '',
  `openid_wa` varchar(50) NOT NULL,
  `updateaddress` tinyint(1) NOT NULL DEFAULT '0',
  `membercardid` varchar(255) DEFAULT '',
  `membercardcode` varchar(255) DEFAULT '',
  `membershipnumber` varchar(255) DEFAULT '',
  `membercardactive` tinyint(1) DEFAULT '0',
  `idnumber` varchar(255) DEFAULT NULL,
  `wxcardupdatetime` int(11) DEFAULT '0',
  `hasnewcoupon` tinyint(1) DEFAULT '0',
  `isheads` tinyint(1) NOT NULL DEFAULT '0',
  `headsstatus` tinyint(1) NOT NULL DEFAULT '0',
  `headstime` int(11) NOT NULL DEFAULT '0',
  `headsid` int(11) NOT NULL DEFAULT '0',
  `diyheadsid` int(11) NOT NULL DEFAULT '0',
  `diyheadsdata` text,
  `diyheadsfields` text,
  `applyagenttime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_member` (`id`, `uniacid`, `uid`, `groupid`, `level`, `agentid`, `openid`, `realname`, `mobile`, `pwd`, `weixin`, `content`, `createtime`, `agenttime`, `status`, `isagent`, `clickcount`, `agentlevel`, `noticeset`, `nickname`, `nickname_wechat`, `credit1`, `credit2`, `diymaxcredit`, `maxcredit`, `birthyear`, `birthmonth`, `birthday`, `gender`, `avatar`, `avatar_wechat`, `province`, `city`, `area`, `childtime`, `agentnotupgrade`, `inviter`, `agentselectgoods`, `agentblack`, `username`, `fixagentid`, `diymemberid`, `diymemberdataid`, `diymemberdata`, `diycommissionid`, `diycommissiondataid`, `diycommissiondata`, `isblack`, `diymemberfields`, `diycommissionfields`, `commission_total`, `endtime2`, `ispartner`, `partnertime`, `partnerstatus`, `partnerblack`, `partnerlevel`, `partnernotupgrade`, `diyglobonusid`, `diyglobonusdata`, `diyglobonusfields`, `isaagent`, `aagentlevel`, `aagenttime`, `aagentstatus`, `aagentblack`, `aagentnotupgrade`, `diyaagentid`, `diyaagentdata`, `diyaagentfields`, `aagenttype`, `aagentprovinces`, `aagentcitys`, `aagentareas`, `salt`, `mobileverify`, `mobileuser`, `carrier_mobile`, `isauthor`, `authortime`, `authorstatus`, `authorblack`, `authorlevel`, `authornotupgrade`, `diyauthorid`, `diyauthordata`, `diyauthorfields`, `authorid`, `comefrom`, `openid_qq`, `openid_wx`, `datavalue`, `openid_wa`, `updateaddress`, `membercardid`, `membercardcode`, `membershipnumber`, `membercardactive`, `idnumber`, `wxcardupdatetime`, `hasnewcoupon`, `isheads`, `headsstatus`, `headstime`, `headsid`, `diyheadsid`, `diyheadsdata`, `diyheadsfields`, `applyagenttime`) VALUES
(1, 1, 0, '', 0, 0, 'ooyv91cPbLRIz1qaX7Fim_cRfjZk', '', '', '', '', NULL, 1601185918, 0, 0, 0, 0, 0, NULL, '', '', '0.00', '0.00', 0, 0, '', '', '', -1, '', '', '', '', '', 0, 0, 0, 0, 0, '', 0, 0, 0, NULL, 0, 0, NULL, 0, NULL, NULL, '0.00', 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, '0', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, NULL, '', '', '', '', 0, '', '', '', 0, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 0);

DROP TABLE IF EXISTS `ims_vending_machine_member_address`;
CREATE TABLE `ims_vending_machine_member_address` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `realname` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `province` varchar(30) DEFAULT '',
  `city` varchar(30) DEFAULT '',
  `area` varchar(30) DEFAULT '',
  `address` varchar(300) DEFAULT '',
  `isdefault` tinyint(1) DEFAULT '0',
  `zipcode` varchar(255) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `street` varchar(50) NOT NULL DEFAULT '',
  `datavalue` varchar(50) NOT NULL DEFAULT '',
  `streetdatavalue` varchar(30) NOT NULL DEFAULT '',
  `lng` varchar(255) NOT NULL DEFAULT '',
  `lat` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_card`;
CREATE TABLE `ims_vending_machine_member_card` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `card_style` varchar(255) DEFAULT NULL,
  `sort_order` int(10) DEFAULT '0',
  `shipping` tinyint(11) DEFAULT NULL,
  `member_discount` tinyint(1) DEFAULT NULL,
  `discount_rate` decimal(10,1) DEFAULT NULL,
  `discount` tinyint(1) NOT NULL DEFAULT '1',
  `is_card_points` tinyint(1) DEFAULT NULL,
  `card_points` varchar(50) DEFAULT NULL,
  `is_card_coupon` tinyint(1) DEFAULT NULL,
  `card_coupon` varchar(500) DEFAULT NULL,
  `is_month_points` tinyint(1) DEFAULT NULL,
  `month_points` varchar(50) DEFAULT NULL,
  `is_month_coupon` tinyint(1) DEFAULT NULL,
  `month_coupon` varchar(500) DEFAULT NULL,
  `validate` int(11) NOT NULL DEFAULT '1',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `stock` int(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` text,
  `kefu_tel` varchar(100) DEFAULT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `sale_count` int(11) NOT NULL DEFAULT '0',
  `del_time` int(11) NOT NULL DEFAULT '0',
  `isdelete` tinyint(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `cardmodel` int(2) DEFAULT '1',
  `goodsids` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_member_card_buysend`;
CREATE TABLE `ims_vending_machine_member_card_buysend` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `member_card_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `receive_time` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `sendtype` tinyint(1) NOT NULL DEFAULT '1',
  `card_points` varchar(50) DEFAULT NULL,
  `card_couponid` int(11) NOT NULL DEFAULT '0',
  `card_couponcount` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_member_card_history`;
CREATE TABLE `ims_vending_machine_member_card_history` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `order_id` int(11) NOT NULL,
  `openid` varchar(50) DEFAULT '',
  `member_card_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `expire_time` int(11) NOT NULL DEFAULT '0',
  `receive_time` int(11) NOT NULL DEFAULT '0',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `user_name` varchar(255) DEFAULT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `isdelete` int(11) NOT NULL DEFAULT '0',
  `del_time` int(11) NOT NULL DEFAULT '0',
  `pay_type` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_member_card_monthsend`;
CREATE TABLE `ims_vending_machine_member_card_monthsend` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `member_card_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `receive_time` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `validate` int(11) NOT NULL DEFAULT '1',
  `sendtype` tinyint(1) NOT NULL DEFAULT '1',
  `card_points` varchar(50) DEFAULT NULL,
  `card_couponid` int(11) NOT NULL DEFAULT '0',
  `card_couponcount` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_member_card_order`;
CREATE TABLE `ims_vending_machine_member_card_order` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `member_id` int(11) DEFAULT '0',
  `payment_name` varchar(32) DEFAULT NULL,
  `telephone` varchar(32) DEFAULT NULL,
  `orderno` varchar(30) DEFAULT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `finishtime` int(11) DEFAULT '0',
  `paytime` int(11) DEFAULT '0',
  `member_card_id` int(11) DEFAULT '0',
  `wxapp_prepay_id` varchar(255) DEFAULT '',
  `transid` varchar(32) DEFAULT '',
  `paytype` varchar(32) DEFAULT '',
  `apppay` tinyint(3) NOT NULL DEFAULT '0',
  `borrowopenid` varchar(50) DEFAULT NULL,
  `isborrow` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_member_card_uselog`;
CREATE TABLE `ims_vending_machine_member_card_uselog` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `order_id` int(11) NOT NULL,
  `member_card_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `shipping` tinyint(1) DEFAULT '0',
  `discount_rate` varchar(50) DEFAULT NULL,
  `order_price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `dec_price` decimal(11,2) NOT NULL DEFAULT '0.00',
  `create_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_member_cart`;
CREATE TABLE `ims_vending_machine_member_cart` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(100) DEFAULT '',
  `goodsid` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `deleted` tinyint(1) DEFAULT '0',
  `optionid` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `diyformdataid` int(11) DEFAULT '0',
  `diyformdata` text,
  `diyformfields` text,
  `diyformid` int(11) DEFAULT '0',
  `selected` tinyint(1) DEFAULT '1',
  `merchid` int(11) DEFAULT '0',
  `isnewstore` tinyint(3) NOT NULL DEFAULT '0',
  `selectedadd` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_credit_record`;
CREATE TABLE `ims_vending_machine_member_credit_record` (
`id` int(11) NOT NULL,
  `uid` int(11) UNSIGNED NOT NULL,
  `openid` varchar(255) DEFAULT '',
  `uniacid` int(11) NOT NULL,
  `credittype` varchar(10) NOT NULL,
  `num` decimal(10,2) NOT NULL,
  `operator` int(10) UNSIGNED NOT NULL,
  `createtime` int(10) UNSIGNED NOT NULL,
  `remark` varchar(200) NOT NULL,
  `module` varchar(30) NOT NULL,
  `presentcredit` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_favorite`;
CREATE TABLE `ims_vending_machine_member_favorite` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `type` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_group`;
CREATE TABLE `ims_vending_machine_member_group` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `groupname` varchar(255) DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_group_log`;
CREATE TABLE `ims_vending_machine_member_group_log` (
`log_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `add_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_history`;
CREATE TABLE `ims_vending_machine_member_history` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `goodsid` int(10) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `deleted` tinyint(1) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `times` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_level`;
CREATE TABLE `ims_vending_machine_member_level` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `level` int(11) DEFAULT '0',
  `levelname` varchar(50) DEFAULT '',
  `ordermoney` decimal(10,2) DEFAULT '0.00',
  `ordercount` int(10) DEFAULT '0',
  `discount` decimal(10,2) DEFAULT '0.00',
  `enabled` tinyint(3) DEFAULT '0',
  `buygoods` tinyint(1) NOT NULL DEFAULT '0',
  `goodsids` text NOT NULL,
  `enabledadd` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_log`;
CREATE TABLE `ims_vending_machine_member_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `type` tinyint(3) DEFAULT NULL,
  `logno` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `money` decimal(10,2) DEFAULT '0.00',
  `rechargetype` varchar(255) DEFAULT '',
  `transid` varchar(255) DEFAULT '',
  `gives` decimal(10,2) DEFAULT NULL,
  `couponid` int(11) DEFAULT '0',
  `isborrow` tinyint(3) DEFAULT '0',
  `borrowopenid` varchar(100) DEFAULT '',
  `apppay` tinyint(3) NOT NULL DEFAULT '0',
  `alipay` varchar(50) NOT NULL DEFAULT '',
  `bankname` varchar(50) NOT NULL DEFAULT '',
  `bankcard` varchar(50) NOT NULL DEFAULT '',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `applytype` tinyint(3) NOT NULL DEFAULT '0',
  `sendmoney` decimal(10,2) DEFAULT '0.00',
  `senddata` text,
  `realmoney` decimal(10,2) DEFAULT '0.00',
  `charge` decimal(10,2) DEFAULT '0.00',
  `deductionmoney` decimal(10,2) DEFAULT '0.00',
  `remark` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_mergelog`;
CREATE TABLE `ims_vending_machine_member_mergelog` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `mergetime` int(11) NOT NULL DEFAULT '0',
  `openid_a` varchar(30) NOT NULL,
  `openid_b` varchar(30) NOT NULL,
  `mid_a` int(11) NOT NULL,
  `mid_b` int(11) NOT NULL,
  `detail_a` text,
  `detail_b` text,
  `detail_c` text,
  `fromuniacid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_message_template`;
CREATE TABLE `ims_vending_machine_member_message_template` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `template_id` varchar(255) DEFAULT '',
  `first` text NOT NULL,
  `firstcolor` varchar(255) DEFAULT '',
  `data` text NOT NULL,
  `remark` text NOT NULL,
  `remarkcolor` varchar(255) DEFAULT '',
  `url` varchar(255) NOT NULL,
  `createtime` int(11) DEFAULT '0',
  `sendtimes` int(11) DEFAULT '0',
  `sendcount` int(11) DEFAULT '0',
  `typecode` varchar(30) DEFAULT '',
  `messagetype` tinyint(1) DEFAULT '0',
  `send_desc` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_message_template_default`;
CREATE TABLE `ims_vending_machine_member_message_template_default` (
`id` int(11) NOT NULL,
  `typecode` varchar(255) DEFAULT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `templateid` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_message_template_type`;
CREATE TABLE `ims_vending_machine_member_message_template_type` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `typecode` varchar(255) DEFAULT NULL,
  `templatecode` varchar(255) DEFAULT NULL,
  `templateid` varchar(255) DEFAULT NULL,
  `templatename` varchar(255) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `typegroup` varchar(255) DEFAULT '',
  `groupname` varchar(255) DEFAULT '',
  `showtotaladd` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_member_message_template_type` (`id`, `name`, `typecode`, `templatecode`, `templateid`, `templatename`, `content`, `typegroup`, `groupname`, `showtotaladd`) VALUES
(1, '订单付款通知', 'saler_pay', 'OPENTM405584202', '', '订单付款通知', '{{first.DATA}}订单编号：{{keyword1.DATA}}商品名称：{{keyword2.DATA}}商品数量：{{keyword3.DATA}}支付金额：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(2, '自提订单提交成功通知', 'carrier', 'OPENTM201594720', '', '订单付款通知', '{{first.DATA}}自提码：{{keyword1.DATA}}商品详情：{{keyword2.DATA}}提货地址：{{keyword3.DATA}}提货时间：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(3, '订单取消通知', 'cancel', 'OPENTM201764653', '', '订单关闭提醒', '{{first.DATA}}订单商品：{{keyword1.DATA}}订单编号：{{keyword2.DATA}}下单时间：{{keyword3.DATA}}订单金额：{{keyword4.DATA}}关闭时间：{{keyword5.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(4, '订单即将取消通知', 'willcancel', 'OPENTM201764653', '', '订单关闭提醒', '{{first.DATA}}订单商品：{{keyword1.DATA}}订单编号：{{keyword2.DATA}}下单时间：{{keyword3.DATA}}订单金额：{{keyword4.DATA}}关闭时间：{{keyword5.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(5, '订单支付成功通知', 'pay', 'OPENTM405584202', '', '订单支付通知', '{{first.DATA}}订单编号：{{keyword1.DATA}}商品名称：{{keyword2.DATA}}商品数量：{{keyword3.DATA}}支付金额：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(6, '订单发货通知', 'send', 'OPENTM401874827', '', '订单发货通知', '{{first.DATA}}订单编号：{{keyword1.DATA}}快递公司：{{keyword2.DATA}}快递单号：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(7, '自动发货通知(虚拟物品及卡密)', 'virtualsend', 'OPENTM207793687', '', '自动发货通知', '{{first.DATA}}商品名称：{{keyword1.DATA}}订单号：{{keyword2.DATA}}订单金额：{{keyword3.DATA}}卡密信息：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(8, '订单状态更新(修改收货地址)(修改价格)', 'orderstatus', 'OPENTM202137457', '', '订单付款通知', '{{first.DATA}}订单编号:{{OrderSn.DATA}}订单状态:{{OrderStatus.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(9, '退款成功通知', 'refund1', 'TM00430', '', '退款成功通知', '{{first.DATA}}退款金额：{{orderProductPrice.DATA}}商品详情：{{orderProductName.DATA}}订单编号：{{orderName.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(10, '换货成功通知', 'refund3', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(11, '退款申请驳回通知', 'refund2', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(12, '充值成功通知', 'recharge_ok', 'OPENTM207727673', '', '充值成功提醒', '{{first.DATA}}充值金额：{{keyword1.DATA}}充值时间：{{keyword2.DATA}}账户余额：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(13, '提现成功通知', 'withdraw_ok', 'OPENTM207422808', '', '提现通知', '{{first.DATA}}申请提现金额：{{keyword1.DATA}}取提现手续费：{{keyword2.DATA}}实际到账金额：{{keyword3.DATA}}提现渠道：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(14, '会员升级通知(任务处理通知)', 'upgrade', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(15, '充值成功通知（后台管理员手动）', 'backrecharge_ok', 'OPENTM207727673', '', '充值成功提醒', '{{first.DATA}}充值金额：{{keyword1.DATA}}充值时间：{{keyword2.DATA}}账户余额：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(16, '积分变动提醒', 'backpoint_ok', 'OPENTM207266668', '', '积分变动提醒', '{{first.DATA}}获得时间：{{keyword1.DATA}}获得积分：{{keyword2.DATA}}获得原因：{{keyword3.DATA}}当前积分：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(17, '换货发货通知', 'refund4', 'OPENTM401874827', '', '订单发货通知', '{{first.DATA}}订单编号：{{keyword1.DATA}}快递公司：{{keyword2.DATA}}快递单号：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(18, '砍价活动通知', 'bargain_message', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'bargain', '砍价消息通知', 0),
(19, '拼团活动通知', 'groups', '', '', '', '', 'groups', '拼团消息通知', 0),
(20, '人人分销通知', 'commission', '', '', '', '', 'commission', '分销消息通知', 0),
(21, '商品付款通知', 'saler_goodpay', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(22, '砍到底价通知', 'bargain_fprice', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'bargain', '砍价消息通知', 0),
(23, '订单收货通知(卖家)', 'saler_finish', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(24, '余额兑换成功通知', 'exchange_balance', 'OPENTM207727673', '', '充值成功提醒', '{{first.DATA}}充值金额：{{keyword1.DATA}}充值时间：{{keyword2.DATA}}账户余额：{{keyword3.DATA}}{{remark.DATA}}', 'exchange', '兑换中心消息通知', 0),
(25, '积分兑换成功通知', 'exchange_score', 'OPENTM207509450', '', '积分变动提醒', '{{first.DATA}}获得时间：{{keyword1.DATA}}获得积分：{{keyword2.DATA}}获得原因：{{keyword3.DATA}}当前积分：{{keyword4.DATA}}{{remark.DATA}}', 'exchange', '兑换中心消息通知', 0),
(26, '兑换中心余额充值通知', 'exchange_recharge', 'OPENTM207727673', '', '充值成功提醒', '{{first.DATA}}充值金额：{{keyword1.DATA}}充值时间：{{keyword2.DATA}}账户余额：{{keyword3.DATA}}{{remark.DATA}}', 'exchange', '兑换中心消息通知', 0),
(27, '游戏中心通知', 'lottery_get', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'lottery', '抽奖消息通知', 0),
(35, '库存预警通知', 'saler_stockwarn', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(36, '卖家核销商品核销通知', 'o2o_sverify', 'OPENTM409521536', '', '核销成功提醒', '{{first.DATA}}核销项目：{{keyword1.DATA}}核销时间：{{keyword2.DATA}}核销门店：{{keyword3.DATA}}{{remark.DATA}}', 'o2o', 'O2O消息通知', 0),
(37, '核销商品核销通知', 'o2o_bverify', 'OPENTM409521536', '', '核销成功提醒', '{{first.DATA}}核销项目：{{keyword1.DATA}}核销时间：{{keyword2.DATA}}核销门店：{{keyword3.DATA}}{{remark.DATA}}', 'o2o', 'O2O消息通知', 0),
(38, '卖家商品预约通知', 'o2o_snorder', 'OPENTM202447657', '', '预约成功提醒', '{{first.DATA}}预约项目：{{keyword1.DATA}}预约时间：{{keyword2.DATA}}{{remark.DATA}}', 'o2o', 'O2O消息通知', 0),
(39, '商品预约成功通知', 'o2o_bnorder', 'OPENTM202447657', '', '预约成功提醒', '{{first.DATA}}预约项目：{{keyword1.DATA}}预约时间：{{keyword2.DATA}}{{remark.DATA}}', 'o2o', 'O2O消息通知', 0),
(42, '商品下单通知', 'saler_goodsubmit', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(50, '维权订单通知', 'saler_refund', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(43, '任务接取通知', 'task_pick', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', 0),
(44, '任务进度通知', 'task_progress', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', 0),
(45, '任务完成通知', 'task_finish', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', 0),
(46, '任务海报接取通知', 'task_poster_pick', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', 0),
(47, '任务海报进度通知', 'task_poster_progress', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', 0),
(48, '任务海报完成通知', 'task_poster_finish', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', 0),
(49, '任务海报扫描通知', 'task_poster_scan', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', 0),
(52, '成为分销商通知', 'commission_become', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(53, '新增下线通知', 'commission_agent_new', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(54, '下级付款通知', 'commission_order_pay', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(55, '下级确认收货通知', 'commission_order_finish', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(56, '提现申请提交通知', 'commission_apply', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(57, '提现申请完成审核通知', 'commission_check', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(58, '佣金打款通知', 'commission_pay', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(59, '分销商等级升级通知', 'commission_upgrade', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(60, '成为股东通知', 'globonus_become', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'globonus', '股东消息通知', 0),
(61, '股东等级升级通知', 'globonus_upgrade', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'globonus', '股东消息通知', 0),
(62, '分红发放通知', 'globonus_pay', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'globonus', '股东消息通知', 0),
(63, '奖励发放通知', 'article', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'article', '文章营销消息通知', 0),
(64, '成为区域代理通知', 'abonus_become', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', 0),
(65, '省级代理等级升级通知', 'abonus_upgrade1', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', 0),
(66, '市级代理等级升级通知', 'abonus_upgrade2', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', 0),
(67, '区级代理等级升级通知', 'abonus_upgrade3', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', 0),
(68, '区域代理分红发放通知', 'abonus_pay', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', 0),
(69, '入驻申请通知', 'merch_apply', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'merch', '商家通知', 0),
(70, '提现申请提交通知', 'merch_applymoney', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'merch', '商家通知', 0),
(71, '社区会员评论通知', 'reply', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sns', '人人社区消息通知', 0),
(51, '社区会员升级通知', 'sns', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'sns', '人人社区消息通知', 0),
(74, '周期购定时发货通知', 'cycelbuy_timing', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', 0),
(73, '修改收货时间卖家通知', 'cycelbuy_seller_date', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', 0),
(72, '修改地址卖家通知', 'cycelbuy_seller_address', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', 0),
(75, '修改收货时间买家通知', 'cycelbuy_buyer_date', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', 0),
(76, '修改地址买家通知', 'cycelbuy_buyer_address', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', 0),
(77, '分销提现申请提醒', 'commission_applymoney', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0),
(80, '成为团长通知', 'dividend_become', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', 0),
(81, '成为团长通知(卖家)', 'dividend_become_saler', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', 0),
(82, '团员成为团长通知', 'dividend_downline_become', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', 0),
(83, '团长提现通知', 'dividend_apply', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', 0),
(84, '提现审核完成通知', 'dividend_check', 'OPENTM415477060', '', '业务处理结果通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', 0),
(85, '好友瓜分券活动发起通知', 'friendcoupon_launch', 'OPENTM413117078', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'friendcoupon', '好友瓜分券', 0),
(86, '好友瓜分券活动完成通知', 'friendcoupon_complete', 'OPENTM413117078', ' ', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'friendcoupon', '好友瓜分券', 0),
(87, '好友瓜分券活动失败通知', 'friendcoupon_failed', 'OPENTM413117078', ' ', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}处理状态：{{keyword2.DATA}}处理内容：{{keyword3.DATA}}{{remark.DATA}}', 'friendcoupon', '好友瓜分券', 0),
(89, '多商户审核成功通知', 'march_type_success', 'OPENTM411720444', '', '审核成功通知', '{{first.DATA}}审核状态：{{keyword1.DATA}}审核时间：{{keyword2.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(90, '多商户审核失败通知', 'march_type_fail', 'OPENTM413117348', '', '审核失败通知', '{{first.DATA}}审核状态：{{keyword1.DATA}}审核时间：{{keyword2.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', 0),
(91, '申请成为分销商通知', 'commission_become_apply', 'OPENTM401202609', '', '申请成为分销商通知', '{{first.DATA}}申请名称：{{keyword1.DATA}}申请人：{{keyword2.DATA}}申请类型：{{keyword3.DATA}}申请时间：{{keyword4.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', 0);

DROP TABLE IF EXISTS `ims_vending_machine_member_printer`;
CREATE TABLE `ims_vending_machine_member_printer` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `type` tinyint(3) DEFAULT '0',
  `print_data` text,
  `createtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_printer_template`;
CREATE TABLE `ims_vending_machine_member_printer_template` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `type` tinyint(3) DEFAULT '0',
  `print_title` varchar(255) DEFAULT '',
  `print_style` varchar(255) DEFAULT '',
  `print_data` text,
  `code` varchar(500) DEFAULT '',
  `qrcode` varchar(500) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `goodssn` tinyint(1) NOT NULL DEFAULT '0',
  `productsn` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_rank`;
CREATE TABLE `ims_vending_machine_member_rank` (
`id` int(11) NOT NULL,
  `uniacid` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_wxapp_message_template_default`;
CREATE TABLE `ims_vending_machine_member_wxapp_message_template_default` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `typecode` varchar(255) NOT NULL DEFAULT '',
  `templateid` varchar(255) NOT NULL DEFAULT '',
  `datas` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_member_wxapp_message_template_type`;
CREATE TABLE `ims_vending_machine_member_wxapp_message_template_type` (
`id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT '',
  `typecode` varchar(255) DEFAULT '',
  `templatecode` varchar(255) DEFAULT '',
  `templatename` varchar(255) DEFAULT '',
  `keyword_id_list` varchar(255) DEFAULT '',
  `typegroup` varchar(255) DEFAULT '',
  `groupname` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_member_wxapp_message_template_type` (`id`, `name`, `typecode`, `templatecode`, `templatename`, `keyword_id_list`, `typegroup`, `groupname`) VALUES
(1, '好友瓜分券活动完成通知', 'friendcoupon_complete', 'AT0280', '任务完成通知', '8,15,11', 'friendcoupon', '好友瓜分券');

DROP TABLE IF EXISTS `ims_vending_machine_merch_account`;
CREATE TABLE `ims_vending_machine_merch_account` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `merchid` int(11) DEFAULT '0',
  `username` varchar(255) DEFAULT '',
  `pwd` varchar(255) DEFAULT '',
  `salt` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `perms` text,
  `isfounder` tinyint(3) DEFAULT '0',
  `lastip` varchar(255) DEFAULT '',
  `lastvisit` varchar(255) DEFAULT '',
  `roleid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_adv`;
CREATE TABLE `ims_vending_machine_merch_adv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` int(11) DEFAULT NULL,
  `enabled` int(11) DEFAULT NULL,
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_banner`;
CREATE TABLE `ims_vending_machine_merch_banner` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `bannername` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_bill`;
CREATE TABLE `ims_vending_machine_merch_bill` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `applyno` varchar(255) NOT NULL DEFAULT '',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `orderids` longtext NOT NULL,
  `realprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `realpricerate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `finalprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrateprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payrate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `applytime` int(11) NOT NULL DEFAULT '0',
  `checktime` int(11) NOT NULL DEFAULT '0',
  `paytime` int(11) NOT NULL DEFAULT '0',
  `invalidtime` int(11) NOT NULL DEFAULT '0',
  `refusetime` int(11) NOT NULL DEFAULT '0',
  `remark` text NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `ordernum` int(11) NOT NULL DEFAULT '0',
  `orderprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `passrealprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `passrealpricerate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `passorderids` text NOT NULL,
  `passordernum` int(11) NOT NULL DEFAULT '0',
  `passorderprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `alipay` varchar(50) NOT NULL DEFAULT '',
  `bankname` varchar(50) NOT NULL DEFAULT '',
  `bankcard` varchar(50) NOT NULL DEFAULT '',
  `applyrealname` varchar(50) NOT NULL DEFAULT '',
  `applytype` tinyint(3) NOT NULL DEFAULT '0',
  `handpay` tinyint(3) NOT NULL DEFAULT '0',
  `creditstatus` tinyint(3) NOT NULL DEFAULT '0',
  `creditrate` int(10) NOT NULL DEFAULT '1',
  `creditnum` int(10) NOT NULL DEFAULT '0',
  `creditmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `passcreditnum` int(10) NOT NULL DEFAULT '0',
  `passcreditmoney` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isbillcredit` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_billo`;
CREATE TABLE `ims_vending_machine_merch_billo` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `billid` int(11) NOT NULL DEFAULT '0',
  `orderid` int(11) NOT NULL DEFAULT '0',
  `ordermoney` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_bill_select`;
CREATE TABLE `ims_vending_machine_merch_bill_select` (
`bill_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_category`;
CREATE TABLE `ims_vending_machine_merch_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `catename` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `thumb` varchar(500) DEFAULT '',
  `isrecommand` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_category_swipe`;
CREATE TABLE `ims_vending_machine_merch_category_swipe` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `thumb` varchar(500) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_clearing`;
CREATE TABLE `ims_vending_machine_merch_clearing` (
`id` int(10) UNSIGNED NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `clearno` varchar(64) NOT NULL DEFAULT '',
  `goodsprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `dispatchprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deductprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deductcredit2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `discountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deductenough` decimal(10,2) NOT NULL DEFAULT '0.00',
  `merchdeductenough` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `starttime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `endtime` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `realprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `realpricerate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `finalprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remark` varchar(2000) NOT NULL DEFAULT '',
  `paytime` int(11) NOT NULL DEFAULT '0',
  `payrate` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_commission_orderprice`;
CREATE TABLE `ims_vending_machine_merch_commission_orderprice` (
`order_id` int(11) UNSIGNED NOT NULL,
  `commission_price` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_group`;
CREATE TABLE `ims_vending_machine_merch_group` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `groupname` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `isdefault` tinyint(1) DEFAULT '0',
  `goodschecked` tinyint(1) DEFAULT '0',
  `commissionchecked` tinyint(1) DEFAULT '0',
  `changepricechecked` tinyint(1) DEFAULT '0',
  `finishchecked` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_nav`;
CREATE TABLE `ims_vending_machine_merch_nav` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `navname` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_notice`;
CREATE TABLE `ims_vending_machine_merch_notice` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `detail` text,
  `status` tinyint(3) DEFAULT '0',
  `createtime` int(11) DEFAULT NULL,
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_perm_log`;
CREATE TABLE `ims_vending_machine_merch_perm_log` (
`id` int(11) NOT NULL,
  `uid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `type` varchar(255) DEFAULT '',
  `op` text,
  `ip` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_perm_role`;
CREATE TABLE `ims_vending_machine_merch_perm_role` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `rolename` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `perms` text,
  `deleted` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_reg`;
CREATE TABLE `ims_vending_machine_merch_reg` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `merchname` varchar(255) DEFAULT '',
  `salecate` varchar(255) DEFAULT '',
  `desc` varchar(500) DEFAULT '',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `diyformdata` text,
  `diyformfields` text,
  `applytime` int(11) DEFAULT '0',
  `reason` text,
  `uname` varchar(50) NOT NULL DEFAULT '',
  `upass` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_saler`;
CREATE TABLE `ims_vending_machine_merch_saler` (
`id` int(11) NOT NULL,
  `storeid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `salername` varchar(255) DEFAULT '',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_store`;
CREATE TABLE `ims_vending_machine_merch_store` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `storename` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `lat` varchar(255) DEFAULT '',
  `lng` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `fetchtime` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `saletime` varchar(255) DEFAULT '',
  `desc` text,
  `displayorder` int(11) DEFAULT '0',
  `commission_total` decimal(10,2) DEFAULT NULL,
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_merch_user`;
CREATE TABLE `ims_vending_machine_merch_user` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `regid` int(11) DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `groupid` int(11) DEFAULT '0',
  `merchno` varchar(255) NOT NULL DEFAULT '',
  `merchname` varchar(255) NOT NULL DEFAULT '',
  `salecate` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(500) NOT NULL DEFAULT '',
  `realname` varchar(255) NOT NULL DEFAULT '',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `accounttime` int(11) DEFAULT '0',
  `diyformdata` text,
  `diyformfields` text,
  `applytime` int(11) DEFAULT '0',
  `accounttotal` int(11) DEFAULT '0',
  `remark` text,
  `jointime` int(11) DEFAULT '0',
  `accountid` int(11) DEFAULT '0',
  `sets` mediumtext,
  `logo` varchar(255) NOT NULL DEFAULT '',
  `payopenid` varchar(32) NOT NULL DEFAULT '',
  `payrate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isrecommand` tinyint(1) DEFAULT '0',
  `cateid` int(11) DEFAULT '0',
  `address` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `lat` varchar(255) DEFAULT '',
  `lng` varchar(255) DEFAULT '',
  `pluginset` text NOT NULL,
  `uname` varchar(50) NOT NULL DEFAULT '',
  `upass` varchar(255) NOT NULL DEFAULT '',
  `maxgoods` int(11) NOT NULL DEFAULT '0',
  `iscredit` tinyint(3) NOT NULL DEFAULT '1',
  `creditrate` int(10) NOT NULL DEFAULT '1',
  `iscreditmoney` int(3) NOT NULL DEFAULT '1',
  `can_import` tinyint(3) NOT NULL DEFAULT '0',
  `can_edit` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_nav`;
CREATE TABLE `ims_vending_machine_nav` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `navname` varchar(255) DEFAULT '',
  `icon` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `iswxapp` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_newstore_category`;
CREATE TABLE `ims_vending_machine_newstore_category` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uniacid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_notice`;
CREATE TABLE `ims_vending_machine_notice` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `detail` text,
  `status` tinyint(3) DEFAULT '0',
  `createtime` int(11) DEFAULT NULL,
  `shopid` int(11) DEFAULT '0',
  `iswxapp` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_open_plugin`;
CREATE TABLE `ims_vending_machine_open_plugin` (
`id` int(11) UNSIGNED NOT NULL,
  `plugin` varchar(255) NOT NULL,
  `key` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `expirtime` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_order`;
CREATE TABLE `ims_vending_machine_order` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `agentid` int(11) DEFAULT '0',
  `ordersn` varchar(30) DEFAULT '',
  `price` decimal(10,2) DEFAULT '0.00',
  `goodsprice` decimal(10,2) DEFAULT '0.00',
  `discountprice` decimal(10,2) DEFAULT '0.00',
  `status` tinyint(3) DEFAULT '0',
  `paytype` tinyint(1) DEFAULT '0',
  `transid` varchar(30) DEFAULT '0',
  `remark` varchar(1000) DEFAULT '',
  `addressid` int(11) DEFAULT '0',
  `dispatchprice` decimal(10,2) DEFAULT '0.00',
  `dispatchid` int(10) DEFAULT '0',
  `createtime` int(10) DEFAULT NULL,
  `dispatchtype` tinyint(3) DEFAULT '0',
  `carrier` text,
  `refundid` int(11) DEFAULT '0',
  `iscomment` tinyint(3) DEFAULT '0',
  `creditadd` tinyint(3) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `userdeleted` tinyint(3) DEFAULT '0',
  `finishtime` int(11) DEFAULT '0',
  `paytime` int(11) DEFAULT '0',
  `expresscom` varchar(30) NOT NULL DEFAULT '',
  `expresssn` varchar(50) NOT NULL DEFAULT '',
  `express` varchar(255) DEFAULT '',
  `sendtime` int(11) DEFAULT '0',
  `fetchtime` int(11) DEFAULT '0',
  `cash` tinyint(3) DEFAULT '0',
  `canceltime` int(11) DEFAULT NULL,
  `cancelpaytime` int(11) DEFAULT '0',
  `refundtime` int(11) DEFAULT '0',
  `isverify` tinyint(3) DEFAULT '0',
  `verified` tinyint(3) DEFAULT '0',
  `verifyopenid` varchar(255) DEFAULT '',
  `verifytime` int(11) DEFAULT '0',
  `verifycode` varchar(255) DEFAULT '',
  `verifystoreid` int(11) DEFAULT '0',
  `deductprice` decimal(10,2) DEFAULT '0.00',
  `deductcredit` int(10) DEFAULT '0',
  `deductcredit2` decimal(10,2) DEFAULT '0.00',
  `deductenough` decimal(10,2) DEFAULT '0.00',
  `virtual` int(11) DEFAULT '0',
  `virtual_info` text,
  `virtual_str` text,
  `address` text,
  `sysdeleted` tinyint(3) DEFAULT '0',
  `ordersn2` int(11) DEFAULT '0',
  `changeprice` decimal(10,2) DEFAULT '0.00',
  `changedispatchprice` decimal(10,2) DEFAULT '0.00',
  `oldprice` decimal(10,2) DEFAULT '0.00',
  `olddispatchprice` decimal(10,2) DEFAULT '0.00',
  `isvirtual` tinyint(3) DEFAULT '0',
  `couponid` int(11) DEFAULT '0',
  `couponprice` decimal(10,2) DEFAULT '0.00',
  `diyformdata` text,
  `diyformfields` text,
  `diyformid` int(11) DEFAULT '0',
  `storeid` int(11) DEFAULT '0',
  `closereason` text,
  `remarksaler` text,
  `printstate` tinyint(1) DEFAULT '0',
  `printstate2` tinyint(1) DEFAULT '0',
  `address_send` text,
  `refundstate` tinyint(3) DEFAULT '0',
  `remarkclose` text,
  `remarksend` text,
  `ismr` int(1) NOT NULL DEFAULT '0',
  `isdiscountprice` decimal(10,2) DEFAULT '0.00',
  `isvirtualsend` tinyint(1) DEFAULT '0',
  `virtualsend_info` text,
  `verifyinfo` longtext,
  `verifytype` tinyint(1) DEFAULT '0',
  `verifycodes` text,
  `merchid` int(11) DEFAULT '0',
  `invoicename` varchar(255) DEFAULT '',
  `ismerch` tinyint(1) DEFAULT '0',
  `parentid` int(11) DEFAULT '0',
  `isparent` tinyint(1) DEFAULT '0',
  `grprice` decimal(10,2) DEFAULT '0.00',
  `merchshow` tinyint(1) DEFAULT '0',
  `merchdeductenough` decimal(10,2) DEFAULT '0.00',
  `couponmerchid` int(11) DEFAULT '0',
  `isglobonus` tinyint(3) DEFAULT '0',
  `merchapply` tinyint(1) DEFAULT '0',
  `isabonus` tinyint(3) DEFAULT '0',
  `isborrow` tinyint(3) DEFAULT '0',
  `borrowopenid` varchar(100) DEFAULT '',
  `apppay` tinyint(3) NOT NULL DEFAULT '0',
  `coupongoodprice` decimal(10,2) DEFAULT '1.00',
  `buyagainprice` decimal(10,2) DEFAULT '0.00',
  `ispackage` tinyint(3) DEFAULT '0',
  `packageid` int(11) DEFAULT '0',
  `taskdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `merchisdiscountprice` decimal(10,2) DEFAULT '0.00',
  `seckilldiscountprice` decimal(10,2) DEFAULT '0.00',
  `verifyendtime` int(11) NOT NULL DEFAULT '0',
  `willcancelmessage` tinyint(1) DEFAULT '0',
  `sendtype` tinyint(3) NOT NULL DEFAULT '0',
  `lotterydiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `contype` tinyint(1) DEFAULT '0',
  `wxid` int(11) DEFAULT '0',
  `wxcardid` varchar(50) DEFAULT '',
  `wxcode` varchar(50) DEFAULT '',
  `dispatchkey` varchar(30) NOT NULL DEFAULT '',
  `quickid` int(11) NOT NULL DEFAULT '0',
  `istrade` tinyint(3) NOT NULL DEFAULT '0',
  `isnewstore` tinyint(3) NOT NULL DEFAULT '0',
  `liveid` int(11) NOT NULL,
  `ordersn_trade` varchar(32) NOT NULL,
  `tradestatus` tinyint(1) DEFAULT '0',
  `tradepaytype` tinyint(1) NOT NULL,
  `tradepaytime` int(11) DEFAULT '0',
  `dowpayment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `betweenprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `isshare` int(11) NOT NULL DEFAULT '0',
  `officcode` varchar(50) NOT NULL DEFAULT '',
  `wxapp_prepay_id` varchar(100) DEFAULT NULL,
  `iswxappcreate` tinyint(1) DEFAULT '0',
  `cashtime` int(11) DEFAULT '0',
  `random_code` varchar(4) DEFAULT NULL,
  `print_template` text,
  `city_express_state` tinyint(1) NOT NULL DEFAULT '0',
  `is_cashier` tinyint(3) NOT NULL DEFAULT '0',
  `commissionmoney` decimal(10,2) DEFAULT '0.00',
  `iscycelbuy` tinyint(3) DEFAULT '0',
  `cycelbuy_predict_time` int(11) DEFAULT NULL,
  `cycelbuy_periodic` varchar(255) DEFAULT NULL,
  `invoice_img` varchar(255) DEFAULT '',
  `headsid` int(11) NOT NULL DEFAULT '0',
  `dividend` text,
  `dividend_applytime` int(11) NOT NULL DEFAULT '0',
  `dividend_checktime` int(11) NOT NULL DEFAULT '0',
  `dividend_paytime` int(11) NOT NULL DEFAULT '0',
  `dividend_invalidtime` int(11) NOT NULL DEFAULT '0',
  `dividend_deletetime` int(11) NOT NULL DEFAULT '0',
  `dividend_status` tinyint(3) NOT NULL DEFAULT '0',
  `dividend_content` text,
  `wxapp_allow_subscribe` varchar(255) DEFAULT NULL,
  `payscore_order_id` int(11) NOT NULL COMMENT '支付分订单号'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_order_buysend`;
CREATE TABLE `ims_vending_machine_order_buysend` (
`id` int(10) UNSIGNED NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `credit` float(10,2) DEFAULT '0.00',
  `money` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_order_comment`;
CREATE TABLE `ims_vending_machine_order_comment` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '',
  `nickname` varchar(50) DEFAULT '',
  `headimgurl` varchar(255) DEFAULT '',
  `level` tinyint(3) DEFAULT '0',
  `content` varchar(255) DEFAULT '',
  `images` text,
  `createtime` int(11) DEFAULT '0',
  `deleted` tinyint(3) DEFAULT '0',
  `append_content` varchar(255) DEFAULT '',
  `append_images` text,
  `reply_content` varchar(255) DEFAULT '',
  `reply_images` text,
  `append_reply_content` varchar(255) DEFAULT '',
  `append_reply_images` text,
  `istop` tinyint(3) DEFAULT '0',
  `checked` tinyint(3) NOT NULL DEFAULT '0',
  `replychecked` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_order_goods`;
CREATE TABLE `ims_vending_machine_order_goods` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '1',
  `optionid` int(10) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `optionname` text,
  `commission1` text,
  `applytime1` int(11) DEFAULT '0',
  `checktime1` int(10) DEFAULT '0',
  `paytime1` int(11) DEFAULT '0',
  `invalidtime1` int(11) DEFAULT '0',
  `deletetime1` int(11) DEFAULT '0',
  `status1` tinyint(3) DEFAULT '0',
  `content1` text,
  `commission2` text,
  `applytime2` int(11) DEFAULT '0',
  `checktime2` int(10) DEFAULT '0',
  `paytime2` int(11) DEFAULT '0',
  `invalidtime2` int(11) DEFAULT '0',
  `deletetime2` int(11) DEFAULT '0',
  `status2` tinyint(3) DEFAULT '0',
  `content2` text,
  `commission3` text,
  `applytime3` int(11) DEFAULT '0',
  `checktime3` int(10) DEFAULT '0',
  `paytime3` int(11) DEFAULT '0',
  `invalidtime3` int(11) DEFAULT '0',
  `deletetime3` int(11) DEFAULT '0',
  `status3` tinyint(3) DEFAULT '0',
  `content3` text,
  `realprice` decimal(10,2) DEFAULT '0.00',
  `goodssn` varchar(255) DEFAULT '',
  `productsn` varchar(255) DEFAULT '',
  `nocommission` tinyint(3) DEFAULT '0',
  `changeprice` decimal(10,2) DEFAULT '0.00',
  `oldprice` decimal(10,2) DEFAULT '0.00',
  `commissions` text,
  `diyformdata` text,
  `diyformfields` text,
  `diyformdataid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `diyformid` int(11) DEFAULT '0',
  `rstate` tinyint(3) DEFAULT '0',
  `refundtime` int(11) DEFAULT '0',
  `printstate` int(11) NOT NULL DEFAULT '0',
  `printstate2` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `parentorderid` int(11) DEFAULT '0',
  `canbuyagain` tinyint(1) DEFAULT '0',
  `seckill` tinyint(3) DEFAULT '0',
  `seckill_taskid` int(11) DEFAULT '0',
  `seckill_roomid` int(11) DEFAULT '0',
  `seckill_timeid` int(11) DEFAULT '0',
  `sendtype` tinyint(3) NOT NULL DEFAULT '0',
  `expresscom` varchar(30) NOT NULL,
  `expresssn` varchar(50) NOT NULL,
  `express` varchar(255) NOT NULL,
  `sendtime` int(11) NOT NULL,
  `finishtime` int(11) NOT NULL,
  `remarksend` text NOT NULL,
  `prohibitrefund` tinyint(3) NOT NULL DEFAULT '0',
  `storeid` varchar(255) NOT NULL,
  `trade_time` int(11) NOT NULL DEFAULT '0',
  `optime` varchar(30) NOT NULL,
  `tdate_time` int(11) NOT NULL DEFAULT '0',
  `dowpayment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peopleid` int(11) NOT NULL DEFAULT '0',
  `esheetprintnum` int(11) NOT NULL DEFAULT '0',
  `ordercode` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(255) DEFAULT NULL,
  `consume` text,
  `single_refundid` int(11) NOT NULL DEFAULT '0',
  `single_refundstate` tinyint(3) NOT NULL DEFAULT '0',
  `single_refundtime` int(11) NOT NULL DEFAULT '0',
  `fullbackid` int(11) NOT NULL DEFAULT '0',
  `merchsale` tinyint(3) NOT NULL DEFAULT '0',
  `isdiscountprice` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_order_peerpay`;
CREATE TABLE `ims_vending_machine_order_peerpay` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `orderid` int(11) NOT NULL DEFAULT '0',
  `peerpay_type` tinyint(1) NOT NULL DEFAULT '0',
  `peerpay_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peerpay_maxprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peerpay_realprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peerpay_selfpay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `peerpay_message` varchar(500) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `createtime` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_order_peerpay_payinfo`;
CREATE TABLE `ims_vending_machine_order_peerpay_payinfo` (
`id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  `uname` varchar(255) NOT NULL DEFAULT '',
  `usay` varchar(500) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `headimg` varchar(255) DEFAULT NULL,
  `refundstatus` tinyint(1) NOT NULL DEFAULT '0',
  `refundprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tid` varchar(255) NOT NULL DEFAULT '',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `paytype` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_order_refund`;
CREATE TABLE `ims_vending_machine_order_refund` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `refundno` varchar(255) DEFAULT '',
  `price` varchar(255) DEFAULT '',
  `reason` varchar(255) DEFAULT '',
  `images` text,
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `reply` text,
  `refundtype` tinyint(3) DEFAULT '0',
  `realprice` decimal(10,2) DEFAULT '0.00',
  `refundtime` int(11) DEFAULT '0',
  `orderprice` decimal(10,2) DEFAULT '0.00',
  `applyprice` decimal(10,2) DEFAULT '0.00',
  `imgs` text,
  `rtype` tinyint(3) DEFAULT '0',
  `refundaddress` text,
  `message` text,
  `express` varchar(100) DEFAULT '',
  `expresscom` varchar(100) DEFAULT '',
  `expresssn` varchar(100) DEFAULT '',
  `operatetime` int(11) DEFAULT '0',
  `sendtime` int(11) DEFAULT '0',
  `returntime` int(11) DEFAULT '0',
  `rexpress` varchar(100) DEFAULT '',
  `rexpresscom` varchar(100) DEFAULT '',
  `rexpresssn` varchar(100) DEFAULT '',
  `refundaddressid` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `ordergoodsids` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_order_single_refund`;
CREATE TABLE `ims_vending_machine_order_single_refund` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `ordergoodsid` int(11) DEFAULT '0',
  `refundno` varchar(255) DEFAULT '',
  `price` varchar(255) DEFAULT '',
  `reason` varchar(255) DEFAULT '',
  `images` text,
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `reply` text,
  `refundtype` tinyint(3) DEFAULT '0',
  `realprice` decimal(10,2) DEFAULT '0.00',
  `refundtime` int(11) DEFAULT '0',
  `ordergoodsrealprice` decimal(10,2) DEFAULT '0.00',
  `applyprice` decimal(10,2) DEFAULT '0.00',
  `imgs` text,
  `rtype` tinyint(3) DEFAULT '0',
  `refundaddress` text,
  `message` text,
  `express` varchar(100) DEFAULT '',
  `expresscom` varchar(100) DEFAULT '',
  `expresssn` varchar(100) DEFAULT '',
  `operatetime` int(11) DEFAULT '0',
  `sendtime` int(11) DEFAULT '0',
  `returntime` int(11) DEFAULT '0',
  `rexpress` varchar(100) DEFAULT '',
  `rexpresscom` varchar(100) DEFAULT '',
  `rexpresssn` varchar(100) DEFAULT '',
  `refundaddressid` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `tradetype` tinyint(3) NOT NULL DEFAULT '0',
  `issuporder` tinyint(3) DEFAULT '0',
  `suptype` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_package`;
CREATE TABLE `ims_vending_machine_package` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `freight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `thumb` varchar(255) NOT NULL,
  `starttime` int(11) NOT NULL DEFAULT '0',
  `endtime` int(11) NOT NULL DEFAULT '0',
  `goodsid` varchar(255) NOT NULL,
  `cash` tinyint(3) NOT NULL DEFAULT '0',
  `share_title` varchar(255) NOT NULL,
  `share_icon` varchar(255) NOT NULL,
  `share_desc` varchar(500) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `deleted` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `dispatchtype` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_package_goods`;
CREATE TABLE `ims_vending_machine_package_goods` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `goodsid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `option` varchar(255) NOT NULL,
  `goodssn` varchar(255) NOT NULL,
  `productsn` varchar(255) NOT NULL,
  `hasoption` tinyint(3) NOT NULL DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `packageprice` decimal(10,2) DEFAULT '0.00',
  `commission1` decimal(10,2) DEFAULT '0.00',
  `commission2` decimal(10,2) DEFAULT '0.00',
  `commission3` decimal(10,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_package_goods_option`;
CREATE TABLE `ims_vending_machine_package_goods_option` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `goodsid` int(11) NOT NULL DEFAULT '0',
  `optionid` int(11) NOT NULL DEFAULT '0',
  `pid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `packageprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commission1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commission2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `commission3` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_payment`;
CREATE TABLE `ims_vending_machine_payment` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `appid` varchar(255) DEFAULT '',
  `mch_id` varchar(50) NOT NULL DEFAULT '',
  `apikey` varchar(50) NOT NULL DEFAULT '',
  `sub_appid` varchar(50) DEFAULT '',
  `sub_appsecret` varchar(50) DEFAULT '',
  `sub_mch_id` varchar(50) DEFAULT '',
  `cert_file` text,
  `key_file` text,
  `root_file` text,
  `is_raw` tinyint(1) DEFAULT '0',
  `createtime` int(10) UNSIGNED DEFAULT '0',
  `paytype` tinyint(3) NOT NULL DEFAULT '0',
  `alitype` tinyint(3) NOT NULL DEFAULT '0',
  `alipay_sec` text NOT NULL,
  `qpay_signtype` tinyint(1) NOT NULL DEFAULT '0',
  `app_qpay_public_key` text NOT NULL,
  `app_qpay_private_key` text NOT NULL,
  `service_id` varchar(128) NOT NULL COMMENT '支付分服务ID',
  `serial_no` varchar(128) NOT NULL COMMENT '证书序列号'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_payment` (`id`, `uniacid`, `title`, `type`, `appid`, `mch_id`, `apikey`, `sub_appid`, `sub_appsecret`, `sub_mch_id`, `cert_file`, `key_file`, `root_file`, `is_raw`, `createtime`, `paytype`, `alitype`, `alipay_sec`, `qpay_signtype`, `app_qpay_public_key`, `app_qpay_private_key`, `service_id`, `serial_no`) VALUES
(1, 1, '微信支付分', 5, '', '', '5ae5klnt1ddjdrs3o1weukwrs0etfhdr', 'wxaf24a22f07bcb49f', '', '1555281461', NULL, NULL, NULL, 0, 1601189470, 0, 0, 'a:4:{s:10:\"public_key\";s:0:\"\";s:11:\"private_key\";s:0:\"\";s:5:\"appid\";s:0:\"\";s:16:\"alipay_sign_type\";i:0;}', 0, '', '', '00004000000000740485051164945313', '4D14847ECF54E76D07B6AF4882BCA497DD3EBD7A');

DROP TABLE IF EXISTS `ims_vending_machine_pc_adv`;
CREATE TABLE `ims_vending_machine_pc_adv` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) UNSIGNED NOT NULL,
  `advname` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `src` varchar(255) NOT NULL,
  `alt` varchar(255) DEFAULT NULL,
  `enabled` tinyint(3) UNSIGNED NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `width` int(11) UNSIGNED NOT NULL,
  `height` int(11) UNSIGNED NOT NULL,
  `settings` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_pc_browse_history`;
CREATE TABLE `ims_vending_machine_pc_browse_history` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `history` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_pc_goods`;
CREATE TABLE `ims_vending_machine_pc_goods` (
`id` int(11) UNSIGNED NOT NULL,
  `temp_id` varchar(11) NOT NULL DEFAULT '0',
  `uniacid` varchar(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `import_image` varchar(255) NOT NULL,
  `import_url` varchar(255) NOT NULL,
  `goods_type` tinyint(1) NOT NULL,
  `goods_info` varchar(2000) NOT NULL,
  `top_image` varchar(255) NOT NULL,
  `top_url` varchar(255) NOT NULL,
  `bottom_image` varchar(255) NOT NULL,
  `bottom_url` varchar(255) NOT NULL,
  `sort` int(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `create_time` varchar(11) NOT NULL,
  `goodsid_text` text NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_pc_link`;
CREATE TABLE `ims_vending_machine_pc_link` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) UNSIGNED NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `displayorder` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_pc_menu`;
CREATE TABLE `ims_vending_machine_pc_menu` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) UNSIGNED NOT NULL,
  `type` int(11) UNSIGNED DEFAULT '0',
  `displayorder` int(11) UNSIGNED DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `enabled` tinyint(3) UNSIGNED DEFAULT '1',
  `createtime` int(11) UNSIGNED DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT '1',
  `create_time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_pc_slide`;
CREATE TABLE `ims_vending_machine_pc_slide` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) UNSIGNED DEFAULT '0',
  `type` int(11) UNSIGNED DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `backcolor` varchar(255) DEFAULT NULL,
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  `shopid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_pc_template`;
CREATE TABLE `ims_vending_machine_pc_template` (
`id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) DEFAULT NULL,
  `setting` text NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

DROP TABLE IF EXISTS `ims_vending_machine_perm_log`;
CREATE TABLE `ims_vending_machine_perm_log` (
`id` int(11) NOT NULL,
  `uid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `type` varchar(255) DEFAULT '',
  `op` text,
  `ip` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_perm_log` (`id`, `uid`, `uniacid`, `name`, `type`, `op`, `ip`, `createtime`) VALUES
(1, 1, 1, '商品管理-添加', 'goods.add', '添加商品 ID: 1<br>是否参与分销 -- 是', '127.0.0.1', 1600021792),
(2, 1, 1, '商品管理-添加', 'goods.add', '添加商品 ID: 2<br>是否参与分销 -- 是', '127.0.0.1', 1601052910),
(3, 1, 1, '商品管理-列表修改', 'goods.list', '编辑商品 ID: 2<br>库存量为1000', '127.0.0.1', 1601052922),
(4, 1, 1, '商品管理-修改', 'goods.edit', '编辑商品 ID: 2<br>是否参与分销 -- 是', '127.0.0.1', 1601053000),
(5, 1, 1, '设置-短信提醒-短信模板库-添加', 'sysset.sms.temp.add', '添加短信模板 ID: 1 标题:  ', '127.0.0.1', 1601185714),
(6, 1, 1, '设置-短信提醒-短信模板库-修改', 'sysset.sms.temp.edit', '编辑群发模板 ID: 1 标题:  ', '127.0.0.1', 1601185846),
(7, 1, 1, '设置-全网通设置-修改', 'sysset.wap.edit', '修改WAP设置', '127.0.0.1', 1601185862),
(8, 1, 1, '设置-支付管理-添加', 'sysset.payment.add', '添加支付信息一条 ID: 1 标题: 微信支付分 ', '127.0.0.1', 1601189470),
(9, 1, 1, '设置-支付方式-修改', 'sysset.payset.edit', '修改系统设置-支付设置', '127.0.0.1', 1601189485),
(10, 1, 1, '设置-支付管理-修改', 'sysset.payment.edit', '编辑支付信息 ID: 1 标题: 微信支付分 ', '127.0.0.1', 1601194307),
(11, 1, 1, '商品管理-修改', 'goods.edit', '编辑商品 ID: 2<br>是否参与分销 -- 是', '127.0.0.1', 1601433869),
(12, 1, 1, '商品管理-商品价格-修改', 'goods.price.edit', '更改多规格商品  规格ID: 1 属性: 蓝色 <br>价格为3.00', '127.0.0.1', 1601433869),
(13, 1, 1, '商品管理-商品价格-修改', 'goods.price.edit', '更改多规格商品  规格ID: 2 属性: 绿色 <br>价格为2.00', '127.0.0.1', 1601433869);

DROP TABLE IF EXISTS `ims_vending_machine_perm_plugin`;
CREATE TABLE `ims_vending_machine_perm_plugin` (
`id` int(11) NOT NULL,
  `acid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `plugins` text,
  `coms` text,
  `datas` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_perm_role`;
CREATE TABLE `ims_vending_machine_perm_role` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `rolename` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `perms` text,
  `perms2` text,
  `deleted` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_perm_user`;
CREATE TABLE `ims_vending_machine_perm_user` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `uid` int(11) DEFAULT '0',
  `username` varchar(255) DEFAULT '',
  `password` varchar(255) DEFAULT '',
  `roleid` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `perms` text,
  `perms2` text,
  `deleted` tinyint(3) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `openid` varchar(50) DEFAULT NULL,
  `openid_wa` varchar(50) DEFAULT NULL,
  `member_nick` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_plugin`;
CREATE TABLE `ims_vending_machine_plugin` (
`id` int(11) NOT NULL,
  `displayorder` int(11) DEFAULT '0',
  `identity` varchar(50) DEFAULT '',
  `category` varchar(255) DEFAULT '',
  `name` varchar(50) DEFAULT '',
  `version` varchar(10) DEFAULT '',
  `author` varchar(20) DEFAULT '',
  `status` int(11) DEFAULT '0',
  `thumb` varchar(255) DEFAULT '',
  `desc` text,
  `iscom` tinyint(3) DEFAULT '0',
  `deprecated` tinyint(3) DEFAULT '0',
  `isv2` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_plugin` (`id`, `displayorder`, `identity`, `category`, `name`, `version`, `author`, `status`, `thumb`, `desc`, `iscom`, `deprecated`, `isv2`) VALUES
(1, 1, 'qiniu', 'tool', '七牛存储', '1.0', '官方', 0, '../addons/ewei_shopv2/static/images/qiniu.jpg', '', 0, 1, 0),
(2, 2, 'taobao', 'tool', '淘宝助手', '1.0', '官方', 0, '../addons/ewei_shopv2/static/images/taobao.jpg', '', 0, 0, 0),
(3, 3, 'commission', 'biz', '人人分销', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/commission.jpg', '', 0, 0, 0),
(4, 4, 'poster', 'sale', '超级海报', '1.2', '官方', 1, '../addons/ewei_shopv2/static/images/poster.jpg', '', 0, 0, 0),
(5, 5, 'verify', 'biz', 'O2O核销', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/verify.jpg', '', 1, 0, 0),
(6, 6, 'perm', 'help', '分权系统', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/perm.jpg', '', 1, 0, 0),
(7, 7, 'tmessage', 'tool', '会员群发', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/tmessage.jpg', '', 1, 0, 0),
(8, 8, 'sale', 'sale', '营销宝', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/sale.jpg', '', 1, 0, 0),
(9, 9, 'creditshop', 'biz', '积分商城', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/creditshop.jpg', '', 0, 0, 0),
(10, 10, 'exhelper', 'tool', '快递助手', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/exhelper.jpg', '', 0, 0, 0),
(11, 11, 'virtual', 'biz', '虚拟物品', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/virtual.jpg', '', 1, 0, 0),
(12, 15, 'coupon', 'sale', '优惠券', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/coupon.jpg', '', 1, 0, 0),
(13, 17, 'postera', 'sale', '活动海报', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/postera.jpg', '', 0, 0, 0),
(14, 18, 'system', 'tool', '系统工具', '1.0', ' 官方', 0, '../addons/ewei_shopv2/static/images/system.jpg', '', 0, 1, 0),
(15, 16, 'diyform', 'tool', '自定义表单', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/diyform.jpg', '', 0, 0, 0),
(16, 20, 'diypage', 'help', '店铺装修', '2.0', '官方', 1, '../addons/ewei_shopv2/static/images/designer.jpg', '', 0, 0, 0),
(17, 23, 'merch', 'biz', '多商户', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/merch.jpg', '', 0, 0, 1),
(18, 26, 'qa', 'help', '帮助中心', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/qa.jpg', '', 0, 0, 1),
(19, 29, 'sign', 'sale', '积分签到', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/sign.jpg', '', 0, 0, 1),
(20, 27, 'sms', 'tool', '短信提醒', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/sms.jpg', '', 1, 0, 1),
(21, 33, 'wap', 'tool', '全网通', '1.0', '官方', 1, '', '', 1, 0, 1),
(22, 34, 'h5app', 'tool', 'H5APP', '1.0', '官方', 1, '', '', 1, 0, 1),
(23, 65, 'wxcard', 'sale', '微信卡券', '1.0', '官方', 1, '', '', 1, 0, 1),
(24, 33, 'printer', 'tool', '小票打印机', '1.0', '官方', 1, '', '', 1, 0, 1),
(26, 41, 'app', 'help', '小程序', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/app.jpg', '', 0, 0, 1),
(27, 51, 'friendcoupon', 'sale', '好友瓜分券', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/friendcoupon.png', '', 0, 0, 1),
(29, 57, 'wxlive', 'sale', '小程序直播', '1.0', '官方', 0, '../addons/ewei_shopv2/static/images/wxlive.png', '', 0, 0, 1),
(30, 40, 'lottery', 'biz', '游戏营销', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/lottery.jpg', '', 0, 0, 1),
(31, 38, 'seckill', 'sale', '整点秒杀', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/seckill.jpg', '', 0, 0, 1),
(32, 26, 'abonus', 'biz', '区域代理', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/abonus.jpg', '', 0, 0, 1),
(34, 35, 'task', 'sale', '任务中心', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/task.jpg', '', 0, 0, 1),
(35, 39, 'exchange', 'biz', '兑换中心', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/exchange.jpg', '', 0, 0, 1),
(36, 42, 'quick', 'biz', '快速购买', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/quick.jpg', '', 0, 0, 1),
(37, 43, 'mmanage', 'tool', '手机端商家管理中心', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/mmanage.jpg', '', 0, 0, 1),
(39, 11, 'article', 'help', '文章营销', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/article.jpg', '', 0, 0, 0),
(40, 19, 'groups', 'biz', '人人拼团', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/groups.jpg', '', 0, 0, 0),
(41, 22, 'globonus', 'biz', '全民股东', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/globonus.jpg', '', 0, 0, 0),
(42, 34, 'bargain', 'tool', '砍价活动', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/bargain.jpg', '', 0, 0, 1),
(44, 37, 'messages', 'tool', '消息群发', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/messages.jpg', '', 0, 0, 1),
(46, 48, 'invitation', 'sale', '邀请卡', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/invitation.png', '', 0, 0, 1),
(48, 49, 'dividend', 'biz', '团队分红', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/dividend.jpg', '', 0, 0, 1),
(49, 50, 'merchmanage', 'tool', '多商户手机端管理', '1.0', '二开', 1, '../addons/ewei_shopv2/static/images/merchmanage.jpg', '', 0, 0, 1),
(50, 51, 'membercard', 'sale', '付费会员卡', '1.0', '官方', 1, '../addons/ewei_shopv2/static/images/membercard.png', '', 0, 0, 1);

DROP TABLE IF EXISTS `ims_vending_machine_poster`;
CREATE TABLE `ims_vending_machine_poster` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `bg` varchar(255) DEFAULT '',
  `data` text,
  `keyword` varchar(255) DEFAULT '',
  `keyword2` varchar(255) DEFAULT '',
  `times` int(11) DEFAULT '0',
  `follows` int(11) DEFAULT '0',
  `isdefault` tinyint(3) DEFAULT '0',
  `resptype` tinyint(3) DEFAULT '0',
  `resptext` text,
  `resptitle` varchar(255) DEFAULT '',
  `respthumb` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `respdesc` varchar(255) DEFAULT '',
  `respurl` varchar(255) DEFAULT '',
  `waittext` varchar(255) DEFAULT '',
  `oktext` varchar(255) DEFAULT '',
  `subcredit` int(11) DEFAULT '0',
  `submoney` decimal(10,2) DEFAULT '0.00',
  `reccredit` int(11) DEFAULT '0',
  `recmoney` decimal(10,2) DEFAULT '0.00',
  `scantext` varchar(255) DEFAULT '',
  `subtext` varchar(255) DEFAULT '',
  `beagent` tinyint(3) DEFAULT '0',
  `bedown` tinyint(3) DEFAULT '0',
  `isopen` tinyint(3) DEFAULT '0',
  `opentext` varchar(255) DEFAULT '',
  `openurl` varchar(255) DEFAULT '',
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `subpaycontent` text,
  `recpaycontent` varchar(255) DEFAULT '',
  `templateid` varchar(255) DEFAULT '',
  `entrytext` varchar(255) DEFAULT '',
  `reccouponid` int(11) DEFAULT '0',
  `reccouponnum` int(11) DEFAULT '0',
  `subcouponid` int(11) DEFAULT '0',
  `subcouponnum` int(11) DEFAULT '0',
  `resptext11` text,
  `reward_totle` varchar(500) DEFAULT '',
  `ismembergroup` tinyint(3) DEFAULT '0',
  `membergroupid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_postera`;
CREATE TABLE `ims_vending_machine_postera` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `days` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `bg` varchar(255) DEFAULT '',
  `data` text,
  `keyword` varchar(255) DEFAULT '',
  `keyword2` varchar(255) DEFAULT '',
  `isdefault` tinyint(3) DEFAULT '0',
  `resptype` tinyint(3) DEFAULT '0',
  `resptext` text,
  `resptitle` varchar(255) DEFAULT '',
  `respthumb` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `respdesc` varchar(255) DEFAULT '',
  `respurl` varchar(255) DEFAULT '',
  `waittext` varchar(255) DEFAULT '',
  `oktext` varchar(255) DEFAULT '',
  `subcredit` int(11) DEFAULT '0',
  `submoney` decimal(10,2) DEFAULT '0.00',
  `reccredit` int(11) DEFAULT '0',
  `recmoney` decimal(10,2) DEFAULT '0.00',
  `scantext` varchar(255) DEFAULT '',
  `subtext` varchar(255) DEFAULT '',
  `beagent` tinyint(3) DEFAULT '0',
  `bedown` tinyint(3) DEFAULT '0',
  `isopen` tinyint(3) DEFAULT '0',
  `opentext` varchar(255) DEFAULT '',
  `openurl` varchar(255) DEFAULT '',
  `paytype` tinyint(1) NOT NULL DEFAULT '0',
  `subpaycontent` text,
  `recpaycontent` varchar(255) DEFAULT '',
  `templateid` varchar(255) DEFAULT '',
  `entrytext` varchar(255) DEFAULT '',
  `reccouponid` int(11) DEFAULT '0',
  `reccouponnum` int(11) DEFAULT '0',
  `subcouponid` int(11) DEFAULT '0',
  `subcouponnum` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `starttext` varchar(255) DEFAULT '',
  `endtext` varchar(255) DEFAULT NULL,
  `testflag` tinyint(1) DEFAULT '0',
  `reward_totle` varchar(500) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_postera_log`;
CREATE TABLE `ims_vending_machine_postera_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `posterid` int(11) DEFAULT '0',
  `from_openid` varchar(255) DEFAULT '',
  `subcredit` int(11) DEFAULT '0',
  `submoney` decimal(10,2) DEFAULT '0.00',
  `reccredit` int(11) DEFAULT '0',
  `recmoney` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `reccouponid` int(11) DEFAULT '0',
  `reccouponnum` int(11) DEFAULT '0',
  `subcouponid` int(11) DEFAULT '0',
  `subcouponnum` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_postera_qr`;
CREATE TABLE `ims_vending_machine_postera_qr` (
`id` int(11) NOT NULL,
  `acid` int(10) UNSIGNED NOT NULL,
  `openid` varchar(100) NOT NULL DEFAULT '',
  `posterid` int(11) DEFAULT '0',
  `type` tinyint(3) DEFAULT '0',
  `sceneid` int(11) DEFAULT '0',
  `mediaid` varchar(255) DEFAULT '',
  `ticket` varchar(250) NOT NULL,
  `url` varchar(80) NOT NULL,
  `createtime` int(10) UNSIGNED NOT NULL,
  `goodsid` int(11) DEFAULT '0',
  `qrimg` varchar(1000) DEFAULT '',
  `expire` int(11) DEFAULT '0',
  `endtime` int(11) DEFAULT '0',
  `qrtime` varchar(32) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_poster_log`;
CREATE TABLE `ims_vending_machine_poster_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `posterid` int(11) DEFAULT '0',
  `from_openid` varchar(255) DEFAULT '',
  `subcredit` int(11) DEFAULT '0',
  `submoney` decimal(10,2) DEFAULT '0.00',
  `reccredit` int(11) DEFAULT '0',
  `recmoney` decimal(10,2) DEFAULT '0.00',
  `createtime` int(11) DEFAULT '0',
  `reccouponid` int(11) DEFAULT '0',
  `reccouponnum` int(11) DEFAULT '0',
  `subcouponid` int(11) DEFAULT '0',
  `subcouponnum` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_poster_qr`;
CREATE TABLE `ims_vending_machine_poster_qr` (
`id` int(11) NOT NULL,
  `acid` int(10) UNSIGNED NOT NULL,
  `openid` varchar(100) NOT NULL DEFAULT '',
  `type` tinyint(3) DEFAULT '0',
  `sceneid` int(11) DEFAULT '0',
  `mediaid` varchar(255) DEFAULT '',
  `ticket` varchar(250) NOT NULL,
  `url` varchar(80) NOT NULL,
  `createtime` int(10) UNSIGNED NOT NULL,
  `goodsid` int(11) DEFAULT '0',
  `qrimg` varchar(1000) DEFAULT '',
  `posterid` int(11) DEFAULT '0',
  `scenestr` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_poster_scan`;
CREATE TABLE `ims_vending_machine_poster_scan` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `posterid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `from_openid` varchar(255) DEFAULT '',
  `scantime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_qa_adv`;
CREATE TABLE `ims_vending_machine_qa_adv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_qa_category`;
CREATE TABLE `ims_vending_machine_qa_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `displayorder` tinyint(3) UNSIGNED DEFAULT '0',
  `enabled` tinyint(1) DEFAULT '1',
  `isrecommand` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_qa_question`;
CREATE TABLE `ims_vending_machine_qa_question` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `cate` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `content` mediumtext NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `isrecommand` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_qa_set`;
CREATE TABLE `ims_vending_machine_qa_set` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `showmember` tinyint(3) NOT NULL DEFAULT '0',
  `showtype` tinyint(3) NOT NULL DEFAULT '0',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `enter_title` varchar(255) NOT NULL DEFAULT '',
  `enter_img` varchar(255) NOT NULL DEFAULT '',
  `enter_desc` varchar(255) NOT NULL DEFAULT '',
  `share` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_queue`;
CREATE TABLE `ims_vending_machine_queue` (
`id` int(11) NOT NULL,
  `channel` varchar(255) NOT NULL,
  `job` blob NOT NULL,
  `pushed_at` int(11) NOT NULL,
  `ttr` int(11) NOT NULL,
  `delay` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) UNSIGNED NOT NULL DEFAULT '1024',
  `reserved_at` int(11) DEFAULT NULL,
  `attempt` int(11) DEFAULT NULL,
  `done_at` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_quick`;
CREATE TABLE `ims_vending_machine_quick` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `merchid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `datas` mediumtext,
  `cart` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` int(11) DEFAULT NULL,
  `lasttime` int(11) DEFAULT NULL,
  `share_title` varchar(255) DEFAULT NULL,
  `share_desc` varchar(255) DEFAULT NULL,
  `share_icon` varchar(255) DEFAULT NULL,
  `enter_title` varchar(255) DEFAULT NULL,
  `enter_desc` varchar(255) DEFAULT NULL,
  `enter_icon` varchar(255) DEFAULT NULL,
  `type` tinyint(3) DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_quick_adv`;
CREATE TABLE `ims_vending_machine_quick_adv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `merchid` int(11) NOT NULL DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_quick_cart`;
CREATE TABLE `ims_vending_machine_quick_cart` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `quickid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(100) DEFAULT '',
  `goodsid` int(11) DEFAULT '0',
  `total` int(11) DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `deleted` tinyint(1) DEFAULT '0',
  `optionid` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0',
  `diyformdataid` int(11) DEFAULT NULL,
  `diyformdata` text,
  `diyformfields` text,
  `diyformid` int(11) DEFAULT '0',
  `selected` tinyint(1) DEFAULT '1',
  `merchid` int(11) DEFAULT '0',
  `selectedadd` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_refund_address`;
CREATE TABLE `ims_vending_machine_refund_address` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT '0',
  `title` varchar(20) DEFAULT '',
  `name` varchar(20) DEFAULT '',
  `tel` varchar(20) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `province` varchar(30) DEFAULT '',
  `city` varchar(30) DEFAULT '',
  `area` varchar(30) DEFAULT '',
  `address` varchar(300) DEFAULT '',
  `isdefault` tinyint(1) DEFAULT '0',
  `zipcode` varchar(255) DEFAULT '',
  `content` text,
  `deleted` tinyint(1) DEFAULT '0',
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_saler`;
CREATE TABLE `ims_vending_machine_saler` (
`id` int(11) NOT NULL,
  `storeid` int(11) DEFAULT '0',
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `salername` varchar(255) DEFAULT '',
  `username` varchar(50) DEFAULT '',
  `pwd` varchar(255) DEFAULT '',
  `salt` varchar(255) DEFAULT '',
  `lastvisit` varchar(255) DEFAULT '',
  `lastip` varchar(255) DEFAULT '',
  `isfounder` tinyint(3) DEFAULT '0',
  `mobile` varchar(255) DEFAULT '',
  `getmessage` tinyint(1) DEFAULT '0',
  `getnotice` tinyint(1) DEFAULT '0',
  `roleid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sale_coupon`;
CREATE TABLE `ims_vending_machine_sale_coupon` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `type` tinyint(3) DEFAULT '0',
  `ckey` decimal(10,2) DEFAULT '0.00',
  `cvalue` decimal(10,2) DEFAULT '0.00',
  `nums` int(11) DEFAULT '0',
  `createtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sale_coupon_data`;
CREATE TABLE `ims_vending_machine_sale_coupon_data` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(255) DEFAULT '',
  `couponid` int(11) DEFAULT '0',
  `gettime` int(11) DEFAULT '0',
  `gettype` tinyint(3) DEFAULT '0',
  `usedtime` int(11) DEFAULT '0',
  `orderid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_seckill_adv`;
CREATE TABLE `ims_vending_machine_seckill_adv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_seckill_category`;
CREATE TABLE `ims_vending_machine_seckill_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_seckill_task`;
CREATE TABLE `ims_vending_machine_seckill_task` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `cateid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `enabled` tinyint(3) DEFAULT '0',
  `page_title` varchar(255) DEFAULT '',
  `share_title` varchar(255) DEFAULT '',
  `share_desc` varchar(255) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `tag` varchar(10) DEFAULT '',
  `closesec` int(11) DEFAULT '0',
  `oldshow` tinyint(3) DEFAULT '0',
  `times` text,
  `createtime` int(11) DEFAULT '0',
  `overtimes` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_seckill_task_goods`;
CREATE TABLE `ims_vending_machine_seckill_task_goods` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `taskid` int(11) DEFAULT '0',
  `roomid` int(11) DEFAULT '0',
  `timeid` int(11) DEFAULT '0',
  `goodsid` int(11) DEFAULT '0',
  `optionid` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(11) DEFAULT '0',
  `maxbuy` int(11) DEFAULT '0',
  `totalmaxbuy` int(11) DEFAULT '0',
  `commission1` decimal(10,2) DEFAULT '0.00',
  `commission2` decimal(10,2) DEFAULT '0.00',
  `commission3` decimal(10,2) DEFAULT '0.00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_seckill_task_room`;
CREATE TABLE `ims_vending_machine_seckill_task_room` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `taskid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `enabled` tinyint(3) DEFAULT '0',
  `page_title` varchar(255) DEFAULT '',
  `share_title` varchar(255) DEFAULT '',
  `share_desc` varchar(255) DEFAULT '',
  `share_icon` varchar(255) DEFAULT '',
  `oldshow` tinyint(3) DEFAULT '0',
  `tag` varchar(10) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `diypage` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_seckill_task_time`;
CREATE TABLE `ims_vending_machine_seckill_task_time` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `taskid` int(11) DEFAULT '0',
  `time` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sendticket`;
CREATE TABLE `ims_vending_machine_sendticket` (
`id` int(10) UNSIGNED NOT NULL,
  `uniacid` int(11) NOT NULL,
  `cpid` varchar(200) NOT NULL,
  `expiration` int(11) NOT NULL DEFAULT '0',
  `starttime` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '新人礼包'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sendticket_draw`;
CREATE TABLE `ims_vending_machine_sendticket_draw` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) NOT NULL,
  `cpid` varchar(50) NOT NULL,
  `openid` varchar(200) NOT NULL,
  `createtime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sendticket_share`;
CREATE TABLE `ims_vending_machine_sendticket_share` (
`id` int(10) UNSIGNED NOT NULL,
  `uniacid` int(11) NOT NULL,
  `sharetitle` varchar(255) NOT NULL,
  `shareicon` varchar(255) DEFAULT NULL,
  `sharedesc` varchar(255) DEFAULT NULL,
  `expiration` int(11) NOT NULL DEFAULT '0',
  `starttime` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  `paycpid1` int(11) DEFAULT NULL,
  `paycpid2` int(11) DEFAULT NULL,
  `paycpid3` int(11) DEFAULT NULL,
  `paycpnum1` int(11) DEFAULT NULL,
  `paycpnum2` int(11) DEFAULT NULL,
  `paycpnum3` int(11) DEFAULT NULL,
  `sharecpid1` int(11) DEFAULT NULL,
  `sharecpid2` int(11) DEFAULT NULL,
  `sharecpid3` int(11) DEFAULT NULL,
  `sharecpnum1` int(11) DEFAULT NULL,
  `sharecpnum2` int(11) DEFAULT NULL,
  `sharecpnum3` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `enough` decimal(10,2) DEFAULT NULL,
  `issync` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sign_records`;
CREATE TABLE `ims_vending_machine_sign_records` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(50) NOT NULL DEFAULT '',
  `credit` int(11) NOT NULL DEFAULT '0',
  `log` varchar(255) DEFAULT '',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `day` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sign_set`;
CREATE TABLE `ims_vending_machine_sign_set` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `iscenter` tinyint(3) NOT NULL DEFAULT '0',
  `iscreditshop` tinyint(3) NOT NULL DEFAULT '0',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) NOT NULL DEFAULT '',
  `isopen` tinyint(3) NOT NULL DEFAULT '0',
  `signold` tinyint(3) NOT NULL DEFAULT '0',
  `signold_price` int(11) NOT NULL DEFAULT '0',
  `signold_type` tinyint(3) NOT NULL DEFAULT '0',
  `textsign` varchar(255) NOT NULL DEFAULT '',
  `textsignold` varchar(255) NOT NULL DEFAULT '',
  `textsigned` varchar(255) NOT NULL DEFAULT '',
  `textsignforget` varchar(255) NOT NULL DEFAULT '',
  `maincolor` varchar(20) NOT NULL DEFAULT '',
  `cycle` tinyint(3) NOT NULL DEFAULT '0',
  `reward_default_first` int(11) NOT NULL DEFAULT '0',
  `reward_default_day` int(11) NOT NULL DEFAULT '0',
  `reword_order` text NOT NULL,
  `reword_sum` text NOT NULL,
  `reword_special` text NOT NULL,
  `sign_rule` text NOT NULL,
  `share` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sign_user`;
CREATE TABLE `ims_vending_machine_sign_user` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `order` int(11) NOT NULL DEFAULT '0',
  `orderday` int(11) NOT NULL DEFAULT '0',
  `sum` int(11) NOT NULL DEFAULT '0',
  `signdate` varchar(10) DEFAULT '',
  `isminiprogram` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sms`;
CREATE TABLE `ims_vending_machine_sms` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(10) NOT NULL DEFAULT '',
  `template` tinyint(3) NOT NULL DEFAULT '0',
  `smstplid` varchar(255) NOT NULL DEFAULT '',
  `smssign` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(100) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_sms` (`id`, `uniacid`, `name`, `type`, `template`, `smstplid`, `smssign`, `content`, `data`, `status`) VALUES
(1, 1, 'asdfasd', 'aliyun_new', 1, '123123', '123123', '', 'a:1:{i:0;a:2:{s:9:\"data_temp\";s:5:\"12312\";s:9:\"data_shop\";s:4:\"1231\";}}', 1);

DROP TABLE IF EXISTS `ims_vending_machine_sms_set`;
CREATE TABLE `ims_vending_machine_sms_set` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `juhe` tinyint(3) NOT NULL DEFAULT '0',
  `juhe_key` varchar(255) NOT NULL DEFAULT '',
  `dayu` tinyint(3) NOT NULL DEFAULT '0',
  `dayu_key` varchar(255) NOT NULL DEFAULT '',
  `dayu_secret` varchar(255) NOT NULL DEFAULT '',
  `aliyun` tinyint(3) NOT NULL DEFAULT '0',
  `aliyun_appcode` varchar(255) NOT NULL,
  `emay` tinyint(3) NOT NULL DEFAULT '0',
  `emay_url` varchar(255) NOT NULL DEFAULT '',
  `emay_sn` varchar(255) NOT NULL DEFAULT '',
  `emay_pw` varchar(255) NOT NULL DEFAULT '',
  `emay_sk` varchar(255) NOT NULL DEFAULT '',
  `emay_phost` varchar(255) NOT NULL DEFAULT '',
  `emay_pport` int(11) NOT NULL DEFAULT '0',
  `emay_puser` varchar(255) NOT NULL DEFAULT '',
  `emay_ppw` varchar(255) NOT NULL DEFAULT '',
  `emay_out` int(11) NOT NULL DEFAULT '0',
  `emay_outresp` int(11) NOT NULL DEFAULT '30',
  `emay_warn` decimal(10,2) NOT NULL DEFAULT '0.00',
  `emay_mobile` varchar(11) NOT NULL DEFAULT '',
  `emay_warn_time` int(11) NOT NULL DEFAULT '0',
  `aliyun_new` tinyint(3) NOT NULL DEFAULT '0',
  `aliyun_new_keyid` varchar(255) NOT NULL DEFAULT '',
  `aliyun_new_keysecret` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_sms_set` (`id`, `uniacid`, `juhe`, `juhe_key`, `dayu`, `dayu_key`, `dayu_secret`, `aliyun`, `aliyun_appcode`, `emay`, `emay_url`, `emay_sn`, `emay_pw`, `emay_sk`, `emay_phost`, `emay_pport`, `emay_puser`, `emay_ppw`, `emay_out`, `emay_outresp`, `emay_warn`, `emay_mobile`, `emay_warn_time`, `aliyun_new`, `aliyun_new_keyid`, `aliyun_new_keysecret`) VALUES
(1, 1, 0, '', 0, '', '', 0, '', 0, '', '', '', '', '', 0, '', '', 0, 30, '0.00', '0', 0, 1, '123123', '123123');

DROP TABLE IF EXISTS `ims_vending_machine_store`;
CREATE TABLE `ims_vending_machine_store` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `storename` varchar(255) DEFAULT '',
  `address` varchar(255) DEFAULT '',
  `tel` varchar(255) DEFAULT '',
  `lat` varchar(255) DEFAULT '',
  `lng` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0',
  `type` tinyint(1) DEFAULT '0',
  `realname` varchar(255) DEFAULT '',
  `mobile` varchar(255) DEFAULT '',
  `fetchtime` varchar(255) DEFAULT '',
  `logo` varchar(255) DEFAULT '',
  `saletime` varchar(255) DEFAULT '',
  `desc` text,
  `displayorder` int(11) DEFAULT '0',
  `order_printer` varchar(500) DEFAULT '',
  `order_template` int(11) DEFAULT '0',
  `ordertype` varchar(500) DEFAULT '',
  `banner` text,
  `label` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `classify` tinyint(1) DEFAULT NULL,
  `perms` text,
  `citycode` varchar(20) DEFAULT '',
  `opensend` tinyint(3) NOT NULL DEFAULT '0',
  `province` varchar(30) NOT NULL DEFAULT '',
  `city` varchar(30) NOT NULL DEFAULT '',
  `area` varchar(30) NOT NULL DEFAULT '',
  `provincecode` varchar(30) NOT NULL DEFAULT '',
  `areacode` varchar(30) NOT NULL DEFAULT '',
  `diypage` int(11) NOT NULL DEFAULT '0',
  `diypage_ispage` tinyint(3) NOT NULL DEFAULT '0',
  `diypage_list` text,
  `storegroupid` int(11) DEFAULT NULL,
  `cates` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_sysset`;
CREATE TABLE `ims_vending_machine_sysset` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `sets` longtext,
  `plugins` longtext,
  `sec` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_sysset` (`id`, `uniacid`, `sets`, `plugins`, `sec`) VALUES
(1, 1, 'a:4:{s:14:\"wxpaycert_view\";a:1:{s:20:\"wxpaycert_view_click\";i:1;}s:12:\"notice_redis\";a:1:{s:18:\"notice_redis_click\";i:1;}s:3:\"wap\";a:24:{s:4:\"open\";i:0;s:7:\"inh5app\";s:1:\"0\";s:8:\"mustbind\";s:1:\"0\";s:12:\"bindrealname\";s:1:\"0\";s:12:\"bindbirthday\";s:1:\"0\";s:12:\"bindidnumber\";s:1:\"0\";s:10:\"bindwechat\";s:1:\"0\";s:5:\"style\";s:7:\"default\";s:5:\"color\";s:0:\"\";s:2:\"bg\";s:57:\"../addons/vending_machine/template/account/default/bg.jpg\";s:10:\"smsimgcode\";s:1:\"0\";s:7:\"sms_reg\";s:1:\"1\";s:10:\"sms_forget\";s:1:\"1\";s:13:\"sms_changepwd\";s:1:\"1\";s:8:\"sms_bind\";s:1:\"1\";s:3:\"agr\";s:1:\"0\";s:13:\"headerbgcolor\";s:0:\"\";s:11:\"headercolor\";s:0:\"\";s:15:\"headericoncolor\";s:0:\"\";s:9:\"statusbar\";s:1:\"0\";s:7:\"loginbg\";N;s:5:\"regbg\";N;s:3:\"sns\";a:2:{s:2:\"wx\";i:0;s:2:\"qq\";i:0;}s:7:\"content\";s:0:\"\";}s:3:\"pay\";a:12:{s:9:\"weixin_id\";i:1;s:6:\"weixin\";i:1;s:10:\"weixin_sub\";i:0;s:10:\"weixin_jie\";i:0;s:14:\"weixin_jie_sub\";i:0;s:6:\"alipay\";i:0;s:9:\"alipay_id\";i:0;s:6:\"credit\";i:0;s:4:\"cash\";i:0;s:10:\"app_wechat\";i:0;s:10:\"app_alipay\";i:0;s:7:\"paytype\";a:3:{s:10:\"commission\";s:1:\"0\";s:8:\"withdraw\";s:1:\"0\";s:7:\"redpack\";s:1:\"0\";}}}', NULL, 'a:4:{s:9:\"alipay_id\";i:0;s:10:\"app_wechat\";a:5:{s:5:\"appid\";s:0:\"\";s:9:\"appsecret\";s:0:\"\";s:9:\"merchname\";s:0:\"\";s:7:\"merchid\";s:0:\"\";s:6:\"apikey\";s:0:\"\";}s:10:\"alipay_pay\";a:9:{s:9:\"sign_type\";s:1:\"0\";s:7:\"partner\";s:0:\"\";s:12:\"account_name\";s:0:\"\";s:5:\"email\";s:0:\"\";s:3:\"key\";s:0:\"\";s:6:\"app_id\";s:0:\"\";s:23:\"single_alipay_sign_type\";s:1:\"0\";s:17:\"single_public_key\";s:0:\"\";s:18:\"single_private_key\";s:0:\"\";}s:10:\"app_alipay\";a:5:{s:10:\"public_key\";s:0:\"\";s:11:\"private_key\";s:0:\"\";s:15:\"public_key_rsa2\";s:0:\"\";s:16:\"private_key_rsa2\";s:0:\"\";s:5:\"appid\";s:0:\"\";}}');

DROP TABLE IF EXISTS `ims_vending_machine_system_adv`;
CREATE TABLE `ims_vending_machine_system_adv` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `module` varchar(255) DEFAULT '',
  `status` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_article`;
CREATE TABLE `ims_vending_machine_system_article` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT '',
  `author` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_banner`;
CREATE TABLE `ims_vending_machine_system_banner` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `url` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `background` varchar(10) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_case`;
CREATE TABLE `ims_vending_machine_system_case` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `qr` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `description` varchar(255) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_casecategory`;
CREATE TABLE `ims_vending_machine_system_casecategory` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_category`;
CREATE TABLE `ims_vending_machine_system_category` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_company_article`;
CREATE TABLE `ims_vending_machine_system_company_article` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT '',
  `author` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_company_category`;
CREATE TABLE `ims_vending_machine_system_company_category` (
`id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_copyright`;
CREATE TABLE `ims_vending_machine_system_copyright` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `copyright` text,
  `bgcolor` varchar(255) DEFAULT '',
  `ismanage` tinyint(3) DEFAULT '0',
  `logo` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_copyright_notice`;
CREATE TABLE `ims_vending_machine_system_copyright_notice` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT '',
  `author` varchar(255) DEFAULT '',
  `content` text,
  `createtime` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `status` tinyint(3) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_guestbook`;
CREATE TABLE `ims_vending_machine_system_guestbook` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `createtime` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `clientip` varchar(64) NOT NULL DEFAULT '',
  `mobile` varchar(11) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_link`;
CREATE TABLE `ims_vending_machine_system_link` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `displayorder` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_plugingrant_adv`;
CREATE TABLE `ims_vending_machine_system_plugingrant_adv` (
`id` int(11) NOT NULL,
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_plugingrant_log`;
CREATE TABLE `ims_vending_machine_system_plugingrant_log` (
`id` int(11) NOT NULL,
  `logno` varchar(50) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `pluginid` int(11) NOT NULL DEFAULT '0',
  `identity` varchar(50) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `month` int(10) NOT NULL DEFAULT '0',
  `permendtime` int(10) NOT NULL DEFAULT '0',
  `permlasttime` int(10) NOT NULL DEFAULT '0',
  `isperm` tinyint(3) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `deleted` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_plugingrant_order`;
CREATE TABLE `ims_vending_machine_system_plugingrant_order` (
`id` int(11) NOT NULL,
  `logno` varchar(50) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(255) DEFAULT NULL,
  `pluginid` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `month` int(11) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `paystatus` tinyint(3) NOT NULL DEFAULT '0',
  `paytime` int(10) NOT NULL DEFAULT '0',
  `paytype` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_plugingrant_package`;
CREATE TABLE `ims_vending_machine_system_plugingrant_package` (
`id` int(11) NOT NULL,
  `pluginid` varchar(255) NOT NULL DEFAULT '',
  `text` varchar(255) DEFAULT NULL,
  `thumb` varchar(1000) DEFAULT NULL,
  `data` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `rec` tinyint(3) NOT NULL DEFAULT '0',
  `desc` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `displayorder` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_plugingrant_plugin`;
CREATE TABLE `ims_vending_machine_system_plugingrant_plugin` (
`id` int(11) NOT NULL,
  `pluginid` int(11) NOT NULL DEFAULT '0',
  `thumb` varchar(1000) NOT NULL,
  `data` text,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `sales` int(11) NOT NULL DEFAULT '0',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `plugintype` tinyint(3) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_plugingrant_setting`;
CREATE TABLE `ims_vending_machine_system_plugingrant_setting` (
`id` int(11) NOT NULL,
  `com` varchar(1000) NOT NULL DEFAULT '',
  `adv` varchar(1000) NOT NULL,
  `plugin` varchar(1000) NOT NULL,
  `customer` varchar(50) NOT NULL DEFAULT '0',
  `contact` text NOT NULL,
  `servertime` varchar(255) DEFAULT NULL,
  `weixin` tinyint(3) NOT NULL DEFAULT '0',
  `appid` varchar(255) DEFAULT NULL,
  `mchid` varchar(255) DEFAULT NULL,
  `apikey` varchar(255) DEFAULT NULL,
  `alipay` tinyint(3) NOT NULL,
  `account` varchar(255) DEFAULT NULL,
  `partner` varchar(255) DEFAULT NULL,
  `secret` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_setting`;
CREATE TABLE `ims_vending_machine_system_setting` (
`id` int(11) NOT NULL,
  `uniacid` int(10) DEFAULT NULL,
  `background` varchar(10) DEFAULT '',
  `casebanner` varchar(255) DEFAULT '',
  `contact` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_system_site`;
CREATE TABLE `ims_vending_machine_system_site` (
`id` int(11) UNSIGNED NOT NULL,
  `type` varchar(32) NOT NULL DEFAULT '',
  `content` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task`;
CREATE TABLE `ims_vending_machine_task` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `dotime` int(11) NOT NULL DEFAULT '0',
  `donetime` int(11) NOT NULL DEFAULT '0',
  `timelimit` float(11,1) NOT NULL,
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `explain` text,
  `require_data` text NOT NULL,
  `reward_data` text NOT NULL,
  `period` int(11) NOT NULL DEFAULT '0',
  `repeat` int(11) NOT NULL DEFAULT '0',
  `maxtimes` int(11) NOT NULL DEFAULT '0',
  `everyhours` float(11,1) NOT NULL DEFAULT '0.0',
  `logo` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_adv`;
CREATE TABLE `ims_vending_machine_task_adv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_default`;
CREATE TABLE `ims_vending_machine_task_default` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `data` text,
  `addtime` int(11) NOT NULL DEFAULT '0',
  `bgimg` varchar(255) NOT NULL DEFAULT '',
  `open` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_extension`;
CREATE TABLE `ims_vending_machine_task_extension` (
`id` int(11) NOT NULL,
  `taskname` varchar(255) NOT NULL DEFAULT '',
  `taskclass` varchar(25) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `classify` varchar(255) NOT NULL DEFAULT '',
  `classify_name` varchar(255) NOT NULL DEFAULT '',
  `verb` varchar(255) NOT NULL DEFAULT '',
  `unit` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_task_extension` (`id`, `taskname`, `taskclass`, `status`, `classify`, `classify_name`, `verb`, `unit`) VALUES
(1, '推荐人数', 'commission_member', 1, 'number', 'commission', '推荐', '人'),
(2, '分销佣金', 'commission_money', 1, 'number', 'commission', '达到', '元'),
(3, '分销订单', 'commission_order', 1, 'number', 'commission', '达到', '笔'),
(6, '订单满额', 'cost_enough', 1, 'number', 'cost', '满', '元'),
(7, '累计金额', 'cost_total', 1, 'number', 'cost', '累计', '元'),
(8, '订单数量', 'cost_count', 1, 'number', 'cost', '达到', '单'),
(9, '指定商品', 'cost_goods', 1, 'select', 'cost', '购买指定商品', '件'),
(10, '商品评价', 'cost_comment', 1, 'number', 'cost', '评价订单', '次'),
(11, '累计充值', 'cost_rechargetotal', 1, 'number', 'cost', '达到', '元'),
(12, '充值满额', 'cost_rechargeenough', 1, 'number', 'cost', '满', '元'),
(13, '绑定手机', 'member_info', 1, 'boole', 'member', '绑定手机号（必须开启wap或小程序）', '');

DROP TABLE IF EXISTS `ims_vending_machine_task_extension_join`;
CREATE TABLE `ims_vending_machine_task_extension_join` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `openid` varchar(255) NOT NULL,
  `require_data` text NOT NULL,
  `progress_data` text NOT NULL,
  `reward_data` text NOT NULL,
  `completetime` int(11) NOT NULL DEFAULT '0',
  `pickuptime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `dotime` int(11) NOT NULL DEFAULT '0',
  `rewarded` text NOT NULL,
  `logo` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_join`;
CREATE TABLE `ims_vending_machine_task_join` (
`join_id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `join_user` varchar(100) NOT NULL DEFAULT '',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `task_type` tinyint(1) NOT NULL DEFAULT '0',
  `needcount` int(11) NOT NULL DEFAULT '0',
  `completecount` int(11) NOT NULL DEFAULT '0',
  `reward_data` text,
  `is_reward` tinyint(1) NOT NULL DEFAULT '0',
  `failtime` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_joiner`;
CREATE TABLE `ims_vending_machine_task_joiner` (
`complete_id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `task_user` varchar(100) NOT NULL DEFAULT '',
  `joiner_id` varchar(100) NOT NULL DEFAULT '',
  `join_id` int(11) NOT NULL DEFAULT '0',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `task_type` tinyint(1) NOT NULL DEFAULT '0',
  `join_status` tinyint(1) NOT NULL DEFAULT '1',
  `addtime` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_list`;
CREATE TABLE `ims_vending_machine_task_list` (
`status` tinyint(1) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `title` char(50) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT '',
  `starttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `endtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `demand` int(11) NOT NULL DEFAULT '0',
  `requiregoods` text NOT NULL,
  `picktype` tinyint(1) NOT NULL DEFAULT '0',
  `stop_type` tinyint(1) NOT NULL DEFAULT '0',
  `stop_limit` int(11) NOT NULL DEFAULT '0',
  `stop_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stop_cycle` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_type` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_interval` int(11) NOT NULL DEFAULT '0',
  `repeat_cycle` tinyint(1) NOT NULL DEFAULT '0',
  `reward` text NOT NULL,
  `followreward` text NOT NULL,
  `goods_limit` int(11) NOT NULL DEFAULT '0',
  `notice` text NOT NULL,
  `design_data` text NOT NULL,
  `design_bg` varchar(255) NOT NULL DEFAULT '',
  `native_data` text NOT NULL,
  `native_data2` text,
  `native_data3` text,
  `reward2` text,
  `reward3` text,
  `level2` int(11) NOT NULL DEFAULT '0',
  `level3` int(11) NOT NULL DEFAULT '0',
  `member_group` text,
  `auto_pick` tinyint(1) NOT NULL DEFAULT '0',
  `keyword_pick` varchar(20) NOT NULL DEFAULT '',
  `verb` varchar(255) DEFAULT '',
  `unit` varchar(255) DEFAULT '',
  `member_level` int(11) NOT NULL DEFAULT '0',
  `poster_version` varchar(255) NOT NULL DEFAULT '',
  `we7_rule_keyword_id` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_log`;
CREATE TABLE `ims_vending_machine_task_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(100) NOT NULL DEFAULT '',
  `from_openid` varchar(100) NOT NULL DEFAULT '',
  `join_id` int(11) NOT NULL DEFAULT '0',
  `taskid` int(11) DEFAULT '0',
  `task_type` tinyint(1) NOT NULL DEFAULT '0',
  `subdata` text,
  `recdata` text,
  `createtime` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_poster`;
CREATE TABLE `ims_vending_machine_task_poster` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `bg` varchar(255) DEFAULT '',
  `data` text,
  `keyword` varchar(255) DEFAULT NULL,
  `resptype` tinyint(1) NOT NULL DEFAULT '0',
  `resptext` text,
  `resptitle` varchar(255) DEFAULT NULL,
  `respthumb` varchar(255) DEFAULT NULL,
  `respdesc` varchar(255) DEFAULT NULL,
  `respurl` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `waittext` varchar(255) DEFAULT NULL,
  `oktext` varchar(255) DEFAULT NULL,
  `scantext` varchar(255) DEFAULT NULL,
  `beagent` tinyint(1) NOT NULL DEFAULT '0',
  `bedown` tinyint(1) NOT NULL DEFAULT '0',
  `timestart` int(11) DEFAULT NULL,
  `timeend` int(11) DEFAULT NULL,
  `is_repeat` tinyint(1) DEFAULT '0',
  `getposter` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `starttext` varchar(255) DEFAULT NULL,
  `endtext` varchar(255) DEFAULT NULL,
  `reward_data` text,
  `needcount` int(11) NOT NULL DEFAULT '0',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `poster_type` tinyint(1) DEFAULT '1',
  `reward_days` int(11) DEFAULT '0',
  `titleicon` text,
  `poster_banner` text,
  `is_goods` tinyint(1) DEFAULT '0',
  `autoposter` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_poster_qr`;
CREATE TABLE `ims_vending_machine_task_poster_qr` (
`id` int(11) NOT NULL,
  `acid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(100) NOT NULL,
  `posterid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `sceneid` int(11) NOT NULL DEFAULT '0',
  `mediaid` varchar(255) DEFAULT NULL,
  `ticket` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `createtime` int(11) DEFAULT NULL,
  `qrimg` varchar(1000) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_qr`;
CREATE TABLE `ims_vending_machine_task_qr` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `openid` varchar(100) NOT NULL DEFAULT '',
  `recordid` int(11) NOT NULL DEFAULT '0',
  `sceneid` varchar(255) NOT NULL DEFAULT '',
  `mediaid` varchar(255) NOT NULL DEFAULT '',
  `ticket` varchar(255) NOT NULL DEFAULT '',
  `poster_version` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_record`;
CREATE TABLE `ims_vending_machine_task_record` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `taskid` int(11) NOT NULL DEFAULT '0',
  `tasktitle` varchar(255) NOT NULL,
  `taskimage` varchar(255) NOT NULL DEFAULT '',
  `tasktype` varchar(50) NOT NULL DEFAULT '',
  `task_progress` int(11) NOT NULL DEFAULT '0',
  `task_demand` int(11) NOT NULL DEFAULT '0',
  `openid` char(50) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `picktime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `stoptime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `finishtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reward_data` text NOT NULL,
  `followreward_data` text NOT NULL,
  `design_data` text NOT NULL,
  `design_bg` varchar(255) NOT NULL DEFAULT '',
  `require_goods` varchar(255) NOT NULL DEFAULT '',
  `level1` int(11) NOT NULL DEFAULT '0',
  `reward_data1` text NOT NULL,
  `level2` int(11) NOT NULL DEFAULT '0',
  `reward_data2` text NOT NULL,
  `member_group` text,
  `auto_pick` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_reward`;
CREATE TABLE `ims_vending_machine_task_reward` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `taskid` int(11) NOT NULL DEFAULT '0',
  `tasktitle` char(50) NOT NULL DEFAULT '',
  `tasktype` varchar(50) NOT NULL DEFAULT '',
  `taskowner` char(50) NOT NULL DEFAULT '',
  `ownernickname` char(50) NOT NULL DEFAULT '',
  `recordid` int(11) NOT NULL DEFAULT '0',
  `nickname` char(50) NOT NULL DEFAULT '',
  `headimg` varchar(255) NOT NULL DEFAULT '',
  `openid` char(50) NOT NULL DEFAULT '',
  `reward_type` char(10) NOT NULL DEFAULT '',
  `reward_title` char(50) NOT NULL DEFAULT '',
  `reward_data` decimal(10,2) NOT NULL DEFAULT '0.00',
  `get` tinyint(1) NOT NULL DEFAULT '0',
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `gettime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `senttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `isjoiner` tinyint(1) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_task_set`;
CREATE TABLE `ims_vending_machine_task_set` (
`uniacid` int(11) NOT NULL DEFAULT '0',
  `entrance` tinyint(1) NOT NULL DEFAULT '0',
  `keyword` varchar(10) NOT NULL DEFAULT '',
  `cover_title` varchar(20) NOT NULL DEFAULT '',
  `cover_img` varchar(255) NOT NULL DEFAULT '',
  `cover_desc` varchar(255) NOT NULL DEFAULT '',
  `msg_pick` text NOT NULL,
  `msg_progress` text NOT NULL,
  `msg_finish` text NOT NULL,
  `msg_follow` text NOT NULL,
  `isnew` tinyint(1) NOT NULL DEFAULT '0',
  `bg_img` varchar(255) NOT NULL DEFAULT '../addons/ewei_shopv2/plugin/task/static/images/sky.png',
  `top_notice` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_task_set` (`uniacid`, `entrance`, `keyword`, `cover_title`, `cover_img`, `cover_desc`, `msg_pick`, `msg_progress`, `msg_finish`, `msg_follow`, `isnew`, `bg_img`, `top_notice`) VALUES
(1, 0, '', '', '', '', '', '', '', '', 0, '../addons/ewei_shopv2/plugin/task/static/images/sky.png', 0);

DROP TABLE IF EXISTS `ims_vending_machine_task_type`;
CREATE TABLE `ims_vending_machine_task_type` (
`id` int(11) NOT NULL,
  `type_key` char(20) NOT NULL DEFAULT '',
  `type_name` char(10) NOT NULL DEFAULT '',
  `description` char(30) NOT NULL DEFAULT '',
  `verb` char(11) NOT NULL DEFAULT '',
  `numeric` tinyint(1) NOT NULL DEFAULT '0',
  `unit` char(10) NOT NULL DEFAULT '',
  `goods` tinyint(1) NOT NULL DEFAULT '0',
  `theme` char(10) NOT NULL DEFAULT '',
  `once` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_vending_machine_task_type` (`id`, `type_key`, `type_name`, `description`, `verb`, `numeric`, `unit`, `goods`, `theme`, `once`) VALUES
(13, 'child_agent', '下级分销商人数', '直属下级分销商人数，累计下级分销商人数达标,即可获得奖励', '直属下级分销商人数达', 1, '人', 0, 'primary', 0);

DROP TABLE IF EXISTS `ims_vending_machine_upwxapp_log`;
CREATE TABLE `ims_vending_machine_upwxapp_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `type` tinyint(2) DEFAULT '0',
  `is_goods` tinyint(1) DEFAULT '0',
  `is_live` tinyint(1) DEFAULT '0',
  `version` varchar(20) DEFAULT NULL,
  `describe` varchar(50) DEFAULT NULL,
  `version_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_verifygoods`;
CREATE TABLE `ims_vending_machine_verifygoods` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `openid` varchar(255) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  `ordergoodsid` int(11) DEFAULT NULL,
  `storeid` int(11) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  `limitdays` int(11) DEFAULT NULL,
  `limitnum` int(11) DEFAULT NULL,
  `used` tinyint(1) DEFAULT '0',
  `verifycode` varchar(20) DEFAULT NULL,
  `codeinvalidtime` int(11) DEFAULT NULL,
  `invalid` tinyint(1) DEFAULT '0',
  `getcard` tinyint(1) DEFAULT '0',
  `activecard` tinyint(1) DEFAULT '0',
  `cardcode` varchar(255) DEFAULT '',
  `limittype` tinyint(1) DEFAULT '0',
  `limitdate` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_verifygoods_log`;
CREATE TABLE `ims_vending_machine_verifygoods_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `verifygoodsid` int(11) DEFAULT NULL,
  `salerid` int(11) DEFAULT NULL,
  `storeid` int(11) DEFAULT NULL,
  `verifynum` int(11) DEFAULT NULL,
  `verifydate` int(11) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_verifyorder_log`;
CREATE TABLE `ims_vending_machine_verifyorder_log` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  `salerid` int(11) DEFAULT NULL,
  `storeid` int(11) DEFAULT NULL,
  `verifytime` int(11) DEFAULT NULL,
  `verifyinfo` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_version`;
CREATE TABLE `ims_vending_machine_version` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `uniacid` int(11) NOT NULL,
  `version` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_virtual_category`;
CREATE TABLE `ims_vending_machine_virtual_category` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `merchid` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_virtual_data`;
CREATE TABLE `ims_vending_machine_virtual_data` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `typeid` int(11) NOT NULL DEFAULT '0',
  `pvalue` varchar(255) DEFAULT '',
  `fields` text NOT NULL,
  `openid` varchar(255) NOT NULL DEFAULT '',
  `usetime` int(11) NOT NULL DEFAULT '0',
  `orderid` int(11) DEFAULT '0',
  `ordersn` varchar(255) DEFAULT '',
  `price` decimal(10,2) DEFAULT '0.00',
  `merchid` int(11) DEFAULT '0',
  `createtime` int(11) NOT NULL,
  `is_top` tinyint(1) DEFAULT '0',
  `sort_time` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_virtual_send_log`;
CREATE TABLE `ims_vending_machine_virtual_send_log` (
`id` int(11) UNSIGNED NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(40) NOT NULL DEFAULT '',
  `orderid` tinyint(3) UNSIGNED NOT NULL,
  `tag` varchar(20) NOT NULL,
  `default` varchar(2000) NOT NULL DEFAULT '',
  `cusdefault` varchar(2000) NOT NULL DEFAULT '',
  `url` varchar(128) NOT NULL DEFAULT '',
  `datas` varchar(2000) NOT NULL DEFAULT '',
  `appurl` varchar(128) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `sendtime` int(11) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_virtual_type`;
CREATE TABLE `ims_vending_machine_virtual_type` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `cate` int(11) DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `fields` text NOT NULL,
  `usedata` int(11) NOT NULL DEFAULT '0',
  `alldata` int(11) NOT NULL DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `linktext` varchar(50) DEFAULT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `recycled` int(11) NOT NULL DEFAULT '0',
  `description` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxapp_bind`;
CREATE TABLE `ims_vending_machine_wxapp_bind` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `wxapp` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxapp_page`;
CREATE TABLE `ims_vending_machine_wxapp_page` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(2) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `data` mediumtext,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lasttime` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `isdefault` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxapp_poster`;
CREATE TABLE `ims_vending_machine_wxapp_poster` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(3) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `bgimg` varchar(255) DEFAULT NULL,
  `data` text,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `displayorder` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxapp_startadv`;
CREATE TABLE `ims_vending_machine_wxapp_startadv` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `data` text,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastedittime` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxapp_subscribe`;
CREATE TABLE `ims_vending_machine_wxapp_subscribe` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `templateid` varchar(255) NOT NULL,
  `createtime` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxapp_tmessage`;
CREATE TABLE `ims_vending_machine_wxapp_tmessage` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `templateid` varchar(50) DEFAULT '',
  `datas` text,
  `emphasis_keyword` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxcard`;
CREATE TABLE `ims_vending_machine_wxcard` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `card_id` varchar(255) DEFAULT '0',
  `displayorder` int(11) DEFAULT NULL,
  `catid` int(11) DEFAULT NULL,
  `card_type` varchar(50) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `wxlogourl` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `code_type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `notice` varchar(50) DEFAULT NULL,
  `service_phone` varchar(50) DEFAULT NULL,
  `description` text,
  `datetype` varchar(50) DEFAULT NULL,
  `begin_timestamp` int(11) DEFAULT NULL,
  `end_timestamp` int(11) DEFAULT NULL,
  `fixed_term` int(11) DEFAULT NULL,
  `fixed_begin_term` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_quantity` varchar(255) DEFAULT NULL,
  `use_limit` int(11) DEFAULT NULL,
  `get_limit` int(11) DEFAULT NULL,
  `use_custom_code` tinyint(1) DEFAULT NULL,
  `bind_openid` tinyint(1) DEFAULT NULL,
  `can_share` tinyint(1) DEFAULT NULL,
  `can_give_friend` tinyint(1) DEFAULT NULL,
  `center_title` varchar(20) DEFAULT NULL,
  `center_sub_title` varchar(20) DEFAULT NULL,
  `center_url` varchar(255) DEFAULT NULL,
  `setcustom` tinyint(1) DEFAULT NULL,
  `custom_url_name` varchar(20) DEFAULT NULL,
  `custom_url_sub_title` varchar(20) DEFAULT NULL,
  `custom_url` varchar(255) DEFAULT NULL,
  `setpromotion` tinyint(1) DEFAULT NULL,
  `promotion_url_name` varchar(20) DEFAULT NULL,
  `promotion_url_sub_title` varchar(20) DEFAULT NULL,
  `promotion_url` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `can_use_with_other_discount` tinyint(1) DEFAULT NULL,
  `setabstract` tinyint(1) DEFAULT NULL,
  `abstract` varchar(50) DEFAULT NULL,
  `abstractimg` varchar(255) DEFAULT NULL,
  `icon_url_list` varchar(255) DEFAULT NULL,
  `accept_category` varchar(50) DEFAULT NULL,
  `reject_category` varchar(50) DEFAULT NULL,
  `least_cost` decimal(10,2) DEFAULT NULL,
  `reduce_cost` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `limitgoodtype` tinyint(1) DEFAULT '0',
  `limitgoodcatetype` tinyint(1) UNSIGNED DEFAULT '0',
  `limitgoodcateids` varchar(255) DEFAULT NULL,
  `limitgoodids` varchar(255) DEFAULT NULL,
  `limitdiscounttype` tinyint(1) UNSIGNED DEFAULT '0',
  `merchid` int(11) DEFAULT '0',
  `gettype` tinyint(3) DEFAULT NULL,
  `islimitlevel` tinyint(1) DEFAULT '0',
  `limitmemberlevels` varchar(500) DEFAULT '',
  `limitagentlevels` varchar(500) DEFAULT '',
  `limitpartnerlevels` varchar(500) DEFAULT '',
  `limitaagentlevels` varchar(500) DEFAULT '',
  `settitlecolor` tinyint(1) DEFAULT '0',
  `titlecolor` varchar(10) DEFAULT '',
  `tagtitle` varchar(20) DEFAULT '',
  `use_condition` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxlive`;
CREATE TABLE `ims_vending_machine_wxlive` (
`id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL DEFAULT '0',
  `room_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `cover_img` varchar(255) NOT NULL DEFAULT '',
  `live_status` tinyint(3) NOT NULL DEFAULT '0',
  `local_live_status` tinyint(1) NOT NULL DEFAULT '0',
  `start_time` int(11) NOT NULL DEFAULT '0',
  `end_time` int(11) NOT NULL DEFAULT '0',
  `anchor_name` varchar(20) NOT NULL DEFAULT '',
  `anchor_img` varchar(255) NOT NULL DEFAULT '',
  `goods_json` text,
  `is_top` tinyint(1) NOT NULL DEFAULT '0',
  `is_recommend` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_machine_wxlive_back`;
CREATE TABLE `ims_vending_machine_wxlive_back` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `live_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `expire_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `media_url` varchar(255) DEFAULT NULL,
  `show_times` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ims_vending_message_mass_sign`;
CREATE TABLE `ims_vending_message_mass_sign` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `openid` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `taskid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `log` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `ims_vending_message_mass_task`;
CREATE TABLE `ims_vending_message_mass_task` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `status` tinyint(1) DEFAULT '0',
  `processnum` int(11) DEFAULT '1',
  `sendnum` int(11) DEFAULT '0',
  `messagetype` tinyint(1) DEFAULT '0',
  `templateid` int(11) DEFAULT '0',
  `resptitle` varchar(255) DEFAULT NULL,
  `respthumb` varchar(255) DEFAULT NULL,
  `respdesc` varchar(255) DEFAULT NULL,
  `respurl` varchar(255) DEFAULT NULL,
  `sendlimittype` tinyint(1) DEFAULT '0',
  `send_openid` text,
  `send_level` int(11) DEFAULT NULL,
  `send_group` int(11) DEFAULT NULL,
  `send_agentlevel` int(11) DEFAULT NULL,
  `customertype` tinyint(1) DEFAULT '0',
  `resdesc2` varchar(255) DEFAULT '',
  `pagecount` int(11) DEFAULT '0',
  `successnum` int(11) DEFAULT '0',
  `failnum` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

DROP TABLE IF EXISTS `ims_vending_message_mass_template`;
CREATE TABLE `ims_vending_message_mass_template` (
`id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `template_id` varchar(255) DEFAULT '',
  `first` text NOT NULL,
  `firstcolor` varchar(255) DEFAULT '',
  `data` text NOT NULL,
  `remark` text NOT NULL,
  `remarkcolor` varchar(255) DEFAULT '',
  `url` varchar(255) NOT NULL,
  `createtime` int(11) DEFAULT '0',
  `sendtimes` int(11) DEFAULT '0',
  `sendcount` int(11) DEFAULT '0',
  `miniprogram` tinyint(1) DEFAULT '0',
  `appid` varchar(255) DEFAULT '',
  `pagepath` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;


ALTER TABLE `ims_vending_machine_abonus_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_month` (`month`),
  ADD KEY `idx_paytime` (`paytime`),
  ADD KEY `idx_paytype` (`paytype`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `idx_week` (`week`),
  ADD KEY `idx_year` (`year`);

ALTER TABLE `ims_vending_machine_abonus_billp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_billid` (`billid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_abonus_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_address_applyfor`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_adv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_area_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_article`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_article_title` (`article_title`) USING BTREE,
  ADD KEY `idx_article_keyword` (`article_keyword`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;

ALTER TABLE `ims_vending_machine_article_category`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_category_name` (`category_name`) USING BTREE;

ALTER TABLE `ims_vending_machine_article_log`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_aid` (`aid`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;

ALTER TABLE `ims_vending_machine_article_report`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_article_share`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_aid` (`aid`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;

ALTER TABLE `ims_vending_machine_article_sys`
  ADD PRIMARY KEY (`uniacid`) USING BTREE,
  ADD KEY `idx_article_message` (`article_message`) USING BTREE,
  ADD KEY `idx_article_keyword` (`article_keyword`) USING BTREE,
  ADD KEY `idx_article_title` (`article_title`) USING BTREE;

ALTER TABLE `ims_vending_machine_banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_bargain_account`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_bargain_actor`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE,
  ADD KEY `idx_account_id` (`account_id`) USING BTREE,
  ADD KEY `idx_status` (`status`) USING BTREE;

ALTER TABLE `ims_vending_machine_bargain_goods`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `goods_id` (`goods_id`) USING BTREE;

ALTER TABLE `ims_vending_machine_bargain_record`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE,
  ADD KEY `idx_actor_id` (`actor_id`) USING BTREE;

ALTER TABLE `ims_vending_machine_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_ishome` (`ishome`),
  ADD KEY `idx_isrecommand` (`isrecommand`),
  ADD KEY `idx_parentid` (`parentid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_city_express`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_commission_apply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_applytime` (`applytime`),
  ADD KEY `idx_checktime` (`checktime`),
  ADD KEY `idx_invalidtime` (`invalidtime`),
  ADD KEY `idx_mid` (`mid`),
  ADD KEY `idx_paytime` (`paytime`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_commission_bank`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_commission_clickcount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_from_openid` (`from_openid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_commission_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_commission_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_applyid` (`applyid`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_mid` (`mid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_commission_rank`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_commission_relation`
  ADD UNIQUE KEY `id_pid` (`id`,`pid`),
  ADD KEY `id` (`id`),
  ADD KEY `level` (`level`),
  ADD KEY `pid` (`pid`);

ALTER TABLE `ims_vending_machine_commission_repurchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applyid` (`applyid`),
  ADD KEY `openid` (`openid`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_commission_shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_mid` (`mid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_catid` (`catid`),
  ADD KEY `idx_coupontype` (`coupontype`),
  ADD KEY `idx_givetype` (`backtype`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_timeend` (`timeend`),
  ADD KEY `idx_timelimit` (`timelimit`),
  ADD KEY `idx_timestart` (`timestart`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_coupon_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_coupon_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_couponid` (`couponid`),
  ADD KEY `idx_gettime` (`gettime`),
  ADD KEY `idx_gettype` (`gettype`),
  ADD KEY `idx_used` (`used`);

ALTER TABLE `ims_vending_machine_coupon_goodsendtask`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_coupon_guess`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_couponid` (`couponid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_coupon_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_couponid` (`couponid`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_getfrom` (`getfrom`),
  ADD KEY `idx_logno` (`logno`),
  ADD KEY `idx_paystatus` (`paystatus`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_coupon_sendshow`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_coupon_sendtasks`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_coupon_taskdata`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_coupon_usesendtasks`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_creditshop_adv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_creditshop_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_creditshop_comment`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_creditshop_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_endtime` (`endtime`),
  ADD KEY `idx_goodstype` (`goodstype`),
  ADD KEY `idx_isrecommand` (`isrecommand`),
  ADD KEY `idx_istime` (`istime`),
  ADD KEY `idx_istop` (`istop`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_timeend` (`timeend`),
  ADD KEY `idx_timestart` (`timestart`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_creditshop_log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_creditshop_option`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_creditshop_spec`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_creditshop_spec_item`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_creditshop_verify`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_datatransfer`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_device`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniacid` (`uniacid`,`imei`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_device_lock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniacid` (`uniacid`,`device_id`,`senid`);

ALTER TABLE `ims_vending_machine_device_remote`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniacid` (`uniacid`,`imei`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_device_scales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniacid` (`uniacid`,`device_id`,`senid`);

ALTER TABLE `ims_vending_machine_dispatch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_dividend_apply`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_mid` (`mid`) USING BTREE,
  ADD KEY `idx_checktime` (`checktime`) USING BTREE,
  ADD KEY `idx_paytime` (`paytime`) USING BTREE,
  ADD KEY `idx_applytime` (`applytime`) USING BTREE,
  ADD KEY `idx_status` (`status`) USING BTREE,
  ADD KEY `idx_invalidtime` (`invalidtime`) USING BTREE;

ALTER TABLE `ims_vending_machine_dividend_bank`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;

ALTER TABLE `ims_vending_machine_dividend_init`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;

ALTER TABLE `ims_vending_machine_dividend_log`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_applyid` (`applyid`) USING BTREE,
  ADD KEY `idx_mid` (`mid`) USING BTREE,
  ADD KEY `idx_createtime` (`createtime`) USING BTREE;

ALTER TABLE `ims_vending_machine_diyform_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_diyform_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cid` (`cid`),
  ADD KEY `idx_typeid` (`typeid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_diyform_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cid` (`cid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_diyform_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cate` (`cate`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_diypage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_keyword` (`keyword`),
  ADD KEY `idx_lastedittime` (`lastedittime`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_diypage_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_lastedittime` (`lastedittime`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_diypage_plu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_lastedittime` (`lastedittime`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_diypage_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cate` (`cate`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_diypage_template_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_exchange_cart`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_exchange_code`
  ADD PRIMARY KEY (`id`,`key`);

ALTER TABLE `ims_vending_machine_exchange_group`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_exchange_query`
  ADD PRIMARY KEY (`id`,`openid`);

ALTER TABLE `ims_vending_machine_exchange_record`
  ADD PRIMARY KEY (`id`,`key`);

ALTER TABLE `ims_vending_machine_exchange_setting`
  ADD PRIMARY KEY (`id`,`uniacid`);

ALTER TABLE `ims_vending_machine_exhelper_esheet`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_exhelper_esheet_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_isdefault` (`isdefault`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_exhelper_express`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_isdefault` (`isdefault`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_exhelper_senduser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_isdefault` (`isdefault`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_exhelper_sys`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_express`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_express_cache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_express` (`express`),
  ADD KEY `idx_expresssn` (`expresssn`);

ALTER TABLE `ims_vending_machine_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_feedbackid` (`feedbackid`),
  ADD KEY `idx_transid` (`transid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_form`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_form_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_friendcoupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_title` (`title`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_friendcoupon_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_activity_id` (`activity_id`),
  ADD KEY `idx_headerid` (`headerid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_send_failed_message` (`send_failed_message`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_fullback_goods`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_fullback_log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_fullback_log_map`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_funbar`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_gift`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_globonus_bill`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_paytype` (`paytype`) USING BTREE,
  ADD KEY `idx_createtime` (`createtime`) USING BTREE,
  ADD KEY `idx_paytime` (`paytime`) USING BTREE,
  ADD KEY `idx_status` (`status`) USING BTREE,
  ADD KEY `idx_month` (`month`) USING BTREE,
  ADD KEY `idx_week` (`week`) USING BTREE,
  ADD KEY `idx_year` (`year`) USING BTREE;

ALTER TABLE `ims_vending_machine_globonus_billo`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_billid` (`billid`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;

ALTER TABLE `ims_vending_machine_globonus_billp`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_billid` (`billid`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;

ALTER TABLE `ims_vending_machine_globonus_level`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;

ALTER TABLE `ims_vending_machine_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ccate` (`ccate`),
  ADD KEY `idx_checked` (`checked`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_iscomment` (`iscomment`),
  ADD KEY `idx_isdiscount` (`isdiscount`),
  ADD KEY `idx_ishot` (`ishot`),
  ADD KEY `idx_isnew` (`isnew`),
  ADD KEY `idx_isrecommand` (`isrecommand`),
  ADD KEY `idx_issendfree` (`issendfree`),
  ADD KEY `idx_istime` (`istime`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_pcate` (`pcate`),
  ADD KEY `idx_productsn` (`productsn`),
  ADD KEY `idx_scate` (`tcate`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_goodscircle_log`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_unid` (`uniacid`) USING BTREE,
  ADD KEY `idx_optype` (`op_type`) USING BTREE,
  ADD KEY `idx_opid` (`op_id`) USING BTREE,
  ADD KEY `idx_succ` (`is_success`) USING BTREE;

ALTER TABLE `ims_vending_machine_goodscode_good`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_goods_cards`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_goods_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_goods_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_goods_label`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_goods_labelstyle`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_goods_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_productsn` (`productsn`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_goods_param`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_goods_spec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_goods_spec_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_show` (`show`),
  ADD KEY `idx_specid` (`specid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_groups_adv`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_enabled` (`enabled`) USING BTREE,
  ADD KEY `idx_displayorder` (`displayorder`) USING BTREE;

ALTER TABLE `ims_vending_machine_groups_category`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_displayorder` (`displayorder`) USING BTREE,
  ADD KEY `idx_enabled` (`enabled`) USING BTREE,
  ADD KEY `idx_name` (`name`) USING BTREE;

ALTER TABLE `ims_vending_machine_groups_goods`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_type` (`category`) USING BTREE,
  ADD KEY `idx_createtime` (`createtime`) USING BTREE,
  ADD KEY `idx_status` (`status`) USING BTREE,
  ADD KEY `idx_category` (`category`) USING BTREE,
  ADD KEY `idx_dispatchid` (`dispatchid`) USING BTREE;

ALTER TABLE `ims_vending_machine_groups_goods_atlas`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_groups_goods_option`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_groups_ladder`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_groups_order`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE,
  ADD KEY `idx_orderno` (`orderno`) USING BTREE,
  ADD KEY `idx_paytime` (`paytime`) USING BTREE,
  ADD KEY `idx_pay_type` (`pay_type`) USING BTREE,
  ADD KEY `idx_teamid` (`teamid`) USING BTREE,
  ADD KEY `idx_verifycode` (`verifycode`) USING BTREE,
  ADD KEY `idx_createtime` (`createtime`) USING BTREE;

ALTER TABLE `ims_vending_machine_groups_order_goods`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_groups_order_refund`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `uniacid` (`uniacid`) USING BTREE,
  ADD KEY `openid` (`openid`) USING BTREE,
  ADD KEY `orderid` (`orderid`) USING BTREE,
  ADD KEY `refundno` (`refundno`) USING BTREE;

ALTER TABLE `ims_vending_machine_groups_paylog`
  ADD PRIMARY KEY (`plid`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE,
  ADD KEY `idx_tid` (`tid`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `uniontid` (`uniontid`) USING BTREE;

ALTER TABLE `ims_vending_machine_groups_set`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_groups_verify`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_invitation`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_type` (`type`) USING BTREE;

ALTER TABLE `ims_vending_machine_invitation_log`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_posterid` (`invitation_id`) USING BTREE,
  ADD KEY `idx_scantime` (`scan_time`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE;

ALTER TABLE `ims_vending_machine_invitation_qr`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_lottery`
  ADD PRIMARY KEY (`lottery_id`);

ALTER TABLE `ims_vending_machine_lottery_default`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_lottery_join`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_lottery_log`
  ADD PRIMARY KEY (`log_id`);

ALTER TABLE `ims_vending_machine_member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_agenttime` (`agenttime`),
  ADD KEY `idx_isagent` (`isagent`),
  ADD KEY `idx_level` (`level`),
  ADD KEY `idx_mobile` (`mobile`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_openid_wa` (`openid_wa`),
  ADD KEY `idx_openid_wx` (`openid_wx`),
  ADD KEY `idx_shareid` (`agentid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uid` (`uid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_isdefault` (`isdefault`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_card`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_member_card_buysend`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE;

ALTER TABLE `ims_vending_machine_member_card_history`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_member_card_monthsend`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE;

ALTER TABLE `ims_vending_machine_member_card_order`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_member_card_uselog`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE;

ALTER TABLE `ims_vending_machine_member_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_credit_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `openid` (`openid`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_group`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_member_group_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `openid` (`openid`);

ALTER TABLE `ims_vending_machine_member_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_mergelog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_mid_a` (`mid_a`),
  ADD KEY `idx_mid_b` (`mid_b`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_message_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_message_template_default`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_member_message_template_type`
  ADD KEY `id` (`id`);

ALTER TABLE `ims_vending_machine_member_printer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_printer_template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_member_rank`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_member_wxapp_message_template_default`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_member_wxapp_message_template_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_id` (`id`);

ALTER TABLE `ims_vending_machine_merch_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_adv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_banner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_bill`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_billo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_bill_select`
  ADD UNIQUE KEY `bid_oid` (`bill_id`,`order_id`),
  ADD KEY `bid` (`bill_id`),
  ADD KEY `oid` (`order_id`);

ALTER TABLE `ims_vending_machine_merch_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_category_swipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_clearing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `endtime` (`endtime`),
  ADD KEY `merchid` (`merchid`),
  ADD KEY `starttime` (`starttime`),
  ADD KEY `status` (`status`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_commission_orderprice`
  ADD PRIMARY KEY (`order_id`);

ALTER TABLE `ims_vending_machine_merch_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_nav`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_perm_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `uid` (`uid`);

ALTER TABLE `ims_vending_machine_merch_perm_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `merchid` (`merchid`);

ALTER TABLE `ims_vending_machine_merch_reg`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_merch_saler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_storeid` (`storeid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_merch_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cateid` (`cateid`),
  ADD KEY `idx_groupid` (`groupid`),
  ADD KEY `idx_regid` (`regid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_nav`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_newstore_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_open_plugin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_finishtime` (`finishtime`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_ordersn` (`ordersn`),
  ADD KEY `idx_paytime` (`paytime`),
  ADD KEY `idx_refundid` (`refundid`),
  ADD KEY `idx_shareid` (`agentid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `parentid` (`parentid`);

ALTER TABLE `ims_vending_machine_order_buysend`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_orderid` (`orderid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_order_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_orderid` (`orderid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_order_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_applytime1` (`applytime1`),
  ADD KEY `idx_applytime2` (`applytime2`),
  ADD KEY `idx_applytime3` (`applytime3`),
  ADD KEY `idx_checktime1` (`checktime1`),
  ADD KEY `idx_checktime2` (`checktime2`),
  ADD KEY `idx_checktime3` (`checktime3`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_invalidtime1` (`invalidtime1`),
  ADD KEY `idx_invalidtime2` (`invalidtime2`),
  ADD KEY `idx_invalidtime3` (`invalidtime3`),
  ADD KEY `idx_orderid` (`orderid`),
  ADD KEY `idx_paytime1` (`paytime1`),
  ADD KEY `idx_paytime2` (`paytime2`),
  ADD KEY `idx_paytime3` (`paytime3`),
  ADD KEY `idx_status1` (`status1`),
  ADD KEY `idx_status2` (`status2`),
  ADD KEY `idx_status3` (`status3`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_order_peerpay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_order_peerpay_payinfo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_order_refund`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_order_single_refund`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_package`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_package_goods`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_package_goods_option`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_pc_adv`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_pc_browse_history`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_pc_goods`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_pc_link`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_pc_menu`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_machine_pc_slide`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE,
  ADD KEY `idx_enabled` (`enabled`) USING BTREE,
  ADD KEY `idx_displayorder` (`displayorder`) USING BTREE;

ALTER TABLE `ims_vending_machine_pc_template`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_title` (`title`) USING BTREE;

ALTER TABLE `ims_vending_machine_perm_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_uid` (`uid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_perm_plugin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uid` (`uid`),
  ADD KEY `idx_uniacid` (`acid`);

ALTER TABLE `ims_vending_machine_perm_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_perm_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_roleid` (`roleid`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uid` (`uid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_plugin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`);

ALTER TABLE `ims_vending_machine_poster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_isdefault` (`isdefault`),
  ADD KEY `idx_times` (`times`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_postera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_isdefault` (`isdefault`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_postera_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_posteraid` (`posterid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_postera_qr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_acid` (`acid`),
  ADD KEY `idx_posterid` (`posterid`),
  ADD KEY `idx_sceneid` (`sceneid`),
  ADD KEY `idx_type` (`type`);

ALTER TABLE `ims_vending_machine_poster_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_posterid` (`posterid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_poster_qr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_acid` (`acid`),
  ADD KEY `idx_sceneid` (`sceneid`),
  ADD KEY `idx_type` (`type`);

ALTER TABLE `ims_vending_machine_poster_scan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_posterid` (`posterid`),
  ADD KEY `idx_scantime` (`scantime`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_qa_adv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_qa_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_qa_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_qa_set`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_unaicid` (`uniacid`);

ALTER TABLE `ims_vending_machine_queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel` (`channel`),
  ADD KEY `priority` (`priority`),
  ADD KEY `reserved_at` (`reserved_at`);

ALTER TABLE `ims_vending_machine_quick`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_quick_adv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_quick_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_merchid` (`merchid`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_refund_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_deleted` (`deleted`),
  ADD KEY `idx_isdefault` (`isdefault`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_saler`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_storeid` (`storeid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_sale_coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_createtime` (`createtime`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_sale_coupon_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_couponid` (`couponid`),
  ADD KEY `idx_gettime` (`gettime`),
  ADD KEY `idx_gettype` (`gettype`),
  ADD KEY `idx_orderid` (`orderid`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `idx_usedtime` (`usedtime`);

ALTER TABLE `ims_vending_machine_seckill_adv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_seckill_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_seckill_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`enabled`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_seckill_task_goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_goodsid` (`goodsid`),
  ADD KEY `idx_optionid` (`optionid`),
  ADD KEY `idx_roomid` (`roomid`),
  ADD KEY `idx_taskid` (`taskid`),
  ADD KEY `idx_time` (`timeid`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_seckill_task_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_taskid` (`taskid`);

ALTER TABLE `ims_vending_machine_seckill_task_time`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_sendticket`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_sendticket_draw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpid` (`cpid`),
  ADD KEY `openid` (`openid`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_sendticket_share`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_sign_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_openid` (`openid`),
  ADD KEY `idx_time` (`time`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_sign_set`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_sign_user`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_sms`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_sms_set`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_sysset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_system_adv`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_article`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_banner`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_case`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_casecategory`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_company_article`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_company_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_copyright`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_system_copyright_notice`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_guestbook`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_link`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_plugingrant_adv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_displayorder` (`displayorder`),
  ADD KEY `idx_enabled` (`enabled`);

ALTER TABLE `ims_vending_machine_system_plugingrant_log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_plugingrant_order`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_plugingrant_package`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_plugingrant_plugin`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_plugingrant_setting`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_setting`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_system_site`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_task_adv`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_task_default`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_task_extension`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_task_extension_join`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_task_join`
  ADD PRIMARY KEY (`join_id`);

ALTER TABLE `ims_vending_machine_task_joiner`
  ADD PRIMARY KEY (`complete_id`);

ALTER TABLE `ims_vending_machine_task_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_passive` (`picktype`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_task_log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_task_poster`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_task_poster_qr`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_task_qr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recordid` (`recordid`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_task_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taskid` (`taskid`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_task_reward`
  ADD PRIMARY KEY (`id`),
  ADD KEY `get` (`get`),
  ADD KEY `recordid` (`recordid`),
  ADD KEY `taskid` (`taskid`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `openid` (`openid`);

ALTER TABLE `ims_vending_machine_task_set`
  ADD PRIMARY KEY (`uniacid`),
  ADD KEY `uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_task_type`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_upwxapp_log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_verifygoods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verifycode` (`verifycode`);

ALTER TABLE `ims_vending_machine_verifygoods_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `verifygoodsid` (`verifygoodsid`);

ALTER TABLE `ims_vending_machine_verifyorder_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniacid` (`uniacid`),
  ADD KEY `orderid` (`orderid`);

ALTER TABLE `ims_vending_machine_version`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uid` (`uid`),
  ADD KEY `idx_version` (`version`);

ALTER TABLE `ims_vending_machine_virtual_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_virtual_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_orderid` (`orderid`),
  ADD KEY `idx_typeid` (`typeid`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `idx_usetime` (`usetime`);

ALTER TABLE `ims_vending_machine_virtual_send_log`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_virtual_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_cate` (`cate`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_wxapp_bind`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `idx_wxapp` (`wxapp`);

ALTER TABLE `ims_vending_machine_wxapp_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_isdefault` (`isdefault`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_wxapp_poster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_type` (`type`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_wxapp_startadv`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_wxapp_subscribe`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_wxapp_tmessage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_uniacid` (`uniacid`);

ALTER TABLE `ims_vending_machine_wxcard`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ims_vending_machine_wxlive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `idx_start_time` (`start_time`),
  ADD KEY `idx_end_time` (`end_time`),
  ADD KEY `idx_is_top` (`is_top`),
  ADD KEY `idx_is_recommend` (`is_recommend`),
  ADD KEY `idx_local_live_status` (`local_live_status`),
  ADD KEY `idx_status` (`status`);

ALTER TABLE `ims_vending_machine_wxlive_back`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_uniacid` (`uniacid`),
  ADD KEY `idx_roomid` (`room_id`),
  ADD KEY `idx_liveid` (`live_id`);

ALTER TABLE `ims_vending_message_mass_sign`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_openid` (`openid`) USING BTREE,
  ADD KEY `idx_taskid` (`taskid`) USING BTREE,
  ADD KEY `idx_status` (`status`) USING BTREE;

ALTER TABLE `ims_vending_message_mass_task`
  ADD PRIMARY KEY (`id`) USING BTREE;

ALTER TABLE `ims_vending_message_mass_template`
  ADD PRIMARY KEY (`id`) USING BTREE;


ALTER TABLE `ims_vending_machine_abonus_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_abonus_billp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_abonus_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_address_applyfor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_area_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_article_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_article_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_article_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_article_share`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_bargain_actor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_bargain_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_bargain_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_city_express`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_commission_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_commission_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_commission_clickcount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_commission_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_commission_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_commission_rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_commission_repurchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_commission_shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_goodsendtask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_guess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_sendshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_sendtasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_taskdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_coupon_usesendtasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_spec_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_creditshop_verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_datatransfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `ims_vending_machine_device_lock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `ims_vending_machine_device_remote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `ims_vending_machine_device_scales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

ALTER TABLE `ims_vending_machine_dispatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_dividend_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_dividend_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_dividend_init`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_dividend_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_diyform_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_diyform_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_diyform_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_diyform_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_diypage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_diypage_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_diypage_plu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_diypage_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `ims_vending_machine_diypage_template_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exchange_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exchange_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exchange_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exchange_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exchange_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exchange_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exhelper_esheet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `ims_vending_machine_exhelper_esheet_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exhelper_express`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exhelper_senduser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_exhelper_sys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_express`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

ALTER TABLE `ims_vending_machine_express_cache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_form_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_friendcoupon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_friendcoupon_data`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_fullback_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_fullback_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_fullback_log_map`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_funbar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_gift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_globonus_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_globonus_billo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_globonus_billp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_globonus_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `ims_vending_machine_goodscircle_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goodscode_good`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goods_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goods_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goods_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goods_label`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goods_labelstyle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goods_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `ims_vending_machine_goods_param`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_goods_spec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `ims_vending_machine_goods_spec_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `ims_vending_machine_groups_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_goods_atlas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_goods_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_ladder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_order_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_order_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_paylog`
  MODIFY `plid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_groups_verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_invitation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_invitation_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_invitation_qr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_lottery`
  MODIFY `lottery_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_lottery_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_lottery_join`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_lottery_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `ims_vending_machine_member_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_card_buysend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_card_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_card_monthsend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_card_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_card_uselog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_credit_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_group_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_mergelog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_message_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_message_template_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_printer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_printer_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_wxapp_message_template_default`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_member_wxapp_message_template_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `ims_vending_machine_merch_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_billo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_category_swipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_clearing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_nav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_perm_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_perm_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_reg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_saler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_merch_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_nav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_newstore_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_open_plugin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_order_buysend`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_order_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_order_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_order_peerpay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_order_peerpay_payinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_order_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_order_single_refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_package_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_package_goods_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `ims_vending_machine_pc_adv`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_pc_browse_history`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_pc_goods`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_pc_link`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_pc_menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_pc_slide`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_pc_template`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_perm_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `ims_vending_machine_perm_plugin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_perm_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_perm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_plugin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

ALTER TABLE `ims_vending_machine_poster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_postera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_postera_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_postera_qr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_poster_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_poster_qr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_poster_scan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_qa_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_qa_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_qa_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_qa_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_quick`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_quick_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_quick_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_refund_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_saler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sale_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sale_coupon_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_seckill_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_seckill_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_seckill_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_seckill_task_goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_seckill_task_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_seckill_task_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sendticket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sendticket_draw`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sendticket_share`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sign_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sign_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sign_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `ims_vending_machine_sms_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `ims_vending_machine_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_sysset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `ims_vending_machine_system_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_casecategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_company_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_company_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_copyright`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_copyright_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_guestbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_plugingrant_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_plugingrant_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_plugingrant_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_plugingrant_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_plugingrant_plugin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_plugingrant_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_system_site`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_adv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_default`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_extension`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `ims_vending_machine_task_extension_join`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_join`
  MODIFY `join_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_joiner`
  MODIFY `complete_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_list`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_poster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_poster_qr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_qr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_task_reward`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_upwxapp_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_verifygoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_verifygoods_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_verifyorder_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_virtual_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_virtual_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_virtual_send_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_virtual_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxapp_bind`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxapp_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxapp_poster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxapp_startadv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxapp_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxapp_tmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxcard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxlive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_machine_wxlive_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_message_mass_sign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_message_mass_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `ims_vending_message_mass_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
ALTER TABLE `ims_vending_machine_device_lock` ADD `disabled` TINYINT(1) NOT NULL COMMENT '状态，1禁用0正常';
ALTER TABLE `ims_vending_machine_goods` ADD `fee_type` TINYINT(1) NOT NULL COMMENT '计费方式0计件1称重', ADD `weight_unit` INT(11) NOT NULL COMMENT '单件商品重量';
ALTER TABLE `ims_vending_machine_order` ADD `device_id` INT(11) NOT NULL COMMENT '设备id';
ALTER TABLE `ims_vending_machine_order_goods` ADD `start_gravity` INT(11) NOT NULL COMMENT '开门时重力值';
ALTER TABLE `ims_vending_machine_order_goods` ADD `stop_gravity` INT(11) NOT NULL COMMENT '最后重力值';
ALTER TABLE `ims_vending_machine_order_goods` ADD `totalprice` DECIMAL(10,2) NOT NULL COMMENT '小计';
ALTER TABLE `ims_vending_machine_order_goods` ADD `fee_type` TINYINT(1) NOT NULL COMMENT '计费方式';
ALTER TABLE `ims_vending_machine_order_goods` ADD `weight` FLOAT(10,2) NOT NULL COMMENT '变化的重量 ';
ALTER TABLE `ims_vending_machine_order_goods` ADD `weight_unit` INT(11) NOT NULL COMMENT '单价商品重量 ';
ALTER TABLE `ims_vending_machine_order_goods` ADD `unit` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '单位 ';
ALTER TABLE `ims_vending_machine_order_goods` ADD `scales_id` INT(11) NOT NULL COMMENT '传感器ID ';
ALTER TABLE `ims_vending_machine_order` CHANGE `payscore_order_id` `payscore_order_id` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付分订单号';
ALTER TABLE `ims_vending_machine_device` ADD `merchid` INT(11) NOT NULL COMMENT '商户ID';
ALTER TABLE `ims_vending_machine_merch_user` ADD `sub_mchid` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付分子商户号';
ALTER TABLE `ims_vending_machine_merch_user` ADD `service_id` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付分服务ID';
ALTER TABLE `ims_vending_machine_member` ADD `alipay_user_id` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付宝用户id';
ALTER TABLE `ims_vending_machine_member` ADD `agreement_no` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付宝签约记录的编号';
ALTER TABLE `ims_vending_machine_order` ADD `agreement_no` VARCHAR(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付宝签约记录的编号';
ALTER TABLE `ims_vending_machine_order` ADD `deductenough_price` DECIMAL(10,2) NOT NULL COMMENT '满xx金额立减';
ALTER TABLE `ims_vending_machine_merch_user` ADD `alipay_appid` VARCHAR(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ADD `alipay_public_key` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ADD `alipay_private_key` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ADD `alipay_cert_file` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ADD `alipay_root_file` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ADD `alipay_key_file` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `ims_vending_machine_order_goods` ADD `discountprice` DECIMAL(10,2) NOT NULL COMMENT '会员优惠金额';
ALTER TABLE `ims_vending_machine_payment` ADD `sub_cert_file` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , ADD `sub_key_file` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

INSERT INTO `ims_vending_machine_plugin` (`id`, `displayorder`, `identity`, `category`, `name`, `version`, `author`, `status`, `thumb`, `desc`, `iscom`, `deprecated`, `isv2`) VALUES (NULL, '52', 'iccard', 'sale', 'IC卡', '1.0', '官方', '0', '', '', '0', '0', '1');
CREATE TABLE `ims_vending_machine_iccard_category` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `catename` varchar(255) DEFAULT '',
  `createtime` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `thumb` varchar(500) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


ALTER TABLE `ims_vending_machine_iccard_category`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `idx_uniacid` (`uniacid`) USING BTREE;


ALTER TABLE `ims_vending_machine_iccard_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
CREATE TABLE `ims_vending_machine_iccard` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `cardsn` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0停用 1启用',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `del_time` int(11) NOT NULL DEFAULT '0',
  `isdelete` tinyint(11) NOT NULL DEFAULT '0',
  `bind_time` int(11) NOT NULL DEFAULT '0',
  `cardid` varchar(255) NOT NULL COMMENT '卡ID 卡密',
  `cateid` int(11) NOT NULL,
  `mid` int(11) NOT NULL COMMENT '绑定用户ID',
  `merchid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


ALTER TABLE `ims_vending_machine_iccard`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uniacid` (`uniacid`,`cardsn`),
  ADD UNIQUE KEY `uniacid_2` (`uniacid`,`cardid`);


ALTER TABLE `ims_vending_machine_iccard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `ims_vending_machine_device_cardreader` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '' COMMENT '名称',
  `device_id` int(11) NOT NULL,
  `senid` int(11) NOT NULL COMMENT '传感器序列号',
  `lock_id` int(11) NOT NULL COMMENT '门锁id'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


ALTER TABLE `ims_vending_machine_device_cardreader`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniacid` (`uniacid`,`device_id`,`senid`);


ALTER TABLE `ims_vending_machine_device_cardreader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
ALTER TABLE `ims_vending_machine_order` ADD `iccardid` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'IC卡卡密';
CREATE TABLE `ims_vending_machine_iccard_log` (
  `id` int(11) NOT NULL,
  `uniacid` int(11) DEFAULT '0',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `cardid` varchar(255) NOT NULL COMMENT '卡ID 卡密',
  `device_id` int(11) NOT NULL,
  `senid` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;


ALTER TABLE `ims_vending_machine_iccard_log`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uniacid` (`uniacid`);


ALTER TABLE `ims_vending_machine_iccard_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
";
//pdo_run($sql);