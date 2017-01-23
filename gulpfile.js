var gulp = require('gulp');

var sass = require('gulp-sass');//https://www.npmjs.com/package/gulp-sass/
var browserSync = require('browser-sync').create();//https://www.browsersync.io/docs/gulp
var plumber = require('gulp-plumber');//https://www.npmjs.com/package/gulp-plumber
var autoprefixer = require('gulp-autoprefixer');//https://www.npmjs.com/package/gulp-autoprefixer
var cleanCSS = require('gulp-clean-css');//https://github.com/scniro/gulp-clean-css
var sourcemaps = require('gulp-sourcemaps'); //https://www.npmjs.com/package/gulp-sourcemaps
var clean = require('gulp-clean');//https://www.npmjs.com/package/gulp-clean
var fs = require('fs');
var GulpSSH = require('gulp-ssh');//https://github.com/teambition/gulp-ssh

var config = {
  host: 'halflife3.beget.com',
  port: 22,
  username: 'snidimod',
  password: 'rL49VTJp'
}

var gulpSSH = new GulpSSH({
  ignoreErrors: false,
  sshConfig: config
})


gulp.task('deploy:dev', function () {
  return gulpSSH
    .shell([
    	'cd drakosha/', 
    	'git pull origin master', 
    	'composer install', 
    	'composer update', 
    	'php artisan migrate', 
    	'npm install', 
    	'npm update', 
    	'gulp sass:prodaction'
    	], {filePath: 'shell.log'})
    .pipe(gulp.dest('logs'))
})


gulp.task('sass', function () {
  return gulp.src('./resources/assets/sass/**/*.sass')
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(sass({
        indentedSyntax: true
      }).on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./public_html/css/'));
});

gulp.task('sass:clean', function () {
  return gulp.src('./public_html/css/**/*', {read: false})
    .pipe(clean());
});

gulp.task('sass:prodaction',['sass:clean'], function () {
    return gulp.src('./resources/assets/sass/**/*.sass')
        .pipe(plumber())
        .pipe(sass({
            indentedSyntax: true
        }).on('error', sass.logError))
        .pipe(autoprefixer({ browsers: ['> 1%', 'IE 7'], cascade: false }))
        .pipe(cleanCSS({keepSpecialComments : 0}))
        .pipe(gulp.dest('./public_html/css/'));
});


gulp.task('serve', ['sass'], function() {
    browserSync.init({
        proxy: 'http://dev.drakosha.ru/',
        notify: false
    });
    gulp.watch('./resources/assets/sass/**/*', ['sass']);
    gulp.watch(["./public_html/**/*", "./resources/views/**/*"]).on('change', function () {
        browserSync.reload();
    });
});

gulp.task('production', ['sass:prodaction']);