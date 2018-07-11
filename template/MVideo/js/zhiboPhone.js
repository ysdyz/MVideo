$(function () {
    var title = '';
    $.ajax({
        type: "get",
        url: "/system/mlooc_zhibo.php",
        async: true,
        dataType: "json",
        success: function (data) {
            if (data.msg == "success") {
                $('.container').css('display', 'block');
                $('.zzjz').remove();
                $('.loader').remove();
                for (var i = 0; i < Object.keys(data.phone).length; i++) {
                    $('#playlist ul').append("<li><a href=\"javascript:void(0);\" data=\"" + data.phone[i] + "\">" + data.title[i] + "</a></li>");
                }
                title = $('#playlist ul li:eq(0) a').text();
                $('#ifrvideo').attr('src', $('#playlist ul li:eq(0) a').attr('data'));
                $('.name').text(title);
                $('title').text(title);
            } else {
                $('.jz').text('emmm... 出现了一个错误，先去看一下别的剧吧！');
            }
        }
    });
    $(document.body).on("click", "li a", function () {
        $('#ifrvideo').attr('src', $(this).attr('data'));
        $('.name').text($(this).text());
        $('title').text($(this).text());
    });
});