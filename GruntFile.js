module.exports = function (grunt) {
	'use strict';

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

		jshint: {
			options: {
				"asi"      : true,
				"boss"     : true,
				"browser"  : true,
				"curly"    : false,
				"debug"    : true,
				"devel"    : true,
				"eqeqeq"   : false,
				"eqnull"   : true,
				"expr"     : true,
				"laxbreak" : true,
				"quotmark" : "single",
				"validthis": true
			},
			all: [
				'assets/js/*.js',
				'!assets/js/*.min.js',
			]
		},
		less: {
			dev: {
				options: {
					relativeUrls: true
				},
				files: {
					'assets/css/final.css': [
						'assets/less/src/*.css',
						'assets/less/theme.less',
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
		          '<%= jshint.all %>'
		        ],
		        tasks: ['jshint', 'uglify']
		    }
		}
	});

	// Load tasks
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.registerTask('build', [
		'less',
		'cssmin',
		'jshint',
		'uglify',
	]);
};