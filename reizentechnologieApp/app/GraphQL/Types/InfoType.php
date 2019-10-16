<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Information;

class InfoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Info',
        'description' => 'A type',
        'model' => Information::class
    ];

    public function fields(): array
    {
        return [
            'info_name' => [
                'type' => Type::string(),
                'description' => 'info name',
            ],
            'info_value' => [
                'type' => Type::string(),
                'description' => 'info content',
            ],
        ];
    }
}
