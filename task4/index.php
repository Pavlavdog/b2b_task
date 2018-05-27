<?php
/**
 * Parsing ini file with database settings
 * @var array $config
 */
$config = parse_ini_file(__DIR__ . '/config.ini');


$dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $connection = new PDO($dsn, $config['db_user'], $config['db_pass'], $opt);
    $user_ids = (!empty($_GET['user_ids'])) ? htmlspecialchars($_GET['user_ids']) : null;

    if (!is_null($user_ids)) {
        $data = load_users_data($user_ids, $connection);
    }

    if (!empty($data) || $data != false) {
        foreach ($data as $user) {
            echo "<a href=\"/show_user.php?id={$user->id}\">{$user->name}</a><br>";
        }
    }

    $connection=null;
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

/**
 *  Loading users from Users table
 *
 * @param string $user_ids
 * @param PDO $pdo
 * @return array|bool
 */
function load_users_data(string $user_ids, PDO $pdo) {
    $user_ids = explode(',', $user_ids);

    if (empty($user_ids)) {
        return false;
    }

    $in = str_repeat('?,', count($user_ids) - 1) . '?';
    $query = $pdo->prepare("SELECT id, name FROM users WHERE id IN ($in)");
    $query->execute($user_ids);
    $data = $query->fetchAll(PDO::FETCH_OBJ);

    return $data;
}