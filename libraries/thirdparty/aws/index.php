<?php
require "aws-autoloader.php";
require "vendor/autoload.php";
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use League\Flysystem\Filesystem;

$client = S3Client::factory(array(
    'key'    => 'AKIAI5WLL3RP2WRPUVBQ',
    'secret' => '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',
    'region' => 'us-east-1'
));

$adapter = new AwsS3Adapter($client, 'b2b-dev/hello');
$filesystem = new Filesystem($adapter);
$filesystem->write('filename.txt', 'contents');

/*$contents = $filesystem->listContents();

foreach ($contents as $object) {
    echo $object['basename'].' is located at'.$object['path'].' and is a '.$object['type'];
}
   */


?>