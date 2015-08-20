<?php

namespace JansenFelipe\CidadesGratis;

use Exception;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Cidades {

    /**
     * Metodo para capturar as UFs disponíveis
     *
     * @throws Exception
     * @return array
     */
    public static function getUfs() {

        $ufs = array();

        $client = new Client();
        $crawler = $client->request('GET', 'http://www.cidades.ibge.gov.br/xtras/home.php');

        $lis = $crawler->filter('#menu_ufs > li');

        foreach($lis as $li){
            $li = new Crawler($li);

            $codigo = substr($li->attr('id'), 2);

            $ufs[] = [
                'codigo' => $codigo,
                'uf' => $li->filter('a')->html()
            ];

        }

        return $ufs;
    }


    /**
     * Metodo para capturar as cidades da uf
     *
     * @param  $codUf
     * @throws Exception
     * @return array
     */
    public static function getCidades($codUf = null) {

        $cidades = array();

        $client = new Client();
        $crawler = $client->request('GET', 'http://www.cidades.ibge.gov.br/xtras/uf.php?lang=&coduf='.$codUf);

        $lis = $crawler->filter('#lista_municipios > li');

        foreach($lis as $li){
            $li = new Crawler($li);

            $codigo = substr($li->attr('id'), 1);

            $cidades[] = [
                'codigo' => $codigo,
                'nome' => $li->filter('a')->html()
            ];

        }

        return $cidades;
    }

    /**
     * Metodo para capturar detalhes da cidade
     *
     * @param  $codCidade
     * @throws Exception
     * @return array
     */
    public static function getCidadeDetalhes($codCidade = null) {

        $detalhes = array();

        $client = new Client();
        $crawler = $client->request('GET', 'http://www.cidades.ibge.gov.br/xtras/perfil.php?lang=&codmun='.$codCidade);

        /*
         * Nome do municipio
         */
        $detalhes['nome'] = $crawler->filter('span.municipio.titulo')->html();

        /*
         * Mais detalhes
         */
        $trs = $crawler->filter('#mod_perfil_infosbasicas > table > tr');

        foreach($trs as $tr){
            $tr = new Crawler($tr);

            $chave = $tr->filter('td:nth-child(1)');
            $valor = $tr->filter('td:nth-child(2)');

            if($chave->count() && $valor->count()){

                switch($chave->html()){

                    case 'Código do Município':
                        $detalhes['codigo'] = $valor->html();
                        break;

                    case 'População estimada 2014 <sup>(1)</sup>':
                        $detalhes['populacao_estimada'] = $valor->html();
                        break;

                    case 'População 2010':
                        $detalhes['populacao'] = $valor->html();
                        break;

                    case 'Área da unidade territorial (km²)   ':
                        $detalhes['area'] = $valor->html();
                        break;

                    case 'Densidade demográfica (hab/km²)':
                        $detalhes['densidade_demografica'] = $valor->html();
                        break;

                    case 'Gentílico':
                        $detalhes['gentilico'] = $valor->html();
                        break;
                }

            }


        }

        return $detalhes;
    }

}
