<?php  
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

?>