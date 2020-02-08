<?php
$str = 'myr122m1';
$strFirst= array();
for ($i = 0; $i < strlen($str); $i++) {
    $strFirst[$str[$i]]=0;
}
for ($i = 0; $i < strlen($str); $i++) {
    $strFirst[$str[$i]]+=1;

}
var_dump($strFirst);