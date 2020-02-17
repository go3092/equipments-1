<section class="content-header">
    <h1>
      Master Location
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-building"></i>  Master Location</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Index</h3>
        <div class="box-tools pull-right">
          <a href="{{url('level/create-new')}}" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="example2">
            <thead>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>Name</th>
                <th>Desc</th>
                <th>Active</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($levels as $index => $lev)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$lev->code}}</td>
                  <td>{{$lev->name}}</td>
                  <td>{{substr($lev->description,0,20) }}</td>
                  <td>
                    @if ($lev->active == TRUE)
                      <span class="label label-success">Active</span>
                    @endif
                  </td>
                  <td><a class="" href="{{url('level/update/'.$lev->idlevels)}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
