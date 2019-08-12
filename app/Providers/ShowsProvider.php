<?php
namespace App\Providers;


use App\Models\Show;
use App\Repositories\RepositoryInterface;

/**
 * Shows provider
 * @package App\Providers
 */
class ShowsProvider
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
     * @return Show[]
     */
    public function getAllModels(): array
    {
        return $this->repository->getModels();
    }
}