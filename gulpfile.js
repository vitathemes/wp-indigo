'use strict';

var gulp = require('gulp');  // Gulp Core
var sass = require('gulp-sass');  // Sass Plugin for Gulp
var browserSync = require('browser-sync').create();  // BrowserSyc for Reload and Inject
sass.compiler = require('node-sass'); // Sass Compiler Work with gul-sass

// Browsersync
gulp.task('serve' , function(){
    browserSync.init({
        ui: false,  // Disable UI of BrowserSync
        injectChanges: true,  // Allow to inject style changes to browser without reloading page
        proxy: "wp-indigo",  // Where is your Project? changes proxy to your project url
    });
});

// Sass - Sass Files Compile Here
gulp.task('sass', function () {
    return gulp.src('./assets/sass/*.sass')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./assets/css'))
        .pipe(browserSync.stream());
});

// Watch task for php files - it will reload Browser if you change any php files
gulp.task('watch', function () {
    gulp.watch('./assets/sass/**/*.sass', gulp.series('sass'));
    browserSync.watch("*/*.php").on("change", browserSync.reload); // Watch for one level deep directories files
    browserSync.watch("*.php").on("change", browserSync.reload);  // Watch for root directory files
});

// Default Gulp Command
gulp.task('default' , gulp.parallel( 'sass' , 'serve' , 'watch'));