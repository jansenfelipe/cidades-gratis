<?php

require_once '../vendor/autoload.php';

use JansenFelipe\CidadesGratis\Cidades;

/*
 * Carregando UF's
 */
$ufs = Cidades::getUfs();

/*
 * Pesquisando cidades caso selecione uma UF
 */
if(isset($_GET['uf']))
    $cidades = Cidades::getCidades($_GET['uf']);

/*
 * Pesquisando detalhes de uma cidade caso selecione
 */
if(isset($_GET['cidade']))
    $detalhes = Cidades::getCidadeDetalhes($_GET['cidade']);

?>

<form>
    <select name="uf">
        <?php foreach($ufs as $uf){ ?>
            <option value="<?php echo $uf['codigo']?>" <?php echo $uf['codigo']==$_GET['uf']?'selected':''?>><?php echo $uf['uf']?></option>
        <?php } ?>
    </select>

    <input type="submit" value="Carregar cidades da UF" />


    <?php if(isset($_GET['uf'])){ ?>

        <select name="cidade">
            <?php foreach($cidades as $cidade){ ?>
                <option value="<?php echo $cidade['codigo']?>" <?php echo $cidade['codigo']==$_GET['cidade']?'selected':''?>><?php echo $cidade['nome']?></option>
            <?php } ?>
        </select>

        <input type="submit" value="Ver detalhes da cidade" />

    <?php } ?>
</form>


<?php

if(isset($_GET['cidade']))
    var_dump($detalhes);

?>