# Simple Personal Laravel Blog with extra features

## The test task:

1. Set up latest Laravel. This should be done on a branch **'master'**.
1. Create the blog on its base (any from the internet that you find can be used, or you can write a basic one yourself, doesn't really matter). This should be done as a separate branch, based on master. Let's call it **'laravel_blog'**.

1. On the article edit page there should be two buttons:
    - ***'search image'***, that searches random image in Internet (you can use any API you like) by article title, and shows one without a page reload. Each time you click it - a random picture from google images should be displayed next to it.
    - ***'insert image'*** - inserts image tag with the image 'found' by first button in the beginning of the article.

    (this should be a separate branch with **'laravel_blog'** as a base, let's call it **'image_buttons'**).

So in the end there should be 3 branches: `image_buttons <- laravel_blog <- master`

Please use Laravel tools as much as possible.

Provide the result as a git repository (in github or bitbucket).

---

### To start the project run the following commands:

```
composer install
cp .env.example .env
php artisan key:generate

php artisan migrate --seed  or  php artisan migrate:refresh --seed

npm install && npm run dev
```

After that run ```php artisan serve``` and open in the browser http://localhost:8000/

For login as **Blog user** open http://localhost:8000/login and in the Login form enter:

login - *test@test.com* and password - *password*

---

P.S.: the third task uses Google Custom Search API with credentials - Search Engine ID and Google API key. The credentials specified in the config are required for the demo test.

For creation own Search Engine ID you have to go to https://cse.google.com/cse

For generation API key you have to go to https://console.developers.google.com

**Attention!** Max quota for Google Custom Search API free usage - 100 requests per 1 day
