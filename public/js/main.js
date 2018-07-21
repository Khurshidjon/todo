$(function () {
    var page = 1;

    function getDataInfo()

    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        $.ajax({
            dataType: 'json',
            method: 'GET',
            url: url,
            data: {
                page: page,
            },
            success: function (data) {
                writeData(data.data);
            },
        });
    }

    getDataInfo();
    function writeData(data) {
        var id = 1;
        var post = '';
        $.each(data, function (key, value) {
            post = post + "<tr id='todoItem'>'>";
            post = post + "<td>" + id++ + "</td>";
            post = post + "<td>" + value.title + "</td>";
            post = post + "<td>" + value.detail + "</td>";
            post = post + "<td id='data_id'>";
            post = post + "<button type='button' data-id='" + value.id + "' class='btn btn-outline-info edit-button'  data-toggle='modal' data-target='#edit-modal'>Edit</button>";
            post = post + "<button type='button' data-id='" + value.id + "' class='btn btn-outline-danger remove-button'>Delete</button>";
            post = post + "</td>";
            post = post + "</tr>";
            $('tbody').html(post);
        });
    }

//--------------------------------------------------------------------------------------------------------------------//

//Add new User

    $('body').on('click', '#regs', function (e) {
        e.preventDefault();

        var url2 = url + '/register';
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });

        $.ajax({
            url: url2,
            dataType: 'json',
            type: 'POST',
            data: {
                name: name,
                email: email,
                password: password,
            },
            success: function (data) {
                $('#registerModal').modal('hide');
                getDataInfo();
                console.log(data);
            },
        });
    });

/*End Add new User*/

//--------------------------------------------------------------------------------------------------------------------//

// Login User

    $('#login').click(function (e) {
        e.preventDefault();
        var url3 = url + '/login';
        var pochta = $('#pochta').val();
        var parol = $('#parol').val();
        var token = $('#loginForm').find("input[name='_token']").val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                }
            });

        $.ajax({
            url: url3,
            token: token,
            type: 'POST',
            dataType: 'json',
            data: {
                email: pochta,
                password: parol,
            },
            success: function (data) {
                $('#loginModal').modal('hide');
                $('#body').load(location.href + '#body');
                console.log(data);
            },
        });
    });

/*End Login User*/
//--------------------------------------------------------------------------------------------------------------------//

// Logout User

    $('#logout-user').on('click', function (e) {
        e.preventDefault();

        var LogoutURL = url + '/logout';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });

        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {
                url: LogoutURL,
            },
            success: function (data) {
                location.reload();
                console.log(data);
            }
        })
    });

/*End Logout User*/



//--------------------------------------------------------------------------------------------------------------------//



/* Add new post*/

    $('#create').click(function (e) {
        e.preventDefault();
        var title = $("#create-post").find("input[name='title']").val();
        var detail = $("#create-post").find("textarea[name='detail']").val();
        var token = $("#create-post").find("input[name='_token']").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            token: token,
            title: title,
            detail: detail,
        },
        success: function (data) {
            $('#create-modal').modal('hide');
            getDataInfo();
            console.log(data);
        },
    });
    });

/* End Add new post*/

//--------------------------------------------------------------------------------------------------------------------//

/*  Write to modal  */

    $('body').on('click', '.edit-button', function (event) {

        event.preventDefault();

        var id = $(this).data('id');

        $.get(url + '/' + id + '/edit', function (data) {

            $("#edit-post").find("input[name='id']").val(data.id);
            $("#edit-post").find("input[name='title']").val(data.title);
            $("#edit-post").find("textarea[name='detail']").val(data.detail);
        });
        console.log('Modal opened');
    });

/*End Write to modal*/

//--------------------------------------------------------------------------------------------------------------------//

/*Update TODO item*/
    $('#edit').on('click', function (e) {
        e.preventDefault();

        var id = $("#edit-post").find("input[name='id']").val();
        var urlUpdate = url + '/' + id;
        var title = $("#edit-post").find("input[name='title']").val();
        var detail = $("#edit-post").find("textarea[name='detail']").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        $.ajax({
            url: urlUpdate,
            type: 'PUT',
            dataType: 'json',
            data: {
                title: title,
                detail: detail
            },
            success: function (data) {
                $('#edit-modal').modal('hide');
                getDataInfo();
                console.log(data);
            },
        });
    });

/*End update TODO item*/

//--------------------------------------------------------------------------------------------------------------------//

/*Post delete*/
    $("body").on('click', '.remove-button', function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        var delURL = url + '/' + id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            }
        });
        $.ajax({
            dataType: 'json',
            url: delURL,
            type: 'DELETE',
            success: function (data) {
                getDataInfo();
                console.log(data);
            }
        })
    })
/*End Post delete*/

//--------------------------------------------------------------------------------------------------------------------//


});