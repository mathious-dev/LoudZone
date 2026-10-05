<?php

use App\Models\History;
if(!function_exists('saveHistory'))
{
    function saveHistory($action)
    {
        History::create([
            'user_id'=>auth()->id(),
            'user_name'=>auth()->user()->name,
            'action'=>$action
        ]);
    }
}
?>