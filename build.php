<?php

require_once 'vendor/autoload.php';

use JansenFelipe\CidadesGratis\Cidades;

echo 'Carregando UFs'.PHP_EOL;

/*
 * Carregando UF's
 */
$ufs = Cidades::getUfs();

//Escrevendo JSON de UFS
file_put_contents(__DIR__.'/build/ufs.json', json_encode($ufs));


foreach($ufs as $uf){

    echo 'Carregando cidades de '. $uf['uf'].PHP_EOL;

    /*
     * Carregando cidades da UF
     */
    $cidades[] = [
        'uf' => $uf['uf'],
        'codUf' => $uf['codigo'],
        'cidades' => Cidades::getCidades($uf['codigo'])
    ];

}

//Escrevendo de cidades
file_put_contents(__DIR__.'/build/cidades.json', json_encode($cidades));