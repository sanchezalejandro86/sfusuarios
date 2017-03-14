var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var flatten = require('gulp-flatten');
var minifyCss = require('gulp-minify-css');
var concatCss = require('gulp-concat-css');

var jsPath = './web/js';
var cssPath = './web/css';
var fontsPath = './web/fonts';
var imgsPath = './web/img';

gulp.task('sass', function() {
	gulp.src([
		'app/Resources/public/sass/*.scss'
	])
	.pipe(sass().on('error', sass.logError))
	.pipe(concatCss('./build/all.css'))
	.pipe(minifyCss())
	.pipe(flatten())
	.pipe(gulp.dest(cssPath))
	;
});

gulp.task('js', function() {
	gulp.src([
		'node_modules/jquery/dist/jquery.js',
		'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
		])
		.pipe(concat('./build/all.js'))
		.pipe(uglify())
		.pipe(flatten())
		.pipe(gulp.dest(jsPath))
		;
});

gulp.task('fonts', function() {
	gulp.src([
		'node_modules/bootstrap-sass/assets/fonts/bootstrap/*.{eot,svg,ttf,woff,woff2}',
		'node_modules/font-awesome/fonts/*.{eot,svg,ttf,woff,woff2}'
		])
		.pipe(flatten())
		.pipe(gulp.dest(fontsPath))
		;
});

gulp.task('img', function() {
	gulp.src([
		'app/Resources/public/img/*.*'
		])
		.pipe(flatten())
		.pipe(gulp.dest(imgsPath))
		;
});

gulp.task('default', ['sass', 'js', 'fonts', 'img']);
