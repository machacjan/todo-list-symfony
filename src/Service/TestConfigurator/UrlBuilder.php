<?php declare(strict_types=1);

namespace App\Service\TestConfigurator;

use App\Controller\TestConfiguratorController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UrlBuilder
{

    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {}


    public function build(?string $tabSlug = null, ?string $sectionSlug = null): string
    {
        $currentLocale = 'en';

        if (!\is_null($tabSlug) && !\is_null($sectionSlug)) {

            return $this->generateUrl(TestConfiguratorController::INDEX_ROUTE_NAME_WITH_TAB_NAME_AND_SECTION_NAME, [
                'tabName' => LocalizationHelper::tabSlugToName($tabSlug, $currentLocale),
                'sectionName' => LocalizationHelper::sectionSlugToName($sectionSlug, $currentLocale),
            ]);

        }

        if (!\is_null($tabSlug)) {

            return $this->generateUrl(TestConfiguratorController::INDEX_ROUTE_NAME_WITH_TAB_NAME, [
                'tabName' => LocalizationHelper::tabSlugToName($tabSlug, $currentLocale),
            ]);

        }

        return $this->urlGenerator->generate(TestConfiguratorController::INDEX_ROUTE_NAME);
    }


    private function generateUrl(string $routeName, array $routeParameters = []): string
    {
        return $this->urlGenerator->generate($routeName, $routeParameters, UrlGeneratorInterface::ABSOLUTE_URL);
    }

}
