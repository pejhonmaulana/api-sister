<?php

include '../vendor/autoload.php';

echo "<pre>";
print_r( $_POST );
die;

use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => 'http://127.0.0.1:8000',
    'timeout' => 5
]);

$response =  $client->request('POST', '/api/tambah-kost', [
    'json' => [
        'nama_kost' => $_POST['nama_kost'],
        'jumlah_kamar' => $_POST['jumlah_kamar'],
        'kamar_kosong' => $_POST['kamar_kosong'],
        'jenis_kost' => $_POST['jenis_kost'],
        'fasilitas' => $_POST['fasilitas'],
        'harga' => $_POST['harga'],
        'gambar1'=> $_POST['gambar1']
        ]
    ]);
    var_dump($response);
    die();

$body = $response->getBody();
header('location:../kost.php');
