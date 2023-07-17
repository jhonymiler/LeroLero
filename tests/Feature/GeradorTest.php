<?php

use Jhonymiler\LeroLero\Gerador;

$leroLero = new Gerador();

it('Criar frase aleatória', function () use ($leroLero) {

    expect($leroLero->getFrase())->toBeString();
});

it('Criar frase aleatória com categoria', function () use ($leroLero) {
    expect($leroLero->getFrase('desenvolvedor'))->toBeString();
});

it('Criar frase aleatória com categoria inválida', function () use ($leroLero) {
    expect($leroLero->getFrase('invalida'))->toBe('Categoria inválida.\n');
});

it('Criar várias frases de acordo com o número de frases passadas', function () use ($leroLero) {
    $frases = $leroLero->getFrase('desenvolvedor', 3);
    expect($frases)->toBeString();
    $arr = explode('\n', $frases);
    array_pop($arr);
    expect($arr)->toHaveLength(3);
});
