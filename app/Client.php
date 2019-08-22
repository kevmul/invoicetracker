<?php

namespace App;

use App\Helper\USDFormatter;
use App\Project;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $guarded = [];

    public function getRemainingBalance()
    {
        $projects = Project::where('client_id', $this->id)
            ->pluck('amount')
            ->sum();

        return USDFormatter::handle($projects);
    }

    public function getAllRemainingBalance()
    {
        $balance = 0;
        foreach($this->projects as $project)
        {
            $balance += $project->getRemaining();
        }
        return $balance;
    }

    /*|========================================================
     | Atributes
    |=======================================================*/

    public function getFormattedAmountRemainingAttribute()
    {
        return USDFormatter::handle($this->getAllRemainingBalance());
    }

    /*|========================================================
     | Relationships
    |=======================================================*/

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id');
    }
}
