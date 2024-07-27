<?php

setlocale(LC_ALL, 'pt_BR.utf-8', 'pt_BR', 'Portuguese_Brazil');
date_default_timezone_set('America/Sao_Paulo');

// make.php - Use: php make.php page-{my-slug} [-c|-m|-v]
if ($argc < 2) {
    echo "Uso: php make.php page-{my-slug} [-c|-m|-v]\n";
    exit(1);
}

// Pega o slug do argumento do comando
$slug = strtolower($argv[1]); // page-my-slug
$slugWithoutPrefix = str_replace('page-', '', $slug); // my-slug
$slugCapitalized = str_replace('-', '', ucwords($slugWithoutPrefix, '-')); // MySlug

// Caminhos dos arquivos a serem criados
$controllerFilePath = "src/Controllers/{$slugCapitalized}Controller.php";
$languageFilePath = "src/Locale/lang/{$slugWithoutPrefix}-pt.php";

$modelFilePath = "src/Models/{$slugCapitalized}Model.php";

$viewFilePath = "views/page/{$slugWithoutPrefix}.twig";
$viewStyleFilePath = "assets/scss/page/{$slugWithoutPrefix}.scss";

$pageFilePath = "page-{$slugWithoutPrefix}.php";
$oldPageFilePath = "OLD_{$slugWithoutPrefix}.php";

// Determina quais arquivos devem ser criados
$createController = in_array('-c', $argv);
$createModel = in_array('-m', $argv);
$createView = in_array('-v', $argv);

if ($argc === 2 || (!$createController && !$createModel && !$createView)) {
    $createController = $createModel = $createView = true;
}

/**
 * createFile
 * 
 * @param type $filePath
 * @param type $template
 * @param type $type
 * @return type
 */
function createFile($filePath, $template, $type) {
    if (file_exists($filePath)) {
        echo "O arquivo {$type} já existe e não será recriado: {$filePath}\n";
        return;
    }
    file_put_contents($filePath, $template);
    echo "{$type} criado: {$filePath}\n";
}

// Conteúdo do arquivo do controlador
$controllerTemplate = <<<CONTROLLER
<?php

namespace MvcTheme\Controllers;

use Timber\Timber;
use MvcTheme\Models\\{$slugCapitalized}Model;
use MvcTheme\Locale\LanguageStrings;

/**
 * Classe {$slugCapitalized}Controller
 * 
 * Controlador específico para gerenciar a funcionalidade e renderização
 * da página "page-{$slugWithoutPrefix}.php" do WordPress.
 */
class {$slugCapitalized}Controller extends PageController {

   private \$currLang; 
   private \$languageStrings;

    /**
     * Construtor da {$slugCapitalized}Controller
     * 
     * Atualmente, chama o construtor pai, que adiciona ao contexto do Timber.
     * Futuras customizações específicas para `{$slugCapitalized}Controller` podem ser adicionadas aqui.
     */
    public function __construct(\$language = 'pt') {
        // Inicializa a classe de strings de idioma
       \$this->languageStrings = new LanguageStrings("{$slugWithoutPrefix}-{\$language}");
     
        // Define o idioma atual do conteúdo
        \$this->currLang = \$language;
     
        parent::__construct(new {$slugCapitalized}Model());
    }

    /**
     * Adiciona dados customizados ao contexto do Timber.
     *
     * Enriquece o contexto do Timber adicionando informações específicas para a 
     * página. Esta função sobrescreve o método da classe pai para adicionar
     * novos dados.
     *
     * @param array \$context O contexto existente do Timber.
     * @param string \$lang
     * @return array O contexto enriquecido com dados adicionais.
     */
    public function addToContext(array \$context,  string \$lang = 'pt'): array {
        \$context = parent::addToContext(\$context, \$lang); // Obtém o contexto da classe pai

        // Adiciona as strings de idioma ao contexto
        \$context['strings'] = \$this->languageStrings;

        return \$context;
    }

    /**
     * Renderiza a página usando Timber.
     * 
     * Puxa o contexto atual e renderiza a página 'page/{$slugWithoutPrefix}.twig'.
     */
    public function render(): void {
        \$context = Timber::get_context(); // Obtém o contexto
        
        // Mescla o contexto com as adições da classe {$slugCapitalized}Controller
        \$context = \$this->addToContext(\$context, \$this->currLang);

        Timber::render('page/{$slugWithoutPrefix}.twig', \$context);
    }
}
CONTROLLER;
        
// Conteúdo do arquivo de idioma (default: pt)
$languageTemplate = <<<LANGUAGE
<?php

\${$slugWithoutPrefix}_content = [
    'greetings' => [
        'title' => 'Olá Mundo!!!',
        'welcome' => 'Seja muito bem vindo por aqui!!!',
    ],
];

return \${$slugWithoutPrefix}_content;

LANGUAGE;

// Conteúdo do arquivo do modelo
$modelTemplate = <<<MODEL
<?php

namespace MvcTheme\Models;

/**
 * Classe {$slugCapitalized}Model
 * 
 * Modelo para a página "page-{$slugWithoutPrefix}.php".
 */
class {$slugCapitalized}Model extends PageModel {
    // Adicione métodos personalizados aqui, se necessário.
}

MODEL;

// Conteúdo da view Twig
$viewTemplate = <<<VIEW
{% extends 'template.twig' %}
{% set greetings = strings.get('greetings') %}

{% block styles %}
    {{ parent() }}
    <link href="{{ theme.link }}/mvc-theme/assets/css/page/{$slugWithoutPrefix}.min.css" rel="stylesheet">
{% endblock %}

{% block content %}
    <div class="container custom-container">
        <h2 class="text-center my-4 text-primary"> {{ greetings.title }} </h2>
        <div class="row">
            <div class="col">
                <p> {{ greetings.welcome }} </p>
            </div>
        </div>
    </div>
{% endblock %}

{% block scripts %}
    {{ parent() }}
{% endblock %}
VIEW;

// Conteúdo do arquivo SCSS da view Twig
$createdAt = strftime("%d de %b de %Y, %H:%M:%S");

$viewStyleTemplate = <<<PAGESTYLE
/*
    Created on: {$createdAt}
    Author: [Nome do autor aqui]

    Description: Folha de Estilos para a página page-{$slugWithoutPrefix}.php.
    Version: 1.0.0
    Dependencies: nenhum arquivo
    Last Major Changes:
        - {$createdAt}: Adicionados estilos para a página refatorada.
    Usage: Importe este arquivo no template TWIG da página em questão, logo abaixo do comando {{ parent() }} do bloco "styles" para aplicar estilos.
*/

PAGESTYLE;

// Conteúdo da página PHP
$pageTemplate = <<<PAGE
<?php

// ... Configurações de erro ...
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Instancia o controlador e renderiza a página
\$controller = new MvcTheme\Controllers\\{$slugCapitalized}Controller();
\$controller->render();
PAGE;

// Cria os arquivos no diretório apropriado
if ($createController) {
    createFile($controllerFilePath, $controllerTemplate, 'Controller');
    createFile($languageFilePath, $languageTemplate, 'Arquivo de idioma (PT-BR)');
}

if ($createModel) {
    createFile($modelFilePath, $modelTemplate, 'Model');
}

if ($createView) {
    createFile($viewFilePath, $viewTemplate, 'View');
    createFile($viewStyleFilePath, $viewStyleTemplate, 'Estilo da View');
}

if (file_exists($pageFilePath) && !file_exists($oldPageFilePath)) {
    rename($pageFilePath, "./OLD_{$slugWithoutPrefix}.php");
    echo "Arquivo existente renomeado para OLD_: {$pageFilePath}\n";
}

createFile($pageFilePath, $pageTemplate, 'Página PHP');

echo "Processo concluído.\n";
