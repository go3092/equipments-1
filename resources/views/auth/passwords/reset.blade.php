
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{env('ADMINLTE')}}bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{env('ADMINLTE')}}bower_components/font-awesome/css/font-awesome.min.css">
    <style media="screen">
    .form-gap {
      padding-top: 70px;
    }
    </style>
  </head>
  <body>
     <div class="form-gap"></div>

    {{--<div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
         <div class="panel-heading">{{ __('Reset Password') }}</div>
         <div class="panel-body">
           <div class="container">

           </div>
           <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
             @csrf

             <input type="hidden" name="token" value="{{ $token }}">

             <div class="form-group row">
               <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

               <div class="col-md-6">
                 <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                 @if ($errors->has('email'))
                   <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('email') }}</strong>
                   </span>
                 @endif
               </div>
             </div>

             <div class="form-group row">
               <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

               <div class="col-md-6">
                 <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                 @if ($errors->has('password'))
                   <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('password') }}</strong>
                   </span>
                 @endif
               </div>
             </div>

             <div class="form-group row">
               <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

               <div class="col-md-6">
                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
               </div>
             </div>
         </div>

         <div class="panel-footer">
           <div class="form-group ">
             <div class="">
               <button type="submit" class="btn btn-primary  pull-right">
                 {{ __('Reset Password') }}
               </button>
             </div>
           </div>
         </div>

       </form>
     </div>Email:</
      </div>
    </div> --}}

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading"><h5>Reset Password</h5></div>
            <div class="panel-body">
              <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" name="email" id="inputEmail" placeholder="Email" required>
                    @if ($errors->has('email'))

                      <small>
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      </small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="inputPassword" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                      <small>
                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                      </small>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirmation Password</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirmation Password">
                </div>
                <button type="submit" class="btn btn-primary pull-right" >Reset Password</button>
              </form>
            </div>
            <div class="panel-footer"></div>
          </div>
      </div>
    </div>

    <script src="{{env('ADMINLTE')}}bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{env('ADMINLTE')}}bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    {{-- @endsection --}}
  </body>
</html>
