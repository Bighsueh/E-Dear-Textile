<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobReport extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_reports';

    protected $fillable =
        ['id','action','operator','ticket_id','quantity','unit','submit_by','created_at','updated_at'];
}
