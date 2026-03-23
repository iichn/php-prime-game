<?php

namespace Iichn\Prime\Controller;

use function Iichn\Prime\View\showWelcome;
use function Iichn\Prime\View\showResult;
use function Iichn\Prime\View\showHistory;
use function Iichn\Prime\Database\getConnection;
use function Iichn\Prime\Database\saveGame;
use function Iichn\Prime\Database\getHistory;

function isPrime(int $n): bool
{
    if ($n < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i === 0) {
            return false;
        }
    }
    return true;
}

function getDivisors(int $n): array
{
    $divisors = [];
    for ($i = 2; $i < $n; $i++) {
        if ($n % $i === 0) {
            $divisors[] = $i;
        }
    }
    return $divisors;
}

function startGame(): void
{
    showWelcome();
    $pdo = getConnection();

    $action = \cli\prompt("Play game or view history? (play/history)");

    if ($action === 'history') {
        showHistory(getHistory($pdo));
        return;
    }

    $player = \cli\prompt("Your name");
    $number = rand(2, 100);
    \cli\line("Is this number prime? {$number}");
    $answer = \cli\prompt("Your answer (yes/no)");

    $prime = isPrime($number);
    $isCorrect = ($answer === 'yes') === $prime;
    $divisors = $prime ? [] : getDivisors($number);

    saveGame($pdo, $player, $number, $isCorrect);
    showResult($isCorrect, $number, $divisors);
}
