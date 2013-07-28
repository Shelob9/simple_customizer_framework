simple_customizer_framework
===========================
The goal of this project is to create a super simple to use framework for programming the WordPress Theme Customizer. It is designed to allow theme authors to specify what an option needs to do, all in one array. The framework will then create the settings/controls, output any necessary CSS to the header and create the js for real time previewing.

Currently it works for color pickers only and the short-term goal is to make a stable alpha for color pickers. See below for the current status. Pull requests are VERY WELCOME:) Keep in mind as of now <em>this will to work with twentytwelve only.</em>

Why?
====
I think the theme customizer should be the standard for options, not option pages/ panels, since it is vastly superior. But, unless it somehow becomes easy to code for, this isn't going to happen.


This started when I was working on the next version of my [theme](https://github.com/Shelob9/_second_foundation). I am changing how I save options set in the customizer to a smarter method (serialized options) and adding some new options. When I was done with that I started working on creating a function to implement all of the options that are implemented via css as well as the js for the automatic previews and decided doing it manually was stupid. I figure as long as I'm creating my color controls via an array, I might as well add the css selector and property and write a few functions to do this automatically for me.


Current Status
==============
<strong>Things That Work And Are Shiny</strong>
* Settings, controls and sections are all created via nice easy to work with arrays.
* The changes show up on the front end as intended.
* All of the variables that are needed by customizer.js for real time preview are localized and available. This has been confirmed by console.loging theme in customizer.js.
* Instructions for end user use is completed in the code. Full documentation can easily be completed when 
* 

<strong>Things That Work But Work In Stupid Ways</strong>
* The option name, the prefix for settings and sections, as well as the translation text domain are all hard coded to be 'scf'. This should be an option the user sets.
* The function scf_customizer_color_loop() creates the array needed for outputting styles to wp_head and customizer.js. That's all shiny, except the function is called in a function hooked to customize_register so that array is only available in the customizer. As quick fix I am save the data to the database and then get that option in scf_auto_style() and in scf_localize_customizer().
* scf_localize_customizer() deregisters the theme's built in customizer js. Right now its hardcoded to use the handle for said script from twentytwelve. A more universal solution is needed. Also in that function, on line 61 you can see the commented out way I tried to set the source for it, instead of the stupid way that actually worked. Maybe its just my local environment.

<strong>Things That Don't Work</strong>
* The real time previewing isn't happening. If you look in customize.js you will see two loops I wrote. One is supposed to accomplish this goal. It doesn't, nor does it give me any console errors. I am even more of an egg when it comes to js than with PHP. The second loop console.logs real nice.

In the "Enter postMessage" section of (this article)[http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/comment-page-3/#comment-11938] Otto explains what I am trying to do.

Long Term Goals
===============
Stage 1: Alpha version that is stable and works as intend for color picker controls in any theme.

Stage 2: Incorporate all controls.

Stage 3: Make custom controls easier or at the very least add acces to the media manager with image controls.

Stage 4: World domination.

