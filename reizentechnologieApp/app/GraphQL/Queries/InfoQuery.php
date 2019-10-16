<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

use App\Models\Information;

class InfoQuery extends Query
{
    protected $attributes = [
        'name' => 'info',
        'description' => 'A query to retrieve information'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('info'));
    }

    public function args(): array
    {
        return [
            'info_name' => ['name' => 'info_name', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['info_name'])) {
            return Information::where('info_name', "=", $args['info_name'])->get();
        }
        return Information::all();
    }
}
