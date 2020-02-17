<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Equipments;
use App\Models\Workers;
use Excel;

class RcomplaintsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      if (!$request->has('date') || !$request->has('cabang') ||!$request->has('type') || !$request->has('status') ) {
        $now = date('Y-m-d');
        $paramdate = 'date='.$now.'+-+'.$now;
        $cabang = 'cabang=';
        $type='type=';
        $status = 'status=';
        return redirect('report/rcomplaint?'.$paramdate.'&'.$cabang.'&'.$type.'&'.$status);
      }


        $daterange = explode(' - ', $request->date);
        //invalid parameter
        if(count($daterange) != 2) {
            return redirect('report/rcomplaint')->with('status_error','Invalid date parameter');
        }
          //filter date
        $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
        $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

        $workers = Workers::join('complaints','workers.idcomplaints','=','complaints.idcomplaints')
                          ->join('users','complaints.created_by','=','users.idusers')
                          ->join('equipments','users.idusers','=','equipments.created_by')
                          ->select(
                            'complaints.*',
                            'workers.name as workname',
                            'workers.nik as worknik',
                            'workers.desc as workdesc',
                            'equipments.description as eqdesc',
                            'equipments.idequipments as idequipments'
                            )
                          ->orderBy('idworkers');
        // return $workers->get();
        if (strlen($request->date) > 0) {
            $workers->whereBetween('complaints.date', [$date_start,$date_end]);
        }
        if (strlen($request->cabang)) {
          $workers->where('equipments.idequipments',$request->cabang);
        }
        if (in_array($request->type,['e','m','s','l'])) {
          $workers->where('complaints.type', $request->type);
        }
        if (in_array($request->status,['o','p','d','c'])) {
          $workers->where('complaints.status', $request->status);
        }

        $getworker = $workers->get();
        $datacomplaint = [];
        foreach ($getworker as $work) {
          if (!isset($datacomplaint[$work->idcomplaints])) {
            $datacomplaint [$work->idcomplaints] = [
              'header' => $work,
              'detail' => []
            ];
          }
          $datacomplaint[$work->idcomplaints]['detail'][] = $work;
        }
        // return $datacomplaint;
      $contents = [
        'equipments' => Equipments::all(),
        'datacomplaint' => $datacomplaint,
      ];

      $pagecontent =  view('contents.report.complaints.index', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Report Complaint',
        'menu' => 'report',
        'submenu' => 'report_complaint',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function excel(Request $request)
    {
      if ($request->has('date') || $request->has('cabang') || $request->has('type') || $requets->has('status') ) {
        $daterange = explode('_', $request->date);
        if(count($daterange) != 2) {
          return redirect('complaint/report')->with('status_error','Invalid date parameter');
        }
        //filter date
        $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
        $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

        $workers = Workers::join('complaints','workers.idcomplaints','=','complaints.idcomplaints')
                          ->join('users','complaints.created_by','=','users.idusers')
                          ->join('equipments','users.idusers','=','equipments.created_by')
                          ->select(
                            'complaints.*',
                            'workers.name as workname',
                            'workers.nik as worknik',
                            'workers.desc as workdesc',
                            'equipments.description as eqdesc',
                            'equipments.idequipments as idequipments'
                            )
                          ->orderBy('idworkers');
                          // ->where('complaints.created_by',Auth::user()->idusers)
                          // ->where('workers.created_by',Auth::user()->idusers);

        if (strlen($request->date) > 0) {
            $workers->whereBetween('complaints.date', [$date_start,$date_end]);
        }
        if (strlen($request->cabang)) {
          $workers->where('equipments.idequipments',$request->cabang);
        }
        if (in_array($request->type,['e','m','s','l'])) {
          $workers->where('complaints.type', $request->type);
        }
        if (in_array($request->status,['o','p','d','c'])) {
          $workers->where('complaints.status', $request->status);
        }

        $getworker = $workers->get();
        // return $getworker;
        $datacomplaint = [];
        $idx = [];

        foreach ($getworker as $index => $work) {
          if (!isset($idx[$work->idcomplaints])) {
            $idx[$work->idcomplaints] = TRUE;

            $datacomplaint[] = [
              'nik' => $work->nik_work ,
              'name' => $work->name_work,
              'cabang' => $work->eqdesc
            ];
          }

          $type = $param = $tatus = '';
          //type
          if($work->type == 'm') {
            $type = 'Mekanikal';
          }elseif ($work->type == 'e') {
            $type = 'Elektonikal';
          }elseif ($work->type == 's') {
            $type = 'Sipil';
          }elseif ($work->type == 'l') {
            $type = 'Lain Lain';
          }
          //param
          if ($work->param == 'j') {
            $param = 'Job';
          }else{
            $param = 'Non Job';
          }
          //status
          if ($work->status == 'o') {
            $status = 'Open';
          }elseif ($work->status == 'p') {
            $status = 'Pending';
          }elseif ($work->status == 'd') {
            $status = 'Done';
          }elseif ($work->status == 'c') {
            $status = 'Cancel';
          }
            $datacomplaint[] = [
              'date' => date('Y-m-d',strtotime($work->date)),
              'time_header' => date('h:i A',strtotime($work->time_header)),
              'location' => $work->location,
              'type' => $type,
              'param' => $param,
              'status' => $status,
              'action_date' =>  date('Y-m-d',strtotime($work->action_date)),
              'start_time' => date('h:i A',strtotime($work->start_time)),
              'end_time' => date('h:i A',strtotime($work->end_time)),
              'desc' => $work->desc,
              'informer_param' => $work->informer_param,
              'informer_name' => $work->informer_name,
              'informer_department' => $work->informer_department,
              'informer_position' => $work->informer_position,
              'work' => $work->work,
              'solution' => $work->solution,
            ];
        }
        // return $datacomplaint;
          Excel::create('Data Complaint', function($excel) use ($datacomplaint) {
               $excel->sheet('Data Complaint', function($sheet) use ($datacomplaint) {

                   $sheet->fromArray($datacomplaint,null,'A1',false,false)->prependRow(
                       array(
                           'Date', 'Time', 'Location','Type','Param','Status','Action Date','Start Date','End Date','Desc','Informer Param', 'Informer Name','Informer Department','Informer Position','Work','Solution'
                       )
                   );
               });
           })->download('xls');
      }
    }
}
