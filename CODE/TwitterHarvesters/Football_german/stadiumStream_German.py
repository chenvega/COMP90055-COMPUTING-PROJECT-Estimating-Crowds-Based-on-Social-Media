# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will harvester tweets data from German 
# football matches with Twitter Stream API
import tweepy
import time
import couchdb
import os
import urllib
import json
from tweepy import Stream
from tweepy.streaming import StreamListener
import simplejson
import datetime
from datetime import timedelta
import math
from math import radians, cos, sin, asin, sqrt

consumer_key = "";
consumer_secret = "";
access_token = "";
access_secret = "";

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_secret)
api = tweepy.API(auth)

couch = couchdb.Server()
couch = couchdb.Server('http://localhost:5984')

db = couch['stadiums']

def get_coordinates(query, from_sensor=False):
	googleURL = 'http://maps.googleURLs.com/maps/api/geocode/json?'
	query = query.encode('utf-8')
	params = {
		'address': query,
		'sensor': "true" if from_sensor else "false"
	}
	url = googleURL + urllib.urlencode(params)
	re_json = urllib.urlopen(url)
	response = simplejson.loads(re_json.read())
	if response['results']:
		location = response['results'][0]['geometry']['location']
		latitude, longitude = location['lat'], location['lng']
	else:
		latitude, longitude = None, None
		print query, "<no results>"
	return str(latitude) + ',' + str(longitude) + ',' + '2km'

def getDistance(lon1, lat1, lon2, lat2):
	# convert decimal degrees to radians 
	lon1, lat1, lon2, lat2 = map(radians, [lon1, lat1, lon2, lat2])

	R = 6373 
	dlon = lon2 - lon1 
	dlat = lat2 - lat1 
	a = sin(dlat/2)**2 + cos(lat1) * cos(lat2) * sin(dlon/2)**2
	c = 2 * asin(sqrt(a)) 
	km = R * c
	return km

def readQuery(path):
	a = []
	with open(path, 'r') as f:
		for line in f.readlines():
			a.append(line.strip())
	return a

class MyListener(StreamListener):
 
	def on_status(self, status):
		if status._json["coordinates"] != None:
			if status.id_str not in db:
				db[status.id_str] = status._json
	def on_error(self, status):
		print(status)
		return True
	def on_timeout(self):
		return True

path = "./stadiums.txt"

for stadiumName in readQuery(path):
	stadiumCoordinates = get_coordinates(stadiumName)
	location = list(getCorner_Coordinate(stadiumCoordinates))

	twitter_stream = Stream(auth, MyListener())
	twitter_stream.filter(locations=location)

