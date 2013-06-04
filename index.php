<?php

$f3=require('lib/base.php');

$f3->config('config.ini');

$f3->route('GET /',
	function($f3) {
	$db=new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=attdonationgame',
    'root',
    'F0rgetting01'
);
if(iswinner()) {
$f3->set('prize',$db->exec('SELECT *  FROM prize WHERE redeemed = "0" limit 1'));
}  else {
$loser = array();
$loser[] = array('prize_image' => 'http://3.bp.blogspot.com/_6a6NWbCRGM4/TQc-F-oyCRI/AAAAAAAAALw/zYf-hCx2MFs/s400/loser.jpg'); 
$f3->set('prize', $loser);
 
}	

	$f3->set('donateurl','http://jaog.convio.net/goto/Team_Ezell');



        $view=new View;
        echo $view->render('game.htm');	
	}
);

$f3->route('GET /remind',
  function($f3) {

        $view=new View;
        echo $view->render('remind.htm');
        }
);

$f3->route('POST /remind',
        function($f3) {
        $db=new DB\SQL(
    'mysql:host=localhost;port=3306;dbname=attdonationgame',
    'root',
    'F0rgetting01'
);
// store the posted stuff in the db


        $view=new View;
        echo $view->render('success.htm');
        }
);



function iswinner() {

$chance = rand(1, 100);
$winner = false;
if($chance > 50){
$winner = true;
}

return $winner;
	
}

function trackPlay($db) {

}




$f3->run();
