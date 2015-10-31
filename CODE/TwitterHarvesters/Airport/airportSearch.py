# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will harvester tweets data from Melbourne 
# International Airport with Twitter Search API
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

db = couch['airport']


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
	return str(latitude) + ',' + str(longitude) + ',' + '4km'

for i in range(10000):

	stadiumCoordinates = get_coordinates('Melbourne Airport')
	englandTweets = tweepy.Cursor(api.search, result_type='recent',include_entities=True, geocode=stadiumCoordinates).items()
	while True:
		try:
			tweet = englandTweets.next()
			if tweet._json["coordinates"] != None:
				if tweet.id_str not in db:
					db[tweet.id_str] = tweet._json

		except tweepy.TweepError:
			time.sleep(60)
			continue
		except StopIteration:
			break


