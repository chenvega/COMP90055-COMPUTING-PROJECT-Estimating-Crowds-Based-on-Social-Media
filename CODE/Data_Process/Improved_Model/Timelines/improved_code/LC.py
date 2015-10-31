# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will extract the screen_names based on related football matches
import couchdb
import csv
from couchdb import Server

couch = couchdb.Server('http://localhost:5984')
db = couch['england']


mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sat Aug 22 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Sun Aug 23 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-1.148762)&&(la>52.615977)&&(lo<-1.135635)&&(la<52.624694)){
			emit(doc.user.id, doc.user.screen_name);
		}
	}
  
}
}
'''

result = db.query(mapFunc, group_level=0)

dic = {}
for i in result.rows:
	dic[i.key] = i.value

with open('/Users/jacky/Desktop/upload/improve/LC0822H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])


mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sun Sep 13 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Mon Sep 14 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-1.148762)&&(la>52.615977)&&(lo<-1.135635)&&(la<52.624694)){
			emit(doc.user.id, doc.user.screen_name);
		}
	}
  
}
}
'''

result = db.query(mapFunc, group_level=0)

dic = {}
for i in result.rows:
	dic[i.key] = i.value
	
with open('/Users/jacky/Desktop/upload/improve/LC0913H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])



mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sat Sep 26 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Sun Sep 27 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-1.148762)&&(la>52.615977)&&(lo<-1.135635)&&(la<52.624694)){
			emit(doc.user.id, doc.user.screen_name);
		}
	}
  
}
}
'''

result = db.query(mapFunc, group_level=0)

dic = {}
for i in result.rows:
	dic[i.key] = i.value
	
with open('/Users/jacky/Desktop/upload/improve/LC0926H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])