#!/bin/bash


for f in tmplBorder[0-9].svg; do
	newFilename=$(echo "$f" | sed -re "s/\.svg/\.png/g");
	rsvg-convert --dpi-x 600 --dpi-y 600 "$f" > "$newFilename" && echo -e "\t[OK]   $newFilename created with RSVG to avoid imageMagick problem with borders and --density" || echo -e "\t[FAIL] Creating $newFilename";
done