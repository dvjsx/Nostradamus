<script type="text/javascript">
    function zapamtiId(id){
        
        document.cookie = "idTek="+id+";path=/";
    }
</script>
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
            <span class="uputstvo"><a href='<?php echo base_url("/$controller/uputstvo") ?>'>
                    <image src="/slike/notepad.png" height="40px"></a>
            </span>
        </td>
    </table>
</div>
<div class="page">

    <?php
    $base=base_url();
    foreach ($predvidjanja as $predvidjanje) {
        if($predvidjanje->Popularnost>0) $plus="+";
            else $plus="";
        echo '<table border="0" class="content">';
        echo '<tr><th class="naslov" colspan="4">';
        echo "{$predvidjanje->Naslov}</th>";
        echo '<td class="datum">';
        echo "{$predvidjanje->DatumEvaluacije}</td></tr>";
        echo '<tr><td colspan="5" class="sadrzaj">';
        echo "{$predvidjanje->Sadrzaj}</td></tr>";
        echo '<tr class="last">';
        echo "<td width='15%'>&nbsp;&nbsp;";
       if($kor_ime=="administratoru" || $kor_ime=="moderatoru") {   echo    "<a href='#olovka'><img src='".base_url()."/slike/pencil.png' height='22' onclick='(zapamtiId({$predvidjanje->IdP}))'></a> "; }
       echo   "<a href='$base/$controller/voliPredvidjanje/$predvidjanje->IdP'><img src='".base_url()."/slike/love.png' height='22'></a> "
            . "<a href='$base/$controller/neVoliPredvidjanje/$predvidjanje->IdP'><img src='".base_url()."/slike/hate.png' height='22'></a> "      
            . "<span class='ikonice'>{$plus}{$predvidjanje->Popularnost}</span></td>"        ;
            
        echo "<td width='10%'><img src='".base_url()."/slike/weight.png' height='22'> ";        
        echo "<span class='ikonice'>{$predvidjanje->Tezina}</span></form></td>";
        
        echo "<form name='ocena_tezine' method='post'
          action='$base/$controller/oceniPredvidjanje/$predvidjanje->IdP'>";
        echo "<td><span class='rating'>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}10' value='10'><label for='{$predvidjanje->IdP}10'>10</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}9' value='9'><label for='{$predvidjanje->IdP}9'>9</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}8' value='8'><label for='{$predvidjanje->IdP}8'>8</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}7' value='7'><label for='{$predvidjanje->IdP}7'>7</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}6' value='6'><label for='{$predvidjanje->IdP}6'>6</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}5' value='5'><label for='{$predvidjanje->IdP}5'>5</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}4' value='4'><label for='{$predvidjanje->IdP}4'>4</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}3' value='3'><label for='{$predvidjanje->IdP}3'>3</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}2' value='2'><label for='{$predvidjanje->IdP}2'>2</label>"
            . "<input type='radio' name='{$predvidjanje->IdP}' id='{$predvidjanje->IdP}1' value='1'><label for='{$predvidjanje->IdP}1'>1</label>"
            . "</span></td>";
        echo "<td width='5%'>&nbsp;&nbsp;"
            . "<input type='image' name='ocena' src='".base_url()."/slike/rating.png' height='28'>"
            . "</td></form>";
        
        echo '<td class="autor">';
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
                <form method="post" action='<?= base_url("Administrator/obrisati_predvidjanje")?>'>
                    <button type="submit" class="button2">DA</button>
                </form>
                
	</div>
    <?php } ?>
        <?php if($kor_ime=='moderatoru') { ?>
    <div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Zelite da izmenite status predvidjanja?</h2>
                <form method='post' action='<?= base_url("Moderator/izmeniStatusTudjegPredvidjanja") ?>'>
                    <input type="radio" name="dane" value="DA">ISPUNJENO
                    <input type="radio" name="dane" value="NE">NEISPUNJENO 
                    <button type="submit" class="button2">POTVRDA</button>
                </form>
	</div>
    <?php } ?>
    
</div>