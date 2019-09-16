function ajaxAction(obj, type) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: '/' + type + '/' + obj[0].className,
        data: type + '_id=' + obj.data('id'),
        success: function (data) {
            obj.attr('class', data);
            let child = $(obj).children()[0];
            let text = $(child).children()[0];
            let newText = data == 'follow' ? 'Подписаться' : 'Отписаться';
            let newClass = data == 'follow' ? 'btn_subscribe' : 'btn_unscribe';
            if (type == 'users')
            {
                newClass = data == 'follow' ? 'subscribe' : 'unscribe';
            }
            $(text).text(newText);
            $(child).removeClass();
            $(child).addClass(newClass).addClass('profile_user_btn');
        },
        error: function (data) {
            alert(data);
        }
    });
}
