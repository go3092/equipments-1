<section class="content-header">
  <h1>
     Profile
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><i class="fa fa-user"></i> profile</li>
  </ol>
</section>


<section class="content">
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      @if ($users->role == 'a')
        @php
          $roles = 'Admin';
        @endphp
      @elseif($users->role == 's')
        @php
          $roles = 'Security';
        @endphp
      @elseif ($users->role == 'l')
        @php
          $roles = 'Supervisor';
        @endphp
      @elseif ($users->role == 'm')
        @php
          $roles = 'Manager';
        @endphp
      @endif
      <div class="box box-success">
        <div class="box-body box-profile">
          @if ($users->photos != NULL )
            <img class="profile-user-img img-responsive img-circle" src="{{env('CDN_URL')}}user_image/{{$users->photos}}" alt="User profile picture">
          @else
            <img src="{{env('ADMINLTE')}}dist/img/default-image.png" class="profile-user-img img-responsive img-circle" alt="User Image">

          @endif
          <h3 class="profile-username text-center">{{$users->name}}</h3>
          <p class="text-muted text-center">{{$roles}}</p>
        </div>
      </div>
    </div>



    <div class="col-md-9">
      <div class="nav-tabs-custom box box-success">
        <div class="tab-content">
          <label > </label>
          {{ Form::open(array('url' => 'profile/', 'class' => 'form-horizontal', 'files' => 'true')) }}
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Name</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="inputName" required value="{{$users->name}}">
              </div>
            </div>
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">NIK</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="nik" id="inputName" required value="{{$users->nik}}">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>

              <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="inputEmail" required value="{{$users->email}}">
              </div>
            </div>

          <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Role</label>
              <div class="col-sm-10">

                <input type="text" class="form-control" id="inputName" value="{{$roles}}" readonly>
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Upload</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="photos" id="photos">
                <small class="text-danger">size image 220 x 220 pixels</small>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success" >Save</button>
              </div>
            </div>
          {{Form::close()}}
        </div>
      </div>
    </div>
  </div>

</section>
