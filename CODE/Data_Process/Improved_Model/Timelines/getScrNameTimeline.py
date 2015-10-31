# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will extract historical tweets data from given screen_name lists.
import csv
from os import listdir
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


def chooseTime(thisTime):
	sinceTime = 'Fri Aug 21 00:00:00 +0000 2015'
	endTime = 'Mon Oct 05 00:00:00 +0000 2015'
	timeA = datetime.datetime.strptime(thisTime,"%a %b %d %H:%M:%S +0000 %Y")
	timeB = datetime.datetime.strptime(sinceTime,"%a %b %d %H:%M:%S +0000 %Y")
	timeC = datetime.datetime.strptime(endTime,"%a %b %d %H:%M:%S +0000 %Y")
	return (timeA > timeB) and (timeA < timeC)

def getTimeline(screenName,db):
	t = tweepy.Cursor(api.user_timeline, id=screenName,count=200).items()
	while True:
		try:
			tweet = t.next()
			if tweet._json["coordinates"] != None:
				if chooseTime(tweet._json['created_at']):
					if tweet.id_str not in db:
						db[tweet.id_str] = tweet._json
		except tweepy.TweepError:
			time.sleep(60)
			continue
		except StopIteration:
			break

def find_csv_filenames( path_to_dir, suffix=".csv" ):
    filenames = listdir(path_to_dir)
    return [ filename for filename in filenames if filename.endswith( suffix ) ]

def getScreenNames(path):
	dic = {}
	for i in path:
		with open(i,'rU') as f:
		    reader = csv.reader(f)
		    for line in reader:
		        dic[line[0]] = line[1]
	return dic

ori = './screenNames/'
files = find_csv_filenames(ori)
path = [ori+i for i in files]
dic = getScreenNames(path)
# for user in dic.values():
# 	print user,dic.values().index(user)
auth = tweepy.OAuthHandler(consumer_key, consumer_secret)
auth.set_access_token(access_token, access_secret)
api = tweepy.API(auth)

couch = couchdb.Server()
couch = couchdb.Server('http://localhost:5984')
db = couch['england']

for user in dic.values():
	getTimeline(user,db)
