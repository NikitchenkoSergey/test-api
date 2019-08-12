<?php

namespace App\Models;

/**
 * Place model
 * @package App\Models
 */
class Place implements \JsonSerializable
{
    /** @var int */
    protected $id;

    /** @var float */
    protected $x;

    /** @var float */
    protected $y;

    /** @var float */
    protected $width;

    /** @var float */
    protected $height;

    /** @var bool */
    protected $isAvailable;

    /**
     * Place constructor.
     * @param int $id
     * @param float $x
     * @param float $y
     * @param float $width
     * @param float $height
     * @param bool $isAvailable
     */
    public function __construct(int $id, float $x, float $y, float $width, float $height, bool $isAvailable)
    {
        $this->id = $id;
        $this->y = $y;
        $this->x = $x;
        $this->width = $width;
        $this->height = $height;
        $this->isAvailable = $isAvailable;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'x' => $this->x,
            'y' => $this->y,
            'width' => $this->width,
            'height' => $this->height,
            'is_available' => $this->isAvailable,
        ];
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }
}