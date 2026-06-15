const gulp = require('gulp');
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const sass = require('gulp-sass')(require('sass'));

function compileSCSS(srcPath, destPath) {
    return gulp.src(srcPath)
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS({ level: 2 }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(destPath));
}

gulp.task('scss-main', function () {
    return compileSCSS('assets/scss/theme.scss', 'assets/css');
});

gulp.task('scss-pages', function () {
    return compileSCSS('assets/scss/page/**/*.scss', 'assets/css/page');
});

gulp.task('scss', gulp.parallel('scss-main', 'scss-pages'));

gulp.task('watch', function () {
    gulp.watch('assets/scss/**/*.scss', gulp.series('scss'));
});
