$(document).ready(function () {
    $('body').on('click', 'a.reply, a.quote', function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var cl = $(this).attr("class");

        alert(id);

        $('#form').remove();
        $(this).parent().find('#add_comment').append('<div id="form"><div class="form-group"><p><textarea class="form-control wysiwyg" id="text" placeholder="Оставьте Ваш комментарий" rows="6"></textarea></p></div><button class="btn btn-info pull-right btn-sm send">Отправить</button></div>')
        $('textarea.wysiwyg').summernote({
            lang: "ru-RU",
            height: 150,
        });
        var user = $(this).parent().find('strong > a').text();
        user = '<b>'+user+',</b><br>';
        if (cl.indexOf("quote") >= 0)
        {
            var blockquote = $(this).parent().find('#text').text();
            user += '<blockquote>'+blockquote+'</blockquote><br>'
        }

        $(this).parent().find('textarea.wysiwyg').summernote('code', user);


        $(this).parent().find('#add_comment').slideToggle();
        $("button.send").click(function () {
            var csrf = $("input[name=csrf_test_name]").val();
            var text = $(this).parent().find('textarea.wysiwyg').summernote('code');
            var parent_id = $(this).parents('#add_comment').attr('data-id');

            $.ajax({
                url: '/users/add_comment',
                type: 'POST',
                data: {
                    'csrf_test_name' : csrf,
                    'text' : text,
                    'parent_id' : parent_id
                },
                success: function(result) {
                    var res = JSON.parse(result);
                    $('#csrf_test_name').val(res.csrf);
                    $('#form').parents('.comment').next('#sub_comments').prepend(res.append);
                    $('#form').remove();
                }
            });

        });
    });

    $('body').on('click', 'a.delete', function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var csrf_test_name = $("input[name=csrf_test_name]").val();

        $.ajax({
            url: "/users/delete_comment/",
            type: "POST",
            dataType: "text",
            data: {
                'csrf_test_name' : csrf_test_name,
                'id' : id
            },
            success: function(result) {
                if (result) {
                    $('#csrf_test_name').val(result);
                    $('#'+id).parent().html('<div class="text-danger">Комментарий удален</div>')
                }
                else alert("Error");
            }
        });
    });

    $('body').on('click', 'button#all_comments', function (e) {
        e.preventDefault();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        $.ajax({
            url: "/users/all_comments/",
            type: "POST",
            dataType: "text",
            data: {
                'csrf_test_name' : csrf_test_name
            },
            success: function(result) {
                if (result) {
                    $('ul#comments').append(result);
                }
                else alert("Error");
            }
        });
    })
});