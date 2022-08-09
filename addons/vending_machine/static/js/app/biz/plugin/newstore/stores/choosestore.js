define(['core', 'tpl'], function (core, tpl) {
    var modal = {};
    modal.init = function (params) {
        modal.lat = '';
        modal.lng = '';
        // modal.city = params.city;
        // modal.city_code = params.city_code;
        // modal.check_city = params.check_city;
        // modal.check_city_code = params.check_city_code;
        modal.storeid = 0;
        modal.keywords = '';
        modal.goodsid = params.goodsid;
        modal.istrade=0;
        // alert(modal.goodsid);

        modal.getList();

        // $('.city-group').click(function () {
        //     modal.check_city_code = $(this).attr("data-value");
        //     modal.check_city = $(this).html();
        //     core.json('newstore/api/checkCity', {check_city: modal.check_city, check_city_code: modal.check_city_code}, function (ret) {
        //         var status = ret.status;
        //         if (status) {
        //             location.href = core.getUrl('newstore/stores/area');
        //             return
        //         }
        //     }, {enableHighAccuracy: true})
        // });

        $('form').submit(function () {
            $('#store_list').empty();
            modal.keywords = $('#search').val();
            modal.getList();
            return false
        });
    };

    modal.getList = function () {
        core.json('newstore/stores/chosestore/get_list', {keywords: modal.keywords, goodsid: modal.goodsid}, function (ret) {
            var result = ret.result;
            $('#store_list').html(result.html);
            console.log(result.html);


            $('.store-group').unbind('click').click(function () {
                modal.storeid = $(this).attr('data-id');

                core.json('newstore/stores/chosestore/chose', {storeid: modal.storeid}, function (ret) {
                    var result = ret.result;
                    if(modal.istrade==1){
                        location.href = core.getUrl('newstore/trade/detail',{id:modal.goodsid,storeid:modal.storeid});
                    }else{
                        location.href = core.getUrl('newstore/goods/detail',{id:modal.goodsid,storeid:modal.storeid});
                    }
                }, {enableHighAccuracy: true})
            })
        })
    };


    modal.getData = function () {
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function (r) {
            var _this = this;
            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                modal.lat = r.point.lat;
                modal.lng = r.point.lng;
            }

            core.json('newstore/api/location', {lat: modal.lat, lng: modal.lng}, function (ret) {
                var result = ret.result;
                modal.city = result.addressLocation.city;
                modal.city_code = result.addressLocation.city_code;
                $('#city').html(modal.city);
                // $('#city').data(modal.city_code);
                $('#city').attr("data-value", modal.city_code);

                if(!modal.check_city ) {
                    $('#check_city').html(modal.city);
                }
            }, {enableHighAccuracy: true})
        })
    };

    return modal
});