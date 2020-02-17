
<section class="content-header">
  <h1>
    Equipment
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('equipments')}}"><i class="fa fa-file-text-o"></i> Equipment</a></li>
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
        {{ Form::open(array('url' => 'equipments/update/'.$equipment->idequipments, 'class' => 'form-horizontal')) }}

          <div class="form-group">
           <label class="col-sm-2 control-label">Date</label>

           <div class="col-sm-10">
             <div class="input-group">
               <div class="input-group-addon">
                 <i class="fa fa-calendar"></i>
               </div>
               <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date" value="{{date('Y-m-d',strtotime($equipment->date_eq))}}" required >
             </div>
           </div>
         </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Cabang</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="desc" required value="{{$equipment->description}}" readonly>
          </div>
        </div>

      <div class="form-group">
        <div class="col-sm-12">
            <p><a class="btn btn-xs btn-primary" id="addRow"> <i class="fa fa-plus"></i> Add </a></p>
        </div>
        <div class="col-sm-12">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="table" style="border: 2px solid #d2d6de !important;  width: 1200px;">
              <tbody>
                @foreach ($equipment->equipment_details as $index => $eqdet)
                  @php
                    if ($eqdet->status == 'a' || $eqdet->status == 'r') {
                      $readonly = 'disabled';
                    }else{
                      $readonly = '';
                    }
                  @endphp
                <tr>
                  <td style="border: 1px solid #d2d6de !important; text-align:center">
                    <label style="display: block;">{{$index+1}}</label>
                    <input type="hidden" name="idequipmentdetails[]" value="{{$eqdet->idequipmentdetails}}">
                    <a class="btn btn-xs del {{$readonly}}" id="count" onclick="delete_eqdet('{{$eqdet->idequipmentdetails}}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  </td>
                  <td width="250" style="border: 1px solid #d2d6de !important;">
                    <small><b>Items</b></small><br>
                    <select class="form-control select2" name="iditems[]" id="iditems_{{$index+1}}" required>
                      <option > -- select items -- </option>
                      @foreach ($items as $item)
                        <option value="{{$item->iditems}}" @if ($item->iditems == $eqdet->iditems) selected @endif> {{$item->name}} - {{$item->merk}} </option>
                      @endforeach
                    </select>
                    <small><b>Funloc</b></small><br>
                    <select class="form-control select2" name="idfunlocdetails[]" id="idfunlocdetails_{{$index+1}}" required>
                      <option > -- select funloc -- </option>
                      @foreach ($fundets as $fun)
                        <option value="{{$fun->idfunlocdetails}}" @if ($fun->idfunlocdetails == $eqdet->idfunlocdetails) selected @endif> {{$fun->number}} - {{$fun->levels->name}} </option>
                      @endforeach
                    </select>
                  </td>
                  <td  style="border: 1px solid #d2d6de !important;">
                    <small><b>Equipment Number</b></small>
                    <input type="text" name="equipment_number[]" id="equipment_number_{{$index+1}}" class="form-control" value="{{$eqdet->equipment_number}}" required>
                    <small><b>Model Number</b></small>
                    <input type="text" name="model_number[]" id="model_number_{{$index+1}}" class="form-control" value="{{$eqdet->model_number}}" required>
                  </td>
                  <td style="border: 1px solid #d2d6de !important; ">
                    <small><b>Rate Number</b></small>
                    <input type="text" name="rate_number[]" id="rate _number_{{$index+1}}" class="form-control" value="{{$eqdet->rate_number}}" required>
                    <small><b>Month Construction</b></small>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control datepicker1" id="month_construction_{{$index+1}}" data-date-format='yyyy-mm-dd' autocomplete="off" name="month_construction[]" value="{{$eqdet->month_construction}}" required>
                    </div>
                  </td>
                  <td style="border: 1px solid #d2d6de !important; ">
                    <small><b>Year Construction</b></small>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control datepicker2" data-date-format='yyyy-mm-dd' autocomplete="off" id="year_construction_{{$index+1}}" name="year_construction[]" value="{{$eqdet->year_construction}}" required>
                    </div>
                    <small><b>Date Instalation</b></small>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date_instalation[]" id="date_instalation_{{$index+1}}" value="{{date('Y-m-d',strtotime($eqdet->date_instalation))}}" required>
                    </div>
                  </td>

                  <td style="border: 1px solid #d2d6de !important;">
                    <small><b>Description</b></small>
                    <textarea name="description[]" rows="1" id="description_{{$index+1}}" class="form-control" required>{{$eqdet->description}}</textarea>

                    <small><b></b></small>
                    <br>
                    @if ($eqdet->status == 'a')
                      <span class="label label-success">Approved</span>
                    @elseif ($eqdet->status == 'r')
                      <span class="label label-danger">Rejected</span>
                    @elseif ($eqdet->status == 'p')
                      <span class="label label-warning">Pending</span>
                    @endif
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
            <a href="{{url('equipments')}}" class="btn btn-warning ">Back</a>
            <input type="submit" value="Save" id="btn_save" class="btn btn-primary pull-right">
          </div>
        </div>

        <input type="hidden" id="deleteindex" name="deleteindex">

        {{ Form::close() }}
      </div>
      <!-- /.box-body -->
    </div>

    <input type="hidden" id="appendindex" value="{{$equipment->equipment_details->count()+1}}">
  </section>

  <script type="text/javascript">
  //delete row
   $('#table').on('click', '.del' ,function(){
     $(this).closest('tr').remove();
      if ($('#count').length-1) {
        $('#btn_save').prop("disabled", 'disabled');
      }
   });
   //items
   var items='';
   @foreach($items as $item)
     items += "<option value='{{$item->iditems}}'>{{$item->name}} - {{$item->merk}}</option>";
   @endforeach
   //funloc details
   var funlocdet='';
   @foreach($fundets as $fun)
     funlocdet += "<option value='{{$fun->idfunlocdetails}}'>{{$fun->number}} - {{$fun->levels->name}}</option>";
   @endforeach
   //delete index equipment details
   function delete_eqdet(idequdet) {
     var eq_det = $('#deleteindex').val();
     $('#deleteindex').val(eq_det+','+idequdet);
   }
   //add row
   $('#addRow').on('click',function(){
     var ais = $('#appendindex').val();
     $('#appendindex').val(parseInt(ais)+1);

       $('#table').append('<tr>'
         +'<td style="border: 1px solid #d2d6de !important; text-align:center">'
          +'<input type="hidden" value="new" name="idequipmentdetails[]">'
           +'<label style="display: block;">'+ais+'</label>'
           +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
         +'</td>'
         +'<td width="250" style="border: 1px solid #d2d6de !important; ">'
           +'<small><strong>Items</strong></small> '
           +'<select class="form-control" name="iditems[]" id="iditems_'+ais+'" required>'
           +'<option>-- select items --</option>'+items+'</select>'
           +'<small><strong>Funloc</strong></small> '
           +'<select class="form-control" name="idfunlocdetails[]" id="idfunlocdetails_'+ais+'" required>'
           +'<option>-- select funloc --</option>'+funlocdet+'</select>'
         +'</td>'
         +'<td style="border: 1px solid #d2d6de !important; ">'
           +'<small><strong>Equipment Number</strong></small>'
           +'<input type="text" name="equipment_number[]" id="equipment_number_'+ais+'" class="form-control" required>'
           +'<small><strong>Model Number</strong></small> '
           +'<input type="text" name="model_number[]" id="model_number_'+ais+'" class="form-control" required>'
         +'</td>'
         +'<td style="border: 1px solid #d2d6de !important;">'
           +'<small><b>Rate Number</b></small>'
           +'<input type="text" name="rate_number[]" id="rate _number_'+ais+'" class="form-control" required>'
           +'<small><b>Month Construction</b></small>'
           +'<div class="input-group">'
             +'<div class="input-group-addon">'
               +'<i class="fa fa-calendar"></i>'
             +'</div>'
             +'<input type="text" class="form-control datepicker1" id="month_construction_'+ais+'"  autocomplete="off" name="month_construction[]" value="{{date('m')}}" required>'
           +'</div>'
         +'</td>'
         +'<td style="border: 1px solid #d2d6de !important;">'
           +'<small><b>Year Construction</b></small>'
           +'<div class="input-group">'
             +'<div class="input-group-addon">'
               +'<i class="fa fa-calendar"></i>'
             +'</div>'
             +'<input type="text" class="form-control datepicker2" data-date-format="yyyy-mm-dd" autocomplete="off" name="year_construction[]" id="year_construction_'+ais+'" value="{{date('Y')}}" required>'
           +'</div>'
           +'<small><b>Date Instalation</b></small>'
           +'<div class="input-group">'
             +'<div class="input-group-addon">'
               +'<i class="fa fa-calendar"></i>'
             +'</div>'
             +'<input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" name="date_instalation[]" id="date_instalation_'+ais+'" value="{{date('Y-m-d')}}" required>'
           +'</div>'
         +'</td>'
         +'<td>'
           +'<small><b>Description</b></small>'
           +'<textarea name="description[]" rows="4" id="description_'+ais+'" class="form-control" required></textarea>'
         +'</td>'
       +'</tr>'
     );
     $('#btn_save').removeAttr("disabled");

     $('select').select2();
     //Date picker
      $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });

       $('.datepicker2').datepicker({
         autoclose: true,
         format: 'yyyy',
         viewMode: "years",
         minViewMode: "years"
       });

       $('.datepicker1').datepicker({
         autoclose: true,
         format: 'mm',
         viewMode: "months",
         minViewMode: "months"
       });
   })
  </script>
