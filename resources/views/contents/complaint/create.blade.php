
<section class="content-header">
  <h1>
    Complaint
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('complaint')}}"><i class="fa fa-list-alt"></i> Complaint</a></li>
    <li class="active"><i class="fa fa-plus"></i> Create New</a></li>
  </ol>
</section>

<section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Create New</h3>
      </div>
      <div class="box-body">
        {{ Form::open(array('url' => 'complaint/create-new', 'class' => 'form-horizontal','files' => 'true')) }}

        <div class="form-group">
          <label class="col-sm-2 control-label">Date Time<span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <small>Date </small>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date" value="{{date('Y-m-d')}}" required>
            </div>
          </div>
          {{-- <label class="col-sm-2 ">Time</label> --}}
          <div class="col-sm-5">
            <small>Time </small>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
              <input type="text" class="form-control" id="datetimepicker" autocomplete="off" name="time_header" value="{{date('h:i A',strtotime('08:00:00'))}}" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Type / Param <span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <small>type</small>
            <select class="form-control" name="type" required>
              <option value> -- select type -- </option>
              <option value="e">Elektrikal</option>
              <option value="m">Makanikal</option>
              <option value="s">Sipil</option>
              <option value="l">Lain - Lain</option>
            </select>
          </div>
          <div class="col-sm-5">
            <small>param </small>
            <select class="form-control" name="param" required>
              <option value> -- select param -- </option>
              <option value="j">Job</option>
              <option value="n">Non Job</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Location <span class="text-danger">*</span></label>
          <div class="col-sm-10">
            <input type="text" name="location" class="form-control" required>
          </div>
        </div>

        @if (Auth::user()->role == 'm' ||Auth::user()->role == 'a' )
          <div class="form-group">
            <label class="col-sm-2 control-label">Status <span class="text-danger">*</span></label>
            <div class="col-sm-10">
              <select class="form-control" name="status" id="status" required>
                <option value="" > -- select status -- </option>
                <option value="o">Open</option>
                <option value="d" id="done">Done</option>
                <option value="p">Pending</option>
                <option value="c">Cancel</option>
              </select>
            </div>
          </div>

          <div id="lifetime">
            <div class="form-group">
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-10">
                <small>Action Date</small>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="action_date" value="{{date('Y-m-d')}}" required>
                </div>
              </div>
              <label class="col-sm-2 control-label"></label>
              <div class="col-sm-5">
                <small>Start Time</small>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" class="form-control" id="datetimepicker-start" autocomplete="off" name="start_time" value="" required>
                </div>
              </div>
              <div class="col-sm-5">
                <small>End Time </small>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <input type="text" class="form-control" id="datetimepicker-end"  autocomplete="off" name="end_time" required>
                </div>
              </div>
            </div>
          </div>
        @endif

        <div class="form-group">
          <label class="col-sm-2 control-label">Description<span class="text-danger">*</span></label>
          <div class="col-sm-10">
            <textarea name="desc" rows="5" class="form-control" required></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Informer</label>
          <div class="col-sm-5">
            <small>Informer param</small>
            <input type="text" name="informer_param" value="" class="form-control">
          </div>
          <div class="col-sm-5">
            <small>Informer Name</small>
            <input type="text" name="informer_name" value="" class="form-control">
          </div>
          <label class="col-sm-2 control-label"></label>

          <div class="col-sm-5">
            <small>Informer Department</small>
            <input type="text" name="informer_departement" value="" class="form-control">
          </div>
          <div class="col-sm-5">
            <small>Informer Position</small>
            <input type="text" name="informer_position" value="" class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Work <span class="text-danger">*</span></label>
          <div class="col-sm-10">
            <textarea name="work" rows="3" class="form-control"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Solution</label>
          <div class="col-sm-10">
            <textarea name="solution" rows="3" class="form-control"></textarea>
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
          <div class="col-sm-10 col-sm-offset-2">
            <p class="">
              <a class="btn btn-xs btn-primary" id="addRow"> <i class="fa fa-plus"></i> Add Worker </a>
            </p>
          </div>
            <div class="col-sm-10 col-sm-offset-2">
              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="table" style="border: 2px solid #d2d6de !important;">
                  <thead>
                    <tr>
                      <th style="border: 1px solid #d2d6de !important;">Nik</th>
                      <th style="border: 1px solid #d2d6de !important;">Name</th>
                      <th style="border: 1px solid #d2d6de !important;">Desc</th>
                      <th style="border: 1px solid #d2d6de !important;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td style="border: 1px solid #d2d6de !important;">
                        <input type="text" name="nik[]" id="nik_1" class="form-control" required>
                      </td>
                      <td style="border: 1px solid #d2d6de !important;">
                        <input type="text" name="name[]" id="name_1" class="form-control" required>
                      </td>
                      <td style="border: 1px solid #d2d6de !important;">
                        <input type="text" name="description[]" id="description_1" class="form-control" required>
                      </td>
                      <td style="border: 1px solid #d2d6de !important;">
                        <a class="btn btn-xs "><i class="fa fa-minus" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <a href="{{url('complaint')}}" class="btn btn-warning pull-right">Back</a>
            <input type="submit" value="Save" class="btn btn-primary">
          </div>
        </div>

        {{ Form::close() }}
      </div>
      <!-- /.box-body -->
    </div>
    <input type="hidden" id="appendindex" value="2">

  </section>

  <script type="text/javascript">
    $('#status').change(function () {
      if($('#done').is(":selected")) {
        $('#lifetime').show();
      }else{
        $('#lifetime').hide();
      }
    }).trigger('change');

    //delete row
     $('#table').on('click', '.del' ,function(){
       $(this).closest('tr').remove();
     });

    $('#addRow').on('click',function(){
      var ais = $('#appendindex').val();
      $('#appendindex').val(parseInt(ais)+1);

      $('#table').append('<tr>'
        +'<td style="border: 1px solid #d2d6de !important; ">'
          +'<input type="text" name="nik[]" id="nik_'+ais+'" class="form-control" required>'
        +'</td>'
        +'<td style="border: 1px solid #d2d6de !important; ">'
          +'<input type="text" name="name[]" id="name_'+ais+'" class="form-control" required>'
        +'</td>'
        +'<td style="border: 1px solid #d2d6de !important; ">'
          +'<input type="text" name="description[]" id="description_'+ais+'" class="form-control" required>'
        +'</td>'
        +'<td style="border: 1px solid #d2d6de !important; ">'
          +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
        +'</td>'

      );
    })

  </script>
