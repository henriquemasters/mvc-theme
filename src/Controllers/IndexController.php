<?php

namespace MvcTheme\Controllers;

use Timber\Timber;
use MvcTheme\Models\IndexModel;
use MvcTheme\Locale\LanguageStrings;

/**
 * Controller for the public showcase page.
 */
class IndexController extends PageController {

    private $currLang;
    private $languageStrings;
    private $indexModel;

    public function __construct($language = 'pt') {
        $this->languageStrings = new LanguageStrings("index-{$language}");
        $this->currLang = $language;
        $this->indexModel = new IndexModel();

        parent::__construct($this->indexModel);
    }

    public function addToContext(array $context, string $lang = 'pt'): array {
        $context = parent::addToContext($context, $lang);
        $context['strings'] = $this->languageStrings;
        $context['showcase'] = $this->indexModel->getShowcase();
        $context['repository_url'] = 'https://github.com/henriquemasters/mvc-theme';

        return $context;
    }

    public function render(): void {
        $context = Timber::get_context();
        $context = $this->addToContext($context, $this->currLang);

        Timber::render('page/index.twig', $context);
    }
}
