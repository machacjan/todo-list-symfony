/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap');

class TestConfigurator
{

    constructor() 
    {
        window.addEventListener('configurator:url:changed', event => {
            console.log(event.detail.url);
            this.#updateUrl(event.detail.url);
        });
    }


    #updateUrl(url)
    {
        window.history.replaceState(null, '', url);
    }

}

new TestConfigurator();
