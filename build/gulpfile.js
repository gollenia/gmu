
var gulp = require('gulp');
var watch = require('gulp');
var sass = require('gulp-sass');
var uglify = require('gulp-clean-css');

var source = __dirname + '/src/';
var dest = __dirname + '/../public/';

gulp.task('css', function () {
    return gulp.src(source + 'scss/main.scss')
        .pipe(sass({
            errLogToConsole: true,
            includePaths: [__dirname]
          }))
        .pipe(gulp.dest(dest + 'css/'));
});

gulp.task('production', function () {
  return gulp.src(source + 'scss/main.scss')
      .pipe(sass({
          errLogToConsole: true,
          includePaths: [__dirname]
        }))
      .pipe(cleanCSS({debug: true}, (details) => {
          console.log(`${details.name}: ${details.stats.originalSize}`);
          console.log(`${details.name}: ${details.stats.minifiedSize}`);
      }))
      .pipe(gulp.dest(dest + 'css/'));
});

gulp.task('vendor', function () {
    return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js','node_modules/popper.js/dist/popper.min.js', 'node_modules/jquery/dist/jquery.min.js' ])
           .pipe(gulp.dest(dest + 'js'));
});


