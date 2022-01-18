<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['arka','pos','order','expense','mbetja','data','serialNumber','notes'];

    public function setSerialNumberAttribute( $value ) {
        $this->attributes['serialNumber'] = "#".$value;
    }
}
