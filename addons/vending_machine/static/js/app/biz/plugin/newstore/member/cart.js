define(['core', 'tpl', 'biz/plugin/newstore/goods/picker', 'biz/plugin/diyform'], function (core, tpl, picker, diyform) {
    var modal = {status: 'cart',goods:[]};
    modal.init = function () {

        core.json('newstore/member/cart/get_list',{},function(ret){
            var result = ret.result;
            if(result.total>0){
                $('.btn-edit').show();
            } else{
                $('.btn-edit').hide();
            }
            modal.goods=result.list;
            //console.log(modal.goods);

            core.tpl("#cart_container",'tpl_member_cart' , ret.result , false);
            core.tpl("#footer_container",'tpl_member_cart_footer' , ret.result , false);
 
            setTimeout(function(){

                modal.bindEvents();

            },100);

        },true);
        return;


    };

    modal.bindEvents = function(){

        $('.fui-number').numbers({
            callback: function (num, container) {

                var cartid = container.closest('.goods-item').data('cartid');
                var optionid = container.closest('.goods-item').data('optionid');

                $.each(modal.goods,function(name,value) {
                    if(value.id==cartid)
                    {
                        modal.goods[name].total=num;
                    }
                });

                modal.update(cartid, num, optionid);
                modal.caculate();
            }
        });


        $('.check-item').unbind('click').click(function () {
            var cartid = $(this).closest('.goods-item').data('cartid');
            modal.select(cartid, $(this).prop('checked'))
        });
        $('.checkall').unbind('click').click(function () {
            var checked = $(this).find(':checkbox').prop('checked');
            $(".check-item").not(':disabled').prop('checked', checked);
            modal.caculate();
            modal.select('all', checked)
        });
        $('.btn-submit').unbind('click').click(function () {
            var btn = $(this);
            if (btn.attr('stop')) {
                return
            }
            var html = $(this).html();
            btn.attr('stop',1).html('????????????...');

            core.json('newstore/member/cart/submit',{}, function(ret){

                console.log(ret);
                if(ret.status!=1){

                    btn.removeAttr('stop' ).html( html );
                    if( ret.result==0){
                        FoxUI.toast.show( ret.result.message );
                    }else{
                        FoxUI.alert( ret.result.message );
                    }

                    return;
                }

                //$.router.load(core.getUrl('order/create'), true);
                location.href = core.getUrl('newstore/order/create');

            },true);

        });
        $('.btn-edit').unbind('click').click(function () {
            modal.changeMode()
        });
        $('.btn-delete').unbind('click').click(function () {
            if ($('.edit-item:checked').length <= 0) {
                return
            }
            modal.remove()
        });
        $('.btn-favorite').unbind('click').click(function () {
            if ($('.edit-item:checked').length <= 0) {
                return
            }
            modal.toFavorite()
        });
        $('.editcheckall').unbind('click').click(function () {
            var checked = $(this).find(':checkbox').prop('checked');
            $(".edit-item").prop('checked', checked);
            modal.caculateEdit()
        });
        $('.edit-item').unbind('click').click(function () {
            modal.caculateEdit()
        });
        $('.choose-option').unbind('click').click(function (e) {
            if (modal.status == 'edit') {
                e.preventDefault();
                modal.changeOption(this)
            }
        });
        modal.caculate();
    };

    modal.changeMode = function () {
        if ($('.goods-item').length <= 0) {
            $('.btn-edit').remove();
            $('.cartmode').remove();
            $('.editmode').remove();
            $('#container').remove();
            $('.content-empty').show();
            return
        }
        $('.fui-list-group').each(function (index,item) {
            if ($(item).find('.goods-item').length <= 0) {
                $(item).prev('.fui-title').remove();
                $(item).remove();
            }
        });
        if (modal.status == 'cart') {
            $('.edit-item').prop('checked', false);
            $('.editcheckall').prop('checked', false);
            $('.cartmode').hide();
            $('.editmode').show();
            modal.status = 'edit';
            $('.btn-edit').html('??????')
        } else {
            $('.cartmode').show();
            $('.editmode').hide();
            modal.status = 'cart';
            $('.btn-edit').html('??????')
        }
    };
    modal.select = function (cartid, select) {
        core.json('newstore/member/cart/select', {id: cartid, select: select ? "1" : '0'}, function (ret) {
            if (ret.status == 0) {
                FoxUI.toast.show(ret.result.message)
            }
            modal.caculate()
        }, true, true)
    };
    modal.caculate = function () {
        var total = 0;
        var totalprice = 0;

        core.json('newstore/member/cart/caculategoodsprice',{goods:modal.goods},function(ret){
            $('.goods-item').each(function () {
                var seckillmaxbuy = $(this).data('seckillMaxbuy') || 0 , seckillselfcount = $(this).data('seckillSelfcount') || 0,seckillprice = $(this).data('seckillPrice') || 0;
                if ($(this).find('.check-item').prop('checked')) {
                    var t = parseInt($(this).find('.shownum').val());
                    total += t;

                    if($(this).data('type')==4)
                    {
                        var good = ret.result.goods[$(this).data('cartid')];

                        $(this).find('.marketprice').html(good.wholesaleprice);

                        var min = good.total-(good.goodsalltotal-good.intervalnum1);

                       $(this).find('.fui-number').data('value', good.total);
                       $(this).find('.fui-number').data('min', parseInt(min)).numbers({
                           value: good.total,
                           min: parseInt(min)
                       });

                    }

                    var price = core.getNumber($(this).find('.marketprice').html());

                    if(seckillprice>0){

                        var seckilllast = 0 ;
                        if( seckillmaxbuy >0 ){
                            seckilllast = seckillmaxbuy - seckillselfcount;
                        }

                        if( seckillmaxbuy>t){
                            seckilllast = t;
                        }
                        if(seckilllast<=0){
                            seckilllast = 0;
                        }

                        var normal = t - seckilllast;
                        if(normal<=0){
                            normal =  0;
                        }

                        totalprice+= seckillprice  * seckilllast + price *  normal;
                    } else{
                        totalprice += parseInt($(this).find('.shownum').val()) * price ;
                    }
                }
                modal.update($(this).data('cartid'), t, $(this).data('optionid'));
            });
            $(".total").html(total);
            window.cartcount = total;

            if(total != 0) {
                $("#menucart span.badge").text(total).show();
            }else{
                $("#menucart span.badge").hide();
            }
            $(".totalprice").html(core.number_format(totalprice, 0));
            if (total <= 0) {
                $(".btn-submit").attr('stop', 1).removeClass('btn-danger').addClass('btn-default disabled')
            } else {
                $(".btn-submit").removeAttr('stop').removeClass('btn-default disabled').addClass('btn-danger')
            }
            $('.checkall .fui-radio').prop('checked', $('.check-item').length > 0 && $('.check-item').length == $('.check-item:checked').length)

        },false,true);
    };
    modal.caculateEdit = function () {
        $('.editcheckall .fui-radio').prop('checked', $('.edit-item').length > 0 && $('.edit-item').length == $('.edit-item:checked').length);
        var selects = $('.edit-item:checked').length;
        if (selects > 0) {
            $('.btn-delete').removeClass('disabled');
            $('.btn-favorite').removeClass('disabled')
        } else {
            $('.btn-delete').addClass('disabled');
            $('.btn-favorite').addClass('disabled')
        }
    };
    modal.update = function (cartid, num, optionid) {


        core.json('newstore/member/cart/update', {id: cartid, total: num, optionid: optionid}, function (ret) {
            if (ret.status == 0) {
                FoxUI.toast.show(ret.result.message)
            }
            var item = $(".goods-item[data-cartid='" + cartid + "']");
            if(ret.result.seckillinfo){
                item.attr('data-seckill-maxbuy' , item.seckillmaxbuy);
                item.attr('data-seckill-price' , item.seckillprice);
                item.attr('data-seckill-selfcount' , item.seckillselfcount);
            }else{
                item.removeAttr('data-seckill-maxbuy'),item.removeAttr('data-seckill-price'),item.removeAttr('data-seckill-selfcount');
            }
        }, true, true)
    };
    modal.add = function (goodsid, optionid, total, diyformdata, callback) {
        core.json('newstore/member/cart/add', {
            id: goodsid,
            optionid: optionid,
            total: total,
            diyformdata: diyformdata
        }, function (ret) {
            if (ret.status == 0) {
                FoxUI.toast.show(ret.result.message);
                if(ret.result.url){
                    setTimeout(function () {
                        location.href = ret.result.url;
                    }, 800);
                }
                return
            }
            if (callback) {
                callback(ret.result)
            }
        }, true, true)
    };

    modal.addwholesale = function (goodsid, options, callback) {
        core.json('newstore/member/cart/addwholesale', {
            id: goodsid,
            options: window.JSON.stringify(options),
        }, function (ret) {
            if (ret.status == 0) {
                FoxUI.toast.show(ret.result.message);
                if(ret.result.url){
                    setTimeout(function () {
                        location.href = ret.result.url;
                    }, 800);
                }
                return
            }
            if (callback) {
                callback(ret.result)
            }
        }, true, true)
    };


    modal.remove = function () {
        var ids = [];
        $('.edit-item:checked').each(function () {
            var cartid = $(this).closest('.goods-item').data('cartid');
            ids.push(cartid)
        });
        if (ids.length <= 0) {
            return
        }
        FoxUI.confirm('???????????????????????????????', function () {
            core.json('newstore/member/cart/remove', {ids: ids}, function (ret) {
                if (ret.status == 0) {
                    FoxUI.toast.show(ret.result.message);
                    return
                }
                $.each(ids, function () {
                    $(".goods-item[data-cartid='" + this + "']").remove()
                });
                modal.caculate();
                modal.changeMode()
            }, true, true)
        })
    };
    modal.toFavorite = function () {
        var ids = [];
        $('.edit-item:checked').each(function () {
            var cartid = $(this).closest('.goods-item').data('cartid');
            ids.push(cartid)
        });
        if (ids.length <= 0) {
            return
        }
        FoxUI.confirm('????????????????????????????????????????', function () {
            core.json('newstore/member/cart/tofavorite', {ids: ids}, function (ret) {
                if (ret.status == 0) {
                    FoxUI.toast.show(ret.result.message);
                    return
                }
                $.each(ids, function () {
                    $(".goods-item[data-cartid='" + this + "']").remove()
                });
                modal.caculate();
                modal.changeMode()
            }, true, true)
        })
    };
    modal.changeOption = function (btn) {
        var goodsitem = $(btn).closest('.goods-item');
        var goodsid = goodsitem.data('goodsid'), total = parseInt(goodsitem.find('.shownum').val()), optionid = goodsitem.data('optionid'),type=goodsitem.data('type');
        var cartid = goodsitem.data('cartid');

        picker.open({
            goodsid: goodsid,
            total: total,
            type:type,
            split: '+',
            optionid: optionid,
            showConfirm: true,
            autoClose: false,
            onConfirm: function (total, optionid, optiontitle, optionthumb) {
                if ($('.diyform-container').length > 0) {
                    var diyformdata = diyform.getData('.diyform-container');
                    if (!diyformdata) {
                        return
                    } else {
                        core.json('newstore/order/create/diyform', {
                            id: goodsid,
                            cartid: cartid,
                            diyformdata: diyformdata
                        }, function (ret) {
                            $("#gimg_"+cartid).attr('src',optionthumb);
                            $(btn).html(optiontitle);
                            goodsitem.data('optionid', optionid);
                            goodsitem.find('.fui-number').numbers('refresh', total);
                            $(".goods-item[data-cartid='" + cartid + "']").find('.cartmode .choose-option').html(optiontitle);
                            modal.caculate();
                        }, true, true);
                        picker.close()
                    }
                } else {
                    $("#gimg_"+cartid).attr('src',optionthumb);
                    $(btn).html(optiontitle);
                    goodsitem.data('optionid', optionid);
                    goodsitem.find('.fui-number').numbers('refresh', total);
                    $(".goods-item[data-cartid='" + cartid + "']").find('.cartmode .choose-option').html(optiontitle);
                    modal.caculate();
                    picker.close()
                }
            }
        })
    };
    return modal
});