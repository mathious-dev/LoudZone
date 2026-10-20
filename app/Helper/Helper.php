<?php

use App\Models\Announcement;
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
if(!function_exists('showAnnouncement'))
{
    function showAnnouncement()
    {
        $listAnnouncement=Announcement::all();
        foreach($listAnnouncement as $announcement)
        {
            if($announcement->start_date&&$announcement->start_date>=now()&&$announcement->is_showing)
            {
                saveHistory("Affichage de l'annonce {$announcement->label} jusqu'à " . ($announcement->end_date ?? 'date indéterminée'));
                return $announcement;
            }
        }
        
    }
}
?>