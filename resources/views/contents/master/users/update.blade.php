<section class="content-header">
  <h1>
    User
    <small>Master</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><i class="fa fa-database"></i> Master</a></li>
    <li><a href="{{url('master/users')}}"><i class="fa fa-users"></i> User</a></li>
    <li class="active"><i class="fa fa-pencil"></i> Update</a></li>
  </ol>
</section>

<section class="content">
    <div class="box">
      <div class="box-body">
        <div class="col-md-12">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs ">
              <li class=""><a href="#tab1" data-toggle="tab" aria-expanded="false"><b>Update</b></a></li>
              <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="true"><b>Reset Password</b></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane " id="tab1">
                {{ Form::open(array('url' => 'master/users/update/'.$users->idusers, 'class' => 'form-horizontal')) }}
                <div class="form-group">
                  <label class="col-sm-2 control-label">NIK</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$users->nik}}" name="nik" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="{{$users->name}}" name="name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" value="{{$users->email}}" name="email" required>
                  </div>
                </div>

                <div class="form-group">
                   <label class="col-sm-2 control-label">Role</label>
                   <div class="col-sm-10">
                     <select class="form-control" name="role" required>
                       <option value="">-- choose Type --</option>
                       <option value="s" @if ($users->role == 's') selected @endif> Security</option>
                       <option value="l" @if ($users->role == 'l') selected @endif> Supervisor</option>
                       <option value="m" @if ($users->role == 'm') selected @endif> Manager</option>

                     </select>
                   </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="active" @if($users->active == TRUE)
                           checked
                        @endif> Active
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <a href="{{url('master/users')}}" class="btn btn-warning pull-right">Back</a>
                    <input type="submit" value="Save" class="btn btn-primary">
                  </div>
                </div>
                {{ Form::close() }}
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane " id="tab2">
                {{ Form::open(array('url' => 'master/users/reset-password/'.$users->idusers, 'class' => 'form-horizontal')) }}
                <div class="form-group">
                  <label class="col-sm-2 control-label">Current Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control"  name="current_password" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">New Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control"  name="password" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="password-confirm">Re-Password</label>
                  <div class="col-sm-10">
                    <input type="password"  id="password-confirm" class="form-control" name="password_confirmation" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <a href="{{url('master/users')}}" class="btn btn-warning pull-right">Back</a>
                    <input type="submit" value="Save" class="btn btn-primary">
                  </div>
                </div>

                {{ Form::close() }}
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab3">

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
      </div>
    </div>
    <!-- modal delete confirmation -->
 <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
   <div class="modal-dialog modal-sm" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="exampleModalLabel">Warning</h4>
       </div>
       <div class="modal-body">
         <center>Sure to delete this user ?</center>
       </div>
       <div class="modal-footer">
         {{ Form::open(array('url' => 'master/users/delete/'.$users->idusers, 'method' => 'delete')) }}
         <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
         <button type="submit" class="btn btn-danger">Yes</button>
         {{ Form::close() }}
       </div>
     </div>
   </div>
 </div>

 <script type="text/javascript">
  $('#tab1').addClass('active');
  $('#tab1').val(true);

  $( "#tab1" ).click(function() {
    $('#tab1').addClass('active');
    $('#tab2').addClass('');
  });

  $( "#tab2" ).click(function() {
    $('#tab2').addClass('active');
    $('#tab1').addClass('');
  });
 </script>
