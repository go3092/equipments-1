<?php

namespace App\Http\Controllers\Master;

use App\Models\Items;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }


    public function index()
    {
      $contents = [
        'items' => Items::all()
      ];
      // return   $contents;
      $pagecontent =  view('contents.master.items.index', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Master Items',
          'menu' => 'master',
          'submenu' => 'item',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function create_page()
    {
      $contents = [
        // 'items' => Items::where('active',TRUE)->get()
      ];
      // return   $contents;
      $pagecontent =  view('contents.master.items.create', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Master Items',
          'menu' => 'master',
          'submenu' => 'item',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function save_create(Request $request)
    {
      $request->validate([
        'name' => 'required',
        'merk' => 'required',
        'unit'=> 'required',
        'country_made' => 'required',
        'code_unit' => 'required',
      ]);

      $active = FALSE;
      if ($request->has('active')) {
        $active = TRUE;
      }

      $save_item = new Items;
      $save_item->iditems =  Str::uuid();
      $save_item->name = $request->name;
      $save_item->merk = $request->merk;
      $save_item->unit = $request->unit;
      $save_item->country_made = $request->country_made;
      $save_item->code_unit = $request->code_unit;
      $save_item->active = $active;
      $save_item->save();

      return redirect('master/item')->with('success','Add Items');
    }

    public function update_page(Items $item)
    {
      $contents = [
        'item' => $item
      ];
      // return   $contents;
      $pagecontent =  view('contents.master.items.update', $contents);

      //masterpage
      $pagemain = array(
          'title' => 'Master Items',
          'menu' => 'master',
          'submenu' => 'item',
          'pagecontent' => $pagecontent,
      );

      return view('masterpage', $pagemain);
    }

    public function update_save(Items $item , Request $request)
    {
      $request->validate([
        'name' => 'required',
        'merk' => 'required',
        'unit'=> 'required',
        'country_made' => 'required',
        'code_unit' => 'required',
      ]);

      $active = FALSE;
      if ($request->has('active')) {
        $active = TRUE;
      }

      $save_item = Items::find($item->iditems);
      $save_item->name = $request->name;
      $save_item->merk = $request->merk;
      $save_item->unit = $request->unit;
      $save_item->country_made = $request->country_made;
      $save_item->code_unit = $request->code_unit;
      $save_item->active = $active;
      $save_item->save();

      return redirect('master/item')->with('success','Updated Items');
    }

    public function delete(Items $item)
    {
      $items = Items::where('iditems',$item->iditems);
      $items->delete();
      return redirect('master/item')->with('success','Deleted Items');

    }


}
