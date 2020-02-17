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
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Update</h3>
      <div class="box-tools pull-right">
        @if (Auth::user()->role == 'a')
          <button class="btn btn-box-tool" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash" aria-hidden="true"></i>
            Delete</button>
        @endif
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
             <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date" value="{{date('Y-m-d',strtotime($equipment->date_eq))}}" required readonly >
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
         <label class="col-sm-2 control-label"></label>
         <div class="col-sm-2">
           @if (Auth::user()->role == 'a')
             {{-- <input type="submit"  value="Update" class="form-control btn btn-success pull-right"> --}}
           @endif
         </div>
       </div>
       {{ Form::close() }}

      </div>
  </div>
  <!-- details-->
  <div class="box">
    <div class="box-header with-border">
      <a href="{{url('equipments/create-details/'.$equipment->idequipments)}}" class="btn btn-default btn btn-xs"><i class="fa fa-plus" aria-hidden="true"></i>
        Create-new
      </a>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" id="example2" style=" width:100%;">
          <thead>
            <tr>
              <th></th>
              <th>Item</th>
              <th>Funloc</th>
              <th>Equipment Number</th>
              <th>Model Number</th>
              <th>Rate Number</th>
              <th>Month Construction</th>
              <th>Year Construction</th>
              <th>Date Instalation</th>
              <th>Description</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($equipment->equipment_details as $index => $eqdet)
              <tr>
                <td>
                  @if ($eqdet->status == 'a')
                    @php
                      $disabled = 'disabled';
                    @endphp
                  @else
                    @php
                    $disabled = '';
                    @endphp
                  @endif
                  <a class="btn btn-xs  {{$disabled}}" data-toggle="modal" data-target="#modal-delete" onclick="delete_details('{{$eqdet->idequipmentdetails}}','{{$eqdet->idequipments}}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </td>
                <td>{{$eqdet->items->name}}</td>
                <td>{{$eqdet->funloc_details->number}} - {{$eqdet->funloc_details->description}}</td>
                <td>{{$eqdet->equipment_number}}</td>
                <td>{{$eqdet->model_number}}</td>
                <td>{{$eqdet->rate_number}}</td>
                <td>{{$eqdet->month_construction}}</td>
                <td>{{$eqdet->year_construction}}</td>
                <td>{{date('Y-m-d',strtotime($eqdet->date_instalation))}}</td>
                <td>
                  {{substr($eqdet->description,0,20)}}
                  @if (strlen($eqdet->description) > 20)
                    ...
                  @endif
                </td>
                <td>
                @if ($eqdet->status == 'p')
                  <span class="label label-warning">Pending</span>
                @elseif($eqdet->status == 'a')
                  <span class="label label-success">Approved</span>
                @elseif($eqdet->status == 'r')
                  <span class="label label-danger">Rejected</span>
                @endif
              </td>
              <td>
                <button type="button" class="btn btn-default btn-xs modal-eqdet" data-toggle="modal" data-target="#modal-eqdet" onclick="update_equipment_det('{{$eqdet->idequipmentdetails}}','{{$eqdet->idequipments}}','{{$eqdet->iditems}}','{{$eqdet->idfunlocdetails}}','{{$eqdet->equipment_number}}','{{$eqdet->model_number}}','{{$eqdet->rate_number}}','{{$eqdet->month_construction}}','{{$eqdet->year_construction}}','{{$eqdet->date_instalation}}','{{$eqdet->description}}','{{$eqdet->status}}')">
                    <i class="fa fa-pencil-square-o"></i>
                </button>
              </td>

              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
      </div>
    </div>
  </div>
</section>

  <script type="text/javascript">


   function update_equipment_det(idequipmentdetails,idequipments,iditems,idfunlocdetails,eqdet_number,model_number,rate_number,month_construction,year_construction,date_instalation,description,status){
     var date = new Date(date_instalation);
     var d = ("0" + date.getDate()).slice(-2);
     var m = ("0" + (date.getMonth() +1)).slice(-2);
     var y = date.getFullYear();
    $('#idequipmentdetails').val(idequipmentdetails);
    $('#idequipments').val(idequipments);
    $('#iditems').val(iditems);
    $('#idfunlocdetails').val(idfunlocdetails);
    $('#equipment_number').val(eqdet_number);
    $('#model_number').val(model_number);
    $('#rate_number').val(rate_number);
    $('#month_construction').val(month_construction);
    $('#year_construction').val(year_construction);
    $('#date_instalation').val(y +'-'+ m +'-'+ d);
    $('#description').val(description);
    if (status == 'p') {
      $('.status').html('<span class="label label-warning">Pending</span>');
    }else if (status == 'a') {
      $('.status').html('<span class="label label-success">Approved</span>');
    }else if (status == 'r') {
      $('.status').html('<span class="label label-danger">Rejected</span>');
    }

   }

   function delete_details(ideqdet,idequipment) {
     $('#idequipments_header').val(idequipment);
     $('#idequipments_details').val(ideqdet);

   }
  </script>

<!--Modal edit equipment details-->
<div class="modal fade" id="modal-eqdet" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
 <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
     <!--header modal-->
     <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     </div>
     <!--body modal-->
     {{ Form::open(array('url' => 'equipments/update-details/', 'class' => 'form-horizontal')) }}
     <div class="modal-body">
       <h3 class="box-title">Update</h3>
      <div class="form-group">
        {{-- <label class="col-sm-2 control-label">Date</label> --}}
        <div class="col-sm-10">
          <input type="hidden" class="form-control" name="idequipmentdetails" value="" id="idequipmentdetails">
          <input type="hidden" class="form-control" name="idequipments" value="" id="idequipments">

        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Item</label>
        <div class="col-sm-10">
          <select class="form-control" name="iditems" id="iditems">
            <option value="">dsfdsfdf</option>
            @foreach ($items as $item)
              <option value="{{$item->iditems}}"> {{$item->name}} </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Funloc</label>
        <div class="col-sm-10">
          <select class="form-control" name="idfunlocdetails" id="idfunlocdetails">
            @foreach ($fundets as $fun)
              <option value="{{$fun->idfunlocdetails}}"> {{$fun->number}} - {{$fun->description}} </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Equipment Number</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="equipment_number" id="equipment_number">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Model Number</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="model_number" id="model_number">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Rate Number</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="rate_number" id="rate_number">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Month Construction</label>
        <div class="col-sm-10">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control datepicker1" id="month_construction" data-date-format='yyyy-mm-dd' autocomplete="off" name="month_construction"  required>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Year Construction</label>
        <div class="col-sm-10">
          <input type="text" class="form-control datepicker2" data-date-format='yyyy-mm-dd' autocomplete="off" id="year_construction" name="year_construction" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Date Instalation</label>
        <div class="col-sm-10">
          <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date_instalation" id="date_instalation"  required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">

          <textarea name="description" rows="3" id="description" class="form-control" id="description" required></textarea>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Status</label>
        <div class="col-sm-10">

          <div class="status"></div>
        </div>
      </div>
     </div>
     <!--footer modal-->
     <div class="modal-footer">
       <button type="submit" class="btn btn-success">Update</button>
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
     </div>
     {{Form::close()}}
   </div>
 </div>
</div>

<!-- modal delete confirmation -->
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <center>Sure to delete this equipment ?</center>
      </div>
      <div class="modal-footer">
        {{ Form::open(array('url' => 'equipments/delete-details/','class' => 'form-horizontal')) }}
          <input type="hidden" name="idequipments_header" value="" id="idequipments_header">
          <input type="hidden" name="idequipments_details" value="" id="idequipments_details">

          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger">Yes</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
