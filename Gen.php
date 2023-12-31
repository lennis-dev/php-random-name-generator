<?php

namespace LennisDev;

class RandomName
{
    private static function getRandomWordFromFile($filename)
    {
        $lines = file($filename);
        return $lines[rand(0, count($lines) - 1)];
    }
    public static function getRandomName()
    {
        $adjective = self::getRandomWordFromFile(__DIR__ . '/wordlists/adjectives.txt');
        $noun = self::getRandomWordFromFile(__DIR__ . '/wordlists/nouns.txt');
        return trim($adjective) . '-' . trim($noun) . '-' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}
