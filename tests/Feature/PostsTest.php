<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    public function indexDataProvider()
    {
        return [
            'index' => [[
                'name' => 'index',
            ]]
        ];
    }
    /**
     * Index Route
     *
     * @return void
     * @dataProvider indexDataProvider
     */
    public function testIndex($data)
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs($data['name']);
    }

    public function sortDataProvider()
    {
        return [
            'cat1' => [[
                'name' => 'news',
            ]],
            'cat2' => [[
                'name' => 'podcast'
            ]]
        ];
    }

    /**
     * SortFeed Route
     *
     * @return void
     * @dataProvider sortDataProvider
     */
    public function testSortFeed($data)
    {
        $response = $this->get('/sortFeed');

        $response = $this->call('POST', '/sortFeed', [
            'category' => $data['name'],
        ]);
        $response->assertStatus(200);
    }
}
