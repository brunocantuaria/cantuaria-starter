module.exports = function(grunt) {
	"use strict";

	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),

		browserSync: {
			dev: {
				bsFiles: {
					src: [
						"assets/img/*.*",
						"assets/css/*.css",
						"assets/js/*.js",
						"**/*.php"
					]
				},
				options: {
					watchTask: true,
					proxy: "http://localhost/"
				}
			}
		}
	});

	// Load tasks
	grunt.loadNpmTasks("grunt-contrib-watch");
	grunt.loadNpmTasks("grunt-browser-sync");

	grunt.registerTask("default", ["browserSync", "watch"]);
};
