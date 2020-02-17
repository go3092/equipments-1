<?php

namespace App\Http\Controllers;

use File;
use Excel;
use Image;
use Illuminate\Http\Request;
use App\Models\EquipmentDetails;
use Illuminate\Support\Facades\Auth;
use App\Models\Workplans;
use Illuminate\Support\Str;

class WorkplaneController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $eq_det  = EquipmentDetails::with([
                'equipments',
                'items',
                'funloc_details' => function($fundet){
                  $fundet->with('levels');
                }
              ])
              ->where('created_by', Auth::user()->idusers)
              ->get();

    $workplans = Workplans::with([
                  'equipment_details' => function($equdet){
                    $equdet->with(
                      'equipments',
                      'items'
                    );
                  }
                ])
                ->where('created_by', Auth::user()->idusers)
                ->get();
    // return $workplans;
    $contents = [
      'equdets' => $eq_det,
      'workplans' => $workplans
    ];
    // return   $contents;
    $pagecontent =  view('contents/workplane/index', $contents);

    //masterpage
    $pagemain = array(
        'title' => 'Work Plane',
        'menu' => 'workplane',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
    }

    public function create_page(EquipmentDetails $equdet)
    {

      $equipment_det = EquipmentDetails::with([
                        'workplans',
                        'items',
                        'equipments',
                        'funloc_details'
                      ])
                      ->where('created_by', $equdet->created_by)
                      ->where('idequipmentdetails', $equdet->idequipmentdetails)
                      ->get();
      // return $equipment_det ;
      $contents = [
        'equipment_det' => $equipment_det,
        'equdets' => $equdet
      ];
      // return   $contents;
      $pagecontent =  view('contents/workplane/create', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Work Plane',
          'menu' => 'workplane',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_save(EquipmentDetails $equdet,Request $request)
    {
      $request->validate([
        'workplane_type' => 'required',
        'plan_week' => 'required|numeric',
        'plan_date' => 'required|date',
        'type' => 'required',
        'plan_desc' => 'required',
        'photos_before' => 'file|mimes:jpeg,png,jpg',
        'photos_after' => 'file|mimes:jpeg,png,jpg'
      ]);

      $filename = NULL;
      if ($request->hasFile('photos_before')) {
        $image_worker = $request->file('photos_before');
        $filename =  Str::random(20).'.'.$image_worker->getClientOriginalExtension();
        $cdnpath = env('UPLOAD').'workplan_image/';
        Image::make($image_worker)->resize(300, 300)->save(public_path($cdnpath.$filename));
      }

      $file_after = NULL;
      if ($request->hasFile('photos_after')) {
        $image_after = $request->file('photos_after');
        $file_after  =   Str::random(20).'.'.$image_after->getClientOriginalExtension();
        $cdnpath = env('UPLOAD').'workplan_image/';
        Image::make($image_after)->resize(300, 300)->save(public_path($cdnpath.$file_after));

      }

      $save_workplane = new Workplans;
      $save_workplane->idworkplans = Str::uuid();
      $save_workplane->idequipmentdetails = $request->idequipmentdetails;
      $save_workplane->workplan_type = $request->workplane_type;
      $save_workplane->workplan_week = $request->plan_week;
      $save_workplane->workplan_date = $request->plan_date;
      $save_workplane->type = $request->type;
      $save_workplane->desc = $request->plan_desc;
      $save_workplane->image_before = $filename;
      $save_workplane->image_after = $file_after;
      $save_workplane->save();

      return redirect('workplane')->with('success','Add Workplane');
    }

    public function update_page(Request $request,Workplans $workplan)
    {
      // return $request->user();
      $eq_det  = EquipmentDetails::with([
                  'equipments',
                  'items',
                  'funloc_details' => function($fundet){
                    $fundet->with('levels');
                  },'workplans'
                ])
                ->where('created_by', Auth::user()->idusers)
                ->where('idequipmentdetails', $workplan->idequipmentdetails)
                ->first();
        // return $eq_det;
      $contents = [
        'equipment_det' => $eq_det,
        'workplans' => $workplan
      ];
      // return   $contents;
      $pagecontent =  view('contents/workplane/update', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Work Plan',
          'menu' => 'workplane',
          'submenu' => '',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_save(Request $request,Workplans $workplan)
    {
      $request->validate([
        'workplane_type' => 'required',
        'plan_week' => 'required|numeric',
        'plan_date' => 'required|date',
        'type' => 'required',
        'plan_desc' => 'required',
        'photos_before' => 'file|mimes:jpeg,png,jpg',
        'photos_after' => 'file|mimes:jpeg,png,jpg'
      ]);

      $save_workplane = Workplans::find($workplan->idworkplans);
      $save_workplane->workplan_type = $request->workplane_type;
      $save_workplane->workplan_week = $request->plan_week;
      $save_workplane->workplan_date = $request->plan_date;
      $save_workplane->type = $request->type;
      $save_workplane->desc = $request->plan_desc;
      $save_workplane->worker = $request->worker;

      //image before null
      if (is_null($workplan->image_before)) {
        if ($request->hasFile('photos_before')) {
          $image_worker_before = $request->file('photos_before');
          $filename_before =  Str::random(20).'.'.$image_worker_before->getClientOriginalExtension();
          $cdnpath = env('UPLOAD').'workplan_image/';
          Image::make($image_worker_before)->resize(300, 300)->save(public_path($cdnpath.$filename_before));
          $save_workplane->image_before = $filename_before;
        }
      }
      //image before  not null
      if (!is_null($workplan->image_before)) {
        $img_before = env('UPLOAD').'workplan_image/'.$workplan->image_before;
        if (!is_null($request->photos_before)) {
          if (File::exists($img_before)) {
            $image_worker_before = $request->file('photos_before');
            $filename =  Str::random(20).'.'.$image_worker_before->getClientOriginalExtension();
            $cdnpath = env('UPLOAD').'workplan_image/';
            Image::make($image_worker_before)->resize(300, 300)->save(public_path($cdnpath.$filename));
            $save_workplane->image_before = $filename;
          }
          File::delete($img_before);
        }
      }

      //image after null
      if ($workplan->image_after == NULL) {
        if ($request->hasFile('photos_after')) {
          $image_worker_after = $request->file('photos_after');
          $filename =  Str::random(20).'.'.$image_worker_after->getClientOriginalExtension();
          $cdnpath = env('UPLOAD').'workplan_image/';
          Image::make($image_worker_after)->resize(300, 300)->save(public_path($cdnpath.$filename));
          $save_workplane->image_after = $filename;
        }
      }
      //image after not null
      if ($workplan->image_after != NULL) {
        $img_after = env('UPLOAD').'workplan_image/'.$workplan->image_after;
        if (!is_null($request->photos_after)) {
          if (File::exists($img_after)) {
            $image_worker_after_upd = $request->file('photos_after');
            $filephoto =Str::random(20).'.'.$image_worker_after_upd->getClientOriginalExtension();
            $cdnpath = env('UPLOAD').'workplan_image/';
            Image::make($image_worker_after_upd)->resize(300, 300)->save(public_path($cdnpath.$filephoto));
            $save_workplane->image_after = $filephoto;
          }
          File::delete($img_after);
        }
      }

      $save_workplane->save();

      return redirect('workplane')->with('success','Updated Workplan');
    }

    public function delete(Workplans $workplan)
    {
      $workplane = Workplans::where('idworkplans',$workplan->idworkplans)->first();
      $workplane->delete();

      $filename = env('UPLOAD').'workplan_image/'.$workplane->image;
      if (File::exists($filename)) {
         File::delete($filename);
       }

    return redirect('/workplane')->with('success', 'Work plan deleted');

    }

    public function report(Request $request)
    {
      if (!$request->has('date') || !$request->has('type') || !$request->has('action_by') ) {
        $now = date('Y-m-d');
        $paramdate = 'date='.$now.'+-+'.$now;
        $type='type=';
        $status = 'action_by=';
        return redirect('workplane/report?'.$paramdate.'&'.$type.'&'.$status);
      }

      $daterange = explode(' - ', $request->date);
      //invalid parameter
      if(count($daterange) != 2) {
          return redirect('workplane/report')->with('status_error','Invalid date parameter');
      }
        //filter date
      $date_start = date('Y-m-d 00:00:00',strtotime($daterange[0]));
      $date_end = date('Y-m-d 23:59:59',strtotime($daterange[1]));

      $workplans = Workplans::with([
                    'equipment_details' => function($equdet){
                      $equdet->with('equipments','items');
                    }
                  ])
                  ->where('created_by',Auth::user()->idusers);

      if (strlen($request->date) > 0) {
        $workplans->whereBetween('workplan_date',[$date_start,$date_end]);
      }

      if (strlen($request->type) > 0) {
        $workplans->where('workplan_type',$request->type);
      }

      if (in_array($request->action_by,['i','e'])) {
        $workplans->where('type', $request->action_by);
      }

      $work = $workplans->get();
      // return $work;
      $contents = [
        'Workplans' => $work,
        // 'workplans' => $workplan
      ];

      $pagecontent =  view('contents/workplane/report', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Work Plane',
          'menu' => 'workplane',
          'submenu' => '',
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

        $workplans = Workplans::with([
                      'equipment_details' => function($equdet){
                        $equdet->with('equipments','items');
                      }
                    ])
                    ->where('created_by',Auth::user()->idusers);

        if (strlen($request->date) > 0) {
          $workplans->whereBetween('workplan_date',[$date_start,$date_end]);
        }

        if (strlen($request->type) > 0) {
          $workplans->where('workplan_type',$request->type);
        }

        if (in_array($request->action_by,['i','e'])) {
          $workplans->where('type', $request->action_by);
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
            'cabang' => $work->equipment_details->equipments->description,
            'items' => $work->equipment_details->items->name,
            'merk' => $work->equipment_details->items->merk,
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
