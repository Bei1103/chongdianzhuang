<?php


if (!defined('IN_IA')) {
	exit('Access Denied');
}

class Index_Page extends WebPage {

	function main() {
		
		if(cv('finance.recharge.view')){
			header('location: '.webUrl('finance/log/recharge'));
		} else if(cv('finance.withdraw.view')){
			header('location: '.webUrl('finance/log/withdraw'));
		} else if(cv('finance.downloadbill')){
			header('location: '.webUrl('finance/downloadbill'));
		}elseif(cv('finance.credit.credit1')){
            header('location:'.webUrl('finance.credit.credit1'));
        }elseif(cv('finance.credit.credit2')){
            header('location:'.webUrl('finance.credit.credit2'));
        }else{
			header('location: '.webUrl());
		}
	}
}