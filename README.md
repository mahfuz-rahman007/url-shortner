URL Shortener Features
1. User Guest Short URL create.
2. User Login To Manage Their Created Short URL. 
2. View How many times URl Visits
3. View Last Time URL Visits.

Setup In Your Local Environment
1. Clone the project
2. copy the .env.example, paste it and rename in .env
3. Setup the mysql database
4. Run `composer install`
5. Run `php artisan key:generate` (For generating the application key)
6. Now Run `php artisan migrate` (Database Migration)
7. Run `npm install`
8. Run `npm run dev`
9. Now start the local server with - `php artisan serve`