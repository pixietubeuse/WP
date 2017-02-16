// Requis appel le plugin gulp
var gulp = require('gulp');

// Include plugins
var plugins = require('gulp-load-plugins')(); // appel tous les plugins du package.json

// Variables de chemins
var source = './sources'; // dossier de travail
var destination = '.'; // dossier à livrer

// Tâche pour créer la feuille de style minifiée
gulp.task('css', function () {
    return gulp.src(source + '/css/style.scss')
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sass().on('error', plugins.sass.logError))
        .pipe(plugins.autoprefixer())
        .pipe(plugins.csso())
        .pipe(plugins.sourcemaps.write('.map'))
        .pipe(gulp.dest(destination));
});

// Tâche pour créer js minifié
gulp.task('js', function() {
    return gulp.src(source + '/js/*.js')
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.uglify())
        .pipe(plugins.concat('application-global.js'))
        .pipe(plugins.sourcemaps.write('.map'))
        .pipe(gulp.dest(destination + '/js'));
});

// Tâche "img" = Images optimisées
gulp.task('img', function () {
    return gulp.src(source + '/images/*')
        .pipe(plugins.imagemin())
        .pipe(gulp.dest(destination + '/images'));
});

gulp.task('default', ['css', 'js', 'img']);

gulp.task('watch',function(){
    gulp.watch([source + '/css/**/*.scss', source + '/js/**/*.js', source + '/images/**/*'], ['default']);
});