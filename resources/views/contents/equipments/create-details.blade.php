<section class="content-header">
  <h1>
    Equipment
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('equipments')}}"><i class="fa fa-file-text-o"></i> Equipment</a></li>
    <li class="active"><i class="fa fa-plus"></i> Create-details</a></li>
  </ol>
</section>

<section class="content">

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Create Details</h3>
    </div>
    <div class="box-body">
      <div class="col-sm-10">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <td width="10%;"><label for="">Date</label></td>
                <td>:</td>
              <td ><label>{{date('Y-m-d',strtotime($equipment->date_eq))}}</label></td>
            </tr>
            <tr>
              <td width="10%;"><label for="">Cabang</label></td>
                <td>:</td>
              <td><label>{{$equipment->description}}</label></td>
            </tr>
          </table>
        </div>
      </div>
    </div>

    <div class="box-body">
      <div class="form-group">
        <div class="row">
          <div class="col-sm-12">
            <a class="btn btn-xs btn-primary pull-right " id="addRow" > <i class="fa fa-plus"></i> Add </a>
          </div>
        </div>
        <br>

        {{ Form::open(array('url' => 'equipments/create-details/'.$equipment->idequipments, 'class' => 'form-horizontal')) }}
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-bordered table-striped" id="table" style="border: 2px solid #d2d6de !important;  width: 1100px;">
                <tbody>
                  <tr>
                    <td style="border: 1px solid #d2d6de !important; text-align:center">
                      <label style="display: block;">1</label>
                      <a class="btn btn-xs"><i class="fa fa-minus" aria-hidden="true"></i></a>
                    </td>
                    <td style="border: 1px solid #d2d6de !important;">
                      <small><b>Items</b></small>
                      <select class="form-control select2" style="width:100%;" name="iditems[]" id="iditems_1" required>
                        <option > -- select items -- </option>
                        @foreach ($items as $item)
                          <option value="{{$item->iditems}}"> {{$item->name}} - {{$item->merk}} </option>
                        @endforeach
                      </select>
                      <small><b>Funloc</b></small><br>
                      <select class="form-control select2" style="width:100%;" name="idfunlocdetails[]" id="idfunlocdetails_1" required>
                        <option > -- select funloc -- </option>
                        @foreach ($fundets as $fun)
                          <option value="{{$fun->idfunlocdetails}}"> {{$fun->number}} - {{$fun->levels->name}} </option>
                        @endforeach
                      </select>
                    </td>
                    <td  style="border: 1px solid #d2d6de !important;">
                      <small><b>Equipment Number</b></small>
                      <input type="text" name="equipment_number[]" id="equipment_number_1" class="form-control" required>
                      <small><b>Model Number</b></small>
                      <input type="text" name="model_number[]" id="model_number_1" class="form-control" required>
                    </td>
                    <td style="border: 1px solid #d2d6de !important; ">
                      <small><b>Rate Number</b></small>
                      <input type="text" name="rate_number[]" id="rate _number_1" class="form-control" required>
                      <small><b>Month Construction</b></small>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control datepicker1" id="month_construction_1" data-date-format='yyyy-mm-dd' autocomplete="off" name="month_construction[]" value="{{date('m')}}" required>
                      </div>
                    </td>
                    <td style="border: 1px solid #d2d6de !important; ">
                      <small><b>Year Construction</b></small>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control datepicker2" data-date-format='yyyy-mm-dd' autocomplete="off" id="year_construction_1" name="year_construction[]" value="{{date('Y')}}" required>
                      </div>
                      <small><b>Date Instalation</b></small>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date_instalation[]" id="date_instalation_1" value="{{date('Y-m-d')}}" required>
                      </div>
                    </td>

                    <td style="border: 1px solid #d2d6de !important;">
                      <small><b>Description</b></small>
                      <textarea name="description[]" rows="4" id="description_1" class="form-control" required></textarea>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>


      </div>
      <div class="form-group">
        <div class="col-sm-12">
          <a href="{{url('equipments/update/'.$equipment->idequipments)}}" class="btn btn-warning ">Back</a>
          <input type="submit" value="Save" class="btn btn-primary pull-right">
        </div>
      </div>
      {{ Form::close() }}
    </div>

  </div>
  <input type="hidden" id="appendindex" value="2">

</section>

<script type="text/javascript">
  //delete row
   $('#table').on('click', '.del' ,function(){
     $(this).closest('tr').remove();
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
  //add new row
  $('#addRow').on('click',function(){
    var ais = $('#appendindex').val();
    $('#appendindex').val(parseInt(ais)+1);
      $('#table').append('<tr>'
        +'<td style="border: 1px solid #d2d6de !important; text-align:center">'
          +'<label style="display: block;">'+ais+'</label>'
          +'<a class="btn btn-xs del"><i class="fa fa-trash" aria-hidden="true"></i></a>'
        +'</td>'
        +'<td style="border: 1px solid #d2d6de !important;">'
          +'<small><strong>Items</strong></small> '
          +'<select class="form-control" name="iditems[]" id="iditems_'+ais+'" style="width:100%;"  required>'
            +'<option>-- select items --</option>'+items+'</select></br>'
          +'<small><strong>Funloc</strong></small> '
          +'<select class="form-control" name="idfunlocdetails[]" id="idfunlocdetails_'+ais+'" style="width:100%;" required>'
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
            +'<input type="text" class="form-control datepicker3" data-date-format="yyyy-mm-dd" autocomplete="off" name="date_instalation[]" id="date_instalation_'+ais+'" value="{{date('Y-m-d')}}" required>'
          +'</div>'
        +'</td>'
        +'<td>'
          +'<small><b>Description</b></small>'
          +'<textarea name="description[]" rows="4" id="description_'+ais+'" class="form-control" required></textarea>'
        +'</td>'
      +'</tr>'
    )
    $('select').select2();

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

      //Date picker
       $('.datepicker3').datepicker({
         autoclose: true,
         format: 'yyyy-mm-dd'
       });
  });
</script>
