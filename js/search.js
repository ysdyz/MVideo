function jiazai(key) {
    $.ajax({
        type: "get",
        url: "/data/datasearch.php?key="+ key,
        async: true,
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                if (Object.keys(data.result).length == 0) {
                    $('.jz').text('找不到关于 ' + key + ' 的相关结果');
                }else{
                    $('.jz').remove();
                    for (var i = 0; i < Object.keys(data.result).length; i++) {
                        $('.table tbody').append("<tr><td><a href=\"javascript:void(0);\" data-id=\"" + data.result[i].id + "\">" + data.result[i].title + "</a></td><td>" + data.result[i].category + "</td><td>" + data.result[i].date + "</td></tr>");
                    }
                }
            }else{
                $('.jz').text('系统繁忙请稍后再试！');
            }
        }
    });
}

$(function () {
    jiazai(key);
    $(document.body).on("click", "td a", function () {
        window.location = "/play/" + $(this).attr('data-id');
    });
});