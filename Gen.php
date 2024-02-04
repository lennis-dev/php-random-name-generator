<?php

/**
 * The MIT License (MIT)
 * 
 * Copyright (c) 2023 lennis-dev (https://lennis.dev)
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace LennisDev;

class RandomName
{
    private static function getRandomWordFromFile(string $filename): string
    {
        $lines = file($filename);
        return $lines[rand(0, count($lines) - 1)];
    }
    public static function getRandomName(string $pattern = "%a-%n-%d%d%d%d%d%d"): string
    {
        // count %adjectives%, %nouns% and %digits% in pattern
        $adjectiveCount = substr_count($pattern, '%a');
        $nounCount = substr_count($pattern, '%n');
        $digitCount = substr_count($pattern, '%d');
        for ($i = 0; $i < $adjectiveCount; $i++) {
            $pattern = preg_replace('/%a/', trim(self::getRandomWordFromFile(__DIR__ . '/wordlists/adjectives.txt')), $pattern, 1);
        }
        for ($i = 0; $i < $nounCount; $i++) {
            $pattern = preg_replace('/%n/', trim(self::getRandomWordFromFile(__DIR__ . '/wordlists/nouns.txt')), $pattern, 1);
        }
        for ($i = 0; $i < $digitCount; $i++) {
            $pattern = preg_replace('/%d/', rand(0, 9), $pattern, 1);
        }
        return $pattern;
    }
}
