$(function () {
    var title = '';
    $.ajax({
        type: "get",
        url: "/system/mlooc_play.php?id=" + id,
        async: true,
        dataType: "json",
        success: function (data) {
            if (data.status == "success") {
                title = data.title;
                $('.container').css('display', 'block');
                $('.zzjz').remove();
                $('.loader').remove();
                for (var i = 0; i < Object.keys(data.result).length; i++) {
                    $('#playlist ul').append("<li><a href=\"javascript:void(0);\" data=\"" + data.result[i].url + "\">" + data.result[i].collection + "</a></li>");
                }
                $('#ifrvideo').attr('src', $('#playlist ul li:eq(0) a').attr('data'));
                $('.name').text(title + ' - ' + $('#playlist ul li:eq(0) a').text());
                $('title').text(title + ' - ' + $('#playlist ul li:eq(0) a').text());
            } else {
                $('.jz').text('emmm... 出现了一个错误，先去看一下别的剧吧！');
            }
        }
    });
    $(document.body).on("click", "li a", function () {
        $('#ifrvideo').attr('src', $(this).attr('data'));
        $('.name').text(title + ' - ' + $(this).text());
        $('title').text(title + ' - ' + $(this).text());
    });
});