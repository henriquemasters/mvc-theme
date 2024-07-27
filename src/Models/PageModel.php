<?php

namespace MvcTheme\Models;

/**
 * Classe PageModel.
 * 
 * Estende a classe Post do Timber para oferecer funcionalidades adicionais
 * na recuperação de atributos de postagens e metadados.
 */
class PageModel extends \Timber\Post {

    /**
     * Recupera o título da postagem.
     * 
     * @return string O título da postagem.
     */
    public function getPostTitle(): string {
        return $this->title();
    }

    /**
     * Recupera um breve resumo do conteúdo da postagem.
     * Remove quaisquer tags HTML e retorna até os primeiros 155 caracteres.
     * 
     * @return string Um breve resumo do conteúdo da postagem.
     */
    public function getPostExcerpt(): string {
        $content = strip_tags($this->content()); // Remove tags HTML
        return mb_substr($content, 0, 155); // Limita a 155 caracteres
    }

    /**
     * Recupera a imagem em destaque (miniatura) da postagem.
     * 
     * @return string|null A URL da imagem em destaque ou null se não estiver definida.
     */
    public function getFeaturedImage(): ?string {
        return $this->thumbnail() ? $this->thumbnail()->src : null;
    }

    /**
     * Recupera a url da postagem.
     * 
     * @return string O link da postagem.
     */
    public function getPermalink(): string {
        return $this->link();
    }

    /**
     * Recupera um array de informações meta para a postagem.
     * 
     * @return array Um array com as chaves 'title', 'description', 'thumbnail' e 'permalink' contendo os respectivos dados da postagem.
     */
    public function getMetas(): array {
        return [
            'title' => $this->getPostTitle(),
            'description' => $this->getPostExcerpt(),
            'thumbnail' => $this->getFeaturedImage(),
            'url' => $this->getPermalink()
        ];
    }

}
