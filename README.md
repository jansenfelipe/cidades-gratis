# Cidades Grátis
[![Latest Stable Version](https://poser.pugx.org/jansenfelipe/cidades-gratis/v/stable.svg)](https://packagist.org/packages/jansenfelipe/cidades-gratis) 
[![Total Downloads](https://poser.pugx.org/jansenfelipe/cidades-gratis/downloads.svg)](https://packagist.org/packages/jansenfelipe/cidades-gratis) 
[![Latest Unstable Version](https://poser.pugx.org/jansenfelipe/cidades-gratis/v/unstable.svg)](https://packagist.org/packages/jansenfelipe/cidades-gratis)
[![MIT license](https://poser.pugx.org/jansenfelipe/nfephp-serialize/license.svg)](http://opensource.org/licenses/MIT)

Com esse pacote você poderá consultar, gratuitamente, Cidades diretamente no site do IBGE.

### Como utilizar

Adicione a library

```sh
$ composer require jansenfelipe/cidades-gratis
```

Adicione o autoload.php do composer no seu arquivo PHP.

```php
require_once 'vendor/autoload.php';  
```

### Métodos

##### Buscar UFs

Use o método `getUfs()` para retornar a lista de UFs com seus respecivos códigos

```php
$ufs = JansenFelipe\CidadesGratis\Cidades::getUfs();
```

##### Buscar Cidades

Use o método `getCidades()` para retornar a lista de Cidades com seus respecivos códigos de uma determinada UF

```php
$cidades = JansenFelipe\CidadesGratis\Cidades::getCidades(31);
```

##### Buscar detalhes de uma cidade

Use o método `getCidadeDetalhes()` para retornar a detalhes de uma determinada cidade

```php
$detalhes = JansenFelipe\CidadesGratis\Cidades::getCidadeDetalhes(310620);
```

### Builds

Dentro da pasta `build/` existe dois arquivos: `ufs.json` e `cidades.json`. Eles foram gerados no dia 20/08/2015

### License

The MIT License (MIT)
