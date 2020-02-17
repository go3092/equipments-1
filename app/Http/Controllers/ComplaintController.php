<?php

namespace App\Http\Controllers;

use App\Models\Complaints;
use App\Models\Workers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipments;
use Excel;
use Image;
use File;

class ComplaintController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(Request $request)
    {
      $equipments = NULL;
      if (Auth::user()->role == 'm' || Auth::user()->role == 'a' ) {
        if (!$request->has('date') || !$request->has('cabang') ||!$request->has('type')) {
          $now = date('Y-m-d');
          $paramdate = 'date='.$now.'+-+'.$now;
          $cabang = 'cabang=';
          $type='type=';
          return redirect('complaint?'.$cabang.'&'.$paramdate.'&'.$type);
        }

        $daterange = explode(' - ', $request->date);
        //invalid parameter
        if(count($daterange) != 2) {
            return redirect('complaint')->with('status_error','Invalid date parameter');
        }
        //filter date
        $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
        $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

        $complaints = Complaints::join('users','complaints.created_by','=','users.idusers')
                                ->join('equipments','users.idusers','=','equipments.created_by')
                                ->select(
                                  'complaints.*',
                                  'equipments.description as cabang'
                                )
                                ->orderBy('complaints.date');

        if (strlen($request->date) > 0) {
          $complaints->whereBetween('complaints.date', [$date_start,$date_end]);
        }

        if (strlen($request->cabang) > 0) {
          $complaints->where('equipments.idequipments', $request->cabang);
        }

        if (in_array($request->type,['e','m','s','l'])) {
          $complaints->where('complaints.type', $request->type);
        }

        //get complaint search
        $complaints = $complaints->get();

        //show equipment
        $equipments = Equipments::all();


      }else{
        $complaints = Complaints::where('created_by',Auth::user()->idusers)->get();
      }

      $contents = [
        'equipments' => $equipments,
        'complaints' => $complaints,
      ];

      $pagecontent =  view('contents.complaint.index', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Complaint',
        'menu' => 'complaint',
        'submenu' => '',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_page()
    {
      $contents = [
        // 'approvals' => $approvals,
      ];

      $pagecontent =  view('contents.complaint.create', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Complaint',
        'menu' => 'complaint',
        'submenu' => '',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_save(Request $request)
    {
      // return $request->all();
      $request->validate([
        'date' => 'required|date|date_format:"Y-m-d"',
        'time_header' => 'required',
        'type' => 'required|in:e,m,s,l',
        'param' => 'required|in:j,n',
        'location' => 'required|max:255',
        // 'status' => 'required|in:o,d,p,c',
        'desc' => 'required',
        'work' => 'required',
        'photos_before' => 'file|mimes:jpeg,png,jpg',
        'photos_after' => 'file|mimes:jpeg,png,jpg'
      ]);

      $nik  = $request->nik;
      $name  = $request->name;
      $description  = $request->description;

      $filename = NULL;
      if ($request->hasFile('photos_before')) {
        $image_complaint_before = $request->file('photos_before');
        $filename =  Str::random(20).'.'.$image_complaint_before->getClientOriginalExtension();
        $cdnpath = env('UPLOAD').'complaints_image/';
        Image::make($image_complaint_before)->resize(300, 300)->save(public_path($cdnpath.$filename));
      }

      $filename_after = NULL;
      if ($request->hasFile('photos_after')) {
        $image_complaint_after = $request->file('photos_after');
        $filename_after = Str::random(20).'.'.$image_complaint_after->getClientOriginalExtension();
        $cdnpath = env('UPLOAD').'complaints_image/';
        Image::make($image_complaint_after)->resize(300, 300)->save(public_path($cdnpath.$filename_after));
      }

      $save_complaints = new Complaints;
      $save_complaints->idcomplaints = Str::uuid();
      $save_complaints->date = date('Y-m-d H:i:s',strtotime($request->date)) ;
      $save_complaints->time_header = date('H:i:s', strtotime($request->time_header));
      $save_complaints->type = $request->type;
      $save_complaints->param = $request->param;
      $save_complaints->location = $request->location;
      if (Auth::user()->role == 'l') {
        $save_complaints->status = 'o';
        $save_complaints->action_date = date('Y-m-d H:i:s');
        $save_complaints->start_time = date('H:i:s');
        $save_complaints->end_time = date('H:i:s');
      }else{
        $save_complaints->status = $request->status;
        $save_complaints->action_date = date('Y-m-d H:i:s',strtotime($request->action_date));
        $save_complaints->start_time = date('H:i:s', strtotime($request->start_time));
        $save_complaints->end_time = date('H:i:s', strtotime($request->end_time));
      }

      $save_complaints->desc = $request->desc;
      $save_complaints->informer_param  = $request->informer_param;
      $save_complaints->informer_name  = $request->informer_name;
      $save_complaints->informer_department  = $request->informer_department;
      $save_complaints->informer_position  = $request->informer_position;
      $save_complaints->work  = $request->work;
      $save_complaints->solution  = $request->solution;
      $save_complaints->img_before = $filename;
      $save_complaints->img_after = $filename_after;
      $save_complaints->save();

      for ($i=0; $i < count($nik); $i++) {
        $save_worker = new Workers;
        $save_worker->idworkers = Str::uuid();
        $save_worker->idcomplaints = $save_complaints->idcomplaints;
        $save_worker->nik = $nik[$i];
        $save_worker->name = $name[$i];
        $save_worker->desc = $description[$i];
        $save_worker->save();
      }
      return redirect('complaint')->with('success','Add complaint');
    }

    public function update_page(Complaints $complaint)
    {
      $complaint = Complaints::with(['workers'])
                  ->where('idcomplaints', $complaint->idcomplaints)
                  ->first();

      $contents = [
        'complaint' => $complaint,
      ];

      $pagecontent =  view('contents.complaint.update', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Complaint',
        'menu' => 'complaint',
        'submenu' => '',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_save(Complaints $complaint ,Request $request)
    {
      $request->validate([
        'date' => 'required|date|date_format:"Y-m-d"',
        'time_header' => 'required',
        'type' => 'required|in:e,m,s,l',
        'param' => 'required|in:j,n',
        'location' => 'required|max:255',
        'status' => 'required|in:o,d,p,c',
        'desc' => 'required',
        'work' => 'required',
        'photos_before' => 'file|mimes:jpeg,png,jpg',
        'photos_after' => 'file|mimes:jpeg,png,jpg'
      ]);

      $idworkers = $request->idworkers;
      $nik  = $request->nik;
      $name = $request->name;
      $desc = $request->description;

      $save_complaints = Complaints::find($complaint->idcomplaints);
      $save_complaints->date = $request->date;
      $save_complaints->time_header = date('H:i:s', strtotime($request->time_header));
      $save_complaints->type = $request->type;
      $save_complaints->param = $request->param;
      $save_complaints->location = $request->location;
      $save_complaints->status = $request->status;
      $save_complaints->action_date = $request->action_date;
      $save_complaints->start_time = date('H:i:s', strtotime($request->start_time));
      $save_complaints->end_time = date('H:i:s', strtotime($request->end_time));
      $save_complaints->desc = $request->desc;
      $save_complaints->informer_param  = $request->informer_param;
      $save_complaints->informer_name  = $request->informer_name;
      $save_complaints->informer_department  = $request->informer_department;
      $save_complaints->informer_position  = $request->informer_position;
      $save_complaints->work  = $request->work;
      $save_complaints->solution  = $request->solution;

      //image before null
      if (is_null($complaint->img_before)) {
        if ($request->hasFile('photos_before')) {
          $image_before_null = $request->file('photos_before');
          $insert_img_before = Str::random(20).'.'.$image_before_null->getClientOriginalExtension();
          $cdnpath = env('UPLOAD').'complaints_image/';
          Image::make($image_before_null)->resize(300, 300)->save(public_path($cdnpath.$insert_img_before));
          $save_complaints->img_before = $insert_img_before;
        }
      }
      // image before not null
      if (!is_null($complaint->img_before)) {
        $img_before = env('UPLOAD').'complaints_image/'.$complaint->img_before;
        if (!is_null($request->photos_before)) {
          if (File::exists($img_before)) {
            $image_worker_before = $request->file('photos_before');
            $filename =  Str::random(20).'.'.$image_worker_before->getClientOriginalExtension();
            $cdnpath = env('UPLOAD').'complaints_image/';
            Image::make($image_worker_before)->resize(300, 300)->save(public_path($cdnpath.$filename));
            $save_complaints->img_before = $filename;
          }
          File::delete($img_before);
        }
      }

      //image after NULL
      if (is_null($complaint->img_after)) {
        if ($request->hasFile('photos_after')) {
          $image_after = $request->file('photos_after');
          $insert_img_after =  Str::random(20).'.'.$image_after->getClientOriginalExtension();
          $cdnpath = env('UPLOAD').'complaints_image/';
          Image::make($image_after)->resize(300, 300)->save(public_path($cdnpath.$insert_img_after));
          $save_complaints->img_after = $insert_img_after;
        }
      }

      //image after not null
      if (!is_null($complaint->img_after)) {
        $img_after = env('UPLOAD').'complaints_image/'.$complaint->img_after;
        if (!is_null($request->photos_after)) {
          if (File::exists($img_after)) {
            $image_after = $request->file('photos_after');
            $update_img_after =  Str::random(20).'.'.$image_after->getClientOriginalExtension();
            $cdnpath = env('UPLOAD').'complaints_image/';
            Image::make($image_after)->resize(300, 300)->save(public_path($cdnpath.$update_img_after));
            $save_complaints->img_after = $update_img_after;
          }
          File::delete($img_after);
        }
      }

      $save_complaints->save();

      for ($i=0; $i < count($idworkers); $i++) {
        if ($idworkers[$i] == 'new') {

          $save_worker = new Workers;
          $save_worker->idworkers = Str::uuid();
          $save_worker->idcomplaints = $save_complaints->idcomplaints;
        }else{
            $save_worker =  Workers::find($idworkers[$i]);
        }
        $save_worker->nik = $nik[$i];
        $save_worker->name = $name[$i];
        $save_worker->desc = $desc[$i];
        $save_worker->save();
      }

      $deleteindex = $request->deleteindex;
      if (strlen($deleteindex) > 0) {
        $del_index = explode(',',$deleteindex);
        $work_del = array_values(array_filter($del_index));
        Workers::whereIn('idworkers',$work_del)->delete();
      }

      return redirect('complaint')->with('success','Updated complaint');
    }

    public function delete(Complaints $complaint)
    {
      $idcomplaints = $complaint->idcomplaints;
      $complaint = Complaints::where('idcomplaints', $complaint->idcomplaints)->first();
      $complaint->delete();
      $workers = Workers::where('idcomplaints', $idcomplaints)->get();
      foreach ($workers as $work) {
        Workers::where('idcomplaints', $work->idcomplaints)->delete();
      }
      return redirect('complaint')->with('success','Deleted complaint');

    }

    public function report(Request $request)
    {
      if (!$request->has('date')) {
           $now = date('Y-m-d');
           $paramdate = 'date='.$now.'+-+'.$now;
           $type='type=';
           $status = 'status=';
           return redirect('complaint/report?'.$paramdate.'&'.$type.'&'.$status);
      }


      $daterange = explode(' - ', $request->date);
      //invalid parameter
      if(count($daterange) != 2) {
          return redirect('complaint/report')->with('status_error','Invalid date parameter');
      }
        //filter date
      $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
      $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

      $workers = Workers::join('complaints','workers.idcomplaints','=','complaints.idcomplaints')
                        ->select(
                          'complaints.*',
                          'workers.created_by as create_work',
                          'workers.name as name_work',
                          'workers.nik as nik_work'

                        )
                        ->where('complaints.created_by',Auth::user()->idusers)
                        ->where('workers.created_by',Auth::user()->idusers);

      if (strlen($request->date) > 0) {
          $workers->whereBetween('complaints.date', [$date_start,$date_end]);
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
        'datacomplaint' => $datacomplaint,
      ];

      $pagecontent =  view('contents.complaint.report', $contents);

      //masterpage
      $pagemain = array(
        'title' => 'Complaint',
        'menu' => 'complaint',
        'submenu' => '',
        'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function excel(Request $request)
    {
      if ($request->has('date') || $request->has('type') || $requets->has('status') ) {
        $daterange = explode('_', $request->date);
        if(count($daterange) != 2) {
          return redirect('complaint/report')->with('status_error','Invalid date parameter');
        }
        //filter date
        $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
        $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

        $workers = Workers::join('complaints','workers.idcomplaints','=','complaints.idcomplaints')
                          ->select(
                            'complaints.*',
                            'workers.created_by as create_work',
                            'workers.name as name_work',
                            'workers.nik as nik_work'
                          )
                          ->where('complaints.created_by',Auth::user()->idusers)
                          ->where('workers.created_by',Auth::user()->idusers);

        if (strlen($request->date) > 0) {
            $workers->whereBetween('complaints.date', [$date_start,$date_end]);
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
              'name' => $work->name_work
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
