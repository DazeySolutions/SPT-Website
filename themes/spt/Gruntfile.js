module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      files: ['Gruntfile.js', 'src/js/*.js'],
      options: {
        globals: {
          jQuery: true
        }
      }
    },
    less: {
        bootstrap:{
            files: {
                "assets/css/bootstrap.css": "src/less/bootstrap.less"
            }
        },
        fontawesome:{
            files: {
                "assets/css/fontawesome.css": "src/less/fontawesome.less"
            }
        },
        flatmate:{
            files: {
                "assets/css/flatmate.css": "src/less/hbc.less"
            }
        }
    },
  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-newer');
  grunt.registerTask('default', ['newer:jshint', 'newer:less']);

};
