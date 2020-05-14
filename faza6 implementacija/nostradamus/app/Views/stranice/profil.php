
<div class="navbar">
    <h1><center><?php echo $korisnik->Username ?></center></h1>
    <a id="linkic" href="<?php "Korisnik/uputstvo" ?>"><?php echo img('uputstvoproba.png'); ?></a>
</div>

<div id="wrapper">
    <div id="page1">
      <?php
      
    for ($i=0;$i<sizeof($predvidjanja);$i++) { 
        echo '<table border="0" class="content">';
        echo '<tr><th class="naslov">';
        echo "{$predvidjanja[$i]->Naslov}</th>";
        echo '<td class="datum" colspan="2">';
        echo "{$predvidjanja[$i]->DatumNastanka}</td></tr>";
        echo '<tr><td colspan="3" class="sadrzaj">';
        echo "{$predvidjanja[$i]->Sadrzaj}</td></tr>";
        echo '<tr class="last">';
        echo "<td>{$predvidjanja[$i]->Tezina}</td>"
        . "<td>{$predvidjanja[$i]->Popularnost}</td>";
        echo '<td class="autor">';
        echo "{$predvidjanja[$i]->IdK}</td></tr>";  
        echo  "</table>";
    }
    ?> </div>  
    <div id="page2">
        <div class="row">
            <div class="col-md-3"><h1>SKOR</h1>
                <div class="kockica"><p>Ovde ce se upisivati racunanje skora</p></div>
            </div>
            <div class="col-md-3"><h1>POPULARNOST</h1>
             <div class="kockica"><p>Ovde ce se upisivati racunanje popularnosti</p></div>
            </div>
        </div>
        <div class="row">
            <form>
                <div class="kockica"><p>Dodavanje novih predvidjanja/ideja</p></div>
  <div class="form-group row">
    <label for="Datum" class="col-sm-2 col-form-label">Datum</label>
    <div class="col-sm-10">
        <input type="datetime" class="form-control" name='Datum' value="<?= set_value('Datum')?>" placeholder="Datum">
    </div>
  </div>
  <div class="form-group row">
    <label for="Naslov" class="col-sm-2 col-form-label">Naslov</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  placeholder="Unesite naslov" name='naslov' value="<?= set_value('naslov')?>">
    </div>
  </div>
                <div class="form-group-row">
                    <input type="textarea" placeholder="Unesite sadrzaj ideje tj predvidjanja" name='sadrzaj' value="<?= set_value('sadrzaj')?>">
                </div>

    <div class="row">
     
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="idejadugme" id="gridRadios1" value="<?= set_value('opcijaideja')?>" >
          <label class="form-check-label">
            Ideja
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="predvidjanjedugme" id="<?= set_value('opcijaideja')?>">
          <label class="form-check-label" >
           Predvidjanje
          </label>
        </div>
        
      </div>
    </div>
 
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary" name="submitdugme">Stavi novo predvidjanje</button>
    </div>
  </div>
</form>
        </div>
       
    
</div>
</div>
