#!/bin/bash

tar pcf fs.ua.tar *
zip fs.ua.zip fs.ua.tar
rm -rf fs.ua.tar