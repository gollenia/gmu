
var gulp = require('gulp');
var sass = require('gulp-sass');

var source = __dirname + '/src/';
var dest = __dirname + '/../public/';

gulp.task('sass', function () {
    return gulp.src(source + 'scss/main.scss')
        .pipe(sass({
            errLogToConsole: true,
            includePaths: [__dirname]
          }))
        .pipe(gulp.dest(dest + 'css/'));
});

gulp.task('vendor', function () {
    return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js','node_modules/popper.js/dist/popper.min.js', 'node_modules/jquery/dist/jquery.min.js' ])
           .pipe(gulp.dest(dest + 'js'));
});
