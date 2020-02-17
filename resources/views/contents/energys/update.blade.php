
<section class="content-header">
  <h1>
    Energy Using
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('energys')}}"><i class="fa fa-battery-three-quarters"></i> energy using</a></li>
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
        {{ Form::open(array('url' => 'energys/update/'.$energys->idenergys, 'class' => 'form-horizontal')) }}

        <div class="form-group">
          <label class="col-sm-2 control-label">Type</label>
          <div class="col-sm-10">
            <select class="form-control" name="type" required>
              <option value> -- select type -- </option>
              <option value="l" @if($energys->type == 'l') selected @endif>Listrik</option>
              <option value="a" @if($energys->type == 'a') selected @endif>Air Pam</option>
              <option value="s" @if($energys->type == 's') selected @endif>Solar</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Volume</label>
          <div class="col-sm-10">
            <input type="number" name="volume" class="form-control" value="{{$energys->volume}}" required>
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-2 control-label">Period</label>
          <div class="col-sm-10">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control datepicker" data-date-format='yyyy-mm-dd' autocomplete="off" name="date" value="{{date('Y-m-d',strtotime($energys->period))}}" required>
            </div>
          </div>

        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10">
            <textarea name="desc" rows="5" class="form-control" required>{{$energys->desc}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <a href="{{url('energys')}}" class="btn btn-warning pull-right">Back</a>
            <input type="submit" value="Save" class="btn btn-primary">
          </div>
        </div>

        {{ Form::close() }}
      </div>
      <!-- /.box-body -->
    </div>

  </section>
  <!-- modal delete confirmation -->
   <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
     <div class="modal-dialog modal-sm" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="exampleModalLabel">Warning</h4>
         </div>
         <div class="modal-body">
           <center>Sure to delete this energys using ?</center>
         </div>
         <div class="modal-footer">
           {{ Form::open(array('url' => 'energys/delete/'.$energys->idenergys, 'method' => 'delete')) }}
           <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
           <button type="submit" class="btn btn-danger">Yes</button>
           {{ Form::close() }}
         </div>
       </div>
     </div>
   </div>
