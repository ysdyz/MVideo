$(function () {
    var title = '';
    $.ajax({
        type: "get",
        url: "/data/dataplay.php?id=" + id,
        async: true,
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                title = data.title;
                $('.container').css('display', 'block');
                $('.zzjz').remove();
                for (var i = 0; i < Object.keys(data.result).length; i++) {
                    $('#playlist ul').append("<li><a href=\"javascript:void(0);\" data=\"" + data.result[i].url + "\">" + data.result[i].collection + "</a></li>");
                }
                $('#ifrvideo').attr('src', $('#playlist ul li:eq(0) a').attr('data'));
                $('.name').text(title + ' - ' + $('#playlist ul li:eq(0) a').text());
            }else{
                $('.jz').text('系统繁忙请稍后再试！');
            }
        }
    });
    $(document.body).on("click", "li a", function () {
        $('#ifrvideo').attr('src', $(this).attr('data'));
        $('.name').text(title + ' - ' + $(this).text());
    });
});