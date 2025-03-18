<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'buyer_id', 'amount', 'file_path', 'status', 'interest_rate', 'due_date'];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}

