
<?php
function getNotifications(){

 return $notifications=App\Models\Notifications::selection()->where('read',0)->where('recive_id',auth()->user()->id)->get();

}

?>
