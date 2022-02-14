#Gramdma's Recipes 


####Development Tools Used 
- Laragon (https://laragon.org/) - A local development environment
- PHP Storm (https://www.jetbrains.com/phpstorm/) - IDE
- git (https://git-scm.com/) for version control and pushed to Bitbucket (https://bitbucket.org/)

##Completed

###Misc
- Converted project to OOP (Object-Oriented Programming)
- Implemented AJAX for most CRUD commands (Create, Read, Update, Delete)
- Cleaned up file structure
- Removed unnecessary PHP functions
- Integrated Composer for PHP Dependencies (https://getcomposer.org/)
- Integrated Node.js (https://nodejs.org/en/) for gulp task runners  (https://gulpjs.com/)
- Using gulp convert all static css to SASS (https://sass-lang.com/)
    - Concatenate and minify all SASS assets into a single file
- Using gulp concatenate and minify all js assets into a single file
- Integrated Google Analytics (gtag.js)
- Integrated Bootstrap 4 and Flexbox
- Coded and tested with PHP 7.2

###Recipes
- Add/Edit recipe
    - Add/Edit recipe details
        - Name
        - Description
        - Serving Size
        - Prep time and duration type
        - Cook time and duration type
    - Add/Edit/Delete ingredients
        - Amount
        - Measurement types
        - Ingredient name
    - Add/Edit/Delete directions
        - Direction information
 - Delete an entire recipe
 
 ###Search
 - AJAX search by recipe name, on click go to recipe page.

##Future Asks
 
###General
- Recipe statuses (published, draft, archived)
- Add recipe category so isotope filtering can be used
- Featured photo
- Auto refresh DIV content with AJAX to remove blink on page reload
- Upload images to direction
    - limit file type
    - limit file size

###Member profiles
- Registration
    - create
- Update
- Delete
- Assign users to recipes
- Email notifications
    - account created
    - password reset
    
###Search Box
- Ajax pull recipes by name assigned to user when logged in
		
###Security
- Filter and sanitize all data/prevent JS and SQL injection
- Hash/Encrypt passwords
- File uploads
    - limit file type
    - limit file size