<?php
$alleTiere = array(
    'Hund' => 'wuff',
    'Katze' => 'miau',
    'Maus' => 'piep'
);
$zweiTiere = array(
    'Hund' => 'wuff',
    'Maus' => 'piep'
);
var_dump(istTeilmengeKeyValue($alleTiere, $zweiTiere));
var_dump(istTeilmengeKeyValue($zweiTiere, $alleTiere));

function istTeilmengeKeyValue($obermenge, $teilmenge)
{
    $schnittmenge = array_intersect_assoc($obermenge, $teilmenge);
    $symmetrischeDifferenzmenge = array_diff_assoc($teilmenge, $schnittmenge);
    if ($symmetrischeDifferenzmenge === array()) {
        return true;
    } else {
        return false;
    }
}
