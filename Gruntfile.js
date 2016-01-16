module.exports = function( grunt ) {
	'use strict';

	// Load all grunt tasks
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Project configuration
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),

		makepot: {
			main: {
				options: {
					domainPath: 'languages',
					mainFile: 'style.css',
					potFilename: 'bus_leader.pot',
					type: 'wp-theme',
					potHeaders: true,
				}
			}
		},

		watch:  {
			pot: {
				files: ['*.php'],
				tasks: ['makepot'],
				options: {
					debounceDelay: 500
				}
			}
		}
	} );

	// Tasks
	grunt.registerTask( 'default', ['makepot'] );

	grunt.util.linefeed = '\n';

	grunt.loadNpmTasks('grunt-contrib-watch');
};
