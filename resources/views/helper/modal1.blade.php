<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="addErrors" style="color:red">

                </div>
                <form action="" id="addForm">
                    {{csrf_field()}}
                    <div class="form-group" style="display: none">
                        <label for="exampleInputEmail1">Id</label>
                        <input type="text" name="id" class="form-control"  placeholder="Enter name">

                        <span id="errorName"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control"  placeholder="Enter name">

                        <span id="errorName"></span>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                        <span id="errorEmail"></span>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" class="form-control"  placeholder="Enter password">
                        <span id="errorPassword"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter phone</label>
                        <input type="email" name="phone" class="form-control"  placeholder="Enter phone">
                        <span id="errorPhone"></span>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveUser" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>