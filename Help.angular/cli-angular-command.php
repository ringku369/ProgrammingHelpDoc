<?php  

first uninstall from c panel then install update version to update node // to update node version

npm install -g npm // to update npm version


node -v
npm -v
ng version

npm update


npm uninstall -g angular-cli // to update nangular cli

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