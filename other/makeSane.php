<?php
    //gekregen van mijn vader die het van het ergens van het internet heeft gehaald 
        function removeeviltags ($source)
        {
            $allowedtags = '<a><address><blockquote><br><b><center><div><em><fieldset><form><font><h1><h2><h3><h4><h5><hr><i><il><input><img><label><legend><li><ol><option><optgroup><p><pre><select><span><strong><sub><sup><textarea><table><title><tr><td><th><u><ul>';
            $source = strip_tags($source, $allowedtags);
            $source = preg_replace('/<(.*?)>/ie', "'<'.removeevilattributes('\\1').'>'", $source);
            $source = stripslashes($source);
            return $source;
        }
        function removeevilattributes ($tagsource)
        {
            $stripattrib = '/javascript:|onclick|ondblclick|onmousedown|onmouseup|onmousedown|'
             . 'onmousemove|onmouseout|onkeypress|onkeydown|onkeyup/';
            $tagsource = stripslashes($tagsource);
            $tagsource = preg_replace($stripattrib, '', $tagsource);
            return $tagsource;
        }
        function removeEviltagArray($array){
            foreach ($array as $key => $value) {
                $array[$key]=removeeviltags($value);
            }
            return $array;
        }
?>