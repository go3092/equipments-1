<section class="content-header">
    <h1>
      Functional Location
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><i class="fa fa-tags"></i> Functional Location</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Index</h3>
        <div class="box-tools pull-right">
          <a href="{{url('funloc/create-new')}}" id="create-new" class="btn btn-box-tool" title="Create New"><i class="fa fa-plus"></i> Create New</a>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" id="example2">
            <thead>
              <tr>
                <th>No</th>
                <th>Date</th>
                <th>Description</th>
                <th>Create By</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($funlocs as $index => $fun)
                <tr id="funloc">
                  <td>{{$index+1}}</td>
                  <td>{{date('Y-m-d', strtotime($fun->date)) }}</td>
                  <td>
                    {{substr($fun->description,0,20)}}
                    @if (strlen($fun->description) > 20)
                      ...
                    @endif
                  </td>
                  <td>{{$fun->users->name}}</td>
                  <td><a class="" href="{{url('funloc/update/'.$fun->idfunlocs)}}"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                  </a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <script type="text/javascript">
    if ($('#funloc').length == 1) {
      $('#create-new').hide();
      $('#create-new').click(function(){
        alert('You must delete this equipment');
        return false;
      });
    }
  </script>
