<?php  
$ npm uninstall -g cordova
$ npm uninstall -g ionic
$ npm cache clean -f
$ npm install -g cordova ionic


cordova --version


ionic cordova plugin add cordova-plugin-geolocation
npm install @ionic-native/geolocation


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




$ ng add @ionic/angular
$ ionic init
$ project-name
$ ionic cordova run android --project="www" --no-native-run --verbose

ionic cordova build android

cordova create mobile
cordova platform add android
cordova build android
cordova run android



npm install -g @ionic/cli native-run cordova-res
ionic start photo-gallery tabs --type=angular --capacitor

npm i -s @ionic/pwa-elements

npm install @ionic/pwa-elements --save

?>