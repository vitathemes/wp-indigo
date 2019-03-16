'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();
sass.compiler = require('node-sass');

// Browsersync
gulp.task('serve' , function(){
    browserSync.init({
        ui: false,
        injectChanges: true,
        proxy: "localhost",

        ws: true
    });
});

// Sass
gulp.task('sass', function () {
    return gulp.src('./assets/sass/style.scss')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('./assets/css'));
});

// Sass Watch
gulp.task('sass:watch', function () {
    gulp.watch('./assets/sass/**/*.sass', ['sass']);
});


gulp.task('watch', function () {
    browserSync.watch("*/*.php").on("change", browserSync.reload);
});
// Watch for php files



// Default Gulp Command
gulp.task('default' , ['sass' , 'serve' , 'watch' , 'sass:watch']);