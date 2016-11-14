# Youtube Playlist Downloader

(I know there are a lots of alternative to download video from youtube, but i really like that kind of pure solution)

I need to change something about this script, because of that: Bye-bye, YouTube Data API v2
http://youtube-eng.blogspot.ie/2015/04/bye-bye-youtube-data-api-v2.html
Now this script works fine.

If you use this script, you can download youtube videos from youtube playlist.
You have options to download video in mp3 format or video format (mp4) as well.
When this script finish to download and / or convert files, you get zip archive and list about these.
Download videos and convert them take a long time.

*for instance:*

* check this nice playlist: https://www.youtube.com/watch?v=L2-EGNKzUAQ&index=3&list=RDXdrWZKqfh8E
* see the last part of this url: list=RDXdrWZKqfh8E
* you can use RDXdrWZKqfh8E as playlist_id

##Binaries and PHP functions are required:

* youtube-dl installed binary on Linux
* zip installed binary on Linux
* tree installed binary on Linux
* php - file_get_contents function
* php - system function (option to run binary via system function)

*Example to use this scripts:*

*Download in mp3:* http://example.com/?q=RDXdrWZKqfh8E
*Download in video format:* http://example.com/?q=RDXdrWZKqfh8E&v=true

*Install youtube-dl:*
https://github.com/rg3/youtube-dl

*Before you run index.php via browser, you need to add right permission to container folder and video.sh and mp3.sh files*

##You can see below another option to download Youtube video or Youtube Videos by Mp3 format:##

**Download by bideo format:**
youtube-dl -cit "http://www.youtube.com/playlist?list=[*playlist_id*]"

**Download by Mp3:**
youtube-dl --extract-audio --audio-format mp3 -cit "http://www.youtube.com/playlist?list=[*playlist_id*]"


























