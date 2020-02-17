<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class EquipmentDetails extends Model
{
  use SoftDeletes;

  protected $table = 'equipment_details';
  protected $primaryKey = 'idequipmentdetails';
  public $incrementing = false;

  protected $hidden = [
      'created_at','created_by',
      'updated_at','updated_by',
      'deleted_at','deleted_by'
  ];

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
        $model->created_by = Auth::user()->idusers;
        return true;
    });

    static::updating(function ($model) {
        $model->updated_by = Auth::user()->idusers;
        return true;
    });

    static::deleting(function ($model) {
        $model->deleted_by = Auth::user()->idusers;
        return true;
    });
  }

  public function equipments()
  {
    return $this->belongsTo('App\Models\Equipments','idequipments');
  }

  public function items()
  {
    return $this->belongsTo('App\Models\Items','iditems','');
  }

  public function funloc_details()
  {
    return $this->belongsTo('App\Models\FunlocDetails','idfunlocdetails');
  }

  public function workplans()
  {
    return $this->hasMany('App\Models\Workplans','idequipmentdetails');
  }
}
