
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
                   @if (session('status'))
                       <div class="alert alert-success" role="alert">
                           {{ session('status') }}
                       </div>
                   @endif
                   <div class="panel-body">
                     {{ Form::open(array('url' => 'password/email', 'class' => 'form-horizontal')) }}
                       <div class="form-group">
                         <div class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                           <input name="email" placeholder="email address" class="form-control"  type="email"  value="{{ old('email') }}"  required>
                         </div>
                       </div>

                       <div class="form-group">
                           @if ($errors->has('email'))
                             <div class="alert alert-danger alert-dismissible">
                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                               <ul>
                                 <span class="invalid-feedback" role="alert">
                                   <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                               </ul>
                             </div>
                           @endif
                       </div>

                       <div class="form-group">
                         <input  class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                       </div>
                       <div class="form-group">
                         <a  class="btn btn-lg btn-warning btn-block" href="{{url('/login')}}">Back</a>
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
