simple_customizer_framework
===========================
The goal of this project is to create a super simple to use framework for programming the WordPress Theme Customizer. It is designed to allow theme authors to specify what an option needs to do, all in one array. The framework will then create the settings/controls, output any necessary CSS to the header and create the js for real time previewing.

Currently it works for color pickers only and the short-term goal is to make a stable alpha for color pickers. See below for the current status. Pull requests are VERY WELCOME:) Keep in mind as of now <em>this will to work with twentytwelve only.</em>

Why?
====
I think the theme customizer should be the standard for options, not option pages/ panels, since it is vastly superior. But, unless it somehow becomes easy to code for, this isn't going to happen.


This started when I was working on the next version of my [theme](https://github.com/Shelob9/_second_foundation). I am changing how I save options set in the customizer to a smarter method (serialized options) and adding some new options. When I was done with that I started working on creating a function to implement all of the options that are implemented via css as well as the js for the automatic previews and decided doing it manually was stupid. I figure as long as I'm creating my color controls via an array, I might as well add the css selector and property and write a few functions to do this automatically for me.


Current Issues
==============
* Sections are not created.
* Only the last control/setting is created.
* Preview JS not working.

Long Term Goals
===============
Stage 1: Alpha version that is stable and works as intend for color picker controls in any theme.

Stage 2: Incorporate all controls.

Stage 3: Make custom controls easier or at the very least add acces to the media manager with image controls.

Stage 4: World domination.

