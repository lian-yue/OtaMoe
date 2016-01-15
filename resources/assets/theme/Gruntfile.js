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

			ie8DevFile: {
				options: {
					compress: false,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'ie8.css.map',
					sourceMapFilename: 'dist/css/ie8.css.map'
				},
				files: {
					"dist/css/ie8.css": "less/ie8.less",
				}
			},
			ie8MinFile: {
				options: {
					compress: true,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'ie8.min.css.map',
					sourceMapFilename: 'dist/css/ie8.min.css.map'
				},
				files: {
					"dist/css/ie8.min.css": "less/ie8.less",
				}
			},

			ie7DevFile: {
				options: {
					compress: false,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'ie7.css.map',
					sourceMapFilename: 'dist/css/ie7.css.map'
				},
				files: {
					"dist/css/ie7.css": "less/ie7.less",
				}
			},
			ie7MinFile: {
				options: {
					compress: true,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'ie7.min.css.map',
					sourceMapFilename: 'dist/css/ie7.min.css.map'
				},
				files: {
					"dist/css/ie7.min.css": "less/ie7.less",
				}
			},

			ie6DevFile: {
				options: {
					compress: false,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'ie6.css.map',
					sourceMapFilename: 'dist/css/ie6.css.map'
				},
				files: {
					"dist/css/ie6.css": "less/ie6.less",
				}
			},
			ie6MinFile: {
				options: {
					compress: true,
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					sourceMapURL: 'ie6.min.css.map',
					sourceMapFilename: 'dist/css/ie6.min.css.map'
				},
				files: {
					"dist/css/ie6.min.css": "less/ie6.less",
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