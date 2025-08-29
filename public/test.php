<?php
echo "<h2>🚀 Laravel + Apache Diagnostic</h2>";

// 1. Cek PHP jalan
echo "<p><b>1. PHP Version:</b> " . phpversion() . "</p>";

// 2. Cek Rewrite Module
if (in_array('mod_rewrite', apache_get_modules())) {
    echo "<p><b>2. mod_rewrite:</b> ✅ Aktif</p>";
} else {
    echo "<p><b>2. mod_rewrite:</b> ❌ TIDAK aktif</p>";
}

// 3. Cek file penting Laravel
$paths = [
    __DIR__ . "/index.php",
    __DIR__ . "/.htaccess",
    __DIR__ . "/../vendor/autoload.php",
    __DIR__ . "/../bootstrap/app.php",
];
echo "<p><b>3. File Check:</b></p><ul>";
foreach ($paths as $path) {
    if (file_exists($path)) {
        echo "<li>✅ Ada → " . basename($path) . "</li>";
    } else {
        echo "<li>❌ Hilang → " . basename($path) . "</li>";
    }
}
echo "</ul>";

// 4. Cek akses route Laravel
$url = "http://" . $_SERVER['HTTP_HOST'] . "/"; 
echo "<p><b>4. Test akses ke root:</b> <a href='$url' target='_blank'>$url</a></p>";

// 5. Cek Hostname
echo "<p><b>5. Hostname yang dipanggil:</b> " . $_SERVER['HTTP_HOST'] . "</p>";

// 6. Cek Document Root
echo "<p><b>6. Document Root Apache:</b> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
?>
