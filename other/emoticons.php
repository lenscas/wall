<?php
function parsesmileys($content){ 

     $smileyList = array(
         '(odd)'  =>     '<img src="smileys/odd.gif" alt="(odd)" />', 
         '(yumi)'  =>     '<img src="smileys/yumi.gif" alt="(yumi)" />', 
         '(ulrich)'=>     '<img src="smileys/ulrich.gif" alt="(ulrich)" />', 
         '(jeremie)'  =>     '<img src="smileys/jeremie.gif" alt="(jeremie)" />'
      ); 
     return str_ireplace(array_keys($smileyList),$smileyList,$content); 
 }
?>