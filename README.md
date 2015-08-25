# cantuaria-starter
Starter theme for WordPress with Bootstrap and Fontawesome. Requires WordPress 4.3+

# Dev Notes
This theme use Nodejs to compile and minify LESS, CSS, JS.

## Installing Grunt and NodeJS

1. Download and install NodeJS https://nodejs.org/
2. Open shell and navigate to the theme folder
3. Execute command 'npm install'

Now, any time you're gonna edit the theme CSS and JS files, activate grunt:

1. Open shell and navigate to the theme folder
2. Use command 'grunt watch'
3. Done! Whenever a CSS, LESS or JS file is saved it will compile everything.

You can also use extensions for your code editor that will automatically activate Grunt.

Using Grunt we can keep all CSS of theme in a single file, as well the JS.

- It will compile the assets/less/theme.less file along any .css file saved on assets/less/src folder in the single assets/css/final.css
- It will minify any .css file saved on folder assets/css/ (ignoring .min.css files)
- It will unify and minify any .js file saved on folder assets/js/ and assets/js/src/ in the single assets/js/final.min.js

## Updating Bootstrap

1. I'm using the default version Bootstrap without Glyphicons.
2. Replace the bootstrap.js on assets/js/src/
3. Replace the boostrap.css on assets/less/src/
4. Save the theme.less file (with Grunt active) to compile and unify the new files.

## Updating Font Awesome

1. I'm using the default version of Font Awesome.
2. Replace the font-awesome.css on assets/less/src/
3. Replace the fonts files on assets/fonts/
4. Save the theme.less file (with Grunt active) to compile and unify the new files.
