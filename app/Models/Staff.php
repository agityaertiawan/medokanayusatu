<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Staff extends Model
{
    use HasUlids;
    protected $fillable = ['name','position','photo'];
}
