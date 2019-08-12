<?php
namespace App\Providers;


use App\Models\Event;
use App\Repositories\RepositoryInterface;

/**
 * Shows provider
 * @package App\Providers
 */
class EventsProvider
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
     * Return all models
     * @param int $showId
     * @return Event[]
     */
    public function getModelsByShowId(int $showId): array
    {
        /** @var Event[] $events */
        $events = $this->repository->getModels();

        $result = [];
        foreach ($events as $event) {
            if ($event->getShowId() == $showId) {
                $result[] = $event;
            }
        }

        return $result;
    }
}