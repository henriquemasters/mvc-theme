# Projeto MVC WordPress Theme

Uma abordagem moderna para estruturar um projeto WordPress do zero, incorporando padrões de design MVC, injeção de dependências e a biblioteca Timber para renderização.

## Sobre o Projeto

O projeto busca aliar a facilidade e versatilidade do WordPress com práticas modernas de desenvolvimento. O foco é criar uma base robusta, segura, manutenível e escalável, facilitando a incorporação de novas funcionalidades e garantindo que a plataforma possa crescer e evoluir sem grandes obstáculos.

## Índice

- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Estrutura de Diretórios](#estrutura-de-diretórios)
- [Uso](#uso)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Tecnologias Utilizadas

- **[WordPress](https://wordpress.org/):** A base do projeto, um sistema de gerenciamento de conteúdo (CMS) de código aberto.
- **[Timber](https://timber.github.io/docs/):** Uma ferramenta que facilita a criação de temas do WordPress usando o motor de templates Twig.
- **[Bootstrap](https://getbootstrap.com/):** Framework front-end adotado para garantir um desenvolvimento responsivo e orientado a dispositivos móveis.
- **[Vue.js](https://vuejs.org/):** Escolhido por sua simplicidade e eficiência, o Vue.js é usado para criar interfaces dinâmicas e interativas no projeto.

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

   Ao criar uma nova página através do painel do WordPress, siga os passos a seguir:

   - **Criação do Arquivo PHP da Página**:
     Para cada nova página, crie um arquivo PHP correspondente no diretório do tema, seguindo a convenção `page-{nomeDaPagina}.php`. Por exemplo, para uma página chamada "Blank", o arquivo seria `page-blank.php`.

     Inclua o seguinte código dentro desse arquivo, adaptando para o controlador específico da sua página:
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
     Crie um controlador específico para a página, estendendo de `PageController`. Aqui está um exemplo usando `BlankController`:
     ```php
     <?php

     namespace MvcTheme\Controllers;

     use Timber\Timber;

     class BlankController extends PageController {

         // ... (restante do código da classe)

     }
     ```

   - **Criação do Modelo (se necessário)**:
     Se sua página tiver funcionalidades ou dados específicos que requerem lógica adicional, crie um modelo estendendo de `PageModel`. Aqui está um exemplo:
     ```php
     <?php

     namespace MvcTheme\Models;

     class BlankModel extends PageModel {
         // Adicione métodos personalizados aqui, se necessário.
     }
     ```

3. Ao desenvolver novos módulos, documente suas funcionalidades e interações no código para garantir a manutenibilidade.

## Contribuição

Sua contribuição é muito bem-vinda! Se você deseja melhorar o código ou adicionar novas funcionalidades:

1. Crie sua branch a partir da `main`.
2. Garanta que seus códigos sigam os padrões estabelecidos e estejam bem documentados.
3. Envie seus commits e abra um Pull Request. 
