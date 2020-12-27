<?php  

first uninstall from c panel then install update version to update node // to update node version

npm install -g npm // to update npm version


node -v
npm -v
ng version

npm update


npm uninstall -g angular-cli // to update nangular cli
npm cache clean --force



npm install -g @angular/cli@latest
ng new --help
ng new projectname - d
ng new projectname --routing --style=scss
ng new frontend --routing --style=css

ng serve --open



ng g c home -it -is --skip-tests -d (it = inline style, it = inline template)
ng g c home -s -t  --skip-tests -d (same command)
ng g c home -s -t  --spec=false -d (same command)

// --flat --module=app only for module creating

ng g c components/modal/ -it -is --skip-tests -d


ng g module demo-routing --flat // --flat for roort path
ng g module demo-routing --flat --module=app // --flat for roort path and --module=app for registaring on module.app 


ng g c components/admin/dashboard -it -is --skip-tests -d
ng g c components/admin/dashboard --skip-tests

ng g service services/admin/dashboard --skip-tests -d

//class service is create in root path

ng g class student         
ng g service student
ng g cl app.routing --skip-tests



ng g c page/home --skip-tests

ng add @angular/material


ng build --prod

//package.json > dependencies
npm install -save plugin name
npm i -s bootstrap@4.* jquery@latest ngx-bootstrap

npm install --save font-awesome angular-font-awesome

npm install ngx-bootstrap --save
ng add ngx-bootstrap

npm i ng2-search-filter --save


npm install ngx-toastr --save

npm install @angular/animations --save
npm install ngx-spinner --save
ng add ngx-spinner




npm install -save mdb-calendar
// angular.json
"./node_modules/bootstrap/dist/css/bootstrap.min.css",
"./node_modules/jquery/dist/jquery.min.js",
"./node_modules/bootstrap/dist/js/bootstrap.min.js"
"./node_modules/ngx-toastr/toastr.css"


@import '~bootstrap/dist/css/bootstrap.css';


import { NgModule, CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
// Import library module
import { NgxSpinnerModule } from "ngx-spinner";

import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

import { CommonModule } from '@angular/common';
import { ToastrModule } from 'ngx-toastr';

import { FormsModule } from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { BsDatepickerModule } from 'ngx-bootstrap/datepicker';



// this.loginservice.getdistrict().subscribe(
//   (response: any) => {
//     this.success = response;
//   },
//   (error: any) => {
//     this.errors = error.error;
//   }
// );



















?>