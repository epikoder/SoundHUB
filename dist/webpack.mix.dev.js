"use strict";

var mix = require("laravel-mix");
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


mix.js("resources/js/app.js", "public/js").js("resources/js/app/upload.js", "public/js/app").js("resources/js/app/regs.js", "public/js/app").js("resources/js/app/signup.js", "public/js/app").js("resources/js/app/login.js", "public/js/app").js("resources/js/app/dashboard.js", "public/js/app").sass("resources/sass/app.scss", "public/css").sass("resources/sass/tailwind.scss", "public/css");
mix.js("resources/js/admin/dashboard", "public/js/admin").sass("resources/sass/admin.scss", "public/css");