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
var a = new Date(Date.parse("Sun Aug 23 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Mon Aug 24 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-2.972389)&&(la>53.435163)&&(lo<-2.959992)&&(la<53.442437)){
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

with open('/Users/jacky/Desktop/upload/improve/EV0823H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])


mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sat Sep 12 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Sun Sep 13 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-2.972389)&&(la>53.435163)&&(lo<-2.959992)&&(la<53.442437)){
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
	
with open('/Users/jacky/Desktop/upload/improve/EV0912H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])



mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sun Oct 04 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Mon Oct 05 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-2.972389)&&(la>53.435163)&&(lo<-2.959992)&&(la<53.442437)){
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
	
with open('/Users/jacky/Desktop/upload/improve/EV1004H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])