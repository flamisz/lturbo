# Steps

## Init steps
1. install Laravel
2. create mysql db
3. make:auth
4. install telescope (debug assistant)

## Task basics
1. create task model
  - `php artisan make:model Task -a`
2. TDD task basics
  - create task test
  - user can create and visit
  - guest can't create and visit
  - other user can't visit
3. Views for the basics
  - tasks index
  - tasks show
  - tasks create

## Task's time
1. time model
2. TDD basic times
  - user can start and stop
  - guest can't start and stop
  - other user can't start and stop
3. views for start/stop
4. show times for tasks (sum and 1-by-1)

## Javascript
0. clean laravel default js settings
1. add turbolinks
2. first stimulusjs
  - start and stop time with stimulus or turbolinks
  - v1: stimulus send post request, in the end delete turbolinks cache and reload page with turbolinks
  - v2: send with stimulus and reload the times table

## Update and Delete
