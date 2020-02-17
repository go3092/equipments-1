<style media="screen">

</style>
<section class="content-header">
  <h1>
    User
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('master/users')}}"><i class="fa fa-users"></i> User</a></li>
    <li class="active"><i class="fa fa-plus"></i> Create New</a></li>
  </ol>
</section>

<section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Create New</h3>
      </div>
      <div class="box-body">
        {{ Form::open(array('url' => 'master/users/create-new/', 'class' => 'form-horizontal')) }}

        <div class="form-group">
          <label class="col-sm-2 control-label">Nik</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="nik" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Role</label>
          <div class="col-sm-10">
            <select class="form-control" name="role" required>
              <option value=""> -- select role --</option>
              <option value="l"> Supervisor </option>
              <option value="s"> Security </option>
              <option value="m"> Manager </option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="password" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label" for="password-confirm">Confirm Password</label>
          <div class="col-sm-10">
            <input type="password"  id="password-confirm" class="form-control" name="password_confirmation" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="active" checked> Active
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <a href="{{url('workplane')}}" class="btn btn-warning pull-right">Back</a>
            <input type="submit" value="Save" class="btn btn-primary">
          </div>
        </div>

        {{ Form::close() }}
      </div>
      <!-- /.box-body -->
    </div>
  </section>
