<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;

use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use App\Models\EmergencyNumber;

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
