<?php
// Never commit real credentials. Set these as environment variables on your host.
$host = "aws-0-ap-northeast-1.pooler.supabase.com"; // getenv() has a parameter for the var name, not the value of it
// should be getenv("db_host") then it is set in the environment variables...
$port = "5432";
$name = "postgres";
$user = "postgres.ldgcmxmuwjozonvyindv";
$pass = "NateHiggers123";

try {
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$name;sslmode=require",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Database connection failed.");
}