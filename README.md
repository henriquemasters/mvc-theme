
# Projeto MVC WordPress Theme

Uma abordagem moderna para estruturar um projeto WordPress do zero, incorporando padrões de design MVC, injeção de dependências e a biblioteca Timber para renderização.

## Índice

- [Introdução](#introdução)
- [Sobre o Projeto](#sobre-o-projeto)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Uso](#uso)
- [Estrutura de Diretórios](#estrutura-de-diretórios)
- [Como Acessar e Utilizar o `make.php`](#como-acessar-e-utilizar-o-makephp)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Introdução

Este projeto visa combinar a facilidade e versatilidade do WordPress com práticas modernas de desenvolvimento. Ele oferece uma base robusta, segura, manutenível e escalável, facilitando a adição de novas funcionalidades e garantindo que a plataforma possa crescer sem grandes obstáculos.

## Sobre o Projeto

O projeto utiliza o Timber para implementar uma arquitetura MVC (Model-View-Controller), promovendo uma separação clara entre lógica de negócio, lógica de apresentação e dados. Isso não só melhora a organização do código, mas também facilita a manutenção e o desenvolvimento contínuo.

## Tecnologias Utilizadas

- **[WordPress](https://wordpress.org/):** CMS de código aberto que serve como base do projeto.
- **[Timber](https://timber.github.io/docs/):** Biblioteca para WordPress que usa o motor de templates Twig.
- **[Bootstrap](https://getbootstrap.com/):** Framework front-end para desenvolvimento responsivo e mobile-first.
- **[Vue.js](https://vuejs.org/):** Framework JavaScript utilizado para criar interfaces de usuário dinâmicas e interativas.

## Requisitos

- WordPress versão 5.3 ou superior.
- PHP versão 7.4 ou superior.
- Composer para gerenciamento de dependências.

## Instalação

1. Clone o repositório em sua máquina local.
2. Navegue até o diretório 'wp-content' do projeto e execute `composer install` para instalar as dependências.

## Uso

1. Após a instalação e configuração, ative o tema através do painel do WordPress.

2. **Criação de uma Nova Página**:

   Para criar uma nova página, siga os passos abaixo:

   - **Criação do Arquivo PHP da Página**:
     Crie um arquivo PHP no diretório do tema, seguindo a convenção `page-{nomeDaPagina}.php`. Por exemplo, para uma página chamada "Blank", crie `page-blank.php`.

     ```php
     <?php

     // Configurações de erro (ajuste conforme necessário)
     ini_set('display_errors', '1');
     ini_set('display_startup_errors', '1');
     error_reporting(E_ALL);

     $blankController = new MvcTheme\Controllers\BlankController();
     $blankController->render();
     ```

   - **Criação do Controlador**:
     Crie um controlador específico para a página, estendendo `PageController`:
     ```php
     <?php

     namespace MvcTheme\Controllers;

     use Timber\Timber;

     class BlankController extends PageController {
         // ... (restante do código da classe)
     }
     ```

   - **Criação do Modelo (se necessário)**:
     Se sua página necessitar de funcionalidades ou dados específicos, crie um modelo estendendo `PageModel`:
     ```php
     <?php

     namespace MvcTheme\Models;

     class BlankModel extends PageModel {
         // Adicione métodos personalizados aqui, se necessário.
     }
     ```

## Estrutura de Diretórios

Estrutura típica de diretórios do tema:

- **src/Controllers/**: Contém os controladores responsáveis pela lógica de negócio.
- **src/Models/**: Contém os modelos que definem a estrutura de dados.
- **views/page/**: Contém os templates Twig usados para a renderização das páginas.
- **page-{slug}.php**: Arquivo PHP que instancia o controlador e inicia a renderização.

## Como Acessar e Utilizar o `make.php`

Para agilizar o desenvolvimento e garantir uma estrutura consistente, o projeto inclui um script chamado `make.php`. Esse script permite gerar rapidamente a estrutura básica para novas funcionalidades, como páginas, controladores, modelos e views.

### Acessando o Script

Navegue até o diretório **"wp-content/themes/mvc-theme/"** do seu projeto WordPress MVC. No terminal, você pode executar o script com o seguinte comando:

```
php make.php page-{my-slug} [-c|-m|-v]
```

### Argumentos e Opções

- **"page-{my-slug}"**: Especifique o slug da sua página. Este será usado para nomear e criar os arquivos.
- Opções:
  - **"-c"**: Cria um controlador para a página.
  - **"-m"**: Cria um modelo para a página.
  - **"-v"**: Cria uma view para a página.

Se nenhuma opção for especificada, o `make.php` criará todos os três tipos de arquivos (controlador, modelo e view) por padrão.

### Estrutura dos Arquivos Gerados

1. **Controller**: Localizado em **"src/Controllers/"**, contém a lógica de manipulação da requisição e preparação de dados para a view.
2. **Model**: Localizado em **"src/Models/"**, define a estrutura de dados e a lógica de negócios.
3. **View**: Uma template Twig em **"views/page/"**, responsável pela apresentação da página.
4. **Página PHP**: Um arquivo PHP em um nível acima, que instancia o controlador e inicia o processo de renderização.

### Exemplo de Uso

Para criar uma nova página chamada "about", use:

```
php make.php page-about
```

Isso gerará os seguintes arquivos:

- **"AboutController.php"** em **"src/Controllers/"**
- **"AboutModel.php"** em **"src/Models/"**
- **"about.twig"** em **"views/page/"**
- **"page-about.php"** no diretório raiz do tema

## Contribuição

Contribuições são bem-vindas! Para contribuir:

1. Crie uma branch a partir da `main`.
2. Garanta que seu código siga os padrões estabelecidos e esteja bem documentado.
3. Envie seus commits e abra um Pull Request.

## Licença

Este projeto é licenciado sob os termos da licença [GNU General Public License, Version 3](https://www.gnu.org/licenses/gpl-3.0.html).