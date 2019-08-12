<?php
namespace App\Providers;

use App\Models\Place;
use App\Repositories\RepositoryInterface;

/**
 * Places provider
 * @package App\Providers
 */
class PlacesProvider
{
    /** @var RepositoryInterface */
    protected $repository;

    /**
     * ShowsProvider constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return places for event
     * @param int $eventId
     * @return Place[]
     */
    public function getModelsByEventId(int $eventId): array
    {
        /** @var Place[] $places */
        $places = $this->repository->getModels();


        return $places;
    }
}