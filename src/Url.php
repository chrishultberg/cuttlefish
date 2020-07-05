<?php

namespace Cuttlefish;

use Configuration;

class Url
{
    public $url_relative = '';
    public $url_absolute = '';

    public function __construct($path = null)
    {
        if (is_string($path)) {
            $this->setUrl($path);
        }

        return $this;
    }

    protected function setUrl(string $path): void
    {
        $this->url_relative = Configuration::INDEX_PAGE . $path;
        $this->url_absolute = $this->protocol() . $_SERVER['HTTP_HOST'] . $this->url_relative;
    }

    /**
     * Returns protocol part of an internal url
     * Source: http://stackoverflow.com/questions/4503135/php-get-site-url-protocol-http-vs-https
     *
     * @return string correct protocol dependent url
     */
    protected function protocol(): string
    {
        $protocol = 'http://';
        if (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
            $protocol = 'https://';
        }

        return (string) $protocol;
    }

    /**
     * Converts a file to an url.
     * make sure to call Url->url_absolute after.
     *
     * @param object $file_object File object
     *
     * @return self url object
     */
    public function convertFileToURL($file_object): self
    {
        $file_object = $file_object->relative();

        $relative_url = str_replace(DIRECTORY_SEPARATOR, "/", $file_object->path);
        $relative_url = '/' . ltrim($relative_url, '/');
        Log::debug(__FUNCTION__ . " relative_url: $relative_url");

        $content_folder = Configuration::CONTENT_FOLDER;

        if (! strrpos($relative_url, $content_folder) === false) {
            $relative_url = str_replace([
                $content_folder . '/',
                '.' . Configuration::CONTENT_EXT,
            ], '', $relative_url);
        }
        $this->setUrl($relative_url);

        return $this;
    }
}