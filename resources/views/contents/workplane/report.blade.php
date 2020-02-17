<section class="content-header">
    <h1>
      Report
      <small>Work plan</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('complaint')}}"><i class="fa fa-list-alt"></i> Complaint</a></li>
      <li class="active"><i class="fa fa-file-excel-o"></i> Report</a></li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        {{ Form::open(array('url' => 'workplane/report', 'method' => 'get', 'class' => 'form-horizontal')) }}

        <div class="box-tools">
          <div class="row">
            <div class="col-sm-4">
              <small>Plan Date</small>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date" class="form-control pull-right" id="datepickerrange" autocomplete="off" value="{{Request::get('date')}}">
              </div>
            </div>
            <div class="col-sm-3">
              <small>Workplan Type</small>
              <select class="form-control" name="type">
                <option value=""> -- select Workplan type --</option>
                <option value="HR" @if (Request::get('type') == 'HR') selected @endif>HR (Harian) </option>
                <option value="1M" @if (Request::get('type') == '1M') selected @endif> 1M (Satu Mingguan) </option>
                <option value="1B" @if (Request::get('type') == '1B') selected @endif> 1B (Satu Bulan)</option>
                <option value="2B" @if (Request::get('type') == '2B') selected @endif> 2B (Dua Bulan)</option>
                <option value="3B" @if (Request::get('type') == '3B') selected @endif> 3B (Tiga Bulan)</option>
                <option value="6B" @if (Request::get('type') == '6B') selected @endif> 6B (Enam Bulan)</option>
                <option value="YR" @if (Request::get('type') == 'YR') selected @endif> YR (1 Tahun)</option>
              </select>
            </div>
            <div class="col-sm-3">
              <small>Action By </small>
              <select class="form-control" name="action_by">
                <option value=""> -- select action by --</option>
                <option value="i" @if (Request::get('action_by') == 'i') selected @endif> Internal  </option>
                <option value="e" @if (Request::get('action_by') == 'e') selected @endif> External </option>
              </select>
            </div>
            <div class="col-sm-1">
              <small>search</small>
              <button class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
            <div class="col-sm-1">
              @php
                $paramdate = str_replace(' - ', '_', Request::query('date'));
                $query = '?date='.$paramdate.'&type='.Request::query('type').'&status='.Request::query('action_by');
              @endphp
              <br>
              <a href="{{url('workplane/report/excel'.$query)}}" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        {{Form::close()}}

      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped" id="">
          <thead>
          <tr>
            <th>Equipment</th>
            <th>Workplan Type</th>
            <th>Week</th>
            <th>Date</th>
            <th>Type</th>
            <th>Desc</th>
            <th>Worker</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($Workplans as $work)
              <tr>
                <td>{{$work->equipment_details->items->name}}<br>
                  <small>{{$work->equipment_details->items->merk}}</small>
                 </td>
                <td>
                  @if ($work->workplan_type == 'HR')
                    HR (Harian)
                  @elseif ($work->workplan_type == '1M')
                    1M (Satu Mingguan)
                  @elseif ($work->workplan_type == '1B')
                    1B (Satu Bulan)
                  @elseif ($work->workplan_type == '2B')
                    2B (Dua Bulan)
                  @elseif ($work->workplan_type == '3B')
                    3B (Tiga Bulan)
                  @elseif ($work->workplan_type == '6B')
                    6B (Enam Bulan)
                  @elseif ($work->workplan_type == 'YR')
                    YR (1 Tahun)
                  @endif
                </td>
                <td>{{$work->workplan_week}}</td>
                <td>{{date('Y-m-d', strtotime($work->workplan_date))}}</td>
                <td>
                  @if ($work->type == 'i')
                    Internal
                  @elseif($work->type == 'e')
                    External
                  @endif
                </td>
                <td> {{$work->desc}} </td>
                <td>{{$work->worker}}</td>
              </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
