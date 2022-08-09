define(['core', 'tpl'], function (core, tpl) {
    var modal = {};
    modal.init = function (params) {
        modal.lat = '';
        modal.lng = '';
        modal.city = params.city;
        modal.city_code = params.city_code;
        modal.check_city = params.check_city;
        modal.check_city_code = params.check_city_code;

        $('.city-group').click(function () {
            modal.check_city_code = $(this).attr("data-value");
            modal.check_city = $(this).html();
            core.json('newstore/api/checkCity', {check_city: modal.check_city, check_city_code: modal.check_city_code}, function (ret) {
                var status = ret.status;
                if (status) {
                    // location.href = core.getUrl('newstore/stores/area');
                    location.href = core.getUrl('newstore/stores');
                    return
                }
            }, {enableHighAccuracy: true})
        });

        $(".retrieval span").click(function() {
            var move = $(this).data('letter');
            var elm = $("#"+ move);
            if(elm.length>0){
                $('.fui-content').stop().animate({scrollTop: elm.position().top}, 800);
            }
        });

        modal.getData()


    };
    modal.getData = function () {
        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function (r) {
            var _this = this;
            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                modal.lat = r.point.lat;
                modal.lng = r.point.lng;
            }

            core.json('newstore/api/location', {lat: modal.lat, lng: modal.lng,check_city: modal.check_city, check_city_code: modal.check_city_code}, function (ret) {
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