$(document).ready(function () {
    $('textarea.wysiwyg').summernote({
        lang: "ru-RU",
        height: 150
    });

    $('button#new_send_comment').click(function () {
        var csrf = $("input[name=csrf_test_name]").val();
        var title = $('#new_title').val();
        var theme = $('#theme_id').val();
        var text = $('#new_text').val();
        if (title === ''){alert('Введите пожалуйста заголовок');return}
        if (text === ''){alert('Введите пожалуйста текст');return}

        $.ajax({
            url: '/users/add_comment',
            type: 'POST',
            data: {
                'csrf_test_name' : csrf,
                'title' : title,
                'theme_id' : theme,
                'text' : text,
                'parent_id' : 0
            },
            success: function(result) {
                var res = JSON.parse(result);
                $('#csrf_test_name').val(res.csrf);
                $('#comments').prepend(res.append);
                $('#new_title').val('');
                $('#new_text').val('');
            }
        });
    });

    $('body').on('click', 'a.delete', function (e) {
        e.preventDefault();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var id = $(this).attr("id");
        var parent_id = $(this).attr("data-id");
        $.ajax({
            url: "/users/delete_comment/",
            type: "POST",
            dataType: "text",
            data: {
                'csrf_test_name': csrf_test_name,
                'id': id,
                'parent_id': parent_id
            },
            success: function (result) {
                if (result) {
                    $('#csrf_test_name').val(result);
                    $('.comment#' + id).html('<div class="text-danger">Комментарий удален</div>')
                }
                else alert("Error");
            }
        });
    });

    $('body').on('click', 'a.reply, a.quote', function (e) {
        e.preventDefault();
        var id = $(this).attr("id");
        var cl = $(this).attr("class");
        var csrf_test_name = $("input[name=csrf_test_name]").val();


        if ($('#reply_form').length)
        {
            $('#reply_form').parent().slideToggle();
            $('#reply_form').remove();
        }

        var result = $.ajax({
                        type: "POST",
                        url: "/users/get_reply_form",
                        data: ({'csrf_test_name': csrf_test_name}),
                        dataType: "html",
                        async: false
                        }).responseText;

        var res = JSON.parse(result);
        $('#csrf_test_name').val(res.csrf);

        $(this).parent().find('#add_comment').append(res.reply_form);

        var user = $(this).parent().find('strong > a').text();
        user = '<b>'+user+',</b> &nbsp;\n';
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
                    $('#reply_form').parents('li#'+parent_id).children('#sub_comments').prepend(res.append);
                    $('#reply_form').parent().slideToggle();
                    $('#reply_form').remove();
                }
            });
        });
        $("button.cancel").click(function (e) {
            if ($('#reply_form').length)
            {
                $('#reply_form').parent().slideToggle();
                $('#reply_form').remove();
            }
        });
    });

    $('body').on('click', 'button.all_comments', function (e) {
        e.preventDefault();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var controller = $(this).attr('data-id');
        var user_id = $(this).attr('id');

        $.ajax({
            url: "/"+controller+"/all_comments/",
            type: "POST",
            dataType: "text",
            data: {
                'csrf_test_name' : csrf_test_name,
                'user_id' : user_id
            },
            success: function(result) {
                if (result) {
                    var res = JSON.parse(result);
                    $('#csrf_test_name').val(res.csrf);
                    $('ul#comments').append(res.result);
                    $('button.all_comments').remove();
                }
                else alert("Error");
            }
        });
    })

    $('button.delete').click(function (e) {
        e.preventDefault();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var id = $(this).attr("id");
        var parent_id = $(this).attr("data-id");
        $.ajax({
            url: "/users/delete_comment/",
            type: "POST",
            dataType: "text",
            data: {
                'csrf_test_name': csrf_test_name,
                'id': id,
                'parent_id': parent_id
            },
            success: function (result) {
                if (result) {
                    $('#csrf_test_name').val(result);
                    $('.comment#' + id).html('<div class="text-danger">Комментарий удален</div>')
                }
                else alert("Error");
            }
        });
    });

    $('input.act').click(function (e) {
        e.preventDefault();
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var controller = $(this).attr("data-id");
        var method = $(this).attr("id");

        $.ajax({
            url: "/"+controller+"/"+method+"/",
            type: "POST",
            dataType: "text",
            data: {
                'csrf_test_name': csrf_test_name,
            },
            success: function (result) {
                if (result) {
                    var res = JSON.parse(result);
                    $('#csrf_test_name').val(res.csrf);
                    $('div.action').append(res.action+'<br>');
                }
                else alert("Error");
            }
        });
    });
});