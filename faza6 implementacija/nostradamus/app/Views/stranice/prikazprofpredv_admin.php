<script type="text/javascript">
    function zapamtiId(id){
        console.log("hello");
        document.cookie = "idTek="+id+";path=/";
    }
</script>
<div class="row">
<div class="navbar">
    <table border="0" width="100%">
      <div class="col-md-2">  <td width="920px">
  <div class="dropdown">
    <button class="dropbtn">Predvidjanja
    </button>
    <div class="dropdown-content">
        <a href='<?php echo base_url()."/$controller/pregledtudjegideja/$user->Username"  ?>' >Ideje</a> 
    </div>
  </div>  </td>   </div>
    <div class="col-md-6">
        <td >
         <div class="podesavanje"> <h1><?php echo $user->Username ?></h1> </div>
        </td> </div>
   

    <div class="col-md-4" > 
        <td id="uputstvo" >
            <span class="uputstvo"><a href='<?php echo base_url("/$controller/uputstvo") ?>'>
                    <image src="/slike/notepad.png" height="40px"></a>
            </span>
        </td>
  </div>
  </table> </div> </div>
<div class="row">
<div id="wrapper">
    <div class="col-md-6">
    <div id="page1">
      <?php
      
      $base=base_url();
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
        echo "<td width='25%'>&nbsp;&nbsp;"
        . "<a href='#olovka'><img src='".base_url()."/slike/pencil.png' height='22' onclick='(zapamtiId({$predvidjanje->IdP}))'></a> "
            . "<a href='$base/$controller/voliPredvidjanje/$predvidjanje->IdP'><img src='".base_url()."/slike/love.png' height='22'></a> "
            . "<a href='$base/$controller/neVoliPredvidjanje/$predvidjanje->IdP'><img src='".base_url()."/slike/hate.png' height='22'></a> "
            . "<span class='ikonice'>{$plus}{$predvidjanje->Popularnost}</span></td>"; 
            
        echo "<td width='15%'><img src='".base_url()."/slike/weight.png' height='22'> ";        
        echo "<span class='ikonice'>{$predvidjanje->Tezina}</span></td>";
        
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
        
        echo '<td></td><td class="autor">';
        echo "{$predvidjanje->Username}</td></tr>";    
        echo  "</table>";
    }
    ?>
 </div>  </div>
    <div class="col-md-6">
        <div id="page2">
        <table width="100%">
            <tr>
                <td width="20%" class="podesavanje"><center><h1>SKOR</h1></center></td>
        <td width="20%" class="podesavanje"><center><h1>POPULARNOST</h1></center></td>
            </tr>
            <tr>
                <td>
                    <div class="box"><center><h2>500</h2></center></div>
                </td>
                <td>
                    <div class="box2"><center><h2>500</h2></center></div>
                </td>
            </tr>
            <div class="wrapbox">
               <?php 
                if($kor_tip=='administratoru') { ?>
                <tr>
                    <td id="promote"><a href="#openModal" >
                        <image src="/slike/promote.png" height="250px" width="250px"></a></td>
                        <div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>U sta zelite da promovisete datog korisnika?</h2>
                <form method='post' action='<?= base_url("Administrator/promovisati")?>'>
                 <input type="hidden" name='korisnik' value='<?php echo $user->Username ?>'>
                <button type="submit" class="button2" name='uloga' value='admin'>Administrator</button>
                <button type="submit" class="button3" name='uloga'value='mod'>Moderator</button>
                </form>
	</div>
</div>
                </tr> <?php } ?>
                 <?php
                 if($kor_tip=='administratoru') { ?>
        <tr>
         
                <td id="flag"><a href="#openModalsankc">
                        <image src="/slike/redflag.png" height="250px" width="250px"></a></td> </tr> </table>
            
        <div id="openModalsankc" class="modalDialog">
          
	<div>
		<a href="#close" title="Close" class="close">X</a>
                <h2>Molim vas da unesite za koliko zelite da smanjite skor korisnika </h2> 
              
        
                            <form method="post" action='<?= base_url("Administrator/sankcionisi_korisnika")?>'>
 
                            <input type="number" name='kazna' min="0">
                              <input type="hidden" name='korisnik' value='<?php echo $user->Username ?>'>
                             <button type="submit" class="button3">POTVRDI</button> </td>
                         </form>
                          
             
	</div>
               
</div>
               <?php } ?>
 <?php 
  if($kor_tip=='moderatoru') { ?>
            <table>
               <tr>
          
                <td id="flagmoderator"><a href="#openModalsankcMod">
                        <image src="/slike/redflag.png" height="250px" width="250px"></a></td> </tr> </table>
      
         <div id="openModalsankcMod" class="modalDialog">
          
	<div>
		<a href="#close" title="Close" class="close">X</a>
                <h2>Molim vas unesite za koliko zelite da smanjite skor korisnika </h2> 
              
        
                <form method="post" action='<?= base_url("Moderator/sankcionisi_korisnika")?>'>
                              <input type="number" name='kazna' min="0">
                              <input type="hidden" name='korisnik' value='<?php echo $user->Username ?>'>
                             <button type="submit" class="button3">POTVRDI</button> </td>
                </form>
                          
             
	</div>
               
</div>
               <?php } ?>
            </div>
        
           
</div>
</div> 
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