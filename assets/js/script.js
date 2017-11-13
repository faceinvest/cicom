$(document).ready(function() {

    $('textarea[id^="text_"]').summernote({
        lang: "ru-RU",
        height: 150,
    });

    $('button[id^="send_comment_"]').on('click', function () {

        var parent_id = this.id.slice(13);
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        var title = '';
        var theme_id = '';
        if(!parent_id)
        {
            parent_id = 0;
            theme_id = document.getElementById('theme_id').value;
            title = document.getElementById('title_'+parent_id).value;
        }
        var text = $('#text_'+parent_id).summernote('code');

        $.ajax({
            type: "POST",
            url: '/users/add_comment/',
            dataType: "text",
            data: {
                'csrf_test_name' : csrf_test_name,
                'title' : title,
                'theme_id' : theme_id,
                'text' : text,
                'parent_id' : parent_id
            },
            success: function(result) {
                    var res = JSON.parse(result);
                    $('#csrf_test_name').val(res.csrf);
                    $("#comments_"+parent_id).prepend(res.append);

            }
        });
    });

    $('body').on( 'click', '.reply', function(){
        var comment = this.id.slice(6);
        var id = '#add_comment_'+comment;
        var user;
        $('body').on('click', '.user', function(){
            user = $(".user").val();
            alert(1);
        });

        var text = "<b>"+user+",</b>";

        alert(user);
        $('#text_'+comment).summernote('code', text);
        $(id).slideToggle();
    });

    $('button[id^="quote_"]').click(function(){
        var comment = this.id.slice(6);
        var id = '#add_comment_'+comment;
        var user = $("#user_com_"+comment).html();
        var t = $("#t_"+comment).html();
        var text = "<b>"+user+",</b><blockquote><p>"+t+"</p></blockquote><br>";
        $('#text_'+comment).summernote('code', text);
        $(id).slideToggle();
    });

    $('button[id^="cancel_comment_"]').click(function(){
        var comment = this.id.slice(15);
        var id = '#add_comment_'+comment;
        $(id).slideToggle();
    });

    $('button[id^="delete_"]').bind("click", function(event) {
        var id = this.id.slice(7);
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
                    $('#comment_'+id).html('<div class="text-danger">Комментарий удален</div>');
                }
                else alert("Error");
            }
        });
    });

    $('#all_comments').click(function () {
        var csrf_test_name = $("input[name=csrf_test_name]").val();
        $.ajax({
            url: "/users/all_comments",
            type: "POST",
            dataType: "text",
            data: {
                'csrf_test_name' : csrf_test_name
            },
            success: function(result) {
                if (result) {
                    var res = JSON.parse(result);
                    $('#csrf_test_name').val(res.csrf);
                    $("#comments_0").append(res.append);
                }
                else alert("Error");
            }
        })
        $('#all_comments').remove();
    });
});