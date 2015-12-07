#!/bin/sh
wget https://github.com/yui/yuicompressor/releases/download/v2.4.8/yuicompressor-2.4.8.jar
java -jar yuicompressor-2.4.8.jar --type js ./js/mpcx-accordion.js -o ./js/mpcx-accordion.min.js
java -jar yuicompressor-2.4.8.jar --type css ./css/mpcx-accordion.css -o ./css/mpcx-accordion.min.css
rm ./yuicompressor-2.4.8.jar
