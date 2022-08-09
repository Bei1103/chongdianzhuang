define(['core', 'tpl'], function (core, tpl) {
    var modal = {params: {}};
    modal.init = function (params) {
        modal.params.orderid = params.orderid;
        modal.params.refundid = params.refundid;
        $('.refund-container-uploader').uploader({
            uploadUrl: core.getUrl('util/uploader'),
            removeUrl: core.getUrl('util/uploader/remove')
        });
        $('.btn-submit').click(function () {
            if ($(this).attr('stop')) {
                return
            }
            $(this).attr('stop', 1).html('正在处理...');
            core.json('newstore/norder/refund/submit', {
                'id': modal.params.orderid,
                'reason': $('#reason').val(),
                'content': $('#content').val()
            }, function (ret) {
                if (ret.status == 1) {
                    location.href = core.getUrl('newstore/norder/detail', {id: modal.params.orderid});
                    return
                }
                $('.btn-submit').removeAttr('stop').html('确定');
                FoxUI.toast.show(ret.result.message)
            }, true, true)
        });
        $('.btn-cancel').click(function () {
            if ($(this).attr('stop')) {
                return
            }
            FoxUI.confirm('确定您要取消申请?', '', function () {
                $(this).attr('stop', 1).attr('buttontext', $(this).html()).html('正在处理..');
                core.json('newstore/norder/refund/cancel', {'id': modal.params.orderid}, function (postjson) {
                    if (postjson.status == 1) {
                        location.href = core.getUrl('newstore/norder/detail', {id: modal.params.orderid});
                        return
                    } else {
                        FoxUI.toast.show(postjson.result.message)
                    }
                    $('.btn-cancel').removeAttr('stop').html($('.btn-cancel').attr('buttontext')).removeAttr('buttontext')
                }, true, true)
            })
        });
    };
    return modal
});