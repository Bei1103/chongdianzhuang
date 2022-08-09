<?php


if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Debug_Page extends WebPage
{

    function main()
    {
        phpinfo();
    }


}