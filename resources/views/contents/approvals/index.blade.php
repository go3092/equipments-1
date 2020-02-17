<section class="content-header">
    <h1>
      Approvals
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-info-circle"></i> Approvals</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        {{ Form::open(array('url' => 'approvals', 'method' => 'get', 'class' => 'form-horizontal')) }}
        <div class="box-tools ">
          <div class="row">
            <div class="col-sm-2">
              <small>Cabang</small>
              <select class="form-control" name="cabang">
                <option value=""> -- All cabang --</option>
                @foreach ($cabangs as $cab)
                  <option value="{{$cab->idequipments}}" @if (Request::get('cabang') == $cab->idequipments)
                    selected
                  @endif>{{$cab->description}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-2">
              <small>Item</small>
              <select class="form-control" name="items">
                <option value=""> -- All items --</option>
                @foreach ($items as $item)
                  <option value="{{$item->iditems}}"  @if (Request::get('items') == $item->iditems)
                    selected
                  @endif>{{$item->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-2">
              <small>Status</small>
              <select class="form-control" name="status">
                <option value="p" @if(Request::get('status') == 'p') selected @endif>Pending</option>
                <option value="a" @if(Request::get('status') == 'a') selected @endif>Approved</option>
                <option value="r" @if(Request::get('status') == 'r') selected @endif>Rejected</option>
              </select>
            </div>
            <div class="col-sm-1">
              <small><br> </small>
              <button type="submit" class="btn btn-box-tool" title="Search"><i class="fa fa-search"></i></button>
            </div>
          </div>

        </div>
        {{Form::close()}}
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="example3">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Cabang</th>
                  <th>level</th>
                  <th>Items</th>
                  <th>Funloc</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($approvals as $index => $app)
                  <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$app->cabang}}</td>
                    <td>{{$app->levelname}} - {{ $app->leveldesc}}</td>
                    <td>{{$app->itemname}}</td>
                    <td>{{$app->funlocnumber}} - {{$app->funlocdesc}}</td>
                    <td>
                      @if ($app->status == 'a')
                        <span class="label label-success">Approved</span>
                      @elseif ($app->status == 'r')
                        <span class="label label-danger">Rejected</span>
                      @elseif ($app->status == 'p')
                        <span class="label label-warning">Pending</span>
                      @endif
                    </td>

                    <td><a class="" href="{{url('approvals/show/'.$app->idapprovals)}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
