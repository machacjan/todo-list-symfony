<?php declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexControllerTest extends WebTestCase
{

    public function testEnglishIndexPageRenders(): void
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Symfony Todo List');
        $this->assertSelectorExists('form[name="todo_list"]');
    }


    public function testCzechIndexPageRenders(): void
    {
        $client = static::createClient();

        $client->request('GET', '/cs');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Symfony Úkolníček');
        $this->assertSelectorExists('form[name="todo_list"]');
    }

}
