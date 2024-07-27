<?php

namespace MvcTheme\Locale;

class LanguageStrings {
    
    /**
     * Array que armazena as strings de idioma.
     */
    private $strings;

    /**
     * Construtor da classe.
     * Carrega as strings de idioma do arquivo correspondente.
     *
     * @param string $language O idioma a ser carregado, 'pt' por padrão.
     */
    public function __construct($language = 'pt') {
        // Constrói o caminho do arquivo de idioma com base no idioma fornecido.
        $file = __DIR__ . "/lang/{$language}.php";

        // Verifica se o arquivo de idioma existe.
        if (file_exists($file)) {
            // Carrega as strings de idioma do arquivo.
            $this->strings = include($file);
        } else {
            // Se o arquivo não existir, carrega o idioma padrão ('pt').
            $this->strings = include(__DIR__ . '/lang/pt.php');
        }
    }

    /**
     * Retorna uma string de idioma específica.
     *
     * @param string $key A chave da string a ser retornada.
     * @param string $default O valor padrão a ser retornado se a chave não for encontrada.
     * @return string A string de idioma ou o valor padrão.
     */
    public function get($key, $default = '') {
        return $this->strings[$key] ?? $default;
    }

    /**
     * Retorna todas as strings de idioma.
     *
     * @return array O array completo de strings de idioma.
     */
    public function getStrings() {
        return $this->strings;
    }
}
