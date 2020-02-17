<section class="content-header">
    <h1>
      Energy Using
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-battery-three-quarters"></i> Energy Using</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Index</h3>
        <div class="box-tools pull-right">
          <a href="{{url('energys/create-new')}}"  class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a>
          <a href="{{url('energys/report')}}"  class="btn btn-box-tool" title="Create New"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Report</a>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="example2">
            <thead>
              <tr>
                <th>No</th>
                <th>Type</th>
                <th>Volume </th>
                <th>Period</th>
                <th>Desc</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($energys as $index => $energy)
                <tr>
                  <td>{{$index+1}}</td>
                  <td>
                    @if ($energy->type == 'l')
                      Listrik
                    @elseif ($energy->type == 'a')
                      Air Pam
                    @elseif ($energy->type == 's')
                      Solar
                    @endif
                  </td>
                  <td>{{number_format($energy->volume)}}</td>
                  <td>{{date('Y-m-d', strtotime($energy->period)) }}</td>
                  <td>{{$energy->desc}}</td>
                  <td>
                    <a class="" href="{{url('energys/update/'.$energy->idenergys)}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                  </td>
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
