<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

     /**
 * 
 * @author Mahabub Mon<mahabubmon@gmail.com>
 */

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
