<body>
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
         
       echo   "<img src='".base_url()."/slike/star.png' height='22'> "
            . "<span class='ikonice'>{$plus}{$ideja->Popularnost}</span></td>" ;
            
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
                    <div class="col-md-3"><center><div class="box"><center><h2><?php echo $user->Skor ?></h2></center></div></center></div>
                </td>
                <td>
                    <div class="col-md-3"><center><div class="box"><center><h2><?php echo $user->Popularnost ?></h2></center></div></center></div>
                </td>
            </tr>
        </table>
            
</div> </div>