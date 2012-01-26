# Responsive P2

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

## P2 Modifications - Important

The parent P2 theme serves an additional stylesheet to visitors with iPhone http headers, unfortunately there's no way to change this from the child-theme so either **delete** or **comment out** lines 443-453 in `p2/functions.php`. 

It will work fine without this modification but it won't appear as it was designed it to on iPhones.

## Demo

See the theme in action [p2.nmecdesign.com](http://p2.nmecdesign.com/) 

## To-do

- Test on more mobile devices
- Test on old browsers (boo, IE)
- Integrate with parent theme
- Tidy and optimise CSS