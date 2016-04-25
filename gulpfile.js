var gulp =  require('gulp');
var inject = require('gulp-inject');
var bowerFiles = require('main-bower-files');
var series = require('stream-series');
var shell = require('gulp-shell');
var connect = require('gulp-connect-php');
var browserSync = require('browser-sync');
var BUNDLE_PUBLIC_ASSETS= './src/AppBundle/Resources/public';

/**Inject JS dependencies to index**/
gulp.task('index', function(){
  var target = gulp.src('./src/AppBundle/Resources/views/Default/index.html.twig');
  var bowerStream = gulp.src(bowerFiles(), {base: BUNDLE_PUBLIC_ASSETS + '/lib'});
  var appStream = gulp.src([BUNDLE_PUBLIC_ASSETS + '/js/*.js', BUNDLE_PUBLIC_ASSETS + '/js/*/*.js', BUNDLE_PUBLIC_ASSETS + '/js/*/*/*.js' ], {read: false});

  return target
    .pipe(inject(series(bowerStream, appStream), {
      addRootSlash: false,
      transform: transformFilePath
  }))
    .pipe(gulp.dest('./src/AppBundle/Resources/views/Default/'));
});


/**Copy Bundles Assets to web folder**/
gulp.task('installAssets', shell.task([
 'php app/console assets:install'
]));

gulp.task('connect', function() {
   //connect.server({base: './web', router: './src/AppBundle/Resources/views/Default/index.html.twig'}, function(){
     console.log('Creando servidor browserSync');
     browserSync({
      proxy: '127.0.0.1:8000'
    });
 // });
   gulp.watch(['./src/*/Resources/public/js/**/*.js',
    './src/*/Resources/public/js/*.js',
    './src/*/Resources/public/js/components/**/*.js',
    './src/*/Resources/public/**/*.html',
    './src/*/Resources/public/js/partials/*.html'], ['installAssets'])
       .on('change', function(event){
         console.log('modificado: ' + event.path);
         browserSync.reload();
       });
});

gulp.task('serve', ['index', 'installAssets', 'connect']);

/***FUNCTIONS***/
function transformFilePath(filePath, file, i, length){
  var newPath = filePath.replace( 'src/AppBundle/Resources/public', 'bundles/app' );
	 return '<script src="' + newPath  + '"></script>';
}
