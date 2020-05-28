
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
         <a href="<?= site_url("$controller/uputstvo") ?>" ><image src="/slike/notepad.png" height="40px" width="40px" ></a> </td>
  </div>
  </table> </div> </div>
<div class="row">
<div id="wrapper">
    <div class="col-md-6">
    <div id="page1">
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
        echo "<td width='25%'>&nbsp;&nbsp;"
        . "<a href='#olovka'><img src='".base_url()."/slike/pencil.png' height='22'></a> "
            . "<a href=''><img src='".base_url()."/slike/love.png' height='22'></a> "
            . "<a href=''><img src='".base_url()."/slike/hate.png' height='22'></a> "
            . "<span class='ikonice'>{$plus}{$predvidjanje->Popularnost}</span></td>";        
        echo "<td width='15%'><img src='".base_url()."/slike/weight.png' height='22'> ";        
        echo "<span class='ikonice'>{$predvidjanje->Tezina}</span></td>";
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
                <button type="button" class="button2">Administrator</button>
                <button type="button" class="button3">Moderator</button>
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
                <h2>Molim vas izaberite za koliko zelite da smanjite skor korisnika </h2> 
              
        
                            <form>
                              <input type="number" min="0">
                        
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
                <h2>Molim vas izaberite za koliko zelite da smanjite skor korisnika </h2> 
              
        
                            <form>
                              <input type="number" min="0">
                        
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