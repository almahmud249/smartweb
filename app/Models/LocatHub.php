<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocatHub extends Model
{
    use HasFactory;

    protected $table = 'locat_hubs';


    protected $fillable =['name','district_id','thana_id','area_id'];

    protected $casts = [
        'thana_id' => 'array',
        'area_id' => 'array'
    ];
}
