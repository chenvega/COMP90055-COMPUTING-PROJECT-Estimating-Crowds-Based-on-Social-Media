# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will harvester tweets data from England 
# football matches with Twitter Search API
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

access_token = ""
access_secret = ""
consumer_key = ""
consumer_secret = ""

auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_secret)
api = tweepy.API(auth)

couch = couchdb.Server()
couch = couchdb.Server('http://localhost:5984')
db = couch.create('stadiums')
db = couch['stadiums']

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

def readQuery(path):
	a = []
	with open(path, 'r') as f:
		for line in f.readlines():
			a.append(line.strip())
	return a

def getTimeline(screenName,db,stadiumCoordinates):
	t = tweepy.Cursor(api.user_timeline, id=screenName,count=200).items()
	while True:
		try:
			tweet = t.next()
			if tweet._json["coordinates"] != None:
				latitude = tweet._json["coordinates"]["coordinates"][1]
				longitude = tweet._json["coordinates"]["coordinates"][0]
				stadiumLat = float(stadiumCoordinates.split(',')[0])
				stadiumLon = float(stadiumCoordinates.split(',')[1])
				if getDistance(stadiumLon,stadiumLat,longitude,latitude) < 2:
					if tweet.id_str not in db:
						db[tweet.id_str] = tweet._json
		except tweepy.TweepError:
			time.sleep(60)
			continue
		except StopIteration:
			break

path = "./stadiums.txt"

for i in readQuery(path):
	stadiumCoordinates = get_coordinates(i)
	bigT = tweepy.Cursor(api.search, result_type='recent',include_entities=True, geocode=stadiumCoordinates).items()
	while True:
		try:
			tweet = bigT.next()
			if tweet._json["coordinates"] != None:
				if tweet.id_str not in db:
					db[tweet.id_str] = tweet._json
					screenName = tweet._json["user"]["screen_name"]
					getTimeline(screenName,db,stadiumCoordinates)
		except tweepy.TweepError:
			time.sleep(60)
			continue
		except StopIteration:
			break

