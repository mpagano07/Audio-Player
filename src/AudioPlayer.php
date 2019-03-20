<?php

require 'PlayerInterface.php';
require 'OggPlayer.php';
require 'Mp3Player.php';

class AudioPlayer
{
    /**
     * @var int
     */
    const MAX_VOLUME = 100;

    /**
     * @var array
     */
    private $registeredPlayers = [];

    /**
     * @var array
     */
    private $songs = [];

    /**
     * @var int
     */
    private $current = 0;

    /**
     * @var int
     */
    private $volume = 0;

    /**
     * @var int
     */
    private $previousVolume = 0;

    /**
     * @var string
     */
    private $status = 'stopped';

    /**
     * AudioPlayer constructor.
     */
    public function __construct(?array $songs = [])
    {
        $this->registerPlayer('mp3', Mp3Player::class);
        $this->registerPlayer('ogg', OggPlayer::class);

        if ($songs) {
            $this->songs = $songs;
        }
    }

    /**
     * @param $song
     * @return $this
     */
    public function addSong(Song $song)
    {
        $this->songs[] = $song;

        return $this;
    }

    /**
     * @return Song
     */
    public function getCurrentSong(): Song
    {
        return $this->songs[$this->current];
    }

    /**
     * @return string
     */
    public function play()
    {
        $song = $this->getCurrentSong();

        $player = new $this->registeredPlayers[$song->getExtension()];

        $this->status === 'playing';

        return $player->play();
    }

    /**
     * @param void
     * @return void
     */
    public function next()
    {
        $this->current++;

        $this->play();
    }

    /**
     * @return string
     */
    public function stop()
    {
        $this->status = 'stopped';

        return $this;
    }

    /**
     * @return string
     */
    public function isStopped()
    {
        return $this->status === 'stopped';
    }

    /**
     * @param $format
     * @param PlayerInterface $player
     * @return $this
     */
    public function registerPlayer($format, string $player)
    {
        if (class_implements($player, PlayerInterface::class)) {
            $this->registeredPlayers[$format] = $player;
        } else {
            throw new InvalidArgumentException('Cannot register a player not implementing PlayerInterface');
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function raiseVolume()
    {
        if ($this->volume < self::MAX_VOLUME) {
            $this->volume++;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function decreaseVolume()
    {
        if ($this->volume > 0) {
            $this->volume--;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function mute()
    {
        $this->previousVolume = $this->volume;

        $this->volume = 0;

        return $this;
    }

    /**
     * @return $this
     */
    public function unmute()
    {
        $this->volume = $this->previousVolume;

        return $this;
    }

    /**
     * @return int
     */
    public function getVolume()
    {
        return $this->volume;
    }
}
