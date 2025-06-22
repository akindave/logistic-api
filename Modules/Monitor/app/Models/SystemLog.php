<?php

namespace Modules\Monitor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Monitor\Database\Factories\SystemLogFactory;

class SystemLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['action','user_id','ip_address','metadata'];

    // protected static function newFactory(): SystemLogFactory
    // {
    //     // return SystemLogFactory::new();
    // }
}
