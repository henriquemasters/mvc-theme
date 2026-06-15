# MVC WordPress Theme

Tema WordPress experimental criado para demonstrar uma forma mais organizada de desenvolver temas customizados: WordPress como CMS, PHP orientado a camadas, Timber/Twig para views, Composer para dependências e Sass para a camada visual.

A proposta não é substituir o ecossistema do WordPress. É mostrar como projetos WordPress podem ganhar uma arquitetura mais previsível quando precisam crescer além de templates soltos e arquivos `functions.php` inchados.

## Destaques

- Arquitetura inspirada em MVC, com `Controllers`, `Models` e `Views` separados.
- Templates Twig renderizados com Timber, reduzindo PHP dentro do HTML.
- Autoload PSR-4 via Composer para classes do tema.
- `make.php` como CLI de scaffolding para gerar paginas mantendo a convenção MVC.
- Pipeline Sass com Gulp para CSS global e estilos por pagina.
- Landing page inicial servindo como vitrine real do próprio tema.
- Base simples para estudo, portfólio, posts técnicos e evolução pública no GitHub.

## Stack

- WordPress
- PHP 7.4+
- Composer
- Volta para fixar a versão do Node.js
- Timber 1.x
- Twig
- Bootstrap
- Sass/Gulp
- make.php CLI
- Font Awesome

## Estrutura

```text
mvc-theme/
|-- assets/
|   |-- bootstrap/
|   |-- css/
|   |-- fontawesome/
|   |-- js/
|   `-- scss/
|-- config/
|   `-- timber-setup.php
|-- src/
|   |-- Controllers/
|   |-- Locale/
|   `-- Models/
|-- views/
|   |-- commons/
|   |-- page/
|   `-- template.twig
|-- composer.json
|-- functions.php
|-- gulpfile.js
|-- index.php
|-- make.php
`-- style.css
```

## Como funciona

O fluxo principal da home demonstra a arquitetura proposta:

1. O WordPress carrega `index.php` como template do tema.
2. `index.php` instancia `MvcTheme\Controllers\IndexController`.
3. O controller usa `MvcTheme\Models\IndexModel` para obter dados estruturados.
4. O contexto e enviado para `views/page/index.twig` via Timber.
5. O Twig renderiza a interface usando layout base, assets e componentes do tema.

Esse fluxo evita misturar consulta de dados, regra de apresentação e HTML no mesmo arquivo.

## Instalacao

Clone o repositório dentro de `wp-content/themes`:

```bash
git clone https://github.com/henriquemasters/mvc-theme.git wp-content/themes/mvc-theme
```

Instale as dependências PHP:

```bash
cd wp-content/themes/mvc-theme
composer install
```

Instale as dependências de front-end somente se for alterar os arquivos Sass. O projeto usa Volta para fixar o Node.js em `20.20.2`, conforme definido no `package.json`:

```bash
volta install node@20.20.2
npm install
npm run build
```

Se você não usa Volta, use uma versão compatível de Node.js 20 antes de rodar `npm install`.

Depois, ative o tema no painel do WordPress em `Aparencia > Temas`.

## Desenvolvimento

Para compilar os estilos:

```bash
npm run build
```

Para observar alteracoes em `assets/scss`:

```bash
npm run watch
```

### CLI de scaffolding: `make.php`

Um dos diferenciais do tema e o gerador de páginas via CLI. Ele reduz trabalho repetitivo e ajuda a manter a arquitetura consistente quando uma nova página precisa de controller, model, view Twig e template PHP.

Para criar uma nova página:

```bash
php make.php page-about
```

O comando acima gera a estrutura inicial esperada:

- `src/Controllers/AboutController.php`
- `src/Models/AboutModel.php`
- `views/page/about.twig`
- `page-about.php`

Também e possível gerar partes específicas usando flags:

```bash
php make.php page-about -c
php make.php page-about -m
php make.php page-about -v
```

Use o gerador sempre que possível para preservar a convenção do projeto e evitar copiar arquivos manualmente.

### Pipeline front-end

O tema usa Gulp para compilar Sass em CSS minificado.

```bash
npm run build
```

Compila todos os arquivos SCSS uma vez.

```bash
npm run watch
```

Observa alterações em `assets/scss/**/*.scss` e recompila automaticamente.

Arquivos principais:

- Entrada global: `assets/scss/theme.scss`
- Saida global: `assets/css/theme.min.css`
- Entradas por pagina: `assets/scss/page/**/*.scss`
- Saidas por pagina: `assets/css/page/*.min.css`

Não edite diretamente os arquivos `.min.css` gerados. Altere os arquivos `.scss` e rode `npm run build`.

## Criando uma pagina manualmente

Exemplo de template WordPress:

```php
<?php

$controller = new MvcTheme\Controllers\AboutController();
$controller->render();
```

Exemplo de controller:

```php
<?php

namespace MvcTheme\Controllers;

use Timber\Timber;
use MvcTheme\Models\AboutModel;

class AboutController extends PageController
{
    public function __construct()
    {
        parent::__construct(new AboutModel());
    }

    public function render(): void
    {
        $context = $this->addToContext(Timber::get_context(), 'pt');
        Timber::render('page/about.twig', $context);
    }
}
```

## Seguranca do pipeline front-end

O tema usa dependências de front-end apenas em desenvolvimento, para compilar Sass em CSS minificado. O `package-lock.json` deve ser versionado para manter instalações reproduzíveis e preservar o resultado de `npm audit`. O campo `volta` no `package.json` fixa o Node.js em `20.20.2`, reduzindo diferenças entre ambientes locais, CI e máquinas de contribuidores.

Validação atual:

```bash
npm audit
# found 0 vulnerabilities
```

## Status do projeto

Este repositório e uma vitrine técnica em evolução. Ele serve para demonstrar organização de código, convenções de arquitetura e uso de ferramentas modernas dentro de um tema WordPress tradicional.

Possíveis próximos passos:

- Adicionar testes automatizados para models e helpers.
- Melhorar suporte a internacionalização nativa do WordPress.
- Evoluir o gerador `make.php` para comandos mais seguros e validáveis.
- Criar componentes Twig reutilizáveis para header, footer, cards e seções.
- Publicar uma demo visual com screenshots atualizados.

## Licença e autoria

Este projeto e distribuído sob a licença GNU General Public License v3 or later.

Você pode usar, estudar, modificar e redistribuir este tema, inclusive em forks, desde que mantenha os avisos de copyright, a licença original e a atribuição ao autor original.

Autor original: Henrique Mariano dos Santos Silva.

Este software e fornecido sem garantia de funcionamento, suporte ou adequação a qualquer finalidade específica. Veja `LICENSE` para os termos completos.
