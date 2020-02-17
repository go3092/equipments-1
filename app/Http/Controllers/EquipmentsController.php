<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Approvals;
use App\Models\Equipments;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FunlocDetails;
use App\Models\EquipmentDetails;
use Illuminate\Support\Facades\Auth;

class EquipmentsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index()
  {
    $equipment  = Equipments::with(['users'])
                  ->where('created_by', Auth::user()->idusers)
                  ->get();
    $contents = [
      'equipments' => $equipment,
    ];

    $pagecontent =  view('contents.equipments.index', $contents);

    //masterpage
    $pagemain = array(
      'title' => 'Equipments',
      'menu' => 'equipment',
      'submenu' => '',
      'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function create_page()
  {
    $funlocs = FunlocDetails::with('levels')
              ->where('created_by',Auth::user()->idusers)
              ->get();
    // return $funlocs;
    $contents = [
      'fundets' => $funlocs,
      'items' => Items::where('active',TRUE)->get(),
    ];

    // return $contents;
    $pagecontent =  view('contents/equipments/create', $contents);

    //masterpage
    $pagemain = array(
      'title' => 'Equipments',
      'menu' => 'equipment',
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

    $iditems = $request->iditems;
    $idfunlocdetails = $request->idfunlocdetails;
    $equipment_number = $request->equipment_number;
    $model_number = $request->model_number;
    $rate_number = $request->rate_number;
    $month_construction = $request->month_construction;
    $year_construction = $request->year_construction;
    $date_instalation = $request->date_instalation;
    $description = $request->description;
    //save equipment
    $save_equipment = new Equipments;
    $save_equipment->idequipments = Str::uuid();
    $save_equipment->date_eq = $request->date;
    $save_equipment->description = $request->desc;
    $save_equipment->save();

    //save equipment details
    for ($i=0; $i < count($iditems); $i++) {
      $save_eqdet = new EquipmentDetails;
      $save_eqdet->idequipmentdetails = Str::uuid();
      $save_eqdet->idequipments = $save_equipment->idequipments;
      $save_eqdet->iditems = $iditems[$i];
      $save_eqdet->idfunlocdetails = $idfunlocdetails[$i];
      $save_eqdet->equipment_number = $equipment_number[$i];
      $save_eqdet->model_number = $model_number[$i];
      $save_eqdet->rate_number = $rate_number[$i];
      $save_eqdet->month_construction = $month_construction[$i];
      $save_eqdet->year_construction = $year_construction[$i];
      $save_eqdet->date_instalation = $date_instalation[$i];
      $save_eqdet->description = $description[$i];
      $save_eqdet->status = 'p';
      $save_eqdet->save();
      //create approvals
      $this->create_approvals($save_eqdet->idequipmentdetails,$save_eqdet->status);
    }
    return redirect('equipments')->with('success','Add equipment');
  }

  public function update_page(Equipments $equipment)
  {
    $funlocs = FunlocDetails::with('levels')
              ->where('created_by',Auth::user()->idusers)
              ->get();

    $equipments = Equipments::with([
                    'equipment_details' => function($eqdet){
                      $eqdet->with([
                        'funloc_details' => function($funlocs){
                          $funlocs->with('levels');
                        }
                      ]);
                    }
                  ])
                  ->where('idequipments', $equipment->idequipments)
                  ->where('created_by', $equipment->created_by)
                  ->first();
    // return $equipments;
    $contents = [
      'equipment' => $equipments,
      'fundets' => $funlocs,
      'items' => Items::where('active',TRUE)->get(),
    ];

    // return $contents;
    $pagecontent =  view('contents/equipments/update-new', $contents);

    //masterpage
    $pagemain = array(
      'title' => 'Equipments',
      'menu' => 'equipment',
      'submenu' => '',
      'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function update_save(Equipments $equipment,Request $request)
  {
    $request->validate([
      'date' => 'required|date',
      'desc' => 'required'
    ]);

    $idequipmentdetails = $request->idequipmentdetails;
    $iditems = $request->iditems;
    $idfunlocdetails = $request->idfunlocdetails;
    $equipment_number = $request->equipment_number;
    $model_number = $request->model_number;
    $rate_number = $request->rate_number;
    $month_construction = $request->month_construction;
    $year_construction = $request->year_construction;
    $date_instalation = $request->date_instalation;
    $description = $request->description;

    //save equipment
    $save_equipment = Equipments::find($equipment->idequipments);
    $save_equipment->date_eq = $request->date;
    $save_equipment->description = $request->desc;
    $save_equipment->save();

    for ($i=0; $i < count($idequipmentdetails); $i++) {
      if ($idequipmentdetails[$i] == 'new') {
        $save_eqdet = new EquipmentDetails;
        $save_eqdet->idequipmentdetails = Str::uuid();
        $save_eqdet->idequipments = $save_equipment->idequipments;
        $save_eqdet->status = 'p';
        $this->create_approvals($save_eqdet->idequipmentdetails,$save_eqdet->status);
      }else{
        $save_eqdet = EquipmentDetails::find($idequipmentdetails[$i]);
      }
      $save_eqdet->iditems = $iditems[$i];
      $save_eqdet->idfunlocdetails = $idfunlocdetails[$i];
      $save_eqdet->equipment_number = $equipment_number[$i];
      $save_eqdet->model_number = $model_number[$i];
      $save_eqdet->rate_number = $rate_number[$i];
      $save_eqdet->month_construction = $month_construction[$i];
      $save_eqdet->year_construction = $year_construction[$i];
      $save_eqdet->date_instalation = $date_instalation[$i];
      $save_eqdet->description = $description[$i];
      $save_eqdet->save();
    }
    //delete equipment details
    $deleteindex = $request->deleteindex;
    if (strlen($deleteindex) > 0) {
      $del_ideqdet =  explode(',', $deleteindex);
      $del_index = array_values(array_filter($del_ideqdet));
      EquipmentDetails::whereIn('idequipmentdetails',$del_index)->delete();
      Approvals::whereIn('idequipmentdetails',$del_index)->delete();
    }
    return redirect('equipments')->with('success','Add equipment');
  }

  public function update_details(Request $request)
  {
    $equipmentdet = EquipmentDetails::find($request->idequipmentdetails);
    $equipmentdet->idfunlocdetails = $request->idfunlocdetails;
    $equipmentdet->iditems = $request->iditems;
    $equipmentdet->equipment_number = $request->equipment_number;
    $equipmentdet->model_number = $request->model_number;
    $equipmentdet->rate_number = $request->rate_number;
    $equipmentdet->month_construction = $request->month_construction;
    $equipmentdet->year_construction = $request->year_construction;
    $equipmentdet->date_instalation = $request->date_instalation;
    $equipmentdet->description = $request->description;
    $equipmentdet->save();
    return redirect('equipments/update/'.$request->idequipments)->with('success','Update equipment');

  }

  public function delete_details(Request $request)
  {
      $equipmentdet = EquipmentDetails::find($request->idequipments_details);
      if (!empty($equipmentdet)) {
        $equipmentdet->delete();
        Approvals::where('idequipmentdetails',$equipmentdet->idequipmentdetails)->update(['seen' => true]);
        Approvals::where('idequipmentdetails',$equipmentdet->idequipmentdetails)->delete();
      }
      return redirect('equipments/update/'.$request->idequipments_header)->with('success','Deleted equipment');

  }



  public function create_details(Equipments $equipment)
  {
    $funlocs = FunlocDetails::with('levels')
              ->where('created_by',Auth::user()->idusers)
              ->get();

    $contents = [
      'fundets' => $funlocs,
      'items' => Items::where('active',TRUE)->get(),
      'equipment' => $equipment
    ];

    $pagecontent =  view('contents/equipments/create-details',$contents);

    //masterpage
    $pagemain = array(
      'title' => 'Equipments',
      'menu' => 'equipment',
      'submenu' => '',
      'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function save_details(Equipments $equipment,Request $request)
  {
    // return $request->all();

    $iditems = $request->iditems;
    $idfunlocdetails = $request->idfunlocdetails;
    $equipment_number = $request->equipment_number;
    $model_number = $request->model_number;
    $rate_number = $request->rate_number;
    $month_construction = $request->month_construction;
    $year_construction = $request->year_construction;
    $date_instalation = $request->date_instalation;
    $description = $request->description;

    // for ($i=0; $i < count($iditems) ; $i++) {
    //    if ($idfunlocdetails[$i] == 0) {
    //     return redirect()->back()->with('status_error', 'funloc empty');
    //   }elseif ($description[$i] == 0) {
    //     return redirect()->back()->with('status_error', 'description empty');
    //   }
    // }

    for ($i=0; $i < count($iditems) ; $i++) {
      $save_eqdet = new EquipmentDetails;
      $save_eqdet->idequipmentdetails = Str::uuid();
      $save_eqdet->idequipments = $equipment->idequipments;
      $save_eqdet->iditems = $iditems[$i];
      $save_eqdet->idfunlocdetails = $idfunlocdetails[$i];
      $save_eqdet->equipment_number = $equipment_number[$i];
      $save_eqdet->model_number = $model_number[$i];
      $save_eqdet->rate_number = $rate_number[$i];
      $save_eqdet->month_construction = $month_construction[$i];
      $save_eqdet->year_construction = $year_construction[$i];
      $save_eqdet->date_instalation = $date_instalation[$i];
      $save_eqdet->description = $description[$i];
      $save_eqdet->status = 'p';
      $save_eqdet->save();
      $this->create_approvals($save_eqdet->idequipmentdetails,$save_eqdet->status);
    }
    return redirect('equipments/update/'.$equipment->idequipments)->with('success','Deleted equipment');

  }

  protected  function create_approvals($idequipmentdetails,$status)
  {
    $save_approvals = new Approvals;
    $save_approvals->idapprovals = Str::uuid();
    $save_approvals->idequipmentdetails = $idequipmentdetails;
    $save_approvals->status = $status;
    $save_approvals->seen  = FALSE;
    $save_approvals->idusers = '00000000-00000000-00000000-00000000';
    $save_approvals->save();
  }
}
