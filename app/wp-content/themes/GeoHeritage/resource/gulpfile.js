const gulp = require('gulp'),
    sass = require('gulp-sass')(require('sass')),
    cleanCSS = require('gulp-clean-css'),
    autoprefixer = require('gulp-autoprefixer'),
    concat = require('gulp-concat'),
    fileinclude = require('gulp-file-include');

// project structure
const src = 'src/',
    dist = 'dist/';

const config = {
    src: {
        style: src + 'scss/**/*.scss',
        js: src + 'js/**/*.*',
        fonts: src + 'fonts/**/*.*',
        images: src + 'images/**/*.*',
    },
    dist: {
        style: dist + 'css/',
        js: dist + 'js/',
        fonts: dist + 'fonts/',
        images: dist + 'images/',
    },
    watch: {
        style: src + 'scss/**/*.scss',
        js: src + 'js/**/*.*',
        fonts: src + 'fonts/**/*.*',
        images: src + 'images/**/*.*',
    }
};

// Tasks
const scssTask = () => {
    return gulp.src(['src/scss/main.scss'])
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({ cascade: false }))
        .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(gulp.dest(config.dist.style))
};

const jsTask = () => {
    return gulp.src(config.src.js)
        .pipe(concat('main.js'))
        .pipe(gulp.dest(config.dist.js))
};

const imagesTask = () => {
    return gulp.src(config.src.images)
        .pipe(gulp.dest(config.dist.images))
};

const fontsTask = () => {
    return gulp.src(config.src.fonts)
        .pipe(gulp.dest(config.dist.fonts))
};

// Watch
const watchFiles = () => {
    gulp.watch([config.watch.style], gulp.series(scssTask));
    gulp.watch([config.watch.js], gulp.series(jsTask));
    gulp.watch([config.watch.fonts], gulp.series(fontsTask));
    gulp.watch([config.watch.images], gulp.series(imagesTask));
};

// start
const start = gulp.series(scssTask, jsTask, fontsTask, imagesTask);

// Run parallel
exports.default = gulp.parallel(start, watchFiles);