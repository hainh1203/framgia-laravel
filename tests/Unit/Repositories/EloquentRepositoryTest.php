<?php

namespace Tests\Unit\Providers;

use Tests\TestCase;
use App\Repositories\EloquentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Mockery as m;

class EloquentRepositoryTest extends TestCase
{
    protected function makeRepository($model)
    {
        return $this->getMockForAbstractClass(EloquentRepository::class, [$model]);
    }

    protected function mockModel()
    {
        return m::mock(Model::class);
    }

    public function test_find_function()
    {
        $model = $this->mockModel();
        $model
            ->shouldReceive('find')
            ->with(1, ['*'])
            ->andReturn($model);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(Model::class, $repository->find(1));
    }

    public function test_all_function()
    {
        $model = $this->mockModel();
        $model
            ->shouldReceive('orderBy->get')
            ->andReturn(new Collection);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(Collection::class, $repository->all());
    }

    public function test_all_with_builder_function()
    {
        $model = $this->mockModel();
        $builder = m::mock(Builder::class);
        $model
            ->shouldReceive('newQuery')
            ->andReturn($builder);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(Builder::class, $repository->allWithBuilder());
    }

    public function test_paginate_function()
    {
        $model = $this->mockModel();
        $paginator = new LengthAwarePaginator([], 0, 15);
        $model
            ->shouldReceive('orderBy->paginate')
            ->andReturn($paginator);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(LengthAwarePaginatorContract::class, $repository->paginate());
    }

    public function test_create_function()
    {
        $model = $this->mockModel();
        $model
            ->shouldReceive('create')
            ->andReturn($model);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(Model::class, $repository->create([]));
    }

    public function test_update_function()
    {
        $model = $this->mockModel();
        $model
            ->shouldReceive('update')
            ->with([], [])
            ->andReturn($model);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(Model::class, $repository->update($model, []));
    }

    public function test_destroy_function()
    {
        $model = $this->mockModel();
        $model
            ->shouldReceive('delete')
            ->andReturn(true);
        $repository = $this->makeRepository($model);
        $this->assertTrue($repository->destroy($model));
    }

    public function test_find_by_attributes_function()
    {
        $model = $this->mockModel();
        $model
            ->shouldReceive('where->first')
            ->andReturn($model);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(Model::class, $repository->findByAttributes([]));
    }

    public function test_get_by_attributes_function()
    {
        $model = $this->mockModel();
        $builder = m::mock(Builder::class);
        $builder
            ->shouldReceive('where->get')
            ->andReturn(new Collection);
        $builder
            ->shouldReceive('orderBy')
            ->with('id', 'asc')
            ->andReturn($builder);
        $model
            ->shouldReceive('newQuery')
            ->andReturn($builder);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(Collection::class, $repository->getByAttributes([]));
        $this->assertInstanceOf(Collection::class, $repository->getByAttributes([], 'id'));
    }

    public function test_find_many()
    {
        $model = $this->mockModel();
        $model
            ->shouldReceive('findMany')
            ->with([], ['*'])
            ->andReturn(new Collection);
        $repository = $this->makeRepository($model);
        $this->assertInstanceOf(Collection::class, $repository->findMany([]));
    }
}
