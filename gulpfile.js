"use strict";

const gulp = require("gulp");
const {parallel, series} = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const imagemin = require("gulp-imagemin");
const concat = require("gulp-concat");
const cleanCSS = require("gulp-clean-css");
const uglify = require("gulp-uglify");
const browserSync = require("browser-sync").create();

const sassTask = () => {
  return gulp
      .src("assets/src/scss/**/*.scss")
      .pipe(sass().on("error", sass.logError))
      .pipe(gulp.dest("assets/src/css"))
      .pipe(browserSync.stream());
};

const cssConcatTask = () => {
  return gulp
      .src("assets/src/css/*.css")
      .pipe(concat("style.css"))
      .pipe(gulp.dest("assets/css"))
      .pipe(browserSync.stream());
};

const cleanCssTask = () => {
  return gulp
      .src("assets/css/*.css")
      .pipe(cleanCSS({ compatibility: "ie11" }))
      .pipe(gulp.dest("assets/css"));
};

const concatVendorJs = () => {
  return gulp
      .src(["./assets/src/js/masonry.pkgd.js", "./assets/src/js/iconify.js"])
      .pipe(concat("vendor.js"))
      .pipe(gulp.dest("assets/js"));
};

const concatJs = () => {
  return gulp
      .src("./assets/src/js/script.js")
      .pipe(concat("script.js"))
      .pipe(gulp.dest("./assets/js"));
};

const browserSyncTask = () => {
  browserSync.init({
    proxy: "wpindigo.local/",
    ui: false,
  });
  gulp.watch("./assets/src/scss/**/*.scss", series(sassTask, cssConcatTask));
  gulp.watch(
      "./assets/src/js/*.js",
      series(concatJs, concatVendorJs)
  ).on('change', browserSync.reload);
  gulp.watch("./**/*.php").on('change', browserSync.reload);
};

exports.default = parallel(
    series(sassTask, cssConcatTask),
    series(concatJs, concatVendorJs),
    browserSyncTask
);

exports.production = parallel(cleanCssTask);
