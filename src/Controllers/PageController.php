<?php

namespace MvcTheme\Controllers;

use MvcTheme\Models\PageModel;
use MvcTheme\Locale\LanguageStrings;
use Timber\Site as TimberSite;

/**
 * Classe PageController.
 *
 * Esta classe serve como o controlador base, fornecendo funcionalidades comuns
 * a todos os controladores de páginas. Ela interage com os frameworks WordPress e Timber
 * para configurar o contexto necessário para os templates de visualização.
 */
class PageController {

    /**
     * @var TimberSite Mantém uma instância do Timber\Site (configurações do site WordPress).
     */
    protected $site;

    /**
     * @var PageModel Mantém uma instância do PageModel.
     */
    protected $model;

    /**
     * Construtor da PageController.
     *
     * Adiciona o filtro do Timber para enriquecer o contexto que será passado aos templates.
     * 
     * @param PageModel $model
     */
    public function __construct(PageModel $model) {
        $this->site = new TimberSite();
        $this->model = $model;
        add_filter('timber/context', array($this, 'addToContext'));
    }

    /**
     * Adiciona dados customizados ao contexto do Timber.
     *
     * Cria uma nova instância do PageModel e usa seus métodos para adicionar
     * informações ao contexto do Timber. Essas informações incluem os dados
     * da postagem atual, metadados associados e a estrutura do menu principal.
     *
     * @param array $context O contexto existente do Timber.
     * @param string $lang
     * @return array O contexto enriquecido com dados adicionais.
     */
    public function addToContext(array $context, string $lang): array {

        $context['page'] = $this->model;
        $context['meta'] = $this->model->getMetas();

        $header_menu = new LanguageStrings("commons/header-{$lang}");
        $context['header_menu'] = $header_menu;

        return $context;
    }
}
