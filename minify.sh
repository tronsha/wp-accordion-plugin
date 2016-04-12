#!/bin/sh
java -jar ./vendor/yuicompressor-2.4.8.jar --type js ./src/js/accordion.js -o ./wordpress/trunk/public/js/accordion.min.js
java -jar ./vendor/yuicompressor-2.4.8.jar --type css ./src/css/accordion.css -o ./wordpress/trunk/public/css/accordion.min.css
