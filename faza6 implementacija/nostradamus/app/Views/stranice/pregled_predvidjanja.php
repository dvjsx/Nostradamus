<div class="navbar">
    <table border="0" width="100%">
        <td width="10%">
  <div class="dropdown">
    <button class="dropbtn">Predvidjanja
    </button>
    <div class="dropdown-content">
        <a href="<?= base_url("$controller/pregled_ideja") ?>">Ideje</a>
    </div>
  </div>
        </td>
        <td width="40%" class="bottom">
            <ul>
                <li><a href="<?php echo base_url("$controller/sortPredvidjanjeNovo"); ?>" class="li">NOVO</a></li>
                <li><a href="<?php echo base_url("$controller/sortPredvidjanjePopularno"); ?>" class="li">POPULARNO</a></li>
                <li><a href="<?php echo base_url("$controller/sortPredvidjanjeNajteze"); ?>" class="li">NAJTEZE</a></li>
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
        <td id="uputstvo" >
         <a href="<?= site_url("$controller/uputstvo") ?>" ><image src="/slike/uputstvoproba.png" height="40px" width="40px" ></a> </td>
    </table>
</div>
<div class="page">

    <?php
    foreach ($predvidjanja as $predvidjanje) {
        if($predvidjanje->Popularnost>0) $plus="+";
            else $plus="";
        echo '<table border="0" class="content">';
        echo '<tr><th class="naslov" colspan="3">';
        echo "{$predvidjanje->Naslov}</th>";
        echo '<td class="datum">';
        echo "{$predvidjanje->DatumNastanka}</td></tr>";
        echo '<tr><td colspan="4" class="sadrzaj">';
        echo "{$predvidjanje->Sadrzaj}</td></tr>";
        echo '<tr class="last">';
        echo "<td width='25%'>&nbsp;&nbsp;";
       if($kor_ime=="administratoru" || $kor_ime=="moderatoru") {   echo    "<a href='#olovka'><img src='".base_url()."/slike/pencil.png' height='22'></a> "; }
       echo   "<a href='$controller/voliPredvidjanje/$predvidjanje->IdP'><img src='".base_url()."/slike/love.png' height='22'></a> "
            . "<a href='$controller/neVoliPredvidjanje/$predvidjanje->IdP'><img src='".base_url()."/slike/hate.png' height='22'></a> "      
            . "<span class='ikonice'>{$plus}{$predvidjanje->Popularnost}</span></td>"        ;
        echo "<td width='15%'><img src='".base_url()."/slike/weight.png' height='22'> ";        
        echo "<span class='ikonice'>{$predvidjanje->Tezina}</span></td>";
        echo '<td></td><td class="autor">';
        echo "<a href='". site_url()."/$controller/pregledtudjegpredv/$predvidjanje->Username'>{$predvidjanje->Username} </a></td></tr>";
         
        echo  "</table>";
    }
    ?>
</div>
<div id="olovka" class="modalDialog">
    <?php if($kor_ime=='administratoru') { ?>
    <div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Zelite li da obrisete ovo predvidjanje?</h2>
                <button type="button" class="button2">DA,POTVRDJUJEM BRISANJE PREDVIDJANJA</button>
                
	</div>
    <?php } ?>
        <?php if($kor_ime=='moderatoru') { ?>
    <div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Zelite da izmenite status predvidjanja?</h2>
                <form>
                    <input type="radio" name="dane" value="DA">ISPUNJENO
                    <input type="radio" name="dane" value="NE">NEISPUNJENO 
                    <button type="submit" class="button2">POTVRDA</button>
                </form>
	</div>
    <?php } ?>
    
</div>