<?php  

npm install -g npm // to update npm version

$ npm uninstall -g cordova
$ npm uninstall -g ionic
$ npm cache clean -f
$ npm install -g cordova ionic


1 - npm install -- save @capacitor/core @capacitor/cli
2 - open file angular.json and change from  "outputPath" : "dist/{{nameApp}}" to be 
"outputPath" : "www"
3 - ng b --prod
4 - npx cap init
5 - npx cap add android
6 - npx cap copy android
7 -npx cap open android



cordova create myApp org.apache.cordova.myApp myApp
cordova plugin add cordova-plugin-camera
cordova platform add android
cordova plugin add cordova-plugin-camera --nosave
cordova platform add android --nosave
cordova requirements android
cordova build android --verbose
cordova run android
cordova build android --release -- --keystore="..\android.keystore" --storePassword=android --alias=mykey
cordova config ls


cordova create mobile
cordova platform add android
cordova build android
cordova run android



node -v
npm -v
ng version

npm update

first uninstall then install update version to update node 

// windows command
cd .. // go back to before folder from current folder
ls  // list show files
mkdir // to make a folder
tuch  file name // to create a new file
rm file name // lto remove file
code ./ // to open vs code 
ln -s ../tergetfolder tocopyfolder // creating link to copy

// for all git command
http://guides.beanstalkapp.com/version-control/common-git-commands.html

git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/ringku369/AngularLaravelJWTApp.git
git push -u origin master



npm uninstall -g angular-cli

npm install -g @angular/cli@latest
ng new --help
ng new projectname - d
ng new projectname --routing --style=scss

ng serve --open



ng g c home -it -is --skip-tests -d (it = inline style, it = inline template)
ng g c home -s -t  --skip-tests -d (same command)
ng g c home -s -t  --spec=false -d (same command)

// --flat --module=app only for module creating

ng g module demo-routing --flat // --flat for roort path
ng g module demo-routing --flat --module=app // --flat for roort path and --module=app for registaring on module.app 

//class service is create in root path

ng g class student         
ng g service student
ng g cl app.routing --skip-tests



ng g c page/home --skip-tests

ng add @angular/material


ng build --prod

//package.json > dependencies
npm install -save plugin name
npm i -s bootstrap@3.* jquery@latest

// angular.json
"./node_modules/bootstrap/dist/css/bootstrap.min.css",
"./node_modules/jquery/dist/jquery.min.js",
"./node_modules/bootstrap/dist/js/bootstrap.min.js"


@import '~bootstrap/dist/css/bootstrap.css';



// this.loginservice.getdistrict().subscribe(
//   (response: any) => {
//     this.success = response;
//   },
//   (error: any) => {
//     this.errors = error.error;
//   }
// );






























?>