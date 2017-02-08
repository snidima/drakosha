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

var imagemin = require('gulp-imagemin');
var rev = require('gulp-rev');//https://www.npmjs.com/package/gulp-rev

var gutil = require('gulp-util');
var browserify = require('browserify');
var babelify = require('babelify');
var source = require('vinyl-source-stream');
var uglify      = require('gulp-uglify');
var buffer = require('vinyl-buffer');


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




gulp.task('image:clean', function () {
	return gulp.src('./public_html/images', {read: true})
	    .pipe(clean());
});
gulp.task('image:production',['image:clean'], function () {
  return gulp.src('./resources/assets/images/**/*')
    .pipe(imagemin())
    .pipe(gulp.dest('./public_html/images'))
});

gulp.task('deploy:dev', function () {
  return gulpSSH
    .shell([
    	'cd drakosha.prod/',
    	'php artisan down',
        'git checkout master',
        'git pull origin master',
    	'composer install',
    	'php artisan migrate --force',
    	'npm install',
    	'gulp production',
    	'php artisan up',
    	], {filePath: 'shell.log'})
    .pipe(gulp.dest('logs'))
});



gulp.task('js:clean', function () {
    return gulp.src('./public_html/js', {read: false})
        .pipe(clean());
});
gulp.task('js', function () {
    return browserify({
        entries: './resources/assets/js/app.js',
        debug: true,
        paths: ['./node_modules']
    })
    .transform('babelify', {
        presets: ['es2015']
    })
    .bundle()
    .on('error', function(err){
        gutil.log(gutil.colors.red.bold('[browserify error]'));
        gutil.log(err.message);
        this.emit('end');
    })
    .pipe(source('app.js'))
    .pipe(gulp.dest('./public_html/js/'));
});

gulp.task('js:production',['js:clean'], function () {
    return browserify({
            entries: './resources/assets/js/app.js',
            debug: false,
        paths: ['./node_modules']
        })
        .transform('babelify', {
            presets: ['es2015']
        })
        .bundle()
        .on('error', function(err){
            gutil.log(gutil.colors.red.bold('[browserify error]'));
            gutil.log(err.message);
            this.emit('end');
        })
        .pipe(source('app.js'))
        .pipe(buffer())
        .pipe(uglify())
        .pipe(rev())
        .pipe(gulp.dest('./public_html/js/'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('./resources/assets/manifests/js'))
        ;
});






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
  return gulp.src('./public_html/css', {read: false})
    .pipe(clean());
});

gulp.task('sass:production',['sass:clean'], function () {
    return gulp.src('./resources/assets/sass/**/*.sass')
        .pipe(plumber())
        .pipe(sass({
            indentedSyntax: true
        }).on('error', sass.logError))
        .pipe(autoprefixer({ browsers: ['> 1%', 'IE 7'], cascade: false }))
        .pipe(cleanCSS({keepSpecialComments : 0}))
        .pipe(rev())
        .pipe(gulp.dest('./public_html/css/'))
        .pipe(rev.manifest())
        .pipe(gulp.dest('./resources/assets/manifests/css'))
        ;
});


gulp.task('serve', ['sass','js','image:production'], function() {
    browserSync.init({
        proxy: 'http://dev.drakosha.ru/',
        notify: false
    });
    gulp.watch('./resources/assets/sass/**/*', ['sass']);
    gulp.watch('./resources/assets/js/**/*', ['js']);
    gulp.watch(["./public_html/**/*", "./resources/views/**/*"]).on('change', function () {
        browserSync.reload();
    });
});

gulp.task('production', ['sass:production', 'image:production','js:production']);