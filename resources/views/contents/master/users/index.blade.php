<section class="content-header">
    <h1>
      User
      <small>Master</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><i class="fa fa-database"></i> Master</a></li>
      <li class="active"><i class="fa fa-users"></i> User</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Index</h3>
        <div class="box-tools pull-right">
          <a href="{{url('master/users/create-new')}}" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped" id="example2">
          <thead>
          <tr>
            <th>No</th>
            <th>Nik</th>
            <th>Name</th>
            <th>Role</th>
            <th>Active</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
            @foreach ($users as $index => $user)
              <tr>
                <td>{{$index+1}}</td>
                <td>{{$user->nik}}</td>
                <td>{{$user->name}}</td>
                <td>
                  @if ($user->role == 's')
                    Security
                  @elseif($user->role == 'l')
                    Supervisor
                  @elseif($user->role == 'm')
                    Manager
                  @endif
                </td>
                <td>
                  @if ($user->active == TRUE)
                    <span class="label label-success">Active</span>
                  @else
                    <span class="label label-danger">In Active</span>
                  @endif
                </td>
                <td><a class="" href="{{url('master/users/update/'.$user->idusers)}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
