<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Feeds;
use Carbon\Carbon;

class PostsController extends Controller
{   
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
        ],
        'Espn' => [
            'channel'   => 'http://www.espnfc.com/rss/feeds',
            'cat'       => ['news','sport']
        ],
        'Russell Brand Podcast' => [
            'channel'   => 'https://feeds.megaphone.fm/LM1344278906',
            'cat'       => ['podcast']
        ],
    ];

    private $channelFeedCount = 5;

    /**
     * Returns index view, passes feed from all channels
     */
    public function index() {

        return view('index', [
            'data' => $this->generateFeed(),
        ]);
    }

    /**
     * Sorts Feed by selected category
     */
    public function sortFeed()
    {
        $allFeed = $this->generateFeed();
        if(request('category') == 'none')
        {
            $sortedFeed = $allFeed;
        }
        else
        {
            $sortedFeed = [];
            foreach ($allFeed as $channel) {
                foreach ($channel['category'] as $category) {
                    if($category == request('category'))
                    {
                        $sortedFeed[$channel['title']] = $channel;
                    }
                }
            }
        }

        return response($sortedFeed, 200);

    }

    /**
     * Returns Feed from all channels
     */
    private function generateFeed()
    {
        foreach ($this->rssChannels as $title => $channel) 
        {
            // rss url, feed count, force read
            $feedObj = Feeds::make($channel['channel'], 5);
            $feed = $feedObj->get_items()[0];

            $data[$title] = [
                'title'     => $title,
                'permalink' => $feed->feed->permanent_url,
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

        // Sorts array alphabetically
        ksort($data);

        return $data;
    }
}
