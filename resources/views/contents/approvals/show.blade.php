
  <section class="content-header">
    <h1>
      Approvals
      <small>Show</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-info-circle"></i> Approvals</a></li>
      <li class="active"><i class="fa fa-eye"></i> show</a></li>
    </ol>
  </section>

<section class="content">
  <div class="box">
    <div class="box-header with-border">

    </div>
    <div class="box-body">
      <table class="table ">
        <tr>
          <td width="10%"><b>Cabang</b></td>
          <td>: {{$approvals->equipment_details->equipments->description}} </td>
        </tr>
        <tr>
          <td><b>Location</b></td>
          <td>: {{$approvals->equipment_details->funloc_details->description}}</td>
        </tr>
        <tr>
          <td><b>Level</b></td>
          <td>: {{$approvals->equipment_details->funloc_details->levels->name}}</td>
        </tr>
        <tr>
          <td><b>Item</b></td>
          <td>: {{$approvals->equipment_details->items->name}} - {{$approvals->equipment_details->items->merk}}</td>
        </tr>
        <tr>
          <td><b>Equipment Number</b></td>
          <td>: {{$approvals->equipment_details->equipment_number}} </td>
        </tr>
        <tr>
          <td><b>Model Number</b></td>
          <td>: {{$approvals->equipment_details->model_number}}</td>
        </tr>
        <tr>
          <td><b>Rate Number</b></td>
          <td>: {{$approvals->equipment_details->rate_number}}</td>
        </tr>
        <tr>
          <td><b>Construction </b></td>
          <td>: {{$approvals->equipment_details->month_construction}} -  {{$approvals->equipment_details->year_construction}}</td>
        </tr>
        <tr>
          <td><b>Instalation </b></td>
          <td>: {{date('Y-m-d', strtotime($approvals->equipment_details->date_instalation))}}</td>
        </tr>
        <tr>
          <td><b>Status </b></td>
          <td>:
            @if ($approvals->status == 'a')
              <span class="label label-success">Approved</span>
            @elseif ($approvals->status == 'r')
              <span class="label label-danger">Rejected</span>
            @elseif ($approvals->status == 'p')
              <span class="label label-warning">Pending</span>
            @endif</td>
        </tr>
      </table>
      <div class="form-group">
        <div class="col-sm-12">
          <div class="pull-right">
            <a href="#modal-approve" data-toggle="modal" class=" btn btn-success">Approve</a>
            <a href="#modal-rejected"  data-toggle="modal" class=" btn btn-danger">Rejected</a>
            <a href="{{url('approvals')}}" class=" btn btn-warning">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!--Modal Approvw-->
<div class="modal fade" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <center>Sure to Approve this equipment ?</center>
      </div>
      <div class="modal-footer">
        {{ Form::open(array('url' => 'approvals/update/'.$approvals->idapprovals, 'method' => 'post')) }}
          <input type="hidden" name="status" value="a">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-success">Yes</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>

<!--Modal Rejected-->
<div class="modal fade" id="modal-rejected" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Warning</h4>
      </div>
      <div class="modal-body">
        <center>Sure to Rejected this equipment ?</center>
      </div>
      <div class="modal-footer">
        {{ Form::open(array('url' => 'approvals/update/'.$approvals->idapprovals, 'method' => 'post')) }}
          <input type="hidden" name="status" value="r">
          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger">Yes</button>
        {{ Form::close() }}
      </div>
    </div>
  </div>
</div>
