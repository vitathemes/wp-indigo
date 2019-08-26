'use strict';

var gulp = require('gulp');  // Gulp Core
var sass = require('gulp-sass');  // Sass Plugin for Gulp
var browserSync = require('browser-sync').create();  // BrowserSyc for Reload and Inject
sass.compiler = require('node-sass'); // Sass Compiler Work with gul-sass
var rtlcss = require('gulp-rtlcss');  // RTLCss Create rtl.css file for theme

// Browsersync
gulp.task('serve' , function(){
    browserSync.init({
        ui: false,  // Disable UI of BrowserSync
        injectChanges: true,  // Allow to inject style changes to browser without reloading page
        proxy: "free-themes.local",  // Where is your Project? changes proxy to your project url
    });
});

// Sass - Sass Files Compile Here
gulp.task('sass', function () {
    return gulp.src('./assets/sass/*.sass')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./assets/css'))
        .pipe(browserSync.stream())
        .pipe(browserSync.stream({match: '**/*.css'}));
});

// Sass Watch - This task wait and watch for any changes in sass files and when watch a change run Sass Compiler task
gulp.task('sass:watch', function () {
    gulp.watch('./assets/sass/**/*.sass', ['sass']);
});

// Watch task for php files - it will reload Browser if you change any php files
gulp.task('watch', function () {
    browserSync.watch("*/*.php").on("change", browserSync.reload); // Watch for one level deep directories files
    browserSync.watch("*.php").on("change", browserSync.reload);  // Watch for root directory files
});

// Default Gulp Command
gulp.task('default' , gulp.series( 'sass' , 'serve' , 'watch' , 'sass:watch'));