<?php

namespace Tests\Drivers;

use Illuminate\Cache\ArrayStore;
use Illuminate\Cache\Repository;
use Jaspaul\LaravelRollout\Drivers\Cache;
use Tests\TestCase;

class CacheTest extends TestCase
{
    private string $prefix = 'testing';

    private Cache $cache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpCache();
    }

    public function setUpCache(): void
    {
        $this->cache = new Cache(
            new Repository(new ArrayStore()),
            $this->prefix
        );
    }

    public function test_ensure_the_cache_can_be_constructed(): void
    {
        $this->assertInstanceOf(Cache::class, $this->cache);
    }

    public function test_get_returns_null_if_the_cache_does_not_have_the_requested_key(): void
    {
        $this->assertNull($this->cache->get('key'));
    }

    public function test_once_set_you_can_get_the_value_back_with_the_same_key(): void
    {
        $key = 'key';
        $value = 'value';

        $this->cache->set($key, $value);
        $this->assertSame($value, $this->cache->get($key));
    }

    public function test_once_you_remove_a_value_you_will_not_be_able_to_retrieve_it_from_the_store(): void
    {
        $key = 'key';
        $value = 'value';

        $this->cache->set($key, $value);
        $this->assertSame($value, $this->cache->get($key));

        $this->cache->remove($key);
        $this->assertNull($this->cache->get($key));
    }
}
