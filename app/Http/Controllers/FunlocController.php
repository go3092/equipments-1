<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funlocs;
use App\Models\FunlocDetails;
use App\Models\Levels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FunlocController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      $funloc = Funlocs::with(['users'])
              ->where('created_by',Auth::user()->idusers)
              ->get();

      $contents = [
        'funlocs' =>  $funloc,
      ];
      // return $contents;
      $pagecontent =  view('contents/funloc/index', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Funloc',
          'menu' => 'funloc',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_page()
    {
      $contents = [
        'levels' => Levels::where('created_by',Auth::user()->idusers)
                    ->where('active',TRUE)
                    ->get()
      ];

      $pagecontent =  view('contents/funloc/create', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Funloc',
          'menu' => 'funloc',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function save_create(Request $request)
    {
      // return $request->all();
      $request->validate([
        'date' => 'required|date',
        'desc' => 'required|max:255'
      ]);

      $idlevel = $request->idlevel;
      $number = $request->number;
      $description = $request->description;

      for ($i=0; $i < count($idlevel) ; $i++) {
        if ($idlevel[$i] == NULL) {
          return redirect()->back()->with('status_error', 'Level NULL');
        }
      }
      //save funloc
      $save_funlocs = new Funlocs;
      $save_funlocs->idfunlocs = Str::uuid();
      $save_funlocs->date = $request->date;
      $save_funlocs->description = $request->desc;
      $save_funlocs->save();
      //save funloc details
      for ($i=0; $i < count($idlevel) ; $i++) {
        $save_fundetails = new FunlocDetails;
        $save_fundetails->idfunlocdetails = Str::uuid();
        $save_fundetails->idfunlocs = $save_funlocs->idfunlocs;
        $save_fundetails->idlevels = $idlevel[$i];
        $save_fundetails->number = $number[$i];
        $save_fundetails->description = $description[$i];
        $save_fundetails->save();
      }

      return redirect('funloc')->with('success','Add Funloc');
    }

    public function update_page(Funlocs $funloc)
    {
      $funlocs = Funlocs::with([
                  'funloc_details' => function($fundet){
                    $fundet->with('levels');
                  }
                ])
                ->where('idfunlocs',$funloc->idfunlocs)
                ->first();
                // return   $funlocs;
      $contents = [
        'funloc' => $funlocs,
        'levels' => Levels::where('created_by',Auth::user()->idusers)
                    ->where('active',TRUE)
                    ->get()
      ];

      $pagecontent =  view('contents/funloc/update', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Funloc',
          'menu' => 'master',
          'submenu' => 'funloc',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_save(Request $request, Funlocs $funloc)
    {
      // return $request->all();
      $request->validate([
        'date' => 'required|date',
        'desc' => 'required'
      ]);

      $idfunlocdetails = $request->idfunlocdetails;
      $idlevel = $request->idlevel;
      $number = $request->number;
      $description = $request->description;

      for ($i=0; $i < count($idlevel) ; $i++) {
        if ($idlevel[$i] == NULL) {
          return redirect()->back()->with('status_error', 'Level NULL');
        }
      }
      //save funloc
      $save_funlocs = Funlocs::find($funloc->idfunlocs);
      $save_funlocs->date = $request->date;
      $save_funlocs->description = $request->desc;
      $save_funlocs->save();

      //save funloc details
      for ($i=0; $i < count($idfunlocdetails) ; $i++) {
        if ($idfunlocdetails[$i] == 'new') {
          $save_fundetails = new FunlocDetails;
          $save_fundetails->idfunlocdetails = Str::uuid();
          $save_fundetails->idfunlocs = $save_funlocs->idfunlocs;
        }else{
          $save_fundetails = FunlocDetails::find($idfunlocdetails[$i]);
        }
        // $save_fundetails->idfunlocs = $save_funlocs->idfunlocs;
        $save_fundetails->idlevels = $idlevel[$i];
        $save_fundetails->number = $number[$i];
        $save_fundetails->description = $description[$i];
        $save_fundetails->save();
      }

      $deleteindex = $request->deleteindex;
      if (strlen($deleteindex) > 0) {
        $del_idfundet = explode(',', $deleteindex);
        $del_idfundetails = array_values(array_filter($del_idfundet));
        FunlocDetails::whereIn('idfunlocdetails',$del_idfundetails)->delete();
      }
      return redirect('funloc')->with('success','Update Funloc');
    }

    public function delete(Funlocs $funloc)
    {
      $idfunlocs = $funloc->idfunlocs;
      $funloc = Funlocs::where('idfunlocs',$funloc->idfunlocs)->first();
      $funloc->delete();

      $funloc_details = FunlocDetails::where('idfunlocs',$idfunlocs)->get();
      foreach ($funloc_details as $value) {
          FunlocDetails::where('idfunlocs', $value->idfunlocs)->delete();
      }
      return redirect('funloc')->with('success','Deleted Funloc');

    }
}
