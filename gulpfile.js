'use strict';

var gulp         = require( 'gulp' );
var browserSync  = require( 'browser-sync' ).create();
var rename       = require( 'gulp-rename' );
var rtlcss       = require( 'gulp-rtlcss' );
var lec          = require( 'gulp-line-ending-corrector' );

// Define paths
var paths = {
	rtlcss          : {
		style : {
			src  : [ './style.css' ],
			dest : './'
		}
	}
};

// Start browserSync
function browserSyncStart( cb ) {
	browserSync.init( {
		proxy : 'himalayas.local'
	}, cb );
}

// Reloads the browser
function browserSyncReload( cb ) {
	browserSync.reload();
	cb();
}

// Generates RTL CSS file.
function generateRTLCSS() {
	return gulp
		.src( paths.rtlcss.style.src )
		.pipe( rtlcss() )
		.pipe( rename( { suffix : '-rtl' } ) )
		.pipe( lec( { verbose : true, eolc : 'LF', encoding : 'utf8' } ) )
		.pipe( gulp.dest( paths.rtlcss.style.dest ) );
}

// Watch for file changes
function watch() {
	// gulp.watch( [ paths.js.src, paths.php.src ], browserSyncReload );
	gulp.watch( paths.rtlcss.style.src, generateRTLCSS );
}


// define series of tasks
var server = gulp.series( browserSyncStart, watch, generateRTLCSS );

exports.browserSyncStart       = browserSyncStart;
exports.browserSyncReload      = browserSyncReload;
exports.watch                  = watch;
exports.server                 = server;
exports.generateRTLCSS         = generateRTLCSS;
