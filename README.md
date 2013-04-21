![MiniBill](http://billcolumbia.com/minibill.png)

# Version 1.0

After first adapting _s to create MiniBill, we have moved to a hand baked code base. Much more minimal now.

## Theme Files
- header
- page
- footer
- index
- single
- search
- searchform
- no-results
- functions
- 404
- screenshot ( will always need to be updated )
- config.rb ( For compass support )

## Theme Folders
- sass/
- js/

## How to use:

###### Sass
Keep an eye on the type of output style defined in config.rb. Use compressed for production and nested for development. There are other styles as well. Get familiar with the [documentation for Compass](http://compass-style.org/help/tutorials/configuration-reference/).

###### Nav Menu
The nav menu in header.php is resposive. menu.sass is pulled into style.sass on comple. Main.js manipulates the menu, adding and removing classes found in menu.sass. Take a look at those files to familiarize yourself.

#### If you are part of OSI:
All the above

#### If you are not part of OSI:
All the above, plus...
Update the footer so that you aren't pulling our logos and info. You don't want that. Make sure you have Codekit or something that can compile compass.