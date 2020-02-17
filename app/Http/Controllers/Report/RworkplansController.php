<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Workplans;
use App\Models\EquipmentDetails;
use App\Models\Equipments;
use Excel;

class RworkplansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
      if (!$request->has('date') || !$request->has('type') || !$request->has('action_by') ) {
        $now = date('Y-m-d');
        $paramdate = 'date='.$now.'+-+'.$now;
        $cabang = 'cabang=';
        $type='type=';
        $status = 'action_by=';
        return redirect('report/rworkplane?'.$paramdate.'&'.$cabang.'&'.$type.'&'.$status);
      }

      $daterange = explode(' - ', $request->date);
      //invalid parameter
      if(count($daterange) != 2) {
          return redirect('workplane/report')->with('status_error','Invalid date parameter');
      }
        //filter date
      $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
      $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

      $workplans = Workplans::join('equipment_details','workplans.idequipmentdetails','=','equipment_details.idequipmentdetails')
                  ->join('equipments','equipment_details.idequipments','=','equipments.idequipments')
                  ->join('items','equipment_details.iditems','=','items.iditems')
                  ->select(
                    'workplans.*',
                    'equipments.idequipments as idequipments',
                    'equipments.description as cabang',
                    'items.name as nameitems',
                    'items.merk as merkitems'

                  )
                  ->orderBy('idworkplans');

      if (strlen($request->date) > 0) {
        $workplans->whereBetween('workplans.workplan_date',[$date_start,$date_end]);
      }

      if (strlen($request->cabang)) {
        $workplans->where('equipments.idequipments',$request->cabang);
      }

      if (strlen($request->type) > 0) {
        $workplans->where('workplans.workplan_type',$request->type);
      }

      if (in_array($request->action_by,['i','e'])) {
        $workplans->where('workplans.type', $request->action_by);
      }

      $work = $workplans->get();
      // return $work;
      $contents = [
        'equipments' => Equipments::all(),
        'workplans' => $work,
      ];

      $pagecontent =  view('contents.report.workplan.index', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Report Work Plan',
        'menu' => 'report',
        'submenu' => 'report_workplane',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function excel(Request $request)
    {
      if ($request->has('date') || $request->has('type') || $request->has('action_by') ) {
        $daterange = explode('_', $request->date);
        //invalid parameter
        if(count($daterange) != 2) {
            return redirect('workplane/report')->with('status_error','Invalid date parameter');
        }

          //filter date
        $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
        $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

        $workplans = Workplans::join('equipment_details','workplans.idequipmentdetails','=','equipment_details.idequipmentdetails')
                    ->join('equipments','equipment_details.idequipments','=','equipments.idequipments')
                    ->join('items','equipment_details.iditems','=','items.iditems')
                    ->select(
                      'workplans.*',
                      'equipments.idequipments as idequipments',
                      'equipments.description as cabang',
                      'items.name as nameitems',
                      'items.merk as merkitems'

                    )
                    ->orderBy('idworkplans');


        if (strlen($request->date) > 0) {
          $workplans->whereBetween('workplans.workplan_date',[$date_start,$date_end]);
        }

        if (strlen($request->cabang)) {
          $workplans->where('equipments.idequipments',$request->cabang);
        }

        if (strlen($request->type) > 0) {
          $workplans->where('workplans.workplan_type',$request->type);
        }

        if (in_array($request->action_by,['i','e'])) {
          $workplans->where('workplans.type', $request->action_by);
        }

        $works = $workplans->get();
        // return $works;
        $data_workplans = [];
        foreach ($works as $work) {
          if ($work->workplan_type == 'HR') {
            $worktype = 'HR (Harian)';
          }elseif ($work->workplan_type == '1M') {
            $worktype = '1M (Satu Mingguan)';
          }elseif ($work->workplan_type == '1B') {
            $worktype = '1B (Satu Bulan)';
          }elseif ($work->workplan_type == '2B') {
            $worktype = '2B (Dua Bulan)';
          }elseif ($work->workplan_type == '3B') {
            $worktype = '3B (Tiga Bulan)';
          }elseif ($work->workplan_type == '6B') {
            $worktype = '6B (Enam Bulan)';
          }elseif ($work->workplan_type == 'YR') {
            $worktype = 'YR (1 Tahun)';
          }

          if ($work->type == 'e') {
            $type = 'External';
          }else{
            $type = 'Internal';
          }

          $data_workplans[] = [
            'cabang' => $work->cabang,
            'items' => $work->nameitems,
            'merk' => $work->merkitems,
            'work_type' =>  $worktype,
            'week' => $work->workplan_week,
            'date' => date('Y-m-d',strtotime($work->workplan_date)),
            'type' => $type,
            'desc' => $work->desc,
            'worker' => $work->worker,
          ];
        }
        // return $data_workplans;
          Excel::create('Data Work Plan', function($excel) use ($data_workplans) {
               $excel->sheet('Data Work Plan', function($sheet) use ($data_workplans) {

                   $sheet->fromArray($data_workplans,null,'A1',false,false)->prependRow(
                       array(
                           'Cabang', 'Item', 'Merk','Work Type','Week/Month','Date','Type','Desc','Worker'
                       )
                   );
               });
           })->download('xls');
      }
    }
}
