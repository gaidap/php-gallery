#!/bin/bash
shopt -s extglob
cp -r !(.idea|.git|test|schema|.gitignore|phpunit.phar|deploy.bat|deploy.sh|clean.sh|clean.bat|README.md|LICENSE|.phpunit.result.cache) /opt/lampp/htdocs/gallery/
