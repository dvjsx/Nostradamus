<div class="navbar">
    <table border="1" width="100%">
        <td width="10%">
  <div class="dropdown">
    <button class="dropbtn">Ideje
    </button>
    <div class="dropdown-content">
        <a href="<?= base_url("Gost/pregled_predvidjanja") ?>">Predvidjanja</a>
    </div>
  </div>
        </td>
        <td width="40%" class="bottom">
            <ul>
                <li><a href="<?php echo base_url('Gost/sortIdejaAktuelno'); ?>" class="li">AKTUELNO</a></li>
                <li><a href="<?php echo base_url('Gost/sortIdejaPopularno'); ?>" class="li">POPULARNO</a></li>                
            </ul>
        </td>
        <td width="40%">
    <form name="pretraga_autora" method="get"
          action="<?= site_url("$controller/pretragaPredvidjanja") ?>" ><br>
        <div class="search-box">                       
            <input type="image" class="search-btn" name="submit" src="<?php echo base_url(); ?>/slike/search-icon.png">
            <input type="text" class="search-txt" name="pretraga" placeholder="Pretraga autora">
        </div>
        </td>
            </form>
        <td>            
        </td>
    </table>
</div>
<div class="page">

    <?php
    foreach ($ideje as $ideja) {
        echo '<table border="0" class="content">';
        echo '<tr><th class="naslov">';
        echo "{$ideja->Naslov}</th>";
        echo '<td class="datum" colspan="2">';
        echo "{$ideja->DatumEvaluacije}</td></tr>";
        echo '<tr><td colspan="3" class="sadrzaj">';
        echo "{$ideja->Sadrzaj}</td></tr>";
        echo '<tr class="last">';
        echo "<td>&nbsp;</td>"
        . "<td>{$ideja->Popularnost}</td>";
        echo '<td class="autor">';
        echo "{$ideja->IdK}</td></tr>";  
        echo  "</table>";
    }
    ?>
</div>