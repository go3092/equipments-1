<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Workplans extends Model
{
  use SoftDeletes;

  protected $table = 'workplans';
  protected $primaryKey = 'idworkplans';
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

  public function equipment_details()
  {
    return $this->belongsTo('App\Models\EquipmentDetails','idequipmentdetails');
  }
}
