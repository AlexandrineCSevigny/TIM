const gulp = require('gulp');
const sass = require('gulp-sass');
const sourceMaps = require('gulp-sourcemaps');
const autoPrefixer = require('gulp-autoprefixer');
const browserSync = require("browser-sync");
const connect = require('gulp-connect-php');
const svgSprite = require('gulp-svg-sprite');


function styles(cb)
{
    return gulp.src('../../../../ressources/liaisons/scss/**/*.scss')
        .pipe(sourceMaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoPrefixer({
            // browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(sourceMaps.write())
        .pipe(gulp.dest('./css'))
        .pipe(browserSync.stream());

    cb();
}

function watch(cb)
{
    connect.server({}, function () {
        browserSync({
            proxy: "http://localhost:8888/tim/timcsf/"
        });
    });

    gulp.watch('./app/**/*.php').on("change", browserSync.reload);
    gulp.watch('../../../../ressources/vues/**/*.php').on("change", browserSync.reload);
    gulp.watch('../../../../ressources/liaisons/scss/*.scss', gulp.series('styles'));
    gulp.watch('../../../../ressources/liaisons/scss/**/*.scss', gulp.series('styles'));
    gulp.watch('../../../../ressources/liaisons/typescript/**/*.js').on("change", browserSync.reload);

    cb();
}

function defaut(cb)
{
    console.log("allo");
    // place code for your default task here
    cb();
}

var config = {
    mode: {
        // css: true, /// Create a «css» sprite
        // view: true, // Create a «view» sprite
        // defs: true, // Create a «defs» sprite
        symbol: true, // Create a «symbol» sprite
        //  stack: true // Create a «stack» sprite
    }
};

function sprite(){
    return gulp.src('../../../../ressources/liaisons/svg/*.svg')
        .pipe(svgSprite(config))
        .pipe(gulp.dest('./ressources/liaisons/images'));
}

exports.default = defaut;
exports.styles = styles;
exports.watch = watch;
exports.sprite=sprite;