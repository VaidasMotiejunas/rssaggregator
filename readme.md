# RSS reader

## About

Rss reader is a small web application with implemented aggregator system.

Functions:
- read rss feed
- filder rss feeds by channel category
- Go to rss feed directly
- Go to every feed topic


Application is built with laravel framework. <br>
Frontend: 
- javascript - vueJs
- css - bootsrap5

---

## Installation

Clone this repository
```
git clone git@github.com:VaidasMotiejunas/rssaggregator.git
```
go to project root folder
```
cd rssaggregator
```
install node dependancies
```
npm install
```
generate js and css to public folder
```
npm run dev
```

---

## Tests

To test application write to console
```
vendor/bin/phpunit
``` 

---

## TODO

Ways to enchance this app
- Update feed using cron job
- Implement validation
- Save channels and posts in database
- Choose a diferent package for getting rss feeds or do it manually (current package has awkward API)
- Fix feed description bug (previous point should fix it)
- Implement a function to limit feed count
- Improve tests by asserting view data and responses, also tests should provide bad data to test validation
- Implement Model logic
- Choose appropriate model and controller names
- Implement vuex store (for project scaling)
- Implement locale and translations

---


