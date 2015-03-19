import sys
from gmusicapi import Mobileclient

if __name__ == "__main__":
	if sys.argv[1] == "1":
		mc = Mobileclient()
		success = mc.login(sys.argv[3], sys.argv[4])
		if success == True:
			sresults = mc.search_all_access(sys.argv[2], 1) #2 = query
			song = sresults['song_hits'][0]
			sid = song['track']['nid']
			sname = song['track']['title']
			sartist = song['track']['artist']
			sartistid = song['track']['artistId'][0]
			salbum = song['track']['album']
			salbumart = song['track']['albumArtRef'][0]['url']
			aresults = mc.get_artist_info(sartistid, False, 1, 1)
			artistart = aresults['artistArtRef']
			print(sid)
			print(sname)
			print(sartist)
			print(salbum)
			print(salbumart)
			print(artistart)
	if sys.argv[1] == "2":
		print("Spotify is not yet supported.")