$(document).ready(function() {
    // save comment to database
    $('#comment_btn').on('click', function(e) {
        e.preventDefault();
        // let name = $('#name').val();
        let comment = $('#comment').val();
        $.ajax({
            url: '../server/comment_like.php',
            type: 'POST',
            data: {
                'save': 1,
                'comment': comment,
            },
            success: function(response) {
                $('#comment').val('');
                // $('#display_area').append(response);
                console.log(response);
            }
        });
    });
    // delete from database
    // $(document).on('click', '.delete', function() {
    //     let id = $(this).data('id');
    //     $clicked_btn = $(this);
    //     $.ajax({
    //         url: 'server.php',
    //         type: 'GET',
    //         data: {
    //             'delete': 1,
    //             'id': id,
    //         },
    //         success: function(response) {
    //             // remove the deleted comment
    //             $clicked_btn.parent().remove();
    //             $('#name').val('');
    //             $('#comment').val('');
    //         }
    //     });
    // });
    let edit_id;
    let $edit_comment;
    // $(document).on('click', '.edit', function() {
    //     edit_id = $(this).data('id');
    //     $edit_comment = $(this).parent();
    //     // grab the comment to be editted
    //     let name = $(this).siblings('.display_name').text();
    //     let comment = $(this).siblings('.comment_text').text();
    //     // place comment in form
    //     $('#name').val(name);
    //     $('#comment').val(comment);
    //     $('#submit_btn').hide();
    //     $('#update_btn').show();
    // });
    // $(document).on('click', '#update_btn', function() {
    //     let id = edit_id;
    //     let name = $('#name').val();
    //     let comment = $('#comment').val();
    //     $.ajax({
    //         url: 'server.php',
    //         type: 'POST',
    //         data: {
    //             'update': 1,
    //             'id': id,
    //             'name': name,
    //             'comment': comment,
    //         },
    //         success: function(response) {
    //             $('#name').val('');
    //             $('#comment').val('');
    //             $('#submit_btn').show();
    //             $('#update_btn').hide();
    //             $edit_comment.replaceWith(response);
    //         }
    //     });
    // });
});