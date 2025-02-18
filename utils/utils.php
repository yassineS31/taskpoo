<?php
/*
*@method nettoyage de chaîne de caractère pour enlever les balises HTML et PHP, les espaces vides en début et fin de chaîne
*@param string $data
*@return string
*/
function sanitize(string $data){
    return htmlentities(strip_tags(stripslashes(trim($data))));
}