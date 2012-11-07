#!/bin/bash
# remove HTML comments from file
sed -i 's/.*<!--\(.*\)-->.*//g' $1
