module.exports = function(grunt) {
	grunt.initConfig({
		watch: {
			html5shiv: {
				files: ['resources/assets/html5shiv/dist/**'],
				tasks: ['copy:html5shiv'],
			},
			respond: {
				files: ['resources/assets/respond/dest/**'],
				tasks: ['copy:respond'],
			},
			'font-awesome': {
				files: ['resources/assets/font-awesome/css/**', 'resources/assets/font-awesome/fonts/**'],
				tasks: ['copy:font-awesome'],
			},
			Ionicons: {
				files: ['resources/assets/Ionicons/css/**', 'resources/assets/Ionicons/fonts/**'],
				tasks: ['copy:Ionicons'],
			},
			jQuery: {
				files: ['resources/assets/jquery/dist/**'],
				tasks: ['copy:jQuery'],
			},
			iCheck: {
				files: ['resources/assets/iCheck/icheck.js', 'resources/assets/iCheck/icheck.min.js', 'resources/assets/iCheck/skins/**'],
				tasks: ['copy:iCheck'],
			},
			bootstrap: {
				files: ['resources/assets/bootstrap/dist/**'],
				tasks: ['copy:bootstrap'],
			},
			datatables: {
				files: ['resources/assets/datatables/media/**'],
				tasks: ['copy:datatables'],
			},
			ckeditor: {
				files: ['resources/assets/ckeditor/**'],
				tasks: ['copy:ckeditor'],
			},
			Plupload: {
				files: ['resources/assets/Plupload/**'],
				tasks: ['copy:Plupload'],
			},
			admin: {
				files: ['resources/assets/AdminLTE/dist/**'],
				tasks: ['copy:admin'],
			},
			theme: {
				files: ['resources/assets/theme/dist/**'],
				tasks: ['copy:theme'],
			},
		},
		copy: {
			html5shiv: {
				files: [{
					expand: true,
					cwd: 'resources/assets/html5shiv/dist',
					src: ['**'],
					dest: 'public/assets/html5shiv/',
				}]
			},
			respond: {
				files: [{
					expand: true,
					cwd: 'resources/assets/respond/dest',
					src: ['**'],
					dest: 'public/assets/respond/',
				}]
			},
			'font-awesome': {
				files: [{
					expand: true,
					cwd: 'resources/assets/font-awesome/css',
					src: ['**'],
					dest: 'public/assets/font-awesome/css',
				},
				{
					expand: true,
					cwd: 'resources/assets/font-awesome/fonts',
					src: ['**'],
					dest: 'public/assets/font-awesome/fonts',
				}]
			},
			Ionicons: {
				files: [{
					expand: true,
					cwd: 'resources/assets/Ionicons/css',
					src: ['**'],
					dest: 'public/assets/Ionicons/css',
				},
				{
					expand: true,
					cwd: 'resources/assets/Ionicons/fonts',
					src: ['**'],
					dest: 'public/assets/Ionicons/fonts',
				}]
			},
			jQuery: {
				files: [{
					expand: true,
					cwd: 'resources/assets/jquery/dist',
					src: ['**'],
					dest: 'public/assets/jquery/',
				}]
			},
			iCheck: {
				files: [{
					expand: true,
					cwd: 'resources/assets/iCheck/',
					src: ['icheck.js', 'icheck.min.js'],
					dest: 'public/assets/iCheck/js',
				},
				{
					expand: true,
					cwd: 'resources/assets/iCheck/skins',
					src: ['**'],
					dest: 'public/assets/iCheck/skins',
				}]
			},
			bootstrap: {
				files: [{
					expand: true,
					cwd: 'resources/assets/bootstrap/dist',
					src: ['**'],
					dest: 'public/assets/bootstrap/',
				}]
			},
			datatables: {
				files: [{
					expand: true,
					cwd: 'resources/assets/datatables/media',
					src: ['**'],
					dest: 'public/assets/datatables/',
				}]
			},
			ckeditor: {
				files: [{
					expand: true,
					cwd: 'resources/assets/ckeditor/',
					src: ['**'],
					dest: 'public/assets/ckeditor/',
				}]
			},
			Plupload: {
				files: [{
					expand: true,
					cwd: 'resources/assets/Plupload/js/',
					src: ['**'],
					dest: 'public/assets/Plupload/js/',
				}]
			},
			admin: {
				files: [{
					expand: true,
					cwd: 'resources/assets/AdminLTE/dist/',
					src: ['**'],
					dest: 'public/assets/admin/',
				}]
			},
			theme: {
				files: [{
					expand: true,
					cwd: 'resources/assets/theme/dist/',
					src: ['**'],
					dest: 'public/assets/theme/',
				}]
			},
		},
	});

	//导入所需的插件
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-watch');

	//注册两个任务
	grunt.registerTask('default', ['copy']);
};