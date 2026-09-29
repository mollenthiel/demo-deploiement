<?php
// Site fictif de la convention de mise en prod partagee (QG #4295).
final class Tarif
{
    public static function ttc(int $centimesHt, int $tauxPourMille = 200): int
    {
        return intdiv($centimesHt * (1000 + $tauxPourMille) + 500, 1000);
    }
}
