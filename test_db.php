<?php
require 'db.php';
$row = $pdo->query("SELECT DATABASE() db, USER() who")->fetch();
echo "✅ Conexión OK<br>BD: {$row['db']}<br>Usuario: {$row['who']}";
