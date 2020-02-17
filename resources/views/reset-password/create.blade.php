<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{env('ADMINLTE')}}bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{env('ADMINLTE')}}bower_components/font-awesome/css/font-awesome.min.css">
    <style media="screen">
    .form-gap {
      padding-top: 70px;
    }
    </style>
    <title></title>
  </head>
  <body>
    <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> error!</h4>
                      {{session('error')}}
                    </div>
                  @endif
                  <div class="panel-body">
                    {{ Form::open(array('url' => 'reset/password', 'class' => 'form-horizontal')) }}
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input name="email" placeholder="email address" class="form-control"  type="email" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <input  class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                  {{ Form::close() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
	      </div>
      </div>
      <script src="{{env('ADMINLTE')}}bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="{{env('ADMINLTE')}}bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
