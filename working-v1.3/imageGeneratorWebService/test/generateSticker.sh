#!/bin/bash


# Get directory of this script
SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do # resolve $SOURCE until the file is no longer a symlink
	THISSCRIPTDIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"
	SOURCE="$(readlink "$SOURCE")"
	[[ $SOURCE != /* ]] && SOURCE="$THISSCRIPTDIR/$SOURCE" # if $SOURCE was a relative symlink, we need to resolve it relative to the path where the symlink file was located
done
THISSCRIPTDIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"

# PARAMS
TMPDIR="$THISSCRIPTDIR/TMP";
TMPLDIR="$THISSCRIPTDIR/Templates";
IMAGEDIR="$THISSCRIPTDIR/IMAGES";
OUTDIR="$THISSCRIPTDIR/BADGES";

# ARGS
COLOR=$1;
LEVEL=$2;
BORDER=$3;
IMAGE=$4;
TXTCOMP1=$5;
TXTCOMP2=$6;
TXTTOPIC=$7;
TXTCODE=$8;
TXTYEAR=$9;
TXTORGA=${10};

# Check script args
if (( $# == 0 )); then
	# Msg
	echo "--------------------------------------------------";
	echo "";
	echo "USAGE     : generateSticker.sh <color> <level> <border> <image> <txtComp1> <txtComp2> <txtTopic> <txtCode> <txtYear> <txtOrga>";
	#echo "NOTE      : arg2 is mandatory";
	#echo "";
	echo "ARGS      : ";
	echo "            <color>        : color of the background (s.a. 'ffcc00')";
	echo "            <level>        : competence level {0, 1, 2, 3, 4, 5, 6, 7, 8}";
	echo "            <border>       : border style {1, 2, 3, 4}";
	echo "            <image>        : name of a square PNG image located in 'Images' dir (s.a. 'regex' or 'default')";
	echo "            <txtComp1>     : text for competence line 1 (s.a. 'Regex')";
	echo "            <txtComp2>     : text for competence line 2 (s.a. 'Avancées' or '')";
	echo "            <txtTopic>     : text for topic (s.a. 'Télécommunications')";
	echo "            <txtCode>      : text for code (s.a. 'KR-1234567')";
	echo "            <txtYear>      : text for year (s.a. '2001')";
	echo "            <txtOrga>      : text for organization (s.a. 'FR-IUTKR-RT')";
	echo "";
	echo "EXAMPLE   : generateSticker.sh ffcc00 8 4 default 'Regex' 'Avancées' 'Admin Système' 'KR-1234567' '2001' 'FR-IUTKR-RT'";
	echo "";
	echo "--------------------------------------------------";
	exit;
elif (( $# == 10 )); then
	echo "[BEGIN]-------------------------------------------";

	# Create TMP dir
	rm -Rf "$TMPDIR" && mkdir -p "$TMPDIR"                                 && echo -e "\t[OK]   Create TMP dir" || echo -e "\t[FAIL] Create TMP dir";

	# Copy template files
	cp -f "$TMPLDIR/tmplBackWhite.svg" "$TMPDIR/"                          && echo -e "\t[OK]   Copy tmplBackWhite" || echo -e "\t[FAIL] Copy tmplBackWhite";
	cp -f "$TMPLDIR/tmplBack$LEVEL.svg" "$TMPDIR/tmplBack.svg"             && echo -e "\t[OK]   Copy tmplBack$LEVEL" || echo -e "\t[FAIL] Copy tmplBack$LEVEL";
	cp -f "$TMPLDIR/tmplBorder$BORDER.png" "$TMPDIR/tmplBorder.png"        && echo -e "\t[OK]   Copy tmplBorder$BORDER" || echo -e "\t[FAIL] Copy tmplBorder$BORDER";
	cp -f "$TMPLDIR/tmplContent.svg" "$TMPDIR/"                            && echo -e "\t[OK]   Copy tmplContent" || echo -e "\t[FAIL] Copy tmplContent";
	cp -f "$TMPLDIR/tmplFront.svg" "$TMPDIR/"                              && echo -e "\t[OK]   Copy tmplFront" || echo -e "\t[FAIL] Copy tmplFront";
	cp -f "$IMAGEDIR/$IMAGE.png" "$TMPDIR/image.png"                       && echo -e "\t[OK]   Copy image $IMAGE" || echo -e "\t[FAIL] Copy image $IMAGE";

	# Replace background color
	./infilesreplace "$TMPDIR/tmplBack.svg" ffcc00 $COLOR                    && echo -e "\t[OK]   Replace background color" || echo -e "\t[FAIL] Replace background color";

	# Replace content texts
	./infilesreplace "$TMPDIR/tmplContent.svg" '#comp1#' "$TXTCOMP1"         && echo -e "\t[OK]   Replace text competence line 1" || echo -e "\t[FAIL] Replace text competence line 1";
	./infilesreplace "$TMPDIR/tmplContent.svg" '#comp2#' "$TXTCOMP2"         && echo -e "\t[OK]   Replace text competence line 2" || echo -e "\t[FAIL] Replace text competence line 2";
	./infilesreplace "$TMPDIR/tmplContent.svg" '#topic#' "$TXTTOPIC"         && echo -e "\t[OK]   Replace text topic" || echo -e "\t[FAIL] Replace text topic";
	./infilesreplace "$TMPDIR/tmplContent.svg" '#code#' "$TXTCODE"           && echo -e "\t[OK]   Replace text code" || echo -e "\t[FAIL] Replace text code";
	
	# Replace front texts
	./infilesreplace "$TMPDIR/tmplFront.svg" '#year#' "$TXTYEAR"             && echo -e "\t[OK]   Replace text year" || echo -e "\t[FAIL] Replace text year";
	./infilesreplace "$TMPDIR/tmplFront.svg" '#orga#' "$TXTORGA"             && echo -e "\t[OK]   Replace text orga" || echo -e "\t[FAIL] Replace text orga";
	./infilesreplace "$TMPDIR/tmplFront.svg" '#level#' "$LEVEL"              && echo -e "\t[OK]   Replace text level" || echo -e "\t[FAIL] Replace text level";

	# Generate sticker
	magick -background none -density 800 \( $TMPDIR/tmplBackWhite.svg -resize 500x \)     \( $TMPDIR/tmplBack.svg -resize 500x \) -composite     \( $TMPDIR/image.png -resize 300x \) -gravity center -geometry +0+0 -composite     \( $TMPDIR/tmplContent.svg -resize 500x \) -composite     \( $TMPDIR/tmplBorder.png -resize 500x \) -composite     \( $TMPDIR/tmplFront.svg -resize 500x \) -composite     "$OUTDIR/sticker-$TXTCODE.png"     && echo -e "\t[OK]   Generate sticker" || echo -e "\t[FAIL] Generate sticker";
	# magick -background none -density 800 \( $TMPDIR/tmplBackWhite.svg -resize 500x \)     \( $TMPDIR/tmplBack.svg -resize 500x \) -composite     \( $TMPDIR/image.png -resize 300x -alpha set -channel A -evaluate Multiply 0.75 +channel \) -gravity center -geometry +0+0 -composite     \( $TMPDIR/tmplContent.svg -resize 500x \) -composite     \( $TMPDIR/tmplBorder.png -resize 500x \) -composite     \( $TMPDIR/tmplFront.svg -resize 500x \) -composite     "$OUTDIR/sticker-$TXTCODE.png"     && echo -e "\t[OK]   Generate sticker" || echo -e "\t[FAIL] Generate sticker";

	# Delete TMP dir
	rm -Rf "$TMPDIR"                                                       && echo -e "\t[OK]   Delete TMP dir" || echo -e "\t[FAIL] Delete TMP dir";
	# return 0
	echo "[END]---------------------------------------------";
fi
