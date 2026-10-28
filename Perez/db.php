<?php

$host = 'aws-0-ap-south-1.pooler.supabase.com';
$dbuser = 'postgres.jixvlhdlxufrpqjbthli';
$dbpassword = 'CoryInTheHouse2201837';
$database = 'postgres';
$port = 5432;

$conn = pg_connect("host=$host port=5432 dbname=postgres user =$dbuser password=$dbpassword sslmode=require");

if(!$conn){
    exit("Error, Database Connection Fail");
}
?>