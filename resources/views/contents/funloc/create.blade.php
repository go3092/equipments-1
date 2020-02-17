
<section class="content-header">
  <h1>
    Functional Location
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('funloc')}}"><i class="fa fa-tags"></i> Functional Location</a></li>
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
        {{ Form::open(array('url' => 'funloc/create-new', 'class' => 'form-horizontal')) }}
          <div class="form-group">
           <label class="col-sm-2 control-label">Date</label>

           <div class="col-sm-10">
             <div class="input-group">
               <div class="input-group-addon">
                 <i class="fa fa-calendar"></i>
               </div>
               <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date" value="{{date('Y-m-d')}}" required>
             </div>
           </div>
         </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Cabang</label>
          <div class="col-sm-10">
            {{-- <textarea name="desc" rows="5" class="form-control" required></textarea> --}}
            <input type="text" name="desc" class="form-control" required>
          </div>
        </div>

      <div class="form-group">
        <div class="col-sm-12">
            <p><a class="btn btn-xs btn-primary" id="addRow"> <i class="fa fa-plus"></i> Add </a></p>
        </div>
        <div class="col-sm-12">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table" style="border: 2px solid #d2d6de !important;">
              <tbody>
                <tr>
                  <td style="border: 1px solid #d2d6de !important; text-align:center">
                    <label style="display: block;">1</label>
                    <a class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></a>
                  </td>
                  <td width="250" style="border: 1px solid #d2d6de !important;">
                    <small><b>Level</b></small><br>
                    <select class="form-control select2" name="idlevel[]" id="idlevel_1" required>
                      <option > -- select level -- </option>
                      @foreach ($levels as $level)
                        <option value="{{$level->idlevels}}"> {{$level->code}} - {{$level->name}} </option>
                      @endforeach
                    </select>
                  </td>
                  <td style="border: 1px solid #d2d6de !important; ">
                    <small><b>Number</b></small>
                    <input type="text" name="number[]" id="number_1" class="form-control" required>
                  </td>
                  <td style="border: 1px solid #d2d6de !important;">
                    <small><b>Description</b></small>
                    <textarea name="description[]" rows="1" id="description_1" class="form-control" required></textarea>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

        <div class="form-group">
          {{-- <label class="col-sm-2 control-label"></label> --}}
          <div class="col-sm-12">
            <a href="{{url('funloc')}}" class="btn btn-warning ">Back</a>
            <input type="submit" value="Save" class="btn btn-primary pull-right">
          </div>
        </div>

        {{ Form::close() }}
      </div>
      <!-- /.box-body -->
    </div>
    <input type="hidden" id="appendindex" value="2">
  </section>

  <script type="text/javascript">

    //delete row
     $('#table').on('click', '.del' ,function(){
       $(this).closest('tr').remove();
     });
    //level
    var level = '';
    @foreach($levels as $level)
      level += "<option value='{{$level->idlevels}}'>{{$level->code}} - {{$level->name}}</option>";
    @endforeach
    //add row
    $('#addRow').on('click',function(){
        var ais = $('#appendindex').val();
        $('#appendindex').val(parseInt(ais)+1);

        $('#table').append('<tr>'
          +'<td style="border: 1px solid #d2d6de !important; text-align:center">'
            +'<label style="display: block;">'+ais+'</label>'
            +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
          +'</td>'
          +'<td style="border: 1px solid #d2d6de !important; ">'
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
    })

    // $('btn_save').on('click', function(){
    //   var ais = $('#appendindex').val();
    //   $('#appendindex').val(parseInt(ais)+1);
    //
    //   if ($('#idlevel_'+ais) == NULL) {
    //     alert('null');
    //   }
    // })


  </script>
