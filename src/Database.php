<?php

namespace Iichn\Prime\Database;

function getConnection(): \PDO
{
    $path = __DIR__ . '/../database.sqlite';
    $pdo = new \PDO("sqlite:{$path}");
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE TABLE IF NOT EXISTS games (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        player TEXT NOT NULL,
        number INTEGER NOT NULL,
        is_correct INTEGER NOT NULL,
        played_at TEXT NOT NULL
    )");
    return $pdo;
}

function saveGame(\PDO $pdo, string $player, int $number, bool $isCorrect): void
{
    $stmt = $pdo->prepare(
        "INSERT INTO games (player, number, is_correct, played_at) VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$player, $number, (int)$isCorrect, date('Y-m-d H:i:s')]);
}

function getHistory(\PDO $pdo): array
{
    return $pdo->query("SELECT * FROM games ORDER BY played_at DESC")->fetchAll(\PDO::FETCH_ASSOC);
}
