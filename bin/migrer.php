<?php
// Applique dans l'ordre les migrations/NNNN_*.sql pas encore passees, chacune dans sa transaction.
require dirname(__DIR__).'/src/Base.php';
$env = Base::env(dirname(__DIR__));
$pdo = Base::pdo($env['DATABASE_URL']);
$pdo->exec('CREATE TABLE IF NOT EXISTS migrations_passees (nom text PRIMARY KEY, le timestamptz NOT NULL DEFAULT now())');
$faites = $pdo->query('SELECT nom FROM migrations_passees')->fetchAll(PDO::FETCH_COLUMN);
$fichiers = glob(dirname(__DIR__).'/migrations/[0-9][0-9][0-9][0-9]_*.sql');
sort($fichiers);
foreach ($fichiers as $f) {
    $nom = basename($f);
    if (in_array($nom, $faites, true)) {
        continue;
    }
    $pdo->beginTransaction();
    $pdo->exec(file_get_contents($f));
    $pdo->prepare('INSERT INTO migrations_passees (nom) VALUES (?)')->execute([$nom]);
    $pdo->commit();
    echo "migration $nom passee\n";
}
