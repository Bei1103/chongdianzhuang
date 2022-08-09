define(['core', 'tpl'], function (core, tpl) {

    var modal = {
        params:  {
                page: "1",              //当前页数
                keywords: "",       //关键词
                citycode: '',          //城市code
                renqi: '',               //人气
                distance:'',            //距离
                order: 'id',              //排序
                storegroup: '',     //门店分组
                category:0,       //门店分类
                by: 'desc',
                needget : 0,
                lat:"",
                lng:"",
                city:"",
                city_code:"",
                by:"SORT_ASC"
            }
    };
    modal.init = function (params) {
        modal.params = $.extend(modal.params, params || {});

        if(modal.params.needget==1)
        {
            modal.getData();
        }else
        {
            var leng = $.trim($('#container').html());
            if (leng == '') {
                modal.params.page = 1;
                modal.getList();
            }
        }


        $('.intell').unbind('click').click(function () {
            var type = $(this).data('type');
            var by = $(this).data('by');

            modal.params.page = 1;
            modal.params.order = type;
            modal.params.by = by;

            $('.intell').removeClass('active');
            $(this).addClass('active');

            $('#container').html('');

            modal.getList();

            $('.fui-mask-m').css({display:'none'})
            $('.intelligent').removeClass('in')
            $('.distance').removeClass('in')
            $('.category').removeClass('in')
        });

        $('.distan').unbind('click').click(function () {
            var num = $(this).data('num');

            modal.params.page = 1;
            modal.params.distance = num;

            $('.distan').removeClass('active');
            $(this).addClass('active');

            $('#container').html('');

            modal.getList();

            $('.fui-mask-m').css({display:'none'})
            $('.intelligent').removeClass('in')
            $('.distance').removeClass('in')
            $('.category').removeClass('in')
        });

        $('.cates').unbind('click').click(function () {
            var category = $(this).data('category');

            modal.params.page = 1;
            modal.params.category = category;

            $('.cates').removeClass('active');
            $(this).addClass('active');

            $('#container').html('');

            modal.getList();

            $('.fui-mask-m').css({display:'none'})
            $('.intelligent').removeClass('in')
            $('.category').removeClass('in')
            $('.category').removeClass('in')
        });

        $('.keywords').unbind('change').change(function () {
            var keyw = $(this).val();

            modal.params.page = 1;
            modal.params.keywords = keyw;
            $('#container').html('');

            modal.getList();
        });



/*        $('#search').bind('input propertychange', function () {
            if ($.trim($(this).val()) == '') {
                $('.container').empty();
                $('.sort .item-price').removeClass('desc').removeClass('asc');
                modal.params = defaults;
                modal.page = 1;
                modal.params.keywords = '';
                modal.getList()
            }
        });*/


        $('.fui-content').infinite({
            onLoading: function () {
                modal.getList()
            }
        });

    };
    modal.getList = function () {
        core.json('newstore/stores/get_list', modal.params, function (ret) {

            $('.infinite-loading').hide();

            var result = ret.result;
            if (result.total <= 0) {
                $('.content-empty').show();
                $('.fui-content').infinite('stop')
            } else {
                $('.content-empty').hide();
                $('.fui-content').infinite('init');
                if (result.list.length <= 0 || result.list.length < result.pagesize) {
                    modal.stopLoading = true;
                    $('.fui-content').infinite('stop')
                }
            }
            modal.params.page++;

            core.tpl('#container', 'tpl_store_list', result,modal.params.page > 1);
        })
    };


    modal.getData = function () {
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function (r) {
            var _this = this;
            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                modal.params.lat = r.point.lat;
                modal.params.lng = r.point.lng;
            }
            core.json('newstore/api/location', {lat: modal.params.lat, lng: modal.params.lng}, function (ret) {
                var result = ret.result;
                modal.params.city = result.addressLocation.city;
                modal.params.city_code = result.addressLocation.city_code;

                var leng = $.trim($('#container').html());
                if (leng == '') {
                    modal.page = 1;
                    modal.getList();
                }


            }, {enableHighAccuracy: true})
        })
    };

    return modal
});