var gulp = require('gulp');
var elixir = require('laravel-elixir');
var shell = require('gulp-shell');
var minify = require('gulp-minify-css');
var browserSync = require('laravel-elixir-browsersync-official');
var concat = require('gulp-concat');
var elixirTypscript = require('elixir-typescript');
var typescript = require('gulp-typescript');
var merge = require('merge2');  // Requires separate installation

var bowerDir = './bower_components/';
var sassDir =  './resources/assets/sass/';
var jsDir =  './resources/assets/js/';
var adminThemeDir = './resources/assets/admin_theme/';
var webThemeDir = './resources/assets/web_theme/';

//Assets Path
 var paths = {
     'jquery'     : bowerDir + "jquery/dist/",
     'bootstrap'  : bowerDir + "bootstrap/dist/",
     'fonts': bowerDir + "bootstrap/fonts/",
     'adminthemecss' : adminThemeDir + "css/",
     'adminAssets' : adminThemeDir + "assets/",
     'adminLess' : adminThemeDir + "assets/less/"
 };

/*
 * Mix the assets
 */

elixir(function(mix) {

    // admin module
    //sass for all
    mix.sass([sassDir + 'admin.scss'], 'public/assets/css/admin.css');
    //for web
    mix.sass([sassDir + 'web.scss'], 'public/assets/css/web.css');

    //Add all javascripts into a js file
    mix.scripts([jsDir + 'admin.js' ],'public/assets/js/admin.min.js');


    /*mix.copy('node_modules/@angular', 'public/angular/@angular')
        .copy('node_modules/anular2-in-memory-web-api', 'public/angular/anular2-in-memory-web-api')
        .copy('node_modules/core-js', 'public/angular/core-js')
        .copy('node_modules/reflect-metadata', 'public/angular/reflect-metadata')
        .copy('node_modules/systemjs', 'public/angular/systemjs')
        .copy('node_modules/rxjs', 'public/angular/rxjs')
        .copy('node_modules/zone.js', 'public/angular/zone.js');*/

    mix.typescript(
            [
                'app.component.ts',
                'app.module.ts',
                'main.ts'
            ],
            'public/app',
            {
                "target": "es5",
                "module": "system",
                "moduleResolution": "node",
                "sourceMap": true,
                "emitDecoratorMetadata": true,
                "experimentalDecorators": true,
                "removeComments": false,
                "noImplicitAny": false
            }
        );

    // versions for cache-busting
    /*mix.version([
        'assets/build/js/app.js',
        'assets/build/css/app.css',
        'assets/build/js/admin.js',
        'assets/build/css/admin.css'
    ]);*/

    mix.browserSync({
        notify: false,
        proxy: 'haber-new.com'
    });

});


/**
 * Copy any needed files.
 */
gulp.task('copyfiles', function() {

     // admin panel + plugins
     gulp.src(adminThemeDir + 'assets/img/**')
        .pipe(gulp.dest('public/assets/images/admin/'));


     // admin panel + plugins
     gulp.src(webThemeDir + 'images/**')
        .pipe(gulp.dest('public/assets/images/web/'));

     //font awesome
     gulp.src(bowerDir + 'bootstrap/dist/fonts/*' + '!**')
        .pipe(gulp.dest('public/assets/fonts'));

 });


/**
 * Copy Admin CSS files.
 */
gulp.task('copycss', function() {

    //make all theme css files into  a single file
    // admin panel + plugins
    gulp.src(adminThemeDir + 'assets/css/working/**/*')
        .pipe(gulp.dest('public/assets/css/admin-theme/'));

    //admin fonts which are depend on css
    gulp.src(adminThemeDir + 'assets/css/fonts/**/*')
        .pipe(gulp.dest('public/assets/fonts/'));


    //make all theme css files
    // admin panel + plugins
    gulp.src(webThemeDir + 'css/**/*')
        .pipe(gulp.dest('public/assets/css/web-theme/'));

    //admin fonts which are depend on css
    gulp.src(webThemeDir + 'fonts/**/*')
        .pipe(gulp.dest('public/assets/fonts/'));


});

/**
 * Copy Admin JS files.
 */
gulp.task('copyjs', function() {

    //make all theme css files into  a single file
    // admin panel + plugins
    gulp.src(adminThemeDir + 'assets/js/working/**/*')
        .pipe(gulp.dest('public/assets/js/admin-theme/'));

    //make all theme css files into  a single file
    // admin panel + plugins
    gulp.src(webThemeDir + 'js/**/*')
        .pipe(gulp.dest('public/assets/js/web-theme/'));

});













