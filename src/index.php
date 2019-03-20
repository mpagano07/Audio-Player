<?php 

require 'AudioPlayer.php';
require 'WavPlayer.php';
require 'Song.php';
require 'AviPlayer.php';

// Inicio el reproductor de audio
$player = new AudioPlayer;

// Registro un nuevo tipo de reproductor para wav
try {
    $player->registerPlayer('wav', WavPlayer::class);

    // Descomentar la siguiente linea para ver el error
    // $player->registerPlayer('avi', AviPlayer::class);
} catch (Exception $e) {
    die($e->getMessage());
}

// Agrego canciones a la lista de reproduccion
$player->addSong(new Song('first-song.mp3'));
$player->addSong(new Song('second-song.wav'));
$player->addSong(new Song('third-song.ogg'));
$player->addSong(new Song('ebook.pdf'));

// Obtengo el volumen actual
echo 'El volumen esta en: ' . $player->getVolume();
echo "\n";

if (0 === $player->getVolume()) {
    $player->raiseVolume();
    $player->raiseVolume();
    $player->raiseVolume();
    $player->raiseVolume();
    $player->raiseVolume();
    $player->raiseVolume();
}

echo 'El volumen esta en: ' . $player->getVolume();
echo "\n";

$player->mute();

echo 'El volumen esta en: ' . $player->getVolume();
echo "\n";

$player->unmute();

echo 'El volumen esta en: ' . $player->getVolume();
echo "\n";

// Ordeno que inicie la reproduccion
$player->play();
echo 'Reproduciendo: ' . $player->getCurrentSong()->getTitle();
echo "\n";

// Avanzo a la proxima cancion
$player->next();

echo 'Reproduciendo: ' . $player->getCurrentSong()->getTitle();
echo "\n";

// Avanzo a la proxima cancion
$player->next();

echo 'Reproduciendo: ' . $player->getCurrentSong()->getTitle();
echo "\n";

// Avanzo a la proxima cancion
//$player->next();

echo 'Reproduciendo: ' . $player->getCurrentSong()->getTitle();
echo "\n";

$player->stop();

if ($player->isStopped()) {
    echo 'La reproduccion se ha detenido.';
}
