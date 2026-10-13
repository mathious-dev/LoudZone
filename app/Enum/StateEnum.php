<?php

namespace App\Enum;

enum StateEnum :string
{
    case WAITING='en attente';
    case REFUSED='refusé';
    case FINISHED='confirmé';
}
