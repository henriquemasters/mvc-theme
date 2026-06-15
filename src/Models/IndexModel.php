<?php

namespace MvcTheme\Models;

/**
 * Model that feeds the public showcase page for the theme.
 */
class IndexModel extends PageModel {
    public function getShowcase(): array {
        return [
            'hero' => [
                'eyebrow' => 'WordPress com arquitetura de aplicacao',
                'title' => 'Um tema MVC para criar experiencias WordPress mais organizadas, testaveis e escalaveis.',
                'description' => 'MVC Theme combina WordPress, Timber, Twig, Composer e uma estrutura por Controllers, Models e Views para tirar projetos institucionais do improviso de templates monoliticos.',
                'primary_cta' => 'Explorar estrutura',
                'secondary_cta' => 'Ver documentacao',
            ],
            'stats' => [
                ['value' => 'MVC', 'label' => 'Separacao clara de responsabilidades'],
                ['value' => 'Twig', 'label' => 'Views limpas com Timber'],
                ['value' => 'CLI', 'label' => 'Scaffolding com make.php'],
            ],
            'features' => [
                [
                    'icon' => 'fas fa-layer-group',
                    'title' => 'Controllers dedicados',
                    'description' => 'Cada pagina pode ter um controller proprio para preparar contexto, regras de exibicao e integracoes sem poluir o template.',
                ],
                [
                    'icon' => 'fas fa-database',
                    'title' => 'Models reaproveitaveis',
                    'description' => 'A camada de dados concentra metadados, consultas e transformacoes antes de entregar informacao para a view.',
                ],
                [
                    'icon' => 'fas fa-code',
                    'title' => 'Templates Twig',
                    'description' => 'A apresentacao fica em Twig, com heranca de layout, componentes reutilizaveis e markup mais legivel.',
                ],
                [
                    'icon' => 'fas fa-terminal',
                    'title' => 'CLI para novas paginas',
                    'description' => 'O make.php gera a base de uma pagina completa mantendo controller, model, view e template PHP na mesma convencao.',
                ],
            ],
            'cli' => [
                'eyebrow' => 'Diferencial do projeto',
                'title' => 'Um gerador simples para manter o MVC consistente a cada nova pagina.',
                'description' => 'Em vez de copiar arquivos manualmente, o CLI cria a estrutura inicial e reduz o risco de quebrar a convencao do tema.',
                'command' => 'php make.php page-about',
                'outputs' => [
                    'src/Controllers/AboutController.php',
                    'src/Models/AboutModel.php',
                    'views/page/about.twig',
                    'page-about.php',
                ],
            ],
            'workflow' => [
                ['step' => '01', 'title' => 'Gere a base', 'description' => 'Use make.php para criar os arquivos iniciais da nova pagina.'],
                ['step' => '02', 'title' => 'Prepare o contexto', 'description' => 'Controller e Model organizam dados, idioma e metadados.'],
                ['step' => '03', 'title' => 'Renderize com Twig', 'description' => 'A view recebe um contexto limpo e foca somente na interface.'],
            ],
            'stack' => ['WordPress', 'PHP', 'Composer', 'Timber', 'Twig', 'Bootstrap', 'Sass', 'Font Awesome', 'make.php CLI'],
            'credits' => [
                'label' => 'Projeto e desenvolvimento',
                'author' => 'Henrique Mariano dos Santos Silva',
                'message' => 'Tema criado como vitrine tecnica para demonstrar arquitetura MVC aplicada ao desenvolvimento WordPress.',
                'url' => 'https://github.com/henriquemasters',
            ],
        ];
    }
}
