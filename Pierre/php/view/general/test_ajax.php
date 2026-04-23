<?php

$villes = ["Trith-Saint-Leger", "Valenciennes", "Lille"];

echo '<label type="text" for="ville_select">Ville (input select):</label><select name="ville" id="ville_select">';
foreach ($villes as $ville) {
    echo '<option value="' . $ville . '">' . $ville . '</option>';
}
echo '</select><label type="text" for="ville_input">Ville (input text):</label><input name="ville" id="ville_input">';
$modele = <<<HTML
<div>
    <template>
        <img src="SOURCE">
        <div style="display:flex">
            <div>
                <div>Température(°C) :</div>
                <div>Direction du vent :</div>
                <div>UV :</div>
            </div>
            <div>
                <div>TEMPERATURE</div>
                <div> VENT</div>
                <div>TEMP_UV</div>
            </div>
        </div>
    </template>
</div>
HTML;
echo $modele;
echo '<div id=contenu>
</div><script src="./js/ajax.js"></script>';
