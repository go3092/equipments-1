<style media="screen">
  .zoom {
  -webkit-transition: all 0.35s ease-in-out;
  -moz-transition: all 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
  cursor: -webkit-zoom-in;
  cursor: -moz-zoom-in;
  cursor: zoom-in;
  }

  .zoom:hover,
  .zoom:active,
  .zoom:focus {
  /**adjust scale to desired size,
  add browser prefixes**/
  -ms-transform: scale(2.5);
  -moz-transform: scale(2.5);
  -webkit-transform: scale(2.5);
  -o-transform: scale(2.5);
  transform: scale(2.5);
  position:relative;
  z-index:100;
  }

  /**To keep upscaled images visible on mobile,
  increase left & right margins a bit**/
  @media only screen and (max-width: 1000px) {
  ul.gallery {
  margin-left: 1000vw;
  margin-right: 1000vw;
  }

  /**TIP: Easy escape for touch screens,
  give gallery's parent container a cursor: pointer.**/
  .DivName {cursor: pointer}
</style>

<section class="content-header">
    <h1>
      Work Plan
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-random"></i> Work Plan</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Index</h3>
        <div class="box-tools pull-right">
          <a  data-toggle="modal" data-target="#modal-equipment" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a>
          <a href="{{url('workplane/report')}}" class="btn btn-box-tool" title="Create New"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Report</a>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="example2">
            <thead>
              <tr>
                <th>No</th>
                <th>Cabang</th>
                <th>Items</th>
                <th>Workplane Type</th>
                <th>Date</th>
                <th>Desc</th>
                <th><center>image</center></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($workplans as $index => $work)
                @if (isset($work->equipment_details))
                <tr>
                  <td>{{$index+1}}</td>
                  <td>
                    @if (!is_null($work->equipment_details->equipments))
                      {{$work->equipment_details->equipments->description}}
                    @endif
                  </td>
                  <td>{{$work->equipment_details->items->name}}</td>
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
                  <td>{{date('Y-m-d', strtotime($work->workplan_date))}}</td>
                  <td>{{substr($work->desc,0,50) }}</td>
                  <td>
                    <center>
                      <button type="button" class="btn btn-primary btn-xs " data-toggle="modal" data-target="#modal-image" onclick="show_image('{{$work->image_before}}','{{$work->image_after}}')">
                        <i class="fa fa-file-image-o" aria-hidden="true"></i>
                      </button>
                    </center>
                  </td>
                  <td><a class="" href="{{url('workplane/update/'.$work->idworkplans)}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a></td>
                </tr>
                  @endif
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
      $('#before').html('<img  src="{{env('CDN_URL')}}workplan_image/'+image_before+'" width="250" class="img-responsive">');
    }

    if (!image_after) {
      $('#after').html('');
    }else{
      $('#after').html('<img  src="{{env('CDN_URL')}}workplan_image/'+image_after+'" width="250" class="img-responsive">');
    }

  }
</script>
  <!-- modal equipment -->
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

  <!-- modal equipment -->
<div class="modal fade" id="modal-equipment" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <!--header modal-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <!--body modal-->
      <div class="modal-body">
        <p>Get Equipment </p>
        <div class="box-body table-responsive">
          <table id="example5" class="table table-bordered table-striped" >
            <thead>
            <tr>
              <th></th>
              <th>Equipment</th>
              <th>Items</th>
              <th>funloc</th>
              <th>level</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($equdets as $equdet)
                <tr>
                  <td><a href="{{url('workplane/create-new/'.$equdet->idequipmentdetails)}}" class="btn btn-primary btn-xs"> <i class="fa fa-arrow-down" aria-hidden="true"></i></a></td>
                  <td>{{$equdet->equipment_number}}</td>
                  <td>{{$equdet->items->name}}</td>
                  <td>{{$equdet->funloc_details->description}}</td>
                  <td>{{$equdet->funloc_details->levels->name}}</td>
                </tr>
              @endforeach
            </tbody>
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
