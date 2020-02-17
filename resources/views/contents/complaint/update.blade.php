
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
        <h3 class="box-title">Update</h3>
        <div class="box-tools pull-right">
         <button class="btn btn-box-tool" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash" aria-hidden="true"></i>
          Delete</button>
       </div>
      </div>
      <div class="box-body">
        {{ Form::open(array('url' => 'complaint/update/'.$complaint->idcomplaints, 'class' => 'form-horizontal', 'files' => 'true')) }}

        <div class="form-group">
          <label class="col-sm-2 control-label">Date Time<span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <small>Date </small>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date" value="{{date('Y-m-d',strtotime($complaint->date))}}" required>
            </div>
          </div>
          {{-- <label class="col-sm-2 ">Time</label> --}}
          <div class="col-sm-5">
            <small>Time </small>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
              </div>
              <input type="text" class="form-control" id="datetimepicker" autocomplete="off" name="time_header" value="{{date('h:i A',strtotime($complaint->time_header))}}" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Type / Param <span class="text-danger">*</span></label>
          <div class="col-sm-5">
            <small>type</small>
            <select class="form-control" name="type" required>
              <option value> -- select type -- </option>
              <option value="e" @if($complaint->type == 'e') selected @endif>Elektrikal</option>
              <option value="m" @if($complaint->type == 'm') selected @endif>Makanikal</option>
              <option value="s" @if($complaint->type == 's') selected @endif>Sipil</option>
              <option value="l" @if($complaint->type == 'l') selected @endif>Lain - Lain</option>
            </select>
          </div>
          <div class="col-sm-5">
            <small>param </small>
            <select class="form-control" name="param" required>
              <option value> -- select param -- </option>
              <option value="j" @if($complaint->param == 'j') selected @endif>Job</option>
              <option value="n" @if($complaint->param == 'n') selected @endif>Non Job</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Location <span class="text-danger">*</span></label>
          <div class="col-sm-10">
            <input type="text" name="location" class="form-control" value="{{$complaint->location}}" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Status <span class="text-danger">*</span></label>
          <div class="col-sm-10">
            <select class="form-control" name="status" id="status" required>
              <option value="" > -- select status -- </option>
              <option value="o" @if ($complaint->status == 'o') selected @endif>Open</option>
              <option value="d" id="done" @if ($complaint->status == 'd') selected @endif>Done</option>
              <option value="p" @if ($complaint->status == 'p') selected @endif>Pending</option>
              <option value="c" @if ($complaint->status == 'c') selected @endif>Cancel</option>
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
                <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="action_date" value="{{date('Y-m-d',strtotime($complaint->action_date))}}" required>
              </div>
            </div>
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-5">
              <small>Start Time</small>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" class="form-control" id="datetimepicker-start" autocomplete="off" name="start_time" value="{{date('h:i A',strtotime($complaint->start_time))}}" required>
              </div>
            </div>
            <div class="col-sm-5">
              <small>End Time </small>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" class="form-control" id="datetimepicker-end" value="{{date('h:i A',strtotime($complaint->end_time))}}" autocomplete="off" name="end_time" required>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Description<span class="text-danger">*</span></label>
          <div class="col-sm-10">
            <textarea name="desc" rows="5" class="form-control" required>{{$complaint->desc}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Informer</label>
          <div class="col-sm-5">
            <small>Informer param</small>
            <input type="text" name="informer_param" value="{{$complaint->informer_param}}" class="form-control">
          </div>
          <div class="col-sm-5">
            <small>Informer Name</small>
            <input type="text" name="informer_name" value="{{$complaint->informer_name}}" class="form-control">
          </div>
          <label class="col-sm-2 control-label"></label>

          <div class="col-sm-5">
            <small>Informer Department</small>
            <input type="text" name="informer_departement" value="{{$complaint->informer_departement}}" class="form-control">
          </div>
          <div class="col-sm-5">
            <small>Informer Position</small>
            <input type="text" name="informer_position" value="{{$complaint->informer_position}}" class="form-control">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Work <span class="text-danger">*</span></label>
          <div class="col-sm-10">
            <textarea name="work" rows="3" class="form-control">{{$complaint->work}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Solution</label>
          <div class="col-sm-10">
            <textarea name="solution" rows="3" class="form-control">{{$complaint->solution}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Upload Before</label>
          <div class="col-sm-8">
            <input type="file" name="photos_before" class="form-control" >
          </div>
          <div class="col-sm-2">
            <a  href="#modal-image-before" data-toggle="modal" class="btn btn-default btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i></a>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Upload After</label>
          <div class="col-sm-8">
            <input type="file" name="photos_after" class="form-control" >
          </div>
          <div class="col-sm-2">
            <a  href="#modal-image-after" data-toggle="modal" class="btn btn-default btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i></a>
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
                    @foreach ($complaint->workers as $index => $work)
                    <tr>
                      <td style="border: 1px solid #d2d6de !important;">
                        <input type="text" name="nik[]" value="{{$work->nik}}" id="nik_{{$index+1}}"  class="form-control">
                        <input type="hidden" name="idworkers[]" value="{{$work->idworkers}}" class="form-control">
                      </td>
                      <td style="border: 1px solid #d2d6de !important;">
                        <input type="text" value="{{$work->name}}" name="name[]" id="name_{{$index+1}}" class="form-control">
                      </td>
                      <td style="border: 1px solid #d2d6de !important;">
                        <textarea name="description[]" rows="1" id="description_{{$index+1}}" class="form-control">{{$work->desc}}</textarea>
                      </td>
                      <td style="border: 1px solid #d2d6de !important;">
                        <a class="btn btn-xs del" id="count" onclick="del_work('{{$work->idworkers}}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <a href="{{url('complaint')}}" class="btn btn-warning pull-right">Back</a>
            <input type="submit" value="Save" id="btn_save" class="btn btn-primary">
          </div>
        </div>

        <input type="hidden" id="deleteindex" name="deleteindex">
        {{ Form::close() }}
      </div>
      <!-- /.box-body -->
    </div>
    <input type="hidden" id="appendindex" value="{{$complaint->workers->count()+1}}">

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
       if ($('#count').length-1) {
          $('#btn_save').prop("disabled", 'disabled');
        }
     });

     function del_work(idwork) {
       var worker = $('#deleteindex').val();
       $('#deleteindex').val(worker+','+idwork);
     }

    $('#addRow').on('click',function(){
      var ais = $('#appendindex').val();
      $('#appendindex').val(parseInt(ais)+1);

      $('#table').append('<tr>'
        +'<td style="border: 1px solid #d2d6de !important; ">'
          +'<input type="hidden" name="idworkers[]" value="new" class="form-control">'
          +'<input type="text" name="nik[]" id="nik_'+ais+'" class="form-control" required>'
        +'</td>'
        +'<td style="border: 1px solid #d2d6de !important; ">'
          +'<input type="text" name="name[]" id="name_'+ais+'" class="form-control" required>'
        +'</td>'
        +'<td style="border: 1px solid #d2d6de !important; ">'
          +'<textarea name="description[]" rows="1" id="description_'+ais+'" class="form-control"></textarea>'
        +'</td>'
        +'<td style="border: 1px solid #d2d6de !important; ">'
          +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
        +'</td>'
      );
      $('#btn_save').removeAttr("disabled");
    })

  </script>
  <!-- modal delete confirmation -->
   <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
     <div class="modal-dialog modal-sm" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="exampleModalLabel">Warning</h4>
         </div>
         <div class="modal-body">
           <center>Sure to delete this complaint ?</center>
         </div>
         <div class="modal-footer">
           {{ Form::open(array('url' => 'complaint/delete/'.$complaint->idcomplaints, 'method' => 'delete')) }}
           <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
           <button type="submit" class="btn btn-danger">Yes</button>
           {{ Form::close() }}
         </div>
       </div>
     </div>
   </div>

   <!-- modal image before -->
    <div class="modal fade" id="modal-image-before" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Image Before</h4>
          </div>
          <div class="modal-body">
            <center>
              @if (is_null($complaint->img_before))
                -
              @else
                <img class="img-responsive" src="{{env('CDN_URL')}}/complaints_image/{{$complaint->img_before }}" width="300">
              @endif
            </center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


    <!-- modal image after -->
     <div class="modal fade" id="modal-image-after" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
       <div class="modal-dialog " role="document">
         <div class="modal-content">
           <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title" id="exampleModalLabel">Image After</h4>
           </div>
           <div class="modal-body">
             <center>
               @if (is_null($complaint->img_after))
                 -
               @else
                 <img class="img-responsive" src="{{env('CDN_URL')}}/complaints_image/{{$complaint->img_after }}" width="300">
               @endif
             </center>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           </div>
         </div>
       </div>
     </div>
