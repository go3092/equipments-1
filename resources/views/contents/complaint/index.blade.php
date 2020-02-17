<section class="content-header">
    <h1>
      Complaint
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-list-alt"></i> Complaint</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">

        {{-- <h3 class="box-title">Index</h3> --}}
        {{ Form::open(array('url' => 'complaint', 'method' => 'get', 'class' => 'form-horizontal')) }}

        @if (Auth::user()->role == 'a' || Auth::user()->role == 'm')
          <div class="box-tools">
          <div class="row">
            <div class="col-sm-3">
              <small><strong>Cabang</strong></small>
              <select class="form-control select2" name="cabang">
                <option value=""> -- select cabang -- </option>
                @foreach ($equipments as $eq)
                  <option value="{{$eq->idequipments}}" @if (Request::get('cabang') == $eq->idequipments) selected @endif>{{$eq->description}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-3">
              <small><strong>Date</strong></small>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date" class="form-control pull-right" id="datepickerrange" autocomplete="off" value="{{Request::get('date')}}">
              </div>
            </div>
            <div class="col-sm-3">
              <small><strong>Type</strong></small>
              <select class="form-control" name="type">
                <option value=""> -- select type --</option>
                <option value="e" @if (Request::get('type') == 'e') selected @endif> Eletrikal </option>
                <option value="m" @if (Request::get('type') == 'm') selected @endif> Mekanikal </option>
                <option value="s" @if (Request::get('type') == 's') selected @endif> Sipil</option>
                <option value="l" @if (Request::get('type') == 'l') selected @endif> Lain-lain</option>
              </select>
            </div>
            <div class="col-sm-1">
              <small><br></small>
              <button  class="btn btn-default form-control"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
          </div>
        </div>
        {{Form::close()}}
        @endif


        <div class="box-tools pull-right">
          <a href="{{url('complaint/create-new')}}" id="create-new" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a>
          <a href="{{url('complaint/report')}}" id="create-new" class="btn btn-box-tool" title="Create New"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Report</a>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="example2">
            <thead>
              <tr>

                <th>
                  @if (Auth::user()->role == 'm' || Auth::user()->role == 'a' )
                    Cabang
                  @else
                    No
                  @endif
                </th>
                <th>Date</th>
                <th>Location</th>
                <th>Type</th>
                <th>Param</th>
                <th>Image</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($complaints as $index => $com)
                <tr>
                  <td>
                    @if (Auth::user()->role == 'm' || Auth::user()->role == 'a' )
                      {{$com->cabang}}
                    @else
                      {{$index+1}}
                    @endif
                  </td>
                  <td>{{date('Y-m-d', strtotime($com->date)) }}</td>
                  <td>{{ $com->location }}</td>
                  <td>
                    @if ($com->type == 'e')
                      Eletrikal
                    @elseif($com->type == 'm')
                      Mekanikal
                    @elseif($com->type == 's')
                      Sipil
                    @elseif($com->type == 'l')
                      Lain - Lain
                    @endif
                  </td>
                  <td>
                    @if ($com->param == 'j')
                      Job
                    @elseif($com->param == 'n')
                      Non Job
                    @endif
                  </td>
                  <td>
                    <button type="button" class="btn btn-primary btn-xs " data-toggle="modal" data-target="#modal-image" onclick="show_image('{{$com->img_before}}','{{$com->img_after}}')">
                      <i class="fa fa-file-image-o" aria-hidden="true"></i>
                    </button>
                  </td>
                  <td>
                    @if ($com->status == 'o')
                      <span class="label label-primary">Open</span>
                    @elseif($com->status == 'p')
                      <span class="label label-default">Pending</span>
                    @elseif($com->status == 'd')
                      <span class="label label-success">Done</span>
                    @elseif($com->status == 'c')
                      <span class="label label-danger">Cancel</span>
                    @endif
                  </td>
                  <td>
                    <a class="" href="{{url('complaint/update/'.$com->idcomplaints)}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
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

  <script type="text/javascript">
  function show_image(image_before,image_after) {
    if (!image_before) {
        $('#before').html('');
    }else{
      $('#before').html('<img src="{{env('CDN_URL')}}complaints_image/'+image_before+'" width="250" class="img-responsive">');
    }

    if (!image_after) {
      $('#after').html('');
    }else{
      $('#after').html('<img src="{{env('CDN_URL')}}complaints_image/'+image_after+'" width="250" class="img-responsive">');
    }

  }
  </script>

  <div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <!--header modal-->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <!--body modal-->
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td>
                    <h4>Before</h4>
                    <div id="before"></div>
                </td>
                <td>
                    <h4>After</h4>
                    <div id="after" ></div>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <!--footer modal-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
