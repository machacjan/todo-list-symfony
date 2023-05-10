<?php declare(strict_types=1);

namespace App\Components;

use App\Service\TestConfigurator\UrlBuilder;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('test_configurator')]
class TestConfiguratorComponent
{

    use DefaultActionTrait;

    use ComponentToolsTrait;


    #[LiveProp()]
    public string $activeTab;

    #[LiveProp()]
    public ?string $activeSection = null;


    public function __construct(private UrlBuilder $urlBuilder)
    {}


    public function mount(?string $activeTab = null)
    {
        $this->activeTab = $activeTab ?? 'content';
    }


    #[LiveAction]
    public function setActiveTab(#[LiveArg] string $tabName): void
    {
        $this->activeTab = $tabName;

        if ($tabName === 'content') {
            $this->activeSection = 'stimuli';
        }

        if ($tabName === 'settings') {
            $this->activeSection = 'basic';
        }

        if (\in_array($tabName, ['sharing', 'results'])) {
            $this->activeSection = null;
        }

        $this->dispatchUrlChangeEvent();
    }


    #[LiveAction]
    public function setActiveSection(#[LiveArg] ?string $sectionName = null): void
    {
        $this->activeSection = $sectionName;

        $this->dispatchUrlChangeEvent();
    }


    private function dispatchUrlChangeEvent(): void
    {
        $url = $this->urlBuilder->build($this->activeTab, $this->activeSection);

        $this->dispatchBrowserEvent('configurator:url:changed', ['url' => $url]);
    }

}
