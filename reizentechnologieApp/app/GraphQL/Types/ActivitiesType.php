<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Activities;

class ActivitiesType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Activities',
        'description' => 'A type',
        'model' => Activities::class
    ];

    public function fields(): array
    {
        return [
            'name' => [
                'type' => Type::string(),
                'description' => 'name'
            ],
            'start_hour' => [
                'type' => Type::string(),
                'description' => 'start hour'
            ],
            'end_hour' => [
                'type' => Type::string(),
                'description' => 'end hour'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'description'
            ],
            'location' => [
                'type' => Type::string(),
                'description' => 'location'
            ],
        ];
    }
}
