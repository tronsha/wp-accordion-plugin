#!/bin/sh
java -jar ./vendor/yuicompressor-2.4.8.jar --type js ./src/admin/js/accordion.js -o ./wordpress/trunk/admin/js/accordion.min.js
java -jar ./vendor/yuicompressor-2.4.8.jar --type css ./src/admin/css/accordion.css -o ./wordpress/trunk/admin/css/accordion.min.css
java -jar ./vendor/yuicompressor-2.4.8.jar --type js ./src/public/js/accordion.js -o ./wordpress/trunk/public/js/accordion.min.js
java -jar ./vendor/yuicompressor-2.4.8.jar --type css ./src/public/css/accordion.css -o ./wordpress/trunk/public/css/accordion.min.css
