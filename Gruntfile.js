module.exports = function(grunt) {
    'use strict';
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        // Project settings
        base: {
            // Configurable paths
            mods: 'modules',
            dest: 'siteroot',
            prog: {
                src: 'site.prog',
                dest: 'su.prog'
            },
            doc: {
                src: 'site.doc',
                dest: 'su.doc'
            },
            'var': {
                src: 'site.var',
                dest: 'su.var'
            }
        },
        rsync: {
            options: {
                args: ["--quiet -tpl --delete -f \". ./grunt-rsync-filter\""],
                recursive: true
            },
            auth_doc: {
                options: {
                    src: './<%= base.mods %>/auth/<%= base.doc.src %>/auth/',
                    dest: './<%= base.dest %>/<%= base.doc.dest %>/auth/'
                }
            },
            auth_prog: {
                options: {
                    src: './<%= base.mods %>/auth/<%= base.prog.src %>/auth/',
                    dest: './<%= base.dest %>/<%= base.prog.dest %>/auth/'
                }
            },
            auth_var: {
                options: {
                    src: './<%= base.mods %>/auth/<%= base.var.src %>/auth/',
                    dest: './<%= base.dest %>/<%= base.var.dest %>/auth/'
                }
            },
            lib_doc: {
                options: {
                    src: './<%= base.mods %>/lib/<%= base.doc.src %>/lib/',
                    dest: './<%= base.dest %>/<%= base.doc.prog %>/lib/'
                }
            },
            lib_prog: {
                options: {
                    src: './<%= base.mods %>/auth/<%= base.prog.src %>/lib/',
                    dest: './<%= base.dest %>/<%= base.prog.dest %>/lib/'
                }
            },
            test: {
                options: {
                    src: "./test/src/",
                    dest: "./test/dist/"
                }
            }
        },
        watch: {
            auth: {
                files: ['./<%= base.mods %>/auth/<%= base.doc.src %>/auth/**'],
                tasks: ['rsync:auth_doc']
            },
        }
    });
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-rsync');

    grunt.registerTask('auth', ['rsync:auth_doc', 'rsync:auth_var', 'rsync:auth_prog']);

    grunt.registerTask('default', ['lib_doc', 'lib_prog']);
}