<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\Major;

class MajorType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Major',
        'description' => 'A type',
        'model' => Major::class,
    ];

    public function fields(): array
    {
        return [
            'major_name' => [
                'type' => Type::string(),
                'description' => 'major name',
            ],
        ];
    }
}
