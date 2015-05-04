import sys
from gmusicapi import Webclient

if __name__ == "__main__":
	if sys.argv[1] == "1":
		wc = Webclient()
		success = wc.login(sys.argv[2], sys.argv[3])
		if success == True:
			devices = wc.get_registered_devices()
			valid = [device['id'][2:] + " (" + device['model'] + ")" for device in devices if device['type'] == 'PHONE']
			deviceid = valid[0].split(' ', 1)[0]
			print(deviceid)
	if sys.argv[1] == "2":
		print("Spotify is not yet supported.")