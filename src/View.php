<?php

namespace Iichn\Prime\View;

function showWelcome(): void
{
    \cli\line("=== Prime Number Game ===");
}

function showResult(bool $isCorrect, int $number, array $divisors): void
{
    if ($isCorrect) {
        \cli\line("Correct!");
    } else {
        \cli\line("Wrong!");
        if (!empty($divisors)) {
            \cli\line("Divisors of {$number}: " . implode(', ', $divisors));
        }
    }
}

function showHistory(array $games): void
{
    if (empty($games)) {
        \cli\line("No games yet.");
        return;
    }
    \cli\line("\n=== Game History ===");
    foreach ($games as $game) {
        $result = $game['is_correct'] ? 'Correct' : 'Wrong';
        \cli\line("[{$game['played_at']}] {$game['player']} — number: {$game['number']}, result: {$result}");
    }
}
