<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\DayPlanning;

class DayPlanningType extends GraphQLType
{
    protected $attributes = [
        'name' => 'DayPlanning',
        'description' => 'A type',
        'model' => DayPlanning::class
    ];

    public function fields(): array
    {
        return [
            'date' => [
                'type' => Type::string(),
                'description' => 'date'
            ],
            'highlight' => [
                'type' => Type::string(),
                'description' => 'highlight'
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
