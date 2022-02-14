'use strict';
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    sourcemaps = require('gulp-sourcemaps'),
    prefix = require('gulp-autoprefixer'),
    minifycss = require('gulp-clean-css'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    rename = require("gulp-rename"),
    plumber = require('gulp-plumber'),
    gutil = require('gulp-util'),
    notify = require('gulp-notify'),
    livereload = require('gulp-livereload');

gulp.task('sass', function () {
    return gulp.src('./assets/css/style.scss')
        .pipe(plumber({
            errorHandler: function (err) {
                notify.onError({
                    title: "Gulp error in " + err.plugin,
                    message: err.toString()
                })(err);

                //gutil.beep();
            }
        }))
        .pipe(sass())
        .pipe(minifycss())
        .pipe(rename("style.min.css"))
        .pipe(gulp.dest('./assets/css'))
        .pipe(livereload());
});

var config = {
    scripts: [
        './assets/js/libs/jquery-2.2.4.min.js',
        'vendor/twbs/bootstrap/dist/js/bootstrap.js',
        './assets/js/libs/isotope.pkgd.min.js',
        './assets/js/libs/jquery.serialize-object.min.js',
        './assets/js/libs/jquery.ns-autogrow.min.js',
        './assets/js/libs/sticky-header.js',
        './assets/js/libs/sweetalert2.all.min.js',
        './assets/js/main.js'
    ]
};

gulp.task('scripts', function () {
    return gulp.src(config.scripts)
        .pipe(plumber({
            errorHandler: function (err) {
                notify.onError({
                    title: "Gulp error in " + err.plugin,
                    message: err.toString()
                })(err);

                //gutil.beep();
            }
        }))
        .pipe(concat('app.js'))
        .pipe(gulp.dest('./assets/js/'))
        .pipe(uglify())
        .pipe(rename({extname: '.min.js'}))
        .pipe(gulp.dest('./assets/js/'))
        .pipe(livereload());
});

gulp.task('watch', function () {
    livereload.listen(35729);
    gulp.watch('**/*.php').on('change', function (file) {
        livereload.changed(file.path);
    });
    gulp.watch('./assets/css/sass/**/*.scss', ['sass'])
    gulp.watch('./assets/js/main.js', ['scripts']);
});


gulp.task('default', ['watch']);