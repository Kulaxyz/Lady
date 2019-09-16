$(document).ready(function () {
    // $('#load-more').click(
    //     function () {
    //         console.log(14);
    //         let ids = [];
    //         let posts = $('.tape-content');
    //         for (let post of posts) {
    //             if ($(post).data('id') != null) {
    //                 ids.push($(post).data('id'));
    //             }
    //         }
    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             type: "POST",
    //             url: $(location).attr("href"),
    //             data: {ids: ids},
    //             success: function (data) {
    //                 console.log(data);
    //                 $('#posts').append(data);
    //             },
    //             error: function () {
    //                 alert(1);
    //             }
    //         });
    //     });
});
