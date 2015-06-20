#!/bin/bash
#https://www.youtube.com/feeds/videos.xml?playlist_id=PLCWtno5o-FOrgoG5gLp6exD0mdW10og9Y
for a in $@
do
    for video in $(curl -s $a | grep -o "url=\"https:\/\/www.youtube.com\/v\/[^\"]*\"")
    do
        id=$(echo $video | sed "s|url\=\"https:\/\/www.youtube.com\/v\/\(.*\)?.*\"|\1|")
	    youtube-dl http://www.youtube.com/watch?v=$id
    done
done
