<?php
/**
 * Générateur de sitemap.xml pour Jobsquare.ma
 * Usage: php generate_sitemap.php
 */

$dbhost = 'localhost';
$dbname = 'jobsquaremadb';
$dbuser = 'root';
$dbpass = '';
$baseUrl = 'https://www.jobsquare.ma';

$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$db->set_charset('utf8');

if ($db->connect_error) {
    die("DB connection failed: " . $db->connect_error . "\n");
}

$today = date('Y-m-d');
$urls = [];

// --- 1. Homepage ---
$urls[] = ['loc' => $baseUrl . '/', 'priority' => '1.0', 'changefreq' => 'daily'];

// --- 2. Static pages ---
$staticPages = [
    '/jobs/'         => ['priority' => '0.9', 'changefreq' => 'daily'],
    '/companies/'    => ['priority' => '0.8', 'changefreq' => 'daily'],
    '/about/'        => ['priority' => '0.5', 'changefreq' => 'monthly'],
    '/contact/'      => ['priority' => '0.5', 'changefreq' => 'monthly'],
    '/recrutement/'  => ['priority' => '0.7', 'changefreq' => 'monthly'],
    '/regions/'      => ['priority' => '0.7', 'changefreq' => 'weekly'],
    '/terms-of-use/' => ['priority' => '0.3', 'changefreq' => 'yearly'],
    '/blog/'         => ['priority' => '0.7', 'changefreq' => 'weekly'],
    '/trainings/'    => ['priority' => '0.7', 'changefreq' => 'weekly'],
    '/categories/'   => ['priority' => '0.8', 'changefreq' => 'weekly'],
    '/registration/' => ['priority' => '0.4', 'changefreq' => 'monthly'],
    '/login/'        => ['priority' => '0.3', 'changefreq' => 'monthly'],
];

foreach ($staticPages as $uri => $meta) {
    $urls[] = ['loc' => $baseUrl . $uri, 'priority' => $meta['priority'], 'changefreq' => $meta['changefreq']];
}

// --- 3. Job listings (active) ---
$result = $db->query("SELECT sid, Title, activation_date FROM listings WHERE active = 1 AND listing_type_sid = 6 ORDER BY activation_date DESC");
while ($row = $result->fetch_assoc()) {
    $slug = pretty_url($row['Title']);
    $lastmod = $row['activation_date'] ? substr($row['activation_date'], 0, 10) : $today;
    $urls[] = [
        'loc' => $baseUrl . '/job/' . $row['sid'] . '/' . $slug . '/',
        'priority' => '0.8',
        'changefreq' => 'weekly',
        'lastmod' => $lastmod,
    ];
}
$jobCount = $result->num_rows;

// --- 4. Training listings (active) ---
$result = $db->query("SELECT sid, Title, activation_date FROM listings WHERE active = 1 AND listing_type_sid = 26 ORDER BY activation_date DESC");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $slug = pretty_url($row['Title']);
        $lastmod = $row['activation_date'] ? substr($row['activation_date'], 0, 10) : $today;
        $urls[] = [
            'loc' => $baseUrl . '/training/' . $row['sid'] . '/' . $slug . '/',
            'priority' => '0.7',
            'changefreq' => 'weekly',
            'lastmod' => $lastmod,
        ];
    }
}

// --- 5. Categories ---
$result = $db->query("SELECT sid, value FROM listing_field_list WHERE field_sid = 198 ORDER BY `order`");
while ($row = $result->fetch_assoc()) {
    $slug = pretty_url($row['value']);
    $urls[] = [
        'loc' => $baseUrl . '/categories/' . $row['sid'] . '/' . $slug . '-jobs/',
        'priority' => '0.7',
        'changefreq' => 'weekly',
    ];
}
$catCount = $result->num_rows;

// --- 6. Featured companies ---
$result = $db->query("
    SELECT u.sid, u.CompanyName FROM users u
    JOIN user_groups ug ON u.user_group_sid = ug.sid
    WHERE u.active = 1 AND u.featured = 1
      AND u.CompanyName IS NOT NULL AND u.CompanyName != ''
      AND ug.id = 'Employer'
      AND u.username != 'jobg8'
    ORDER BY u.CompanyName
");
$companyCount = 0;
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $slug = pretty_url($row['CompanyName']);
        $urls[] = [
            'loc' => $baseUrl . '/company/' . $row['sid'] . '/' . $slug . '/',
            'priority' => '0.6',
            'changefreq' => 'weekly',
        ];
        $companyCount++;
    }
}

// --- 7. Blog articles ---
$result = $db->query("SELECT sid, title, date FROM blog WHERE active = 1 ORDER BY date DESC");
$blogCount = 0;
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $slug = pretty_url($row['title']);
        $lastmod = $row['date'] ? substr($row['date'], 0, 10) : $today;
        $urls[] = [
            'loc' => $baseUrl . '/blog/' . $row['sid'] . '/' . $slug . '/',
            'priority' => '0.6',
            'changefreq' => 'monthly',
            'lastmod' => $lastmod,
        ];
        $blogCount++;
    }
}

// --- Generate XML ---
$outputPath = dirname(__FILE__) . '/sitemap.xml';
$handle = fopen($outputPath, 'w');
if (!$handle) {
    die("Cannot open sitemap.xml for writing!\n");
}

fwrite($handle, '<?xml version="1.0" encoding="UTF-8"?>' . "\n");
fwrite($handle, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n");

foreach ($urls as $url) {
    $lastmod = $url['lastmod'] ?? $today;
    fwrite($handle, "  <url>\n");
    fwrite($handle, "    <loc>" . htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') . "</loc>\n");
    fwrite($handle, "    <lastmod>" . $lastmod . "</lastmod>\n");
    fwrite($handle, "    <changefreq>" . $url['changefreq'] . "</changefreq>\n");
    fwrite($handle, "    <priority>" . $url['priority'] . "</priority>\n");
    fwrite($handle, "  </url>\n");
}

fwrite($handle, '</urlset>' . "\n");
fclose($handle);

$db->close();

// --- Report ---
$size = filesize($outputPath);
echo "sitemap.xml generated successfully!\n";
echo "  Location: $outputPath\n";
echo "  Size: " . number_format($size) . " bytes\n";
echo "  Total URLs: " . count($urls) . "\n";
echo "    - Static pages: " . (count($staticPages) + 1) . "\n";
echo "    - Jobs: $jobCount\n";
echo "    - Categories: $catCount\n";
echo "    - Companies: $companyCount\n";
echo "    - Blog: $blogCount\n";
echo "  Base URL: $baseUrl\n";

// --- Helper function ---
function pretty_url($text)
{
    $text = mb_strtolower($text, 'UTF-8');
    // Transliterate accented chars
    $text = strtr($text, [
        'à' => 'a', 'â' => 'a', 'ä' => 'a', 'á' => 'a',
        'é' => 'e', 'è' => 'e', 'ê' => 'e', 'ë' => 'e',
        'ï' => 'i', 'î' => 'i', 'í' => 'i', 'ì' => 'i',
        'ô' => 'o', 'ö' => 'o', 'ó' => 'o', 'ò' => 'o',
        'ù' => 'u', 'û' => 'u', 'ü' => 'u', 'ú' => 'u',
        'ç' => 'c', 'ñ' => 'n', 'œ' => 'oe', 'æ' => 'ae',
    ]);
    $text = preg_replace('/[^\w]/u', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    return trim($text, '-');
}
