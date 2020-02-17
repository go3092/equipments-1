<style media="screen">
.accordion-toggle:hover {
    text-decoration: none;
  }
.panell{
  background-color: #047117 !important;
}
</style>
<section class="content-header">
  <h1>
    Workplane
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('workplane')}}"><i class="fa fa-random"></i> Work plan</a></li>
    <li class="active"><i class="fa fa-plus"></i> Create New</a></li>
  </ol>
</section>

<section class="content">
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <div class="panel panel-dafault ">
        <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="more-less glyphicon glyphicon-plus"></i>
                    History Equipment {{$equdets->items->name}} {{$equdets->items->merk}}
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
              <div class="box-body">
                <table class="table table-bordered table-striped" id="">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Workplane Type</th>
                    <th>Week</th>
                    <th>Date</th>
                    <th>Action By</th>
                    <th>Desc</th>
                    <th>Worker</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($equipment_det as $eq_det)
                      @foreach ($eq_det->workplans as $index => $work)
                        <tr>
                          <td>{{$index+1}}</td>
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
                          <td>
                            {{date('Y-m-d', strtotime($work->workplan_date))}}
                          </td>
                          <td>
                            @if ($work->type == 'i')
                              Internal
                            @elseif($work->type == 'e')
                              External
                            @endif
                          </td>
                          <td>{{$work->desc}}</td>
                          <td>{{$work->worker}}</td>
                        </tr>
                      @endforeach
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
  </div><!-- panel-group -->
    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Create New</h3>
      </div>
      <div class="box-body">
        {{ Form::open(array('url' => 'workplane/create-new/'.$equdets->idequipmentdetails, 'class' => 'form-horizontal', 'files' => 'true')) }}
        <input type="hidden" name="idequipmentdetails" value="{{$equdets->idequipmentdetails}}">
        <div class="form-group">
          <label class="col-sm-2 control-label">Workplane Type</label>
          <div class="col-sm-10">
            <select class="form-control" name="workplane_type" required>
              <option value=""> -- select workplane type --</option>
              <option value="HR">HR (Harian)</option>
              <option value="1M">1M (Satu Mingguan)</option>
              <option value="1B">1B (Satu Bulan)</option>
              <option value="2B">2B (Dua Bulan)</option>
              <option value="3B">3B (Tiga Bulan)</option>
              <option value="6B">6B (Enam Bulan)</option>
              <option value="YR">YR (1 Tahun)</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Plan Week / Month</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" name="plan_week" required>
          </div>
        </div>

        <div class="form-group">
         <label class="col-sm-2 control-label">Plan Date</label>

         <div class="col-sm-10">
           <div class="input-group">
             <div class="input-group-addon">
               <i class="fa fa-calendar"></i>
             </div>
             <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="plan_date" value="{{date('Y-m-d')}}" required>
           </div>
         </div>
       </div>

       <div class="form-group">
         <label class="col-sm-2 control-label">Action By</label>
         <div class="col-sm-10">
           <select class="form-control" name="type" required>
             <option value=""> -- select action by --</option>
             <option value="i">Internal</option>
             <option value="e">External</option>
           </select>
         </div>
       </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Plan Desc</label>
          <div class="col-sm-10">
            <textarea name="plan_desc" rows="5" class="form-control"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Upload Before</label>
          <div class="col-sm-10">
            <input type="file" name="photos_before" class="form-control" >
            {{-- <small class="text-danger">size image max height:1000, width:1000 pixel</small> --}}
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Upload After</label>
          <div class="col-sm-10">
            <input type="file" name="photos_after" class="form-control" >
            {{-- <small class="text-danger">size image max height:1000, width:1000 pixel</small> --}}
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <a href="{{url('workplane')}}" class="btn btn-warning pull-right">Back</a>
            <input type="submit" value="Save" class="btn btn-primary">
          </div>
        </div>

        {{ Form::close() }}
      </div>
      <!-- /.box-body -->
    </div>
  </section>

    <script type="text/javascript">
      $('.collapse').on('shown.bs.collapse', function(){
        $(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
      }).on('hidden.bs.collapse', function(){
        $(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
      });
    </script>
