<body>
<div class="row">
    
<div class="navbar">
    <table border="0" width="100%">
        <td width="920px"> <div class="col-md-4">
    <div class="dropdown">
    <button class="dropbtn">Predvidjanja
    </button>
    <div class="dropdown-content">
          <a href='<?php echo base_url()."/$controller/pregledtudjegideja/$user->Username"  ?>' >Ideje</a>
    </div>
  </div></div>
    
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
                    <div class="col-md-3"><center><div class="box"><center><h2><?php echo $user->Skor ?></h2></center></div></center></div>
                </td>
                <td>
                    <div class="col-md-3"><center><div class="box"><center><h2><?php echo $user->Popularnost ?></h2></center></div></center></div>
                </td>
            </tr>
        </table>
</div> </div>