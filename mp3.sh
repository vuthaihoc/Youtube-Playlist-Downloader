#!/bin/bash
for a in $@
do
    for video in $(curl -s $a | grep -o "url=\"https:\/\/www.youtube.com\/v\/[^\"]*\"")
    do
        id=$(echo $video | sed "s|url\=\"https:\/\/www.youtube.com\/v\/\(.*\)?.*\"|\1|")
	    youtube-dl --extract-audio --audio-format mp3 http://www.youtube.com/watch?v=$id
    done
done
