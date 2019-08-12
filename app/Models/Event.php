<?php

namespace App\Models;

/**
 * Event model
 * @package App\Models
 */
class Event implements \JsonSerializable
{
    /** @var int */
    protected $id;

    /** @var int */
    protected $showId;

    /** @var string */
    protected $date;

    /**
     * Show constructor.
     * @param int $id
     * @param int $showId
     * @param string $date
     */
    public function __construct(int $id, int $showId, string $date)
    {
        $this->id = $id;
        $this->showId = $showId;
        $this->date = $date;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'showId' => $this->showId,
            'date' => $this->date,
        ];
    }

    /**
     * @return int
     */
    public function getShowId(): int
    {
        return $this->showId;
    }
}