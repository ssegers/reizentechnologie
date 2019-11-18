<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;

class EmergencyNumberType extends GraphQLType
{
    protected $attributes = [
        'name' => 'EmergencyNumber',
        'description' => 'A type',
        'model' => EmergencyNumbers::class
    ];

    public function fields(): array
    {
        return [
            'number' => [
                'type' => Type::string(),
                'description' => 'emergency number'
            ],

        ];
    }
}
