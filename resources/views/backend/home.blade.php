@extends('backend.layout')
@section('content')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Add new
    </button>
    <table  id="table_id">
        <thead>
        <tr>
            <td>ID</td>
            <td>NAME</td>
            <td>EMAIL</td>
            <td>PHONE</td>
            <td>Edit/Delete</td>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>



  @include('helper.modal1')
    @include('helper.modal2')
@endsection
@section('scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript">

        $('#table_id').DataTable( {
            'processing': true,
            'serverSide': true,
            ajax: {
                url: '/api/users',
                dataSrc: 'data'
            },
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                {
                    data: null,

                    defaultContent: ' <button type="button" id="editor_edit" class="btn btn-primary" data-toggle="modal" data-target="#example2Modal">\n' +
                        '      EDIT\n' +
                        '    </button> / <a href="" class="editor_remove">Delete</a>'
                }
            ]
        } );

    </script>

    <script>
        $(document).ready(function()
        {
            $('#addNew').click(function () {

            });

            $('#saveUser').on('click', function(e) {
                e.preventDefault();
                console.log('loged');
                $.ajax({
                    type: "POST",
                    url: "/api/users",
                    data: $('#addForm').serialize(),
                    success: function(response) {
                        alert(response['response']);
                    },
                    error: function(response) {

                        var response2 = JSON.parse(response.responseText);
                        var errorString = '<ul>';
                        $.each( response2.errors, function( key, value) {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul>';
                        $('#addErrors').html(errorString);
                    }
                });
                return false;
            });

            $('#table_id').on('click', '#editor_edit', function (e) {
                e.preventDefault();

                var name = $(this).parent().parent().find('td').eq(1).html();
                var id = $(this).parent().parent().find('td').eq(0).html();
                var phone = $(this).parent().parent().find('td').eq(3).html();
                var email = $(this).parent().parent().find('td').eq(2).html();

                $("#inputName").val(name);
                $("#inputId").val(id);
                $("#inputPhone").val(phone);
                $("#inputEmail").val(email);
            } );

            $("#updateUser").on('click', function(e) {
                e.preventDefault();
                console.log('loged');
                $.ajax({
                    type: "PUT",
                    url: "/api/users",
                    data: $('#updateForm').serialize(),
                    success: function(response) {
                        alert(response['response']);
                        $('#table_id').data.reload();
                    },
                    error: function(response) {
                      //  alert('Error');

                        var response2 = JSON.parse(response.responseText);
                        var errorString = '<ul>';
                        $.each( response2.errors, function( key, value) {
                            errorString += '<li>' + value + '</li>';
                        });
                        errorString += '</ul>';
                        $('#updateErrors').html(errorString);
                    }
                });
                return false;
            });
        });
    </script>
@endsection