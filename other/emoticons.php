<?php
function parsesmileys($content){ 
   global $smileyList;
     return str_ireplace(array_keys($smileyList),$smileyList,$content); 
 }
?>