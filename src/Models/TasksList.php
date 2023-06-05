<?php

namespace DiDiTask\Seat\SeatDiDiTask\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Seat\Services\Traits\NotableTrait;


class TasksList extends Model
{
    use NotableTrait;
    use Notifiable;

    public $timestamps = true;

    protected $primaryKey = 'id';

    protected $table = 'tasks_list';

    protected $fillable = ['id', 'taskname', 'location', 'Receiver_Rewards', 'status', 'send_time'];

}