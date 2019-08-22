<?php

namespace App;

use App\Client;
use App\Helper\USDFormatter;
use App\Payment;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $guarded = [];

    public function getRemaining()
    {
        $payments = Payment::where('client_id', $this->client_id)
            ->where('project_id', $this->id)
            ->pluck('amount')
            ->sum();

        return $this->amount - $payments;
    }

    public function getFormattedAmountRemainingAttribute()
    {
        return USDFormatter::handle($this->getRemaining());
    }

    public function amountPaid()
    {
        return USDFormatter::handle($this->payments()->pluck('amount')->sum());
    }

    public function getFormattedPriceAttribute()
    {
        return USDFormatter::handle($this->amount);
    }

    /*|========================================================
     | Relationships
    |=======================================================*/

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
