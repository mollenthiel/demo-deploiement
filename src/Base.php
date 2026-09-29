<?php
final class Base
{
    public static function env(string $racine): array
    {
        $env = [];
        foreach (['.env', '.env.local'] as $f) {
            if (is_file("$racine/$f")) {
                foreach (file("$racine/$f", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $l) {
                    if ($l[0] !== '#' && str_contains($l, '=')) {
                        [$k, $v] = explode('=', $l, 2);
                        $env[trim($k)] = trim($v, " \"'");
                    }
                }
            }
        }
        return $env + getenv();
    }

    public static function pdo(string $url): PDO
    {
        $p = parse_url($url);
        $dsn = sprintf('pgsql:host=%s;port=%d;dbname=%s', $p['host'], $p['port'] ?? 5432, ltrim($p['path'], '/'));
        return new PDO($dsn, urldecode($p['user']), urldecode($p['pass'] ?? ''), [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}
