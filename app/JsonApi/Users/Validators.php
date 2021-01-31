<?php

namespace App\JsonApi\Users;

use App\Models\User;
use CloudCreativity\LaravelJsonApi\Validation\AbstractValidators;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class Validators extends AbstractValidators
{
    protected $allowedPagingParameters = ['number', 'size'];

    /**
     * The include paths a client is allowed to request.
     *
     * @var string[]|null
     *      the allowed paths, an empty array for none allowed, or null to allow all paths.
     */
    protected $allowedIncludePaths = [];

    /**
     * The sort field names a client is allowed send.
     *
     * @var string[]|null
     *      the allowed fields, an empty array for none allowed, or null to allow all fields.
     */
    protected $allowedSortParameters = [
        'id',
        'name'
    ];

    /**
     * The filters a client is allowed send.
     *
     * @var string[]|null
     *      the allowed filters, an empty array for none allowed, or null to allow all.
     */
    protected $allowedFilteringParameters = [
        'name',
        'phone',
        'username',
        'email',
        'birthday'
    ];

    /**
     * Get resource validation rules.
     *
     * @param mixed|null $record
     *      the record being updated, or null if creating a resource.
     * @param array $data
     *      the data being validated
     * @return array
     */
    protected function rules($record, array $data): array
    {
        /*
         * Validate, username and email to be unique
         * $record is null for a POST request, and is the model for a PATCH.
         */
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:8'],
            'username' =>
                $record ?
                    [
                        'required',
                        Rule::unique(User::class)->ignore($record->id)
                    ]
                    :
                    [
                        'required',
                        Rule::unique(User::class)
                    ]
            ,
            'birthday' => ['required', 'date'],
            'email' =>
                $record ?
                    [
                        'required', 'string', 'email', 'max:255',
                        Rule::unique(User::class)->ignore($record->id),
                    ]
                    :
                    [
                       'required', 'string', 'email', 'max:255',
                        Rule::unique(User::class),
                    ]
            ,
            'password' => ['required', 'min:8'],
        ];
    }

    /**
     * Get query parameter validation rules.
     *
     * @return array
     */
    protected function queryRules(): array
    {
        return [
            'filter.name' => 'string|min:1',
            'filter.phone' => 'string|min:1',
            'filter.username' => 'string|min:1',
            'page.number' => 'filled|numeric|min:1',
            'page.size' => 'filled|numeric|between:1,100',
        ];
    }

}
