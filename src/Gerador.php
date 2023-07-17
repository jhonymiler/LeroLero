<?php


namespace Jhonymiler\LeroLero;

class Gerador
{

    private $jsons = [];

    protected $folderPath = __DIR__ . '/jsons';

    public function __construct()
    {
        $this->loadJsonFiles();
    }

    public function getFrase($category = null, $number = 1): string
    {
        $frases = '';
        for ($i = 0; $i < $number; $i++) {
            if ($category) {
                $frases .= $this->gerarFrase($category) . '\n';
            } else {
                $randomCategory = array_rand($this->jsons);
                $frases .= $this->gerarFrase($randomCategory) . '\n';
            }
        }
        return $frases;
    }


    public function gerarFrase($category): string
    {
        if (array_key_exists($category, $this->jsons)) {
            $file = $this->jsons[$category];
            $sentences = $this->loadJson($file);

            $phrase = '';
            foreach ($sentences as $sentenceGroup) {
                $randomIndex = array_rand($sentenceGroup);
                $phrase .= $sentenceGroup[$randomIndex] . ' ';
            }

            return $phrase;
        } else {
            return 'Categoria inválida.';
        }
    }

    private function loadJson($file): array
    {
        $json = file_get_contents($file);
        $json = json_decode($json, true);
        return $json;
    }

    protected function loadJsonFiles(): void
    {
        $files = scandir($this->folderPath);
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'json') {
                $arquivoName = pathinfo($file, PATHINFO_FILENAME);
                $this->jsons[$arquivoName] = $this->folderPath . '/' . $file;
            }
        }
    }
}
