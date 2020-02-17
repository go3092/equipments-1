
<section class="content-header">
  <h1>
    Master Equipment
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('master/item')}}"><i class="fa fa-inbox"></i> Master Equipment</a></li>
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
        {{ Form::open(array('url' => 'master/item/create-new', 'class' => 'form-horizontal')) }}

        <div class="form-group">
          <label class="col-sm-2 control-label">Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="name" name="name" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Merk</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Merk" name="merk" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Unit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Unit" name="unit" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Country Made</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Country Made" name="country_made" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Code Unit</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Code Unit" name="code_unit" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Status</label>
          <div class="col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="active" checked> Active
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
