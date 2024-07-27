const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cssnano = require('gulp-cssnano');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');

/**
 * Função genérica para compilar SCSS
 * 
 * @param {string} srcPath Caminho de Origem (SCSS)
 * @param {string} destPath Caminho de Destino (CSS)
 * @returns {void}
 */
function compileSCSS(srcPath, destPath) {
    return gulp.src(srcPath)                             // Caminho do seu arquivo SCSS
            .pipe(sourcemaps.init())                     // Inicializa sourcemaps
            .pipe(sass().on('error', sass.logError))     // Compila SCSS para CSS
            .pipe(cssnano())                             // Minifica o CSS
            .pipe(rename({suffix: '.min'}))              // Renomeia para .min.css
            .pipe(sourcemaps.write('.'))                 // Escreve sourcemaps
            .pipe(gulp.dest(destPath));                  // Define a pasta de destino do CSS compilado
}

// Tarefa para compilar o SCSS principal
gulp.task('scss-main', function () {
    return compileSCSS('assets/scss/theme.scss', 'assets/css');
});

// Tarefa para compilar os SCSS de páginas individuais
gulp.task('scss-pages', function () {
    return compileSCSS('assets/scss/page/**/*.scss', 'assets/css/page');
});

/**
 * Main Task 1: Tarefa única para executar ambas as compilações
 */
gulp.task('scss', gulp.parallel('scss-main', 'scss-pages'));

/**
 * Main Task 2: Tarefa de observação para monitorar alterações nos arquivos SCSS
 */
gulp.task('watch', function () {
    gulp.watch('assets/scss/**/*.scss', gulp.series('scss'));
});