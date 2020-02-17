
<section class="content-header">
  <h1>
    Master Location
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('level')}}"><i class="fa fa-building"></i>  Master Location</a></li>
    <li class="active"><i class="fa fa-pencil"></i> Update</a></li>
  </ol>
</section>

<section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Create New</h3>
        <div class="box-tools pull-right">
         <button class="btn btn-box-tool" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash"></i> Delete</button>
        </div>
      </div>
      <div class="box-body">
        {{ Form::open(array('url' => 'level/update/'.$levels->idlevels, 'class' => 'form-horizontal')) }}
        <div class="form-group">
          <label class="col-sm-2 control-label">Code</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$levels->code}}" name="code" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="{{$levels->name}}" name="name" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10">
            <textarea name="desc" rows="5" class="form-control">{{$levels->description}}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="active" @if ($levels->active == TRUE)
                  checked
                @endif > Active
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"></label>
          <div class="col-sm-10">
            <a href="{{url('level')}}" class="btn btn-warning pull-right">Back</a>
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
           <center>Sure to delete this level ?</center>
         </div>
         <div class="modal-footer">
           {{ Form::open(array('url' => 'level/delete/'.$levels->idlevels, 'method' => 'delete')) }}
           <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
           <button type="submit" class="btn btn-danger">Yes</button>
           {{ Form::close() }}
         </div>
       </div>
     </div>
   </div>
