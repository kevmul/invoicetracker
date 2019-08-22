<?php

namespace App;

use App\Project;
use App\Helper\USDFormatter;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $guarded = [];

    public $dates = ['paid_on'];

    /*|========================================================
     | Methods
    |=======================================================*/

    // public function getRemainingBalance()
    // {
    //     return $this->
    // }

    /*|========================================================
     | Attributes
    |=======================================================*/

    public function getFormattedPriceAttribute()
    {
        return USDFormatter::handle($this->amount);
    }

    public function getDollarAmountAttribute()
    {
        return explode('.',($this->amount / 100))[0];
    }

    public function getCentAmountAttribute()
    {
        return explode('.',number_format($this->amount/100, 2))[1];
    }

    /*|========================================================
     | Relationships
    |=======================================================*/

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
