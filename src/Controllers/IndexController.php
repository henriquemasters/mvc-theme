<?php

namespace MvcTheme\Controllers;

use Timber\Timber;
use MvcTheme\Models\IndexModel;
use MvcTheme\Locale\LanguageStrings;

/**
 * Classe IndexController
 * 
 * Controlador específico para gerenciar a funcionalidade e renderização
 * da página "page-index.php" do WordPress.
 */
class IndexController extends PageController {

   private $currLang; 
   private $languageStrings;

    /**
     * Construtor da IndexController
     * 
     * Atualmente, chama o construtor pai, que adiciona ao contexto do Timber.
     * Futuras customizações específicas para `IndexController` podem ser adicionadas aqui.
     */
    public function __construct($language = 'pt') {
        // Inicializa a classe de strings de idioma
       $this->languageStrings = new LanguageStrings("index-{$language}");
     
        // Define o idioma atual do conteúdo
        $this->currLang = $language;
     
        parent::__construct(new IndexModel());
    }

    /**
     * Adiciona dados customizados ao contexto do Timber.
     *
     * Enriquece o contexto do Timber adicionando informações específicas para a 
     * página. Esta função sobrescreve o método da classe pai para adicionar
     * novos dados.
     *
     * @param array $context O contexto existente do Timber.
     * @param string $lang
     * @return array O contexto enriquecido com dados adicionais.
     */
    public function addToContext(array $context,  string $lang = 'pt'): array {
        $context = parent::addToContext($context, $lang); // Obtém o contexto da classe pai

        // Adiciona as strings de idioma ao contexto
        $context['strings'] = $this->languageStrings;

        return $context;
    }

    /**
     * Renderiza a página usando Timber.
     * 
     * Puxa o contexto atual e renderiza a página 'page/index.twig'.
     */
    public function render(): void {
        $context = Timber::get_context(); // Obtém o contexto
        
        // Mescla o contexto com as adições da classe IndexController
        $context = $this->addToContext($context, $this->currLang);

        Timber::render('page/index.twig', $context);
    }
}