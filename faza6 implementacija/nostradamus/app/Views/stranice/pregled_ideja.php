<div class="navbar">
    <table border="0" width="100%">
        <td width="10%">
  <div class="dropdown">
    <button class="dropbtn">Ideje
    </button>
    <div class="dropdown-content">
        <a href="<?= base_url("$controller/pregled_predvidjanja") ?>">Predvidjanja</a>
    </div>
  </div>
        </td>
        <td width="40%" class="bottom">
            <ul>
                <li><a href="<?php echo base_url("$controller/sortIdejaAktuelno"); ?>" class="li">AKTUELNO</a></li>
                <li><a href="<?php echo base_url("$controller/sortIdejaPopularno"); ?>" class="li">POPULARNO</a></li>                
            </ul>
        </td>
        <td width="40%">
    <form name="pretraga_autora" method="get"
          action="<?= site_url("$controller/pretragaIdeja") ?>" ><br>
        <div class="search-box">                       
            <input type="image" class="search-btn" name="submit" src="<?php echo base_url(); ?>/slike/search-icon.png">
            <input type="text" class="search-txt" name="pretraga" placeholder="Pretraga autora">
        </div>
        </td>
            </form>
         <td id="uputstvo" >
         <a href="<?= site_url("$controller/uputstvo") ?>" ><image src="/slike/uputstvoproba.png" height="40px" width="40px" ></a> </td>
    </table>
</div>
<div class="page">

    <?php
    foreach ($ideje as $ideja) {
        if($ideja->Popularnost>0) $plus="+";
            else $plus="";        
        echo '<table border="0" class="content">';
        echo '<tr><th class="naslov" colspan="3">';
        echo "{$ideja->Naslov}</th>";
        echo '<td class="datum">';
        echo "{$ideja->DatumEvaluacije}</td></tr>";
        echo '<tr><td colspan="4" class="sadrzaj">';
        echo "{$ideja->Sadrzaj}</td></tr>";
        echo '<tr class="last">';
        echo "<td width='25%'>&nbsp;&nbsp;"
            . "<a href=''><img src='".base_url()."/slike/pencil.png' height='22'></a> "
            . "<a href=''><img src='".base_url()."/slike/love.png' height='22'></a> "
            . "<a href=''><img src='".base_url()."/slike/hate.png' height='22'></a> "
            . "<span class='ikonice'>{$plus}{$ideja->Popularnost}</span></td>" ;
            
        echo "<td width='15%'>&nbsp;</td>";
        echo '<td></td><td class="autor">';
        echo "<a href='". site_url()."/$controller/pregledtudjegideja/$ideja->Username'>{$ideja->Username} </a></td></tr>";  
        echo  "</table>";
    }
    ?>
</div>