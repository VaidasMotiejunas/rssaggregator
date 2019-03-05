<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Feeds;
use Carbon\Carbon;

class PostsController extends Controller
{   
    // TODO Add to database
    private $rssChannels = [
        'Hacker News' => [
            'channel'   =>'https://hnrss.org/frontpage',
            'cat'       => ['news', 'developement', 'it']
            ],
        'BBC' => [
            'channel'   => 'http://feeds.bbci.co.uk/news/rss.xml#',
            'cat'       => ['news']
            ],
        'Joe Rogan Podcast' => [
            'channel'   => 'http://podcasts.joerogan.net/feed',
            'cat'       => ['podcast']
            ],
        'Delfi' => [
            'channel'   => 'https://www.delfi.lt/rss/feeds/daily.xml',
            'cat'       => ['news']
            ]
    ];

    private $channelFeedCount = 5;

    /**
     * Fetches rss feed from provider array
     */
    public function index() {

        foreach ($this->rssChannels as $title => $channel) 
        {
            // rss url, feed count, force read
            $feedObj = Feeds::make($channel['channel'], 5);
            $feed = $feedObj->get_items()[0];

            $data[$title] = [
                'title'     => $title,
                'permalink' => $feed->feed->permanent_url,
                // 'items'     => $feedObj->get_items(),
                'category'  => $channel['cat'],
            ];
            foreach ($feedObj->get_items() as $key => $item) 
            {
                $data[$title]['items'][$key] = [
                    'description' => $item->get_description(),
                    'title' => $item->get_title(),
                    'link' => $item->get_permalink(),
                    'date' => $item->get_date('j F Y | g:i a'),
                ];
            }

        }

        return view('index', [
            'data' => $data
        ]);
    }
}
