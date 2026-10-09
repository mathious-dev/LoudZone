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
if(!function_exists('subNewsLetter'))
{
    function subNewsLetter()
    {
        $user=auth()->user();
        if($user)
        {
            $user->news_letter=true;
            $user->save();
            saveHistory('Abonnement à la newsletter');
        }
    }
}
?>