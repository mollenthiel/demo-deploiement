<?php
require dirname(__DIR__).'/src/Tarif.php';
require dirname(__DIR__).'/src/Base.php';
$env = Base::env(dirname(__DIR__));
$version = basename(dirname(__DIR__));
try {
    $n = Base::pdo($env['DATABASE_URL'])->query('SELECT count(*) FROM rendez_vous')->fetchColumn();
} catch (Throwable) {
    http_response_code(500);
    exit("base injoignable\n");
}
header('Content-Type: text/plain; charset=utf-8');
echo "Salon fictif (v2), version $version, $n rendez-vous, massage 60 min : ".Tarif::ttc(5000)." centimes TTC\n";
