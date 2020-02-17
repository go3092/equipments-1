<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Energys;
use App\Models\Equipments;
use Excel;

class RenergysController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
    if (!$request->has('date') || !$request->has('type')) {
      $now = date('Y-m-d');
      $paramdate = 'date='.$now.'+-+'.$now;
      $type='type=';
      $cabang='cabang=';
      return redirect('report/renergys?'.$paramdate.'&'.$cabang.'&'.$type);
    }

    $daterange = explode(' - ', $request->date);
    //invalid parameter
    if(count($daterange) != 2) {
        return redirect('report/renergys')->with('status_error','Invalid date parameter');
    }

      //filter date
    $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
    $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

    $energys = Energys::join('users','energys.created_by','=','users.idusers')
              ->join('equipments','users.idusers','=','equipments.created_by')
              ->orderBy('energys.idenergys')
              ->select(
                'energys.*',
                'equipments.idequipments as idequipments',
                'equipments.description as cabang'
              );

    if (strlen($request->date) > 0) {
      $energys->whereBetween('energys.period',[$date_start,$date_end]);
    }

    if (strlen($request->cabang)) {
      $energys->where('equipments.idequipments',$request->cabang);
    }

    if (in_array($request->type,['l','a','s'])) {
      $energys->where('energys.type',$request->type);
    }

    $data_energys  = $energys->get();
    // return $data_energys  ;
    $contents = [
      'equipments' => Equipments::all(),
      'energys' => $data_energys
    ];

    $pagecontent =  view('contents.report.energys.index', $contents);

    //masterpage
    $pagemain = array(
      'title' => 'Report Complaint',
      'menu' => 'report',
      'submenu' => 'report_energys',
      'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function excel(Request $request)
  {
    if (!$request->has('date') || !$request->cabang || !$request->type) {
      $daterange = explode('_', $request->date);
      if(count($daterange) != 2) {
        return redirect('report/renergys')->with('status_error','Invalid date parameter');
      }
      //filter date
      $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
      $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

      $energys = Energys::join('users','energys.created_by','=','users.idusers')
                ->join('equipments','users.idusers','=','equipments.created_by')
                ->orderBy('energys.idenergys')
                ->select(
                  'energys.*',
                  'equipments.idequipments as idequipments',
                  'equipments.description as cabang'
                );
      if (strlen($request->date) > 0) {
        $energys->whereBetween('energys.period',[$date_start,$date_end]);
      }

      if (strlen($request->cabang)) {
        $energys->where('equipments.idequipments',$request->cabang);
      }

      if (in_array($request->type,['l','a','s'])) {
        $energys->where('energys.type',$request->type);
      }

      $data_energys  = $energys->get();
      $data_excel_energys = [];

      foreach ($data_energys as $energy) {
        if ($energy->type == 'l') {
          $types = 'Listrik';
        }elseif ($energy->type == 'a') {
          $types = 'Air Pam';
        }elseif ($energy->type == 's') {
          $types = 'Solar';
        }
        //populate all energys
        $data_excel_energys[] = [
          'cabang' => $energy->cabang,
          'type' => $types,
          'volume' => $energy->volume,
          'period' => date('Y-m-d',strtotime($energy->period)),
          'desc' => $energy->desc
        ];
      }
      // return $data_excel_energys;
      Excel::create('Report Energys', function($excel) use ($data_excel_energys) {
           $excel->sheet('Report Energys', function($sheet) use ($data_excel_energys) {

               $sheet->fromArray($data_excel_energys,null,'A1',false,false)->prependRow(
                   array(
                       'Cabang','Type', 'Volume','Period','Description'
                   )
               );
           });
       })->download('xls');
    }
  }
}
