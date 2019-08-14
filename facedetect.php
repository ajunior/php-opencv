<?php

use CV\CascadeClassifier, CV\Scalar;
use function CV\{imread, imwrite, cvtColor, equalizeHist, rectangleByRect};
use const CV\{COLOR_BGR2GRAY};

// Setando o classificador
$faceClassifier = new CascadeClassifier();
$faceClassifier->load('models/lbpcascades/lbpcascade_frontalface.xml');
//$faceRecognizer = LBPHFaceRecognizer::create();

// Carregando a imagem
$src = imread("images/mulher.jpg");

// Transformando a imagem para escala de cinza
$gray = cvtColor($src, COLOR_BGR2GRAY);
$faceClassifier->detectMultiScale($gray, $faces);

// Desenhando o quadrado que define o rosto na imagem
if ($faces) {
    $scalar = new Scalar(0, 0, 255); //blue
    foreach ($faces as $face) {
        rectangleByRect($src, $face, $scalar, 3);
    }
}

// Salva a nova imagem
imwrite("results/img_rosto_definido.jpg", $src);