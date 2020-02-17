<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Energys;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Excel;
class EnergysController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      $contents = [
         'energys' =>  Energys::where('created_by',Auth::user()->idusers)->get()
      ];
      $pagecontent =  view('contents.energys.index', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Energys Using',
        'menu' => 'energys',
        'submenu' => '',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_page()
    {
      $contents = [

      ];
      $pagecontent =  view('contents.energys.create', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Energys Using',
        'menu' => 'energys',
        'submenu' => '',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_save(Request $request)
    {
      $request->validate([
        'type' => 'required|in:a,l,s',
        'volume' => 'required|numeric',
        'date' => 'required|date',
        'desc' => 'required'
      ]);

      $save_energys = new Energys;
      $save_energys->idenergys = str::uuid();
      $save_energys->type = $request->type;
      $save_energys->volume = $request->volume;
      $save_energys->period = $request->date;
      $save_energys->desc = $request->desc;
      $save_energys->save();

      return redirect('energys')->with('success','Add Energys');

    }

    public function update_page(Energys $energys)
    {
      $contents = [
        'energys' => $energys
      ];
      $pagecontent =  view('contents.energys.update', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Energys Using',
        'menu' => 'energys',
        'submenu' => '',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_save(Energys $energys, Request $request)
    {
      $request->validate([
        'type' => 'required|in:a,l,s',
        'volume' => 'required|numeric',
        'date' => 'required|date',
        'desc' => 'required'
      ]);

      $save_energys = Energys::find($energys->idenergys);
      $save_energys->type = $request->type;
      $save_energys->volume = $request->volume;
      $save_energys->period = $request->date;
      $save_energys->desc = $request->desc;
      $save_energys->save();

      return redirect('energys')->with('success','Updated Energys');

    }

    public function delete(Energys $energys)
    {
      $energy = Energys::where('idenergys',$energys->idenergys)->first();
      $energy->delete();
      return redirect('energys')->with('success','Deleted Energys');

    }

    public function report(Request $request)
    {
      if (!$request->has('date') || !$request->has('type')) {
        $now = date('Y-m-d');
        $paramdate = 'date='.$now.'+-+'.$now;
        $type='type=';
        return redirect('energys/report?'.$paramdate.'&'.$type);
      }

      $daterange = explode(' - ', $request->date);
      //invalid parameter
      if(count($daterange) != 2) {
          return redirect('energys/report')->with('status_error','Invalid date parameter');
      }

        //filter date
      $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
      $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

      $energys = Energys::where('created_by', Auth::user()->idusers);

      if (strlen($request->date) > 0) {
        $energys->whereBetween('period',[$date_start,$date_end]);
      }

      if (in_array($request->type,['l','a','s'])) {
        $energys->where('type',$request->type);
      }


      $contents = [
        'energys' => $energys->get()
      ];
      $pagecontent =  view('contents.energys.report', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Energys Using',
        'menu' => 'energys',
        'submenu' => '',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function excel(Request $request)
    {
      if ($request->has('date') || $request->has('type')) {
        $daterange = explode('_', $request->date);
        if(count($daterange) != 2) {
          return redirect('energys/report')->with('status_error','Invalid date parameter');
        }
        //filter date
        $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
        $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));
        //get energys
        $energys = Energys::where('created_by', Auth::user()->idusers);

        if (strlen($request->date) > 0) {
          $energys->whereBetween('period',[$date_start,$date_end]);
        }

        if (in_array($request->type,['l','a','s'])) {
          $energys->where('type',$request->type);
        }

        $data_energy  = $energys->get();
        // return $data_energy;
        // die;
        $data_energy_excel = [];

        foreach ($data_energy as $energy) {
          $types = '';
          if ($energy->type == 'l') {
            $types = 'Listrik';
          }elseif ($energy->type == 'a') {
            $types = 'Air Pam';
          }elseif ($energy->type == 's') {
            $types = 'Solar';
          }

          $data_energy_excel [] = [
            'type' => $types,
            'volume' => $energy->volume,
            'period' => date('Y-m-d',strtotime($energy->period)),
            'desc' => $energy->desc
          ];
        }
        // return $data_energy_excel;
        Excel::create('Data Enerrgy Using', function($excel) use ($data_energy_excel) {
             $excel->sheet('Data Enerrgy Using', function($sheet) use ($data_energy_excel) {

                 $sheet->fromArray($data_energy_excel,null,'A1',false,false)->prependRow(
                     array(
                         'Type','Volume','Period','Description'
                     )
                 );
             });
         })->download('xls');
      }
    }
}
