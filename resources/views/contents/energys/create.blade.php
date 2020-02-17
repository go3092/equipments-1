
<section class="content-header">
  <h1>
    Energy Using
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dasboard</a></li>
    <li><a href="{{url('complaint')}}"><i class="fa fa-battery-three-quarters"></i> Energy Using</a></li>
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
        {{ Form::open(array('url' => 'energys/create-new', 'class' => 'form-horizontal')) }}

        <div class="form-group">
          <label class="col-sm-2 control-label">Type</label>
          <div class="col-sm-10">
            <select class="form-control" name="type" required>
              <option value> -- select type -- </option>
              <option value="l">Listrik</option>
              <option value="a">Air Pam</option>
              <option value="s">Solar</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Volume</label>
          <div class="col-sm-10">
            <input type="number" name="volume" class="form-control" required>
          </div>
        </div>


        <div class="form-group">
          <label class="col-sm-2 control-label">Period</label>
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
          <label class="col-sm-2 control-label">Description</label>
          <div class="col-sm-10">
            <textarea name="desc" rows="5" class="form-control" required></textarea>
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
