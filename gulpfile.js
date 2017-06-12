var gulp = require('gulp'),
	sass = require('gulp-sass'),
	browserSync = require('browser-sync'),
	autoprefixer = require('gulp-autoprefixer');


gulp.task('sass', function () {
	return gulp.src(['sass/**/*.sass', 'sass/**/*.scss'])
	.pipe(sass({outputStyle: 'expanded'}).on('error', sass.logError)) //pipe - вызов плагина(функции), обработка
	.pipe(autoprefixer('last 16 version'))
	.pipe(gulp.dest('css/')) //путь выгрузки обработаного кода
	.pipe(browserSync.reload({stream: true}))
	
});

// gulp.task('autoprefixer', function() {
// 	return gulp.src(['sass/**/*.sass', 'sass/**/*.scss'])
// 	.pipe(autoprefixer({
// 		browsers: ['last 16 versions'],
// 		cascade: false
// 	}))
// 	.pipe(gulp.dest('app/css'))
// });

// gulp.task('browser-sync', function () {
// 	browserSync({
// 		server: {
// 			baseDir: 'app'
// 			},
// 			notify: false,
// 			port: 8080,
// 			//browser: ["google chrome", "safari"],
// 			//open: false
// 			open: 'local'
// 		});
// });

gulp.task('watch', ['sass'], function () {
	gulp.watch(['sass/**/*.sass', 'sass/**/*.scss'], ['sass']);
});