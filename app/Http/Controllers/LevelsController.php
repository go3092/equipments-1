<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Levels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LevelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

      $contents = [
        'levels' => Levels::where('created_by',Auth::user()->idusers)
                    ->where('active',TRUE)
                    ->get()
      ];
      // return   $contents;
      $pagecontent =  view('contents.levels.index', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Level',
          'menu' => 'level',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_page()
    {
      $contents = [
          // 'levels' => Levels::where('active',TRUE)->get();
      ];
      // return   $contents;
      $pagecontent =  view('contents.levels.create', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Level',
          'menu' => 'level',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_save(Request $request)
    {
      $request->validate([
        'code' => 'required|max:200',
        'name' => 'required|max:200|min:3',
        'desc' => 'required',
      ]);

      //active
       $active = FALSE;
       if($request->has('active')) {
           $active = TRUE;
       }

      $save_level = new Levels;
      $save_level->idlevels = Str::uuid();
      $save_level->code = $request->code;
      $save_level->name = $request->name;
      $save_level->description = $request->desc;
      $save_level->active = $active;
      $save_level->save();

      return redirect('level')->with('success','Add Level');
    }

    public function update_page(Levels $level)
    {
      $contents = [
          'levels' => $level
      ];
      // return   $contents;
      $pagecontent =  view('contents.levels.update', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Level',
          'menu' => 'level',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_save(Request $request, Levels $level)
    {
      $request->validate([
        'code' => 'required|max:200',
        'name' => 'required|max:200|min:3',
        'desc' => 'required',
      ]);

      //active
       $active = FALSE;
       if($request->has('active')) {
           $active = TRUE;
       }

      $save_level = Levels::find($level->idlevels);
      $save_level->code = $request->code;
      $save_level->name = $request->name;
      $save_level->description = $request->desc;
      $save_level->active = $active;
      $save_level->save();

      return redirect('level')->with('success','Updated Level');
    }

    public function delete(Levels $level)
    {
      $levels = Levels::where('idlevels',$level->idlevels)->first();
      if (!empty(  $levels)) {
        $levels->delete();
      }
      return redirect('level')->with('success','Deleted Level');

    }
}
