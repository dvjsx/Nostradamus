<div class="navbar">
    <table border="0">
        <td width="10%">
  <div class="dropdown">
    <button class="dropbtn">Predvidjanja
    </button>
    <div class="dropdown-content">
        <a href="<?= base_url("Gost/pregled_ideja") ?>">Ideje</a>
    </div>
  </div>
        </td>
        <td width="40%">
        </td>
        <td width="10%">
    <form name="pretraga_autora" method="get"
          action="<?= site_url("$controller/pretragaPredvidjanja") ?>" ><br>
        <input type="text" name="pretraga" placeholder="Pretraga autora">
        </td>
        <td width="5%">
            <input name="Trazi" type="submit" value="Trazi">
        </td>
            </form>
        <td width="35%">            
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
        echo "{$predvidjanje->DatumEvaluacije}</td></tr>";
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