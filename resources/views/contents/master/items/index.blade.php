<section class="content-header">
    <h1>
      Master Equipment
      {{-- <small>Master</small> --}}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-inbox"></i> Master Equipment</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Index</h3>
        <div class="box-tools pull-right">
          <a href="{{url('master/item/create-new')}}" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="example2">
            <thead>
              <tr>
                <th>No</th>
                <th>Name</th>
                <th>Merk</th>
                <th>Unit</th>
                <th>Country Made</th>
                <th>Code Unit</th>

                <th>Active</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $index => $item)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->merk}}</td>
                  <td>{{$item->unit }}</td>
                  <td>{{$item->country_made }}</td>
                  <td>{{$item->code_unit }}</td>
                  <td>
                    @if ($item->active == TRUE)
                      <span class="label label-success">Active</span>
                    @else
                      <span class="label label-danger">In Active</span>
                    @endif
                  </td>
                  <td><a class="" href="{{url('master/item/update/'.$item->iditems)}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a></td>
                </tr>
              @endforeach
            </tbody>
        </div>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
