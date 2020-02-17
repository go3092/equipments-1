<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

      $contents = [
        'users' => User::whereNotIn('role',['a'])->get(),
      ];
      // return   $contents;
      $pagecontent =  view('contents/master/users/index', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'User',
          'menu' => 'master',
          'submenu' => 'user',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_page()
    {
      $contents = [
        // 'users' => User::whereNotIn('role',['a'])->get(),
      ];
      // return   $contents;
      $pagecontent =  view('contents/master/users/create', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'User',
          'menu' => 'master',
          'submenu' => 'user',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function save_page(Request $request)
    {
      // return $request->all();
      $request->validate([
        'nik' => 'required|numeric',
        'name' => 'required|max:225',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed'
      ]);

      //active
       $active = FALSE;
       if($request->has('active')) {
           $active = TRUE;
       }

      $save_user = new User;
      $save_user->idusers = str::uuid();
      $save_user->nik = $request->nik;
      $save_user->name = $request->name;
      $save_user->email = $request->email;
      $save_user->role = $request->role;
      $save_user->password =  Hash::make($request->password);
      $save_user->active = $active;
      $save_user->save();

      return redirect('master/users')->with('success','New created user');
    }

    public function update_page(User $user)
    {

      $contents = [
        'users' => User::find($user->idusers)
      ];
      // return   $contents;
      $pagecontent =  view('contents/master/users/update', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'User',
          'menu' => 'master',
          'submenu' => 'user',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_save(Request $request ,User $user)
    {
      $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users,email,'.$user->idusers.',idusers',
        'nik' => 'required',
      ]);
      //active
       $active = FALSE;
       if($request->has('active')) {
           $active = TRUE;
       }

       $save_user = User::find($user->idusers);
       $save_user->nik = $request->nik;
       $save_user->name = $request->name;
       $save_user->email = $request->email;
       $save_user->role = $request->role;
       $save_user->active =  $active;
       $save_user->save();

       return redirect('master/users')->with('success','Update user');
    }

    public function delete(User $user)
    {
      $user = User::find($user->idusers);
      if (!is_null($user)) {
        $user->delete();
      }
      return redirect('master/users')->with('success','Deleted user');

    }

    public function reset_password(Request $request,User $user)
    {
      if (!(Hash::check($request->current_password, $user->password))) {
        return redirect()->back()->with('status_error',"Your current password does not matches with the password you provided. Please try again.");
      }

      if (strcmp($request->current_password,$request->password) == 0) {
        return redirect()->back()->with('status_error',"New Password cannot be same as your current password. Please choose a different password.");
      }

      $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:6|confirmed'
      ]);

      $reset_pass = User::find($user->idusers);
      $reset_pass->password = bcrypt($request->password);
      $reset_pass->save();

      return redirect('master/users')->with('success','Reset Password');

    }
}
