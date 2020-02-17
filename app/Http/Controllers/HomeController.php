<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use File;
use Image;
use App\Models\Complaints;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
      $user_login = User::where('last_login','!=' ,NULL)
                    ->orderBy('last_login','desc')
                    ->limit(8)
                    ->get();
      //display week
      $en = Carbon::now();
      $en->startOfWeek();
      // $en->startOfMonth();
      $arr = [];
      for ($i=0; $i < 7; $i++) {
        $arr[] = $en->format('Y-m-d');
        $en->addDays(1);
      }

      $complaint1 = Complaints::where('date',$arr[0])
                    ->where('created_by',Auth::user()->idusers)
                    ->count();
      $complaint2 = Complaints::where('date',$arr[1])
                    ->where('created_by',Auth::user()->idusers)
                    ->count();
      $complaint3 = Complaints::where('date',$arr[2])
                    ->where('created_by',Auth::user()->idusers)
                    ->count();
      $complaint4 = Complaints::where('date',$arr[3])
                    ->where('created_by',Auth::user()->idusers)
                    ->count();
      $complaint5 = Complaints::where('date',$arr[4])
                    ->where('created_by',Auth::user()->idusers)
                    ->count();
      $complaint6 = Complaints::where('date',$arr[5])
                    ->where('created_by',Auth::user()->idusers)
                    ->count();
      $complaint7 = Complaints::where('date',$arr[6])
                    ->where('created_by',Auth::user()->idusers)
                    ->count();

      // return $arr;
        $contents = [
          'complaint1' => $complaint1,
          'complaint2' => $complaint2,
          'complaint3' => $complaint3,
          'complaint4' => $complaint4,
          'complaint5' => $complaint5,
          'complaint6' => $complaint6,
          'complaint7' => $complaint7,
          'data_arr' => $arr,
          'user_login' => $user_login,
      ];
      // return   $contents;
      $pagecontent =  view('contents/home', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Home',
          'menu' => 'home',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function profile(User $user)
    {

      $contents = [
          'users' => Auth::user(),
      ];
      // return   $contents;
      $pagecontent =  view('contents/profile', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Profile',
          'menu' => 'home',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_profile(Request $request)
    {
      $request->validate([
        'name' => 'required ',
        'email' => 'required|unique:users,email,'.Auth::user()->idusers.',idusers',
        'photos' => 'file|mimes:jpeg,png,jpg|max:1024|dimensions:max_width=220,max_height=220',
      ]);

      $save_profile = User::find(Auth::user()->idusers);
      $save_profile->email = $request->email;
      $save_profile->name = $request->name;
      $save_profile->nik = $request->nik;

      //file upload
      if (Auth::user()->photos == NULL) {
        $filename = NULL;
        if ($request->hasFile('photos')) {
          $image_user = $request->file('photos');
          $filename =  Str::random(20).'.'.$image_user->getClientOriginalExtension();

          $cdnpath = env('UPLOAD').'user_image/';
          $image_user->move($cdnpath, $filename);
          $save_profile->photos = $filename;
        }
      }
      //file upload update
      if (Auth::user()->photos != NULL) {
          $filename = env('UPLOAD').'user_image/'.Auth::user()->photos;
          if (!is_null($request->photos)) {
            if (File::exists($filename)) {
              $photos = $request->photos;
              $filephoto = Str::random(20).'.'.$photos->getClientOriginalExtension();
              $cdnpath = env('UPLOAD').'user_image/';
              $photos->move($cdnpath, $filephoto);
              $save_profile->photos = $filephoto;
            }
            File::delete($filename);
          }
      }
      $save_profile->save();

      return redirect('profile')->with('success','Update Profile');
    }
}
