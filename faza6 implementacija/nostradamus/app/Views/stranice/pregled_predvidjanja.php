<div class="navbar">
    <table border="1" width="100%">
        <td width="10%">
  <div class="dropdown">
    <button class="dropbtn">Predvidjanja
    </button>
    <div class="dropdown-content">
        <a href="<?= base_url("Gost/pregled_ideja") ?>">Ideje</a>
    </div>
  </div>
        </td>
        <td width="40%" class="bottom">
            <ul>
                <li><a href="<?php echo base_url('Gost/sortPredvidjanjeNovo'); ?>" class="li">NOVO</a></li>
                <li><a href="<?php echo base_url('Gost/sortPredvidjanjePopularno'); ?>" class="li">POPULARNO</a></li>
                <li><a href="<?php echo base_url('Gost/sortPredvidjanjeNajteze'); ?>" class="li">NAJTEZE</a></li>
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
    foreach ($predvidjanja as $predvidjanje) {
        echo '<table border="0" class="content">';
        echo '<tr><th class="naslov">';
        echo "{$predvidjanje->Naslov}</th>";
        echo '<td class="datum" colspan="2">';
        echo "{$predvidjanje->DatumNastanka}</td></tr>";
        echo '<tr><td colspan="3" class="sadrzaj">';
        echo "{$predvidjanje->Sadrzaj}</td></tr>";
        echo '<tr class="last">';
        echo "<td>{$predvidjanje->Tezina}</td>"
        . "<td>{$predvidjanje->Popularnost}</td>";
        echo '<td class="autor">';
        echo "{$predvidjanje->IdK}</td></tr>";  
        echo  "</table>";
    }
    ?>
</div>