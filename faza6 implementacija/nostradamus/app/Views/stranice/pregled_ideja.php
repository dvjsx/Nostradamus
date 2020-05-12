<div class="navbar">
    <table border="0">
        <td width="10%">
  <div class="dropdown">
    <button class="dropbtn">Ideje
    </button>
    <div class="dropdown-content">
        <a href="<?= base_url("Gost/pregled_predvidjanja") ?>">Predvidjanja</a>
    </div>
  </div>
        </td>
        <td width="40%">
        </td>
        <td width="10%">
    <form name="pretraga_autora" method="get"
          action="<?= site_url("$controller/pretragaIdeja") ?>" ><br>
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
    foreach ($ideje as $ideja) {
        echo '<table border="0" class="content">';
        echo '<tr><th class="naslov">';
        echo "{$ideja->Naslov}</th>";
        echo '<td class="datum" colspan="2">';
        echo "{$ideja->DatumEvaluacije}</td></tr>";
        echo '<tr><td colspan="3" class="sadrzaj">';
        echo "{$ideja->Sadrzaj}</td></tr>";
        echo '<tr class="last">';
        echo "<td>&nbsp;</td>"
        . "<td>{$ideja->Popularnost}</td>";
        echo '<td class="autor">';
        echo "{$ideja->IdK}</td></tr>";  
        echo  "</table>";
    }
    ?>
</div>