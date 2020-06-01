<script type="text/javascript">
    function zapamtiId(id){
        document.cookie = "idTekIdeja="+id+";path=/";
    }
</script>
<div class="row">
    
<div class="navbar">
    <table border="0" width="100%">
        <td width="920px"> <div class="col-md-4">
   <div class="dropdown">
    <button class="dropbtn">Ideje
    </button>
    <div class="dropdown-content">
         <a href='<?php echo base_url()."/$controller/pregledtudjegpredv/$user->Username"  ?>' >Predvidjanja</a>
    </div>
  </div>
 </div>
    
        <td >
            <div class="col-md-5">
         <div class="podesavanje"> <h1><?php echo $user->Username ?></h1> </div>
        </div></td> 
   

    
        <td id="uputstvo" >
            <div class="col-md-3" > 
            <span class="uputstvo"><a href='<?php echo base_url("/$controller/uputstvo") ?>'>
                    <image src="/slike/notepad.png" height="40px"></a>
            </span>
                </div>
        </td>
  
  </table> </div> </div>
<div class="row">
<div id="wrapper">
    <div class="col-md-6">
    <div id="page1">
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
        echo "<td width='25%'>&nbsp;&nbsp;";
            if($kor_tip=="administratoru") {   echo    "<a href='#olovka'><img src='".base_url()."/slike/pencil.png' height='22' onclick='zapamtiId({$ideja->IdI})'></a> "; }
       echo   "<a href=''><img src='".base_url()."/slike/love.png' height='22'></a> "
            . "<a href=''><img src='".base_url()."/slike/hate.png' height='22'></a> "
            . "<span class='ikonice'>{$plus}{$ideja->Popularnost}</span></td>"; 
        echo "<td width='15%'>&nbsp;</td>";
        echo '<td></td><td class="autor">';
        echo "{$ideja->Username}</td></tr>";  
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
                    <div class="col-md-3"><center><div class="box"><center><h2>500</h2></center></div></center></div>
                </td>
                <td>
                    <div class="col-md-3"><center><div class="box"><center><h2>500</h2></center></div></center></div>
                </td>
            </tr>
        </table>
            <div class="col-md-6">&nbsp;</div>
            <div class="col-md-6">&nbsp; </div>
            <div class="col-md-6">&nbsp;</div>
            <div class="col-md-6">&nbsp;</div>
            <div class="col-md-6">&nbsp;</div>
            <div class="col-md-6">&nbsp;</div>
               <div class="col-md-6">
                   <center>
            <div class="wrapbox">
                <table class="tabela">
               <?php 
                if($kor_tip=='administratoru') { ?>
                <tr>
                    <td colspan="2"><center><a href="#openModal"  >
                        <image src="/slike/promote.png" height="250px" width="250px" id="promote"></a></center></td>
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
         
            <td  colspan="2"><center><a href="#openModalsankc" >
                        <image src="/slike/redflag.png" height="250px" width="250px" id="flag"></a></center></td> </tr> </table>
            
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
            <table class="tabela">
               <tr >
             
                   <td colspan="2"><center><a href="#openModalsankcMod">
                        <image src="/slike/redflag.png" height="250px" width="250px" id="flagmoderator"></a></center></td> </tr> </table>
      
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
            </div> </center> </div>
        
           
</div>
</div> 
</div>
   	  <div id="olovka" class="modalDialog">
    <?php if($kor_tip=='administratoru') { ?>
    <div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Zelite li da obrisete ovu ideju?</h2>
                <form method='post' action="<?= base_url("Administrator/obrisati_ideju")?>">
                <button type="submit" class="button2">DA</button>
                </form>
    </div> <?php } ?> </div>
	