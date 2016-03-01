#!/bin/sh
wget https://github.com/yui/yuicompressor/releases/download/v2.4.8/yuicompressor-2.4.8.jar
java -jar yuicompressor-2.4.8.jar --type js ./src/js/mpcx-accordion.js -o ./mpcx-accordion/trunk/public/js/mpcx-accordion.min.js
java -jar yuicompressor-2.4.8.jar --type css ./src/css/mpcx-accordion.css -o ./mpcx-accordion/trunk/public/css/mpcx-accordion.min.css
rm ./yuicompressor-2.4.8.jar
