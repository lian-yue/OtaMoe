module.exports = function (grunt) {
	grunt.initConfig({
		watch: {
			less: {
				files: ["less/*.less"],
				tasks: ["less"]
			},
			js: {
				files: ["js/*.js"],
				tasks: ["concat", "uglify"]
			},
			images: {
				files: ["images/**"],
				tasks: ["copy:images"]
			}
	    },
	    less: {
			devFile: {
				options: {
					compress: false,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'main.css.map',
					sourceMapFilename: 'dist/css/main.css.map'
				},
				files: {
					"dist/css/main.css": "less/main.less",
				}
			},
			minFile: {
				options: {
					compress: true,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'main.min.css.map',
					sourceMapFilename: 'dist/css/main.min.css.map'
				},
				files: {
					"dist/css/main.min.css": "less/main.less",
				}
			},

			ieDevFile: {
				options: {
					compress: false,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'ie.css.map',
					sourceMapFilename: 'dist/css/ie.css.map'
				},
				files: {
					"dist/css/ie.css": "less/ie.less",
				}
			},
			ieMinFile: {
				options: {
					compress: true,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'ie.min.css.map',
					sourceMapFilename: 'dist/css/ie.min.css.map'
				},
				files: {
					"dist/css/ie.min.css": "less/ie.less",
				}
			},
		},
		concat: {
			options: {
				separator: ';'
			},
			theme: {
				src: ['js/*.js'],
				dest: 'dist/js/main.js'
			}
		},
		uglify: {
			options: {
				compress: {
					warnings: false
				},
				mangle: true,
				preserveComments: 'some'
			},
			theme: {
				src: '<%= concat.theme.dest %>',
				dest: 'dist/js/main.min.js'
			},
		},
		copy: {
			images: {
				files: [{
					expand: true,
					cwd: 'images/',
					src: ['**'],
					dest: 'dist/images/',
				}]
			},
		}
	});


	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');

	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.registerTask('default', ['watch']);
};