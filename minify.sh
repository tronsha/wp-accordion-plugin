#!/bin/sh
java -jar ./vendor/yuicompressor-2.4.8.jar --type js ./src/js/mpcx-accordion.js -o ./mpcx-accordion/trunk/public/js/mpcx-accordion.min.js
java -jar ./vendor/yuicompressor-2.4.8.jar --type css ./src/css/mpcx-accordion.css -o ./mpcx-accordion/trunk/public/css/mpcx-accordion.min.css
