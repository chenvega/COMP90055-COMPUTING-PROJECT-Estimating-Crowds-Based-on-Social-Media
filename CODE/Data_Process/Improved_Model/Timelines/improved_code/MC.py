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
var a = new Date(Date.parse("Sat Aug 29 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Sun Aug 30 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-2.207452)&&(la>53.478801)&&(lo<-2.193339)&&(la<53.4875)){
			emit(doc.user.id, 1);
		}
	}
  
}
}
'''

result = db.query(mapFunc, group_level=0)

dic = {}
for i in result.rows:
	dic[i.key] = i.value

with open('/Users/jacky/Desktop/upload/improve/MC0829H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])


mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sat Sep 19 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Sun Sep 20 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-2.207452)&&(la>53.478801)&&(lo<-2.193339)&&(la<53.4875)){
			emit(doc.user.id, 1);
		}
	}
  
}
}
'''

result = db.query(mapFunc, group_level=0)

dic = {}
for i in result.rows:
	dic[i.key] = i.value
	
with open('/Users/jacky/Desktop/upload/improve/MC0919H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])



mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sat Oct 03 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Sun Oct 04 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-2.207452)&&(la>53.478801)&&(lo<-2.193339)&&(la<53.4875)){
			emit(doc.user.id, 1);
		}
	}
  
}
}
'''

result = db.query(mapFunc, group_level=0)

dic = {}
for i in result.rows:
	dic[i.key] = i.value
	
with open('/Users/jacky/Desktop/upload/improve/MC1003H.csv', 'w') as fw:
	writer = csv.writer(fw,lineterminator='\n')
	for key, value in dic.items():
		writer.writerow([key,value])