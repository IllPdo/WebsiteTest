<?php
require_once "db.php";
 
function getUserByUsername(PDO $conn, string $username)
{
    $stmt = $conn->prepare("SELECT id, username, password FROM public.users WHERE username = :u");
    $stmt->execute([":u" => $username]);
    return $stmt->fetch(); // row array or false
}
 
function checkUsername(PDO $conn, string $username): bool
{
    return getUserByUsername($conn, $username) !== false;
}
 
function createUser(PDO $conn, string $username, string $hashedPassword): void
{
    $stmt = $conn->prepare("INSERT INTO public.users (username, password) VALUES (:u, :p)");
    $stmt->execute([":u" => $username, ":p" => $hashedPassword]);
}
 
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}
 