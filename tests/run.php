<?php
// Tests du site fictif : code 1 au premier echec.
require dirname(__DIR__).'/src/Tarif.php';
$cas = [[5000, 200, 6001], [1, 200, 1], [999, 55, 1054]];
foreach ($cas as [$ht, $taux, $attendu]) {
    $obtenu = Tarif::ttc($ht, $taux);
    if ($obtenu !== $attendu) {
        fwrite(STDERR, "ECHEC ttc($ht, $taux) = $obtenu, attendu $attendu\n");
        exit(1);
    }
}
echo count($cas)." tests verts\n";
