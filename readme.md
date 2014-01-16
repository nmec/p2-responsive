# Responsive P2

![](screenshot.jpg)

A fluid and responsive child theme for [P2](http://p2theme.com/). 

I've tried to do as much as possible with CSS but there are a few things that had to be moved around in the markup, plus a bit of JS magic:

- `comments.php` rename the comments function so it could be modified:
	- `p2_responsive_comments` place span.actions at the end of comments so it responds nicely.
- `entry.php` again, move span.actions to after `the_content` so it responds nicely
- `footer.php` nothing major here, just moving the sidebar so it flows under posts/content when we switch to single column layout on small screens.
- `functions.php` adds a few functions we need to make it responsive.
- `header.php` remove the sidebar and put it in the footer and also add a mobile viewport on line 14
- `img/responsive-bg.png` a responsive faux column for the sidebar
- `js/jquery.fitvids.js` Embedded videos maintain aspect ratio when resized
- `js/modernizr.min.js` polyfill for HTML5 elements and media queries
- `style.css` All our responsive goodness lives here. Unfortunately it's quite messy CSS, hopefully it can be made much neater when it's merged with the parent theme. 

## Demo

See the theme in action [p2.nmecdesign.com](http://p2.nmecdesign.com/) 

## To-do

- Test on more mobile devices
- Test on old browsers (boo, IE)
- Integrate with parent theme
- Tidy and optimise CSS