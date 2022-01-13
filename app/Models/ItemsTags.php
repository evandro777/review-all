<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsTags extends Model
{
    use HasFactory;

    protected $fillable = ['item', 'tag_id', 'created_user_id'];
}
