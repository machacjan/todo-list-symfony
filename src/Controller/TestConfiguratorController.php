<?php declare(strict_types=1);

namespace App\Controller;

use App\Service\TestConfigurator\LocalizationHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/', name: 'app_test_configurator_index_')]
class TestConfiguratorController extends AbstractController
{

    const INDEX_ROUTE_NAME = 'app_test_configurator_index_default';

    const INDEX_ROUTE_NAME_WITH_TAB_NAME = 'app_test_configurator_index_tab_name';

    const INDEX_ROUTE_NAME_WITH_TAB_NAME_AND_SECTION_NAME = 'app_test_configurator_index_tab_name_section_name';


    #[Route(path: '/{tabName}/{sectionName}', name: 'tab_name_section_name')]
    public function tabNameAndSectionName(Request $request, string $tabName, string $sectionName): Response
    {
        return $this->process(request: $request, tabName: $tabName, sectionName: $sectionName);
    }


    #[Route(path: '/{tabName}', name: 'tab_name')]
    public function tabName(Request $request, string $tabName): Response
    {
        return $this->process(request: $request, tabName: $tabName);
    }


    #[Route(name: 'default')]
    public function index(Request $request): Response
    {
        return $this->process(request: $request);
    }


    private function process(Request $request, ?string $tabName = null, ?string $sectionName = null): Response
    {
        $locale = 'en';

        $arguments = [
            'tab_name' => \is_null($tabName) ? null : LocalizationHelper::tabNameToSlug($tabName, $locale),
            'section_name' => \is_null($sectionName) ? null : LocalizationHelper::sectionNameToSlug($sectionName, $locale),
        ];

        return $this->render('base.html.twig', $arguments);
    }

}
