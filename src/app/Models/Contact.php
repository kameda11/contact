<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'phone1',
        'phone2',
        'phone3',
        'address',
        'building',
        'inquiry_type',
        'detail',
        'category_id'
    ];

    protected $hidden = [
        'category_id',
    ];

}
