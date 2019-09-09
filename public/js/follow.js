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
            let text = $(obj).children()[0];
            let newText = data == 'follow' ? 'Подписаться' : 'Отписаться';
            let newClass = data == 'follow' ? 'btn btn-primary' : 'btn btn-light';
            $(text).text(newText);
            $(text).removeClass();
            $(text).addClass(newClass);
        },
        error: function (data) {
            alert(data);
        }
    });
}
