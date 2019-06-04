@extends('backend.layout')
@section('content')
    <button type="button" id="addNew" class="btn btn-primary" data-toggle="modal" data-target="#example2Modal">
      Add new
    </button>
    <hr/>
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
    @include('helper.modal2')
@endsection
@section('scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script type="text/javascript">

     var table2 =  $('#table_id').DataTable( {
            'processing': true,
            'serverSide': true,
            ajax: {
                url: '/api/users',
                dataSrc: 'data'
            },
            "columnDefs": [
                {  targets: "_all", }
            ],
            columns: [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'phone' },
                {
                    data: null,
                    orderable:false,
                    defaultContent: ' <button type="button" id="editor_edit" class="btn btn-primary" data-toggle="modal" data-target="#example2Modal">\n' +
                        '      EDIT\n' +
                        '    </button> / <button  href="" class="btn btn-danger editor_remove">Delete</button>'
                }
            ]
        } );

    </script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function()
        {

            function getSelectedRowData(that)
            {
                var tr = that.closest('tr');

                var data = tr.children('td').map(function()
                {
                    return $(this).text();
                }).get();

                console.log('data');
                return data;
            }

            //update,new
            function callAjax(id)
            {
                var type;

                if(id==0)
                {
                    type='POST';
                }else
                {
                    type='PUT';
                }
                    $.ajax({
                        type: type,
                        url: "/api/users",
                        data: $('#updateForm').serialize(),
                        success: function(response) {
                            alert(response['response']);
                            $('#table_id').DataTable().ajax.reload();
                        },
                        error: function(response) {

                            var response2 = JSON.parse(response.responseText);
                            var errorString = '<ul>';
                            $.each( response2.errors, function( key, value) {
                                errorString += '<li>' + value + '</li>';
                            });
                            errorString += '</ul>';
                            $('#updateErrors').html(errorString);
                        }
                    });


            }

            function deleteUserAjaxRequest(id)
            {
                $.ajax({
                    type: 'DELETE',
                    url: "/api/users/"+id,
                    data: {},
                    success: function(response) {
                        alert(response['response']);

                        table2.ajax.reload();
                    },
                    error: function(response) {
                      alert(response.responseText);
                    }
                });
            }

            $('#table_id').on('click', '.editor_remove', function (e) {
                e.preventDefault();
                if(confirm('Silinsin?'))
                {
                    var data = getSelectedRowData($(this));
                    deleteUserAjaxRequest(data[0]);
                }
            });


            $("#addNew").click(function (e) {
                $("#exampleModalLabel").html('Əlavə et');
                $("#updateForm").trigger('reset');
                $("#updateErrors").html('');
            });

            $('#saveUser').on('click', function(e) {
                e.preventDefault();
                var id = $('#inputId').val();

                if(!id)
                {
                    id=0;
                }

                callAjax(id);

                return false;
            });

            $('#table_id').on('click', '#editor_edit', function (e) {
                e.preventDefault();
                $("#updateErrors").html('');
                data = getSelectedRowData($(this));

                $("#inputName").val(data[1]);
                $("#inputId").val(data[0]);
                $("#inputPhone").val(data[3]);
                $("#inputEmail").val(data[2]);

                $("#exampleModalLabel").html(data[1]+" istifadəçini yenilə");
            } );

            $("#updateUser").on('click', function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "/api/users",
                    data: $('#updateForm').serialize(),
                    success: function(response) {
                        alert(response['response']);
                        $('#updateErrors').html('');
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