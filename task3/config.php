<?php

// Database
const DB_NAME     = 'b2b';
const DB_USER     = 'root';
const DB_PASS     = '';
const DB_HOST     = '127.0.0.1';
const DB_CHARTSET = 'utf8';

//PDO options
const DB_OPTIONS = [
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // default associative array
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION // errors throw exception
];