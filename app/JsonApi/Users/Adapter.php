<?php

namespace App\JsonApi\Users;

use App\Models\User;
use CloudCreativity\LaravelJsonApi\Eloquent\AbstractAdapter;
use CloudCreativity\LaravelJsonApi\Pagination\StandardStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Adapter extends AbstractAdapter
{

    /**
     * @var array
     */
    protected $dates = [
        'birthday',
    ];

    /**
     * @var array
     */
    protected $defaultPagination = [
        //'number' => 1,
    ];

    /**
     * Mapping of JSON API attribute field names to model keys.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Mapping of JSON API filter names to model scopes.
     *
     * @var array
     */
    protected $filterScopes = [];

    /**
     * Adapter constructor.
     *
     * @param StandardStrategy $paging
     */
    public function __construct(StandardStrategy $paging)
    {
        parent::__construct(new User(), $paging);
    }

    /**
     * @param Builder $query
     * @param Collection $filters
     * @return void
     */
    protected function filter($query, Collection $filters)
    {
        // $this->filterWithScopes($query, $filters);

        if ($name = $filters->get('name')) {
            $query->where('users.name', 'like', "%{$name}%");
        }

        if ($username = $filters->get('username')) {
            $query->where('users.username', 'like', "%{$username}%");
        }

        if ($email = $filters->get('email')) {
            $query->where('users.email', 'like', "%{$email}%");
        }

        if ($phone = $filters->get('phone')) {
            $query->where('users.phone', 'like', "%{$phone}%");
        }
    }

}
