<?php declare(strict_types=1);

namespace App\Service\TestConfigurator;

use InvalidArgumentException;

class LocalizationHelper
{

    const TAB_MAP = [
        'content' => [
            'cs' => 'obsah',
            'en' => 'content',
        ],
        'settings' => [
            'cs' => 'nastaveni',
            'en' => 'settings',
        ],
        'sharing' => [
            'cs' => 'sdileni',
            'en' => 'share',
        ],
        'results' => [
            'cs' => 'vysledky',
            'en' => 'results',
        ],
    ];

    const SECTION_MAP = [
        'intro' => [
            'cs' => 'uvitaci-stranka',
            'en' => 'welcome-page',
        ],
        'stimuli' => [
            'cs' => 'podnety',
            'en' => 'stimuli',
        ],
        'outro' => [
            'cs' => 'dekovaci-stranka',
            'en' => 'thank-you-page',
        ],
        'basic' => [
            'cs' => 'zakladni',
            'en' => 'basic',
        ],
        'advanced' => [
            'cs' => 'pokrocile',
            'en' => 'advanced',
        ],
        'security' => [
            'cs' => 'zabezpeceni',
            'en' => 'security',
        ],
    ];


    /**
     * @return array<string>
     */
    public static function getTabNames(string $locale): array
    {
        $tabNames = [];

        foreach (self::TAB_MAP as $localizations) {

            if (isset($localizations[$locale])) {
                $tabNames[] = $localizations[$locale];
            }

        }

        if (empty($tabNames)) {
            throw new InvalidArgumentException(\sprintf('No values defined for locale %s.', $locale));
        }

        return $tabNames;
    }


    /**
     * @return array<string>
     */
    public static function getSectionNames(string $locale): array
    {
        $sectionNames = [];

        foreach (self::SECTION_MAP as $localizations) {

            if (isset($localizations[$locale])) {
                $sectionNames[] = $localizations[$locale];
            }

        }

        if (empty($sectionNames)) {
            throw new InvalidArgumentException(\sprintf('No values defined for locale %s.', $locale));
        }

        return $sectionNames;
    }


    public static function tabNameToSlug(string $tabName, string $locale): string
    {
        foreach (self::TAB_MAP as $tabSlug => $localizations) {

            if (!isset($localizations[$locale])) {
                continue;
            }

            if ($localizations[$locale] !== $tabName) {
                continue;
            }

            return $tabSlug;

        }

        throw new InvalidArgumentException(\sprintf('Slug not defined for tab name %s and locale %s.', $tabName, $locale));
    }


    public static function sectionNameToSlug(string $sectionName, string $locale): string
    {
        foreach (self::SECTION_MAP as $sectionSlug => $localizations) {

            if (!isset($localizations[$locale])) {
                continue;
            }

            if ($localizations[$locale] !== $sectionName) {
                continue;
            }

            return $sectionSlug;

        }

        throw new InvalidArgumentException(\sprintf('Slug not defined for section name %s and locale %s.', $sectionName, $locale));
    }


    public static function tabSlugToName(string $tabSlug, string $locale): string
    {
        if (isset(self::TAB_MAP[$tabSlug][$locale])) {
            return self::TAB_MAP[$tabSlug][$locale];
        }

        throw new InvalidArgumentException(\sprintf('Name not defined for tab slug %s and locale %s.', $tabSlug, $locale));
    }


    public static function sectionSlugToName(string $sectionSlug, string $locale): string
    {
        if (isset(self::SECTION_MAP[$sectionSlug][$locale])) {
            return self::SECTION_MAP[$sectionSlug][$locale];
        }

        throw new InvalidArgumentException(\sprintf('Name not defined for section slug %s and locale %s.', $sectionSlug, $locale));
    }

}
