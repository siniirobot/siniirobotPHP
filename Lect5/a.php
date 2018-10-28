<?php

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$a = json_decode(file_get_contents('test.json'));
foreach ($a->features as $i => $v)
{
    //echo $v['properties']['CompanyMetaData']['name'];
    echo $v->properties->CompanyMetaData->name;
    echo ',';
    echo $v->properties->CompanyMetaData->address;
    echo ',';
    echo $v->properties->CompanyMetaData->url;
    echo ',';
    if (is_array($v->properties->CompanyMetaData->Phones))
    {
        foreach ($v->properties->CompanyMetaData->Phones as $a => $b)
        {
            echo $b->formatted.';';
        }
    }
    echo ',';
    echo $v->geometry->coordinates[1];
    echo ',';
    echo $v->geometry->coordinates[0];
    echo "<br>\n";
}
//print_r($a);
