<section class="content-header">
    <h1>
      Report
      <small>Energys</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('complaint')}}"><i class="fa fa-battery-three-quarters"></i> Energys Using</a></li>
      <li class="active"><i class="fa fa-file-excel-o"></i> Report</a></li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        {{ Form::open(array('url' => 'report/renergys', 'method' => 'get', 'class' => 'form-horizontal')) }}

        <div class="box-tools">
          <div class="row">
            <div class="col-sm-4">
              <small>Period</small>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date" class="form-control pull-right" id="datepickerrange" autocomplete="off" value="{{Request::get('date')}}">
              </div>
            </div>
            <div class="col-sm-3">
              <small>Cabang</small>
              <select class="form-control" name="cabang">
                <option value=""> -- select cabang --</option>
                @foreach ($equipments as $eq)
                  <option value="{{$eq->idequipments}}" @if (Request::get('cabang') == $eq->idequipments) selected @endif>{{$eq->description}} </option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-3">
              <small>Type</small>
              <select class="form-control" name="type">
                <option value=""> -- select type --</option>
                <option value="l" @if (Request::get('type') == 'l') selected @endif> Listrik </option>
                <option value="a" @if (Request::get('type') == 'a') selected @endif> Air Pam </option>
                <option value="s" @if (Request::get('type') == 's') selected @endif> Solar </option>
              </select>
            </div>

            <div class="col-sm-1">
              <small><br></small>
              <button class="btn btn-default form-control"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
            <div class="col-sm-1">
              @php
                $paramdate = str_replace(' - ', '_', Request::query('date'));
                $query = '?date='.$paramdate.'&cabang='.Request::query('cabang').'&type='.Request::query('type');
              @endphp
              <small><br></small>
              <a href="{{url('report/renergys/excel'.$query)}}" class="btn btn-success form-control"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        {{Form::close()}}

      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="">
            <thead>
              <tr>
                <th>Cabang</th>
                <th>Type</th>
                <th>Volume</th>
                <th>Period</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($energys as $energy)
                <tr>
                  <td>{{$energy->cabang}}</td>
                  <td>
                    @if ($energy->type == 'l')
                      Listrik
                    @elseif ($energy->type == 'a')
                      Air Pam
                    @elseif ($energys->type == 's')
                      Solar
                    @endif
                  </td>
                  <td>{{$energy->volume}}</td>
                  <td>{{date('Y-m-d',strtotime($energy->period))}}</td>
                  <td>{{substr($energy->desc,0,100)}}</td>
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
