<?php  

// for all git command
http://guides.beanstalkapp.com/version-control/common-git-commands.html

https://codeshare.co.uk/blog/how-to-solve-the-github-error-fatal-httprequestexception-encountered/


// Set Credential 

git config --global credential.helper manager-core


// For download 

git clone https://github.com/ringku369/ProgrammingHelpDoc.git
git clone https://github.com/ringku369/jstree.git

git init
git add README.md
git add ./
git commit -m "first commit"
git remote add origin https://github.com/ringku369/AngularLaravelJWTApp.git
git push -u origin master

git pull origin master

?>