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
IMAGEDIR="$THISSCRIPTDIR/IN";
OUTDIR="$THISSCRIPTDIR/QRCODES";

# ARGS
TXTIDUSER=$1;
ISUSER=$2;
$TXTTITLE=$3;
# Check script args
if (( $# == 0 )); then
	# Msg
	echo "--------------------------------------------------";
	echo "";
	echo "USAGE     : generateUserSticker.sh <id>";
	#echo "NOTE      : arg2 is mandatory";
	#echo "";
	echo "ARGS      : ";
	echo "            <id>        : idUser (s.a. '123456789')";
	echo "            <isUser>    : istheId a id User (s.a. true/false)";
	echo "";
	echo "EXAMPLE   : generateUserSticker.sh '123456789'";
	echo "OR";
	echo "EXAMPLE   : generateUserSticker.sh '123456789' true";
	echo "";
	echo "--------------------------------------------------";
	exit;
elif (( $# == 1 || $# == 2 || $# == 3)); then
	echo "[BEGIN]-------------------------------------------";

	# Create TMP dir
	rm -Rf "$TMPDIR" && mkdir -p "$TMPDIR"                                 && echo -e "\t[OK]   Create TMP dir" || echo -e "\t[FAIL] Create TMP dir";

	# Copy template files
	cp -f "$TMPLDIR/tmplBackWhite.svg" "$TMPDIR/"                          && echo -e "\t[OK]   Copy tmplBackWhite" || echo -e "\t[FAIL] Copy tmplBackWhite";
	cp -f "$TMPLDIR/tmplBorderUser.png" "$TMPDIR/"                         && echo -e "\t[OK]   Copy tmplBorderUser" || echo -e "\t[FAIL] Copy tmplBorderUser";
	cp -f "$TMPLDIR/tmplFrontUser.svg" "$TMPDIR/"                          && echo -e "\t[OK]   Copy tmplFrontUser" || echo -e "\t[FAIL] Copy tmplFrontUser";
	URL="http://10.122.7.206/SAE32/working-v1.3/webClient/getCompetences.php?idC=$TXTIDUSER";
	if [ $ISUSER == 1 ]; then URL="http://10.122.7.206/SAE32/working-v1.3/webClient/getCompetences.php?idS=$TXTIDUSER";fi
	# Generate QR for user
	qrencode -s 30 -m 0 -d 500 -l L -o "$TMPDIR/qrUser.png" "$URL";
	
	# Replace front text
	$FRONTTEXT="$TXTTITLE $TXTIDUSER";
	./infilesreplace "$TMPDIR/tmplFrontUser.svg" '#user#' "$FRONTTEXT"       && echo -e "\t[OK]   Replace text user" || echo -e "\t[FAIL] Replace text user";

	# Generate sticker
	magick -background none -density 800 \( $TMPDIR/tmplBackWhite.svg -resize 500x \)     \( $TMPDIR/qrUser.png -resize 250x \) -gravity center -geometry +0+0 -composite     \( $TMPDIR/tmplBorderUser.png -resize 500x \) -composite     \( $TMPDIR/tmplFrontUser.svg -resize 500x \) -composite     "$OUTDIR/user-$TXTIDUSER.png"     && echo -e "\t[OK]   Generate user sticker" || echo -e "\t[FAIL] Generate user sticker";

	# Delete TMP dir
	rm -Rf "$TMPDIR"                                                       && echo -e "\t[OK]   Delete TMP dir" || echo -e "\t[FAIL] Delete TMP dir";

	echo "[END]---------------------------------------------";
fi
