<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

     /**
 * 
 * @author Mahabub Mon<mahabubmon@gmail.com>
 */

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }
}
