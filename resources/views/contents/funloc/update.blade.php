<section class="content-header">
  <h1>
    Functional Location
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('funloc')}}"><i class="fa fa-tags"></i> Functional Location</a></li>
    <li class="active"><i class="fa fa-pencil"></i> Update</a></li>
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
        {{ Form::open(array('url' => 'funloc/update/'.$funloc->idfunlocs, 'class' => 'form-horizontal')) }}

          <div class="form-group">
           <label class="col-sm-2 control-label">Date</label>

           <div class="col-sm-10">
             <div class="input-group">
               <div class="input-group-addon">
                 <i class="fa fa-calendar"></i>
               </div>
               <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date" value="{{date('Y-m-d', strtotime($funloc->date))}}" required>
             </div>
           </div>
         </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Cabang</label>
          <div class="col-sm-10">
            {{-- <textarea name="desc" rows="5" class="form-control" required>{{$funloc->description}}</textarea> --}}
            <input type="text" name="desc" class="form-control" value="{{$funloc->description}}" required>

          </div>
        </div>

      <div class="form-group">
        <div class="col-sm-12">
            <p><a class="btn btn-xs btn-primary" id="addRow"> <i class="fa fa-plus"></i> Add </a></p>
        </div>
        <div class="col-sm-12" id="home">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table" style="border: 2px solid #d2d6de !important;">
              <tbody>
                @foreach ($funloc->funloc_details as $index => $fundet)
                  <tr>
                    <td style="border: 1px solid #d2d6de !important; text-align:center">
                      <label style="display: block;">{{$index+1}}</label>
                      <a class="btn btn-xs del" id="count" onclick="delete_fundet('{{$fundet->idfunlocdetails}}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      <input type="hidden" name="idfunlocdetails[]" value="{{$fundet->idfunlocdetails}}">
                    </td>
                    <td width="250" style="border: 1px solid #d2d6de !important;">
                      <small><b>Level</b></small><br>
                      <select class="form-control select2" name="idlevel[]" id="idlevel_{{$index+1}}" required>
                        <option > -- select level -- </option>
                        @foreach ($levels as $level)
                          <option value="{{$level->idlevels}}"
                            @if ($level->idlevels == $fundet->idlevels) selected @endif> {{$level->code}} - {{$level->name}} </option>
                        @endforeach
                      </select>
                    </td>
                    <td style="border: 1px solid #d2d6de !important; ">
                      <small><b>Number</b></small>
                      <input type="text" name="number[]" value="{{$fundet->number}}" id="number_{{$index+1}}" class="form-control" required>
                    </td>
                    <td style="border: 1px solid #d2d6de !important;">
                      <small><b>Description</b></small>
                      <textarea name="description[]" rows="1" id="description_{{$index+1}}" class="form-control" required>{{$fundet->description}}</textarea>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <div class="form-group">
        {{-- <label class="col-sm-2 control-label"></label> --}}
        <div class="col-sm-12">
          <a href="{{url('funloc')}}" class="btn btn-warning ">Back</a>
          <input type="submit" value="Save" id="btn_save" class="btn btn-primary pull-right">
        </div>
      </div>

        <input type="hidden" id="deleteindex" name="deleteindex">

        {{ Form::close() }}
      </div>
      <!-- /.box-body -->
    </div>
    <input type="hidden" id="appendindex" value="{{$funloc->funloc_details->count()+1}}">
  </section>

  <script type="text/javascript">

    //delete row
     $('#table').on('click', '.del' ,function(){
       $(this).closest('tr').remove();
       if ($('#count').length-1) {
         $('#btn_save').prop("disabled", 'disabled');
       }
     });
    //level
    var level = '';
    @foreach($levels as $level)
      level += "<option value='{{$level->idlevels}}'>{{$level->code}} - {{$level->name}}</option>";
    @endforeach
    //add row        <input type="hidden" id="deleteindex" name="deleteindex">

    $('#addRow').on('click',function(){
        var ais = $('#appendindex').val();
        $('#appendindex').val(parseInt(ais)+1);

        $('#table').append('<tr>'
          +'<td style="border: 1px solid #d2d6de !important; text-align:center">'
            +'<label style="display: block;">'+ais+'</label>'
            +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            +'<input type="hidden" name="idfunlocdetails[]" value="new">'
          +'</td>'
          +'<td width="250" style="border: 1px solid #d2d6de !important; ">'
            +'<small><strong>Level</strong></small> '
            +'<select class="form-control" name="idlevel[]" id="idlevel_'+ais+'" >'
            +'<option value="">- select level -</option>'+level+'</select>'
          +'</td>'
          +'<td style="border: 1px solid #d2d6de !important;">'
            +'<small><b>Number</b></small>'
            +'<input type="text" name="number[]" id="number_'+ais+'" class="form-control" required>'
          +'</td>'
          +'<td style="border: 1px solid #d2d6de !important; ">'
            +'<small><b>Description</b></small>'
            +'<textarea name="description[]" id="description_'+ais+'" rows="1" class="form-control" required></textarea>'
          +'</td>'
        +'</tr>'
      );
      $('select').select2();
      $('#btn_save').removeAttr("disabled");
    })

    function delete_fundet(idfundet) {
      var fun_det = $('#deleteindex').val();
      $('#deleteindex').val(fun_det+','+idfundet);
    }
    // $('btn_save').on('click', function(){
    //   var ais = $('#appendindex').val();
    //   $('#appendindex').val(parseInt(ais)+1);
    //
    //   if ($('#idlevel_'+ais) == NULL) {
    //     alert('null');
    //   }
    // })

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
             <center>Sure to delete this funloc ?</center>
           </div>
           <div class="modal-footer">
             {{ Form::open(array('url' => 'funloc/delete/'.$funloc->idfunlocs, 'method' => 'delete')) }}
             <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
             <button type="submit" class="btn btn-danger">Yes</button>
             {{ Form::close() }}
           </div>
         </div>
       </div>
     </div>
