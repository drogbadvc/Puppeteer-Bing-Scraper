<?php
require 'vendor/autoload.php';

use Symfony\Component\DomCrawler\Crawler;

$dirname = 'assets/ranks/bing/html';
$dir = scandir($dirname);
$list_files = [];
$date_chart = [];
foreach ($dir as $file) {
    if ($file != '.' && $file != '..' && !is_dir($dirname . $file)) {
        $list_files[] = $file;
    }
}
foreach ($list_files as $list_bing) {
    $date_bing = str_replace('.html', '', $list_bing);
    $date_chart[] = $date_bing;
}

$date = isset($_POST['date']) ? $_POST['date'] : end($date_chart);

$result = [];
$string_html = file_get_contents($dirname . DIRECTORY_SEPARATOR . $date . '.html');
$crawler = new Crawler($string_html);
$nodeValues = $crawler->filter('#b_results > li > h2 > a')->each(function (Crawler $node) {
    $link = $node->link();
    return $link->getUri();
});
$urls = $nodeValues;
$result[$date] = $urls;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://bootswatch.com/3/paper/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title></title>
</head>
<div class="content-page" style="margin-top: 35px">
    <div class="container">
        <div class="card">
            <div class="row page-title" style="padding-left: 15px">
                <div class="col-sm-4 col-xl-6">
                    <h4 class="mb-1 mt-0">Bing Search Scraper</h4>
                </div>
            </div>
        </div>
        <form action="" method="POST">
            <select class="form-control form-control" name="date" onchange="this.form.submit()">
                <?php foreach (array_unique($date_chart) as $dateJs) {
                    if ($dateJs == $date) {
                        echo "<option selected>$dateJs</option>";
                    } else {
                        echo "<option value='$dateJs'>$dateJs</option>";
                    }

                } ?>
            </select>
        </form>
        <p class="row"></p>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="row page-title" style="padding-left: 15px">
                        <div class="col-sm-4 col-xl-6">

                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="active">
                            <a id="text-tab" href="#text" role="tab" aria-controls="text" data-toggle="tab"><h4
                                        class="mb-1 mt-0">Text</h4></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="visual-tab" data-toggle="tab" href="#visual" role="tab"
                               aria-controls="visual" aria-selected="false"><h4 class="mb-1 mt-0">visual</h4></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="text">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">URL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($result[$date] as $key => $r) {
                                    $rank = $key + 1;
                                    $url = $r;
                                    $domain = parse_url($url, PHP_URL_HOST);
                                    $parse_domain = explode('.', $domain);
                                    $nb_element = count($parse_domain);
                                    echo "<tr><td>$rank</td>
          <td><img src='https://s2.googleusercontent.com/s2/favicons?domain=$domain'> $url</a></td></tr>";
                                } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="visual" role="tabpanel">
                            <img src="assets/ranks/bing/<?= $date . '.png' ?>" class="img-fluid"
                                 style="max-width:inherit;width: 1150px">
                        </div>
                    </div>