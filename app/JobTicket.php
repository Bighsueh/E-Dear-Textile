<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTicket extends Model
{
    protected $table = 'job_tickets';
    protected $fillable =
        ['id','employeeName','item','ticket_id','itemId','factory','color','wash','colorId'
            ,'colorId2','rollFunc','manager','order','ps','status','created_at'];
}
