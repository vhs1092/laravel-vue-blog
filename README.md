## Laravel Vue Blog
This is a blog made with Laravel for the backend to serve the api, Vue.js and Vuex for state management.

### Includes
| Use | Remark |
| --- | --- |
| Pagination support | ✓ |
| App state-preservation/restoration | ✓ |
| Search posts | ✓ |
| Passport authentication | ✓ |
| User registration | ✓ |
| Importing posts from external API | ✓ |
| User Profile | ✓ |
| Post Comments | ✓ |
| Post Likes | ✓ |
| Support split layout | ✓ |
| Responsive design | ✓ |

## Additional packages installed:

#### JavaScript
| Use | Remark |
| --- | --- |
| Vue.js | ✓ |
| Axios | ✓ |
| Vuex | ✓ |
| Bootstrap Vue | ✓ |
| Vue Persisted State | ✓ |
| Vue Moment | ✓ |
| Vee Validate | ✓ |
| Vue authenticate | ✓ |


#### CSS
| Use | Remark |
| --- | --- |
| Font Awesome | ✓ |
| Sass Compiler | ✓ |
| Boostrap | ✓ |


### Project Setup
1. clone the project.
2. copy the content of `.env.example` to `.env` and update the values
3. run `composer install`
4. run `npm install`
5. Run `php artisan migrate`
6. This project uses Laravel Passport, to generate access tokens. Run command below 
to install passport

    ```
    php artisan passport:install
    ```

7. Seed the database
    ```
    php artisan db:seed
    ```

8. Serving the app

    ```
    php artisan serve
    ```
    
9.  ```
    npm run dev
    ```
       
    or
       
    ```
    npm run watch
    ```

10. Dummy data for testing (optional)

    ```
    php artisan tinker
    factory(App\User::class, 25)->create();
    factory(App\Blog::class, 50)->create();
    ```

11. Admin Access<br>
    <b>User - </b> admin@gmail.com<br>
    <b>Password - </b> password
