<?php

namespace App\Utils;

class Slugify
{
    public static function slugify(string $text): string
    {
        // Remplacer les caractères spéciaux par des tirets et convertir en minuscules
        $text = preg_replace('/[^\w\s]/', '', $text); // Enlever les caractères spéciaux
        $text = strtolower(trim($text)); // Convertir en minuscules
        $text = preg_replace('/\s+/', '-', $text); // Remplacer les espaces par des tirets

        return $text;
    }
}
