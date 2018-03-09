'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var cleanCSS = require('gulp-clean-css');



gulp.task('sass', function () {
 return gulp.src('./css/src/main.scss')
   .pipe(sass().on('error', sass.logError))
   .pipe(cleanCSS())
   .pipe(gulp.dest('./css/dist'));
});

gulp.task('sass:watch', function () {
 gulp.watch('./css/src/main.scss', ['sass']);
});

gulp.task('js', function () {
    return gulp.src(["node_modules/jquery/dist/jquery.min.js","node_modules/bootstrap/js/dist/util.js",
    "node_modules/popper.js/dist/umd/popper.js",
    "node_modules/bootstrap/js/dist/tooltip.js",
    "node_modules/bootstrap/js/dist/popover.js",
    "node_modules/bootstrap/js/dist/modal.js",
    "js/src/main.js"])
      .pipe(concat('main.min.js'))
      .pipe(uglify())
      .pipe(gulp.dest('./js/dist'));
   });




   