<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultTicketContent extends Model
{
    protected $table = 'default_ticket_content';

    protected $fillable =
        [
            'content_id',
            'customer_name',
            'item_no',
            'color',
            'wash_tag',
            'item',
            'blenching_and_dyeing_factory',
            'color_thread',
            'piping_method',
            'remark',
            'ticket_status'
        ];

}
