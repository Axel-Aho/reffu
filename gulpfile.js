'use strict';

var gulp = require('gulp');
var gulpif = require('gulp-if');
var sass = require('gulp-sass');
var importonce  = require('node-sass-import-once');
var jshint = require('gulp-jshint');
var stylish = require('jshint-stylish');
var sourcemaps = require('gulp-sourcemaps');
var browserify = require('gulp-browserify');
var autoprefixer = require('gulp-autoprefixer');
var argv = require('yargs').argv;
var buffer = require('vinyl-buffer');
var uglify = require('gulp-uglify');
require('colors');

gulp.task('sass', function (done) {
    return gulp.src('assets/sass/**/*.scss').on('error', function(err) { console.log(err); done(); })
    .pipe(gulpif(!argv.production, sourcemaps.init())).on('error', console.log.bind(console))
    .pipe(sass({
        importer: importonce,
        includePaths: ['../../plugins/gwwp-grid/sass/grid'],
        outputStyle: argv.production ? 'compressed' : 'expanded'
    }, function (err) { console.log('err'); done(); }).on('error', function (err) {  console.log(err); done(); }))
    .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
    })).on('error', function(err) { console.log(err); done(); })
    .pipe(gulpif(!argv.production, sourcemaps.write())).on('error', function(err) { console.log(err); done(); })
    .pipe(gulp.dest('.')).on('error', function(err) { console.log(err); done(); });
});

gulp.task('js', function(done) {
    return gulp.src('assets/js/app.js').on('error', function(err) { console.log(err); done(); })
    .pipe(jshint({ linter: 'jshint' }))
    .pipe(jshint.reporter(stylish)).on('error', function(){})
    .pipe(browserify({
        insertGlobals : !argv.production,
        debug: !argv.production,
        paths: ['../../plugins/gwwp-mvc/libs/js', 'node_modules', '/usr/lib/node_modules']
    })).on('error', function(err) { console.error(err.message.bgRed.white); })
    .pipe(gulpif(argv.production, buffer())).on('error', function(err) { console.log(err); done(); })
    .pipe(gulpif(argv.production, uglify())).on('error', function(err) { console.log(err); done(); })
    .pipe(gulp.dest('.')).on('error', function(err) { console.log(err); done(); });
});

gulp.task('watch', function () {
    gulp.watch(['assets/sass/**/*.scss', '../../plugins/gwwp-grid/sass/grid/**/*.scss'] , ['sass']);
    gulp.watch(['assets/js/**/*.js', '../../plugins/gwwp-mvc/libs/js/**/*.js'], ['js']);
});

gulp.task('default', function() {
    return gulp.start('js', 'sass');
});