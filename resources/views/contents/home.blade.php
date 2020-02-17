<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
<section class="content-header">
  <h1>
    Dashboard
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
        <div class="chart">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Complaint Chart</h3>
            </div>
            <div class="box-body" style="">
              <div class="chart">

                  <canvas id="myChart" width="400" height="100"></canvas>

              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Last Login</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <ul class="users-list clearfix">
              @foreach ($user_login as $uslogin)
              <li>
                @if ($uslogin->photos != NULL)
                  <img src="{{env('CDN_URL')}}user_image/{{$uslogin->photos}}" class="user-image" alt="User Image">

                @else
                  <img src="{{env('ADMINLTE')}}dist/img/default-image.png " alt="User Image">

                @endif
                <br>
                {{$uslogin->name}} <small><i class="far fa-clock"></i> <br>{{time_diff($uslogin->last_login)}}</small>
              </li>
            @endforeach
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.box-body -->
        </div>
      {{-- <div class="box">

        <div class="box-header with-border">

          @foreach ($user_login as $uslogin)
            <ul class="users-list clearfix">
              <li class="list-group-item">
                <img src="https://lh6.googleusercontent.com/-rMB3Jtpbzvk/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfKZ75DenLxPvwYaq-RnTsAMUmTgQ/s50-mo/photo.jpg?sz=120" alt="User Image"><br>
                {{$uslogin->name}} <small><i class="far fa-clock"></i> {{time_diff($uslogin->last_login)}}</small>
              </li>
            </ul>
          @endforeach
        </div>
      </div> --}}
    </div>
  </div>
</section>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js">

</script>
<script type="text/javascript">

var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
      labels: {!! json_encode($data_arr) !!},
      datasets: [{
          label: 'Complaint Of The Weekly',
          data: [{!! json_encode($complaint1) !!}, {!! json_encode($complaint2) !!}, {!! json_encode($complaint3) !!}, {!! json_encode($complaint4) !!},{!! json_encode($complaint5) !!}, {!! json_encode($complaint6) !!},{!! json_encode($complaint7) !!}],
          backgroundColor: [
              'rgba(255, 206, 86, 0.2)',
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
          ],
          borderWidth: 1
      }]
  },
  options: {
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero: true
              }
          }]
      }
  }
});

</script>
