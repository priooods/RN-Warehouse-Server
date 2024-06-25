<?php

namespace Modules\Manage\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Manage\Database\Factories\MTabungTabFactory;

class MTabungTab extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['code'];

    protected static function newFactory()
    {
        // Create a new
    }
}
