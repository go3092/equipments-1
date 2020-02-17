<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Approvals;
use App\Models\EquipmentDetails;
use App\Models\Equipments;
use App\Models\Items;

class ApprovalsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index(Request $request)
  {
    if (!$request->has('cabang') || !$request->has('status') ) {
      $cabang = 'cabang=';
      $status = 'status=p';
      return redirect('approvals?'.$cabang.'&'.$status);
    }

    $approvals = Approvals::join('users','approvals.idusers','=','users.idusers')
                ->join('equipment_details','approvals.idequipmentdetails','=','equipment_details.idequipmentdetails')
                ->join('equipments','equipment_details.idequipments','=','equipments.idequipments')
                ->join('items','equipment_details.iditems','=','items.iditems')
                ->join('funloc_details','equipment_details.idfunlocdetails','=','funloc_details.idfunlocdetails')
                ->join('levels','funloc_details.idlevels','=','levels.idlevels')
                ->select(
                  'approvals.*',
                  'equipments.description as cabang',
                  'items.name as itemname',
                  'levels.name as levelname',
                  'levels.description as leveldesc',
                  'funloc_details.number as funlocnumber',
                  'funloc_details.description as funlocdesc'
                  )
                ->orderBy('approvals.idapprovals');

    if (in_array($request->status, ['p','a','r'])) {
      $approvals->where('approvals.status',$request->status);
    }

    if (strlen($request->cabang) > 0) {
      $approvals->where('equipments.idequipments', $request->cabang);
    }

    if (strlen($request->items) > 0) {
      $approvals->where('items.iditems', $request->items);
    }

    $data_approvals = $approvals->get();
    // return $data_approvals;

    $contents = [
      'cabangs' => Equipments::all(),
      'items' => Items::where('active',TRUE)->get(),
      'approvals' => $data_approvals,
    ];

    $pagecontent =  view('contents.approvals.index', $contents);

    //masterpage
    $pagemain = array(
      'title' => 'Approvals',
      'menu' => 'approvals',
      'submenu' => '',
      'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function show(Approvals $approval)
  {
    $approvals = Approvals::with([
                  'equipment_details' => function($equdet){
                    $equdet->with([
                      'equipments',
                      'items',
                      'funloc_details' => function($fundet){
                        $fundet->with('levels');
                      }
                    ]);
                  }
                ])
                ->where('idapprovals', $approval->idapprovals)
                ->first();
                  // return $approvals;
    $contents = [
      'approvals' => $approvals,
    ];

    $pagecontent =  view('contents.approvals.show', $contents);

    //masterpage
    $pagemain = array(
      'title' => 'Approvals',
      'menu' => 'approvals',
      'submenu' => '',
      'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
  }

  public function update_approvals(Request $request, Approvals $approval )
  {
     $save_approve = Approvals::find($approval->idapprovals);
     $save_approve->status  = $request->status;
     $save_approve->seen = 1;
     $save_approve->save();

     $this->update_equipments($approval->idequipmentdetails ,$save_approve->status);
     return redirect('approvals')->with('success','Updated status equipment');
  }

  protected function update_equipments($idequipmentdetails,$status)
  {
    $save_eqdet = EquipmentDetails::find($idequipmentdetails);
    $save_eqdet->status = $status;
    $save_eqdet->save();

  }
}
