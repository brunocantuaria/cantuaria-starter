module.exports = function (grunt) {
	'use strict';

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		less: {
			dev: {
				options: {
					relativeUrls: true
				},
				files: {
					'assets/css/final.css': [
						'assets/less/src/*.css',
						'assets/less/theme.less',
						'assets/less/**/*.less'
					]
				}
			}
		},
		cssmin: {
			clean: {
				options: {
					keepSpecialComments: '0',
					keepBreaks: true
				},
				expand: true,
    			cwd: 'assets/css/',
    			src: ['*.css', '!*.min.css'],
    			dest: 'assets/css/',
    			ext: '.min.css'
			}
		},
		uglify: {
			dev: {
				files: {
					'assets/js/final.min.js': [
						'assets/js/src/**/*.js',
						'assets/js/*.js',
						'!assets/js/final.min.js'
					]
				}
			}
		},
		watch: {
			less: {
				files: [
					'assets/less/*.less',
					'assets/less/**/*.less'
				],
				tasks: ['less']
			},
			css: {
				files: [
					'assets/css/*.css',
					'!assets/css/*.min.css'
				],
				tasks: ['cssmin']
			},
			js: {
		        files: [
		          	'assets/js/*.js',
					'!assets/js/*.min.js',
		        ],
		        tasks: ['uglify']
		    }
		}
	});

	// Load tasks
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.registerTask('build', [
		'less',
		'cssmin',
		'uglify',
	]);
	
};