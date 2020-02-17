<section class="content-header">
    <h1>
      Report
      <small>Complaint</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('complaint')}}"><i class="fa fa-file"></i> Report</a></li>
      <li class="active"><i class="fa fa-circle-o text-default"></i> Complaint</a></li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        {{ Form::open(array('url' => 'report/rcomplaint', 'method' => 'get', 'class' => 'form-horizontal')) }}

        <div class="box-tools">
          <div class="row">
            <div class="col-sm-5">
              <small>Date</small>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date" class="form-control pull-right" id="datepickerrange" autocomplete="off" value="{{Request::get('date')}}">
              </div>
            </div>
            <div class="col-sm-5">
              <small>Cabang</small>
              <select class="form-control" name="cabang">
                <option value=""> -- select cabang --</option>
                @foreach ($equipments as $eq)
                  <option value="{{$eq->idequipments}}" @if (Request::get('cabang') == $eq->idequipments) selected @endif> {{$eq->description}} </option>
                @endforeach

              </select>
            </div>
            <div class="col-sm-5">
              <small>Type</small>
              <select class="form-control" name="type">
                <option value=""> -- select type --</option>
                <option value="e" @if (Request::get('type') == 'e') selected @endif> Eletrikal </option>
                <option value="m" @if (Request::get('type') == 'm') selected @endif> Mekanikal </option>
                <option value="s" @if (Request::get('type') == 's') selected @endif> Sipil</option>
                <option value="l" @if (Request::get('type') == 'l') selected @endif> Lain-lain</option>
              </select>
            </div>
            <div class="col-sm-5">
              <small>Status</small>
              <select class="form-control" name="status">
                <option value=""> -- select status --</option>
                <option value="o" @if (Request::get('status') == 'o') selected @endif> Open  </option>
                <option value="p" @if (Request::get('status') == 'p') selected @endif> Pending </option>
                <option value="d" @if (Request::get('status') == 'd') selected @endif> Done </option>
                <option value="c" @if (Request::get('status') == 'c') selected @endif> Cancel </option>
              </select>
            </div>
            <div class="col-sm-1">
              <small><br></small>
              <button  class="btn btn-default form-control"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
            <div class="col-sm-1">
              @php
                $paramdate = str_replace(' - ', '_', Request::query('date'));
                $query = '?date='.$paramdate.'&type='.Request::query('type').'&status='.Request::query('status');
              @endphp
              <br>
              <a href="{{url('report/rcomplaint/excel'.$query)}}" class="btn btn-success form-control"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
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
                <th>Date</th>
                <th>Type</th>
                <th>Location</th>
                <th>Status</th>
                <th>Param</th>
                <th>Action Date</th>
                <th>Star End Time</th>
                <th>Work </th>
                <th>Solution </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($datacomplaint as $complaint)
                <tr class="danger">
                  <td><small>{{$complaint['header']['worknik']}}</small></td>
                  <td><small>{{$complaint['header']['workname']}}</small></td>
                  <td><small>{{$complaint['header']['eqdesc']}}</small><br></td>
                </tr>
                @foreach ($complaint['detail'] as $detail)
                  <tr class="success">
                    <td>
                      <small>{{date('Y-m-d',strtotime($detail['date']))}} -  {{date('h:i A',strtotime($detail['time_header']))}}</small>
                    </td>
                    <td>
                      @if ($detail['type'] == 'm')
                        <small> Mekanikal</small>
                      @elseif($detail['type'] == 's')
                        <small>Sipil</small>
                      @elseif($detail['type'] == 'e')
                        <small>Elektrikal</small>
                      @elseif($detail['type'] == 'l')
                        <small>Lain - Lain</small>
                      @endif
                    </td>
                    <td>{{$detail['location']}}</td>
                    <td>
                      @if ($detail['status'] == 'o')
                        <span class="label label-primary">Open</span>
                      @elseif($detail['status'] == 'p')
                        <span class="label label-default">Pending</span>
                      @elseif($detail['status'] == 'd')
                        <span class="label label-success">Done</span>
                      @elseif($detail['status'] == 'c')
                        <span class="label label-danger">Cancel</span>
                      @endif
                    </td>
                    <td>
                      @if ($detail['param'] == 'j')
                        Job
                      @elseif($detail['param'] == 'n')
                        Non Job
                      @endif
                    </td>
                    <td>
                      {{date('Y-m-d',strtotime($detail['action_date']))}}
                    </td>
                    <td>
                      {{date('h:i A',strtotime($detail['start_time']))}} - {{date('h:i A',strtotime($detail['end_time']))}}
                    </td>
                    <td>{{$detail['work']}}</td>
                    <td>{{$detail['solution']}}</td>
                  </tr>
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
