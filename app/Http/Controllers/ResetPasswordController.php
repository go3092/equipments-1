<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordResets;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PassResets;

class ResetPasswordController extends Controller
{
    public function show()
    {
      return view('reset-password.create');
    }

    public function send_email_reset(Request $request,User $user)
    {
      $user = User::whereEmail($request->email)->first();
      if($user == NULL){
        return redirect()->back()->with('error','email does not exist');
      }

      $save_reset_password = new PasswordResets;
      $save_reset_password->email = $request->email;
      $save_reset_password->token = str::random(60);
      $save_reset_password->save();

      Mail::to($request->email)->send(new PassResets($save_reset_password));
      // sleep(1);

      // PasswordResets::truncate();

      return "success";
  }
}
