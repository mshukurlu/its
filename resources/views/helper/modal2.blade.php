<!-- Modal -->
<div class="modal fade" id="example2Modal" tabindex="-1" role="dialog" aria-labelledby="example2ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="updateErrors" style="color:red">

                </div>
                <form action="" id="updateForm">
                    {{csrf_field()}}
                    <div class="form-group" style="display: none">
                        <label for="exampleInputEmail1">Id</label>
                        <input type="text" name="id" class="form-control" id='inputId' placeholder="Enter name">

                        <span id="errorName"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" id='inputName' placeholder="Enter name">

                        <span id="errorName"></span>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id='inputEmail' placeholder="Enter email">
                        <span id="errorEmail"></span>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" class="form-control" id='inputPassword' placeholder="Enter password">
                        <span id="errorPassword"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter phone</label>
                        <input type="email" name="phone" class="form-control" id='inputPhone' placeholder="Enter phone">
                        <span id="errorPhone"></span>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="updateUser" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>