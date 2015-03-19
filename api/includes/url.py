import sys
from gmusicapi import Mobileclient

if __name__ == "__main__":
	if sys.argv[1] == "1":
		mc = Mobileclient()
		success = mc.login(sys.argv[3], sys.argv[4])
		if success == True:
			url = mc.get_stream_url(sys.argv[2], sys.argv[5]) #songid, deviceid
			print(url)
	if sys.argv[1] == "2":
		print("Spotify is not yet supported.")