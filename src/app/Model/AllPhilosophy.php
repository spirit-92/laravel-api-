<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AllPhilosophy extends Model
{
    protected $table = 'all_philosophy';
    protected $fillable = ['title','body','url'];
    public $timestamps = true;
    public $updated_at = false;
}
