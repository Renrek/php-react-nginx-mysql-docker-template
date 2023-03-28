# php-react-nginx-mysql-docker-template

## Purpose

Why make a framework when there are so may good options out there? My reason to prove to myself that I learned something, it is best to respond to a lesson by putting it into your own words to prove that you know what was taught, also cements it into the mind and provides notes for the future. Problem solving through some of the pieces also provides a memorable journey that can be reflected on and improve instincts when dealing with future problems. As I have been working through this project I have also tapped into things that I forgot that I knew. 

## Why do it from scratch when there is X available?

Truth is if I was creating a true production project I would likely use Doctrine instead of the hand crafted Model system, or Latte templates instead of the Ol'`<?= ?>`. I am doing it this way to roll up my sleeves and get into the fine details of the matter for a better understanding.

## Stack Features
- Docker
- PHP
    - Psalm
    - PHP Unit 
    - Composer
- Nginx
- Mysql
- Typescript
- Sass
- Webpack
- React
- MobX

## Critical ToDos
- Add proper error handling
- Add full Auth and Session
- Add CRSF prevention system
- Add API (RESTful)

## Future Tasks
- CLI Command tool to streamline host to container commands.
- Websocket

## Requirements
- Docker - everything runs within docker, this includes tests and static analysis.

## Setup
1. Download Repo
1. With a terminal within the project root use command `docker compose up -d`
1. Then use `./init.sh` to install both composer and npm dependencies, note that npm takes awhile.
1. Next use `./build.sh`, this fires off webpack build to generate assets
1. Lastly go to `localhost` within your browser.

If you are going to develop instead of `./build.sh`, I manually go into docker container with `docker exec -it php bash` then use `npm run watch` to view webpack's output while I develop React.ts

## Investigate
1. OPcache, psalm performance boost
