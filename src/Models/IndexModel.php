<?php

namespace MvcTheme\Models;

/**
 * Model that feeds the public showcase page for the theme.
 */
class IndexModel extends PageModel {
    public function getShowcase(): array {
        return [
            'hero' => [
                'eyebrow' => 'WordPress com arquitetura de aplicação',
                'title' => 'Um tema MVC para criar experiências WordPress mais organizadas, testáveis e escaláveis.',
                'description' => 'MVC Theme combina WordPress, Timber, Twig, Composer e uma estrutura por Controllers, Models e Views para tirar projetos institucionais do improviso de templates monolíticos.',
                'primary_cta' => 'Explorar estrutura',
                'secondary_cta' => 'Ver documentação',
            ],
            'stats' => [
                ['value' => 'MVC', 'label' => 'Separação clara de responsabilidades'],
                ['value' => 'Twig', 'label' => 'Views limpas com Timber'],
                ['value' => 'CLI', 'label' => 'Scaffolding com make.php'],
            ],
            'features' => [
                [
                    'icon' => 'fas fa-layer-group',
                    'title' => 'Controllers dedicados',
                    'description' => 'Cada pagina pode ter um controller próprio para preparar contexto, regras de exibição e integrações sem poluir o template.',
                ],
                [
                    'icon' => 'fas fa-database',
                    'title' => 'Models reaproveitáveis',
                    'description' => 'A camada de dados concentra metadados, consultas e transformações antes de entregar informação para a view.',
                ],
                [
                    'icon' => 'fas fa-code',
                    'title' => 'Templates Twig',
                    'description' => 'A apresentação fica em Twig, com herança de layout, componentes reutilizáveis e markup mais legível.',
                ],
                [
                    'icon' => 'fas fa-terminal',
                    'title' => 'CLI para novas páginas',
                    'description' => 'O make.php gera a base de uma página completa mantendo controller, model, view e template PHP na mesma convenção.',
                ],
            ],
            'cli' => [
                'eyebrow' => 'Diferencial do projeto',
                'title' => 'Um gerador simples para manter o MVC consistente a cada nova página.',
                'description' => 'Em vez de copiar arquivos manualmente, o CLI cria a estrutura inicial e reduz o risco de quebrar a convenção do tema.',
                'command' => 'php make.php page-about',
                'outputs' => [
                    'src/Controllers/AboutController.php',
                    'src/Models/AboutModel.php',
                    'views/page/about.twig',
                    'page-about.php',
                ],
            ],
            'workflow' => [
                ['step' => '01', 'title' => 'Gere a base', 'description' => 'Use make.php para criar os arquivos iniciais da nova página.'],
                ['step' => '02', 'title' => 'Prepare o contexto', 'description' => 'Controller e Model organizam dados, idioma e metadados.'],
                ['step' => '03', 'title' => 'Renderize com Twig', 'description' => 'A view recebe um contexto limpo e foca somente na interface.'],
            ],
            'stack' => ['WordPress', 'PHP', 'Composer', 'Timber', 'Twig', 'Bootstrap', 'Sass', 'Font Awesome', 'make.php CLI'],
            'credits' => [
                'label' => 'Projeto e desenvolvimento',
                'author' => 'Henrique Mariano dos Santos Silva',
                'message' => 'Tema criado como vitrine técnica para demonstrar arquitetura MVC aplicada ao desenvolvimento WordPress.',
                'url' => 'https://github.com/henriquemasters',
            ],
        ];
    }
}
