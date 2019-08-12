<?php

namespace App\Models;

/**
 * Show model
 * @package App\Models
 */
class Show implements \JsonSerializable
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /**
     * Show constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}