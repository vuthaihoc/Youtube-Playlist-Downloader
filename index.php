<?php

error_reporting(0);
set_time_limit(0);

/**
 * required binaries and php functions:
 * - youtube-dl
 * - zip
 * - tree
 * - php - file_get_contents function
 * - php - system function
 */

if (!isset($_REQUEST["q"])) {
    echo "If you want to download by mp3 format you can add this parameter: ?q=RDXdrWZKqfh8E\n<br />";
    echo "If you want to download mp4 videos you can use this: ?q=RDXdrWZKqfh8E&v=true\n<br />";
    echo "for instance: http://example.com/?q=playlist_id\n<br />";
    exit;
}

$youUrl = "https://www.youtube.com/feeds/videos.xml?playlist_id=%s";
$q = strip_tags(trim($_REQUEST["q"]));

if (empty($q)) {
    die("Playist ID required!");
}

// download playlist rss data
$youtubeUrl = sprintf($youUrl, $q);
$rssContent = file_get_contents($youtubeUrl);
if (!$rssContent) {
    die("GData RSS content is not valid! try to open manual! <a target='_blank' href='{$youtubeUrl}'>Click here</a>");
}

$folder = uniqid();
mkdir($folder, 0777);
chdir($folder);

$type = (isset($_REQUEST["v"])) ? "video" : "mp3";
$cmd = "nohup ../{$type}.sh {$youtubeUrl} &";
$cmd = escapeshellcmd($cmd);
exec($cmd);

$filesFolder = dirname(__FILE__) . "/" . $folder;

// create zip files
$commandZip = "nohup zip -rj {$filesFolder}/{$folder}.zip {$filesFolder}/ &";
$commandZip = escapeshellcmd($commandZip);
exec($commandZip);

$files = scandir($filesFolder);

if (!is_array($files)) {
    die("Process have just finished, file not found!");
}

//create visual dirlist
foreach ($files as $file) {
    if ($file == '.' || $file == '..') {
        continue;
    }
    $newFileName = sanitize($file, true);
    rename($filesFolder . "/" . $file, $filesFolder . "/" . $newFileName);
    $list[] = "<li><a target='_blank' href='{$folder}/{$newFileName}'>{$newFileName}</a></li>";
}

echo "<ul>";
echo implode("\n", $list);
echo "</ul>";
echo "<hr>";

chdir(dirname(__FILE__));
echo "<pre>";
$output = system("tree");
$output = str_replace(array("|-- index.php", "|-- mp3.sh", "`-- video.sh"), "", $output);
echo $output;
echo "</pre>";


/**
 * Convert a string to the file/URL safe "slug" form
 *
 * @param string $string the string to clean
 * @param bool $is_filename TRUE will allow additional filename characters
 * @return string
 */
function sanitize($string = '', $is_filename = FALSE)
{
    // Replace all weird characters with dashes
    $string = preg_replace('/[^\w\-' . ($is_filename ? '~_\.' : '') . ']+/u', '-', $string);

    // Only allow one dash separator at a time (and make string lowercase)
    return mb_strtolower(preg_replace('/--+/u', '-', $string), 'UTF-8');
}