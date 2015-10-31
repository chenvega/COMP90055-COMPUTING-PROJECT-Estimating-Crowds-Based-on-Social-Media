# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will count individual number attending one specific
# football match on a corresponding stadium
import couchdb
from couchdb import Server

couch = couchdb.Server('http://localhost:5984')
db = couch['spain']

mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sun Sep 27 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Mon Sep 28 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>-5.642968)&&(la>43.532007)&&(lo<-5.631773)&&(la<43.540523)){
			emit(doc.user.id, 1);
		}
	}
  
}
}
'''

reduceFunc = '''function(keys, values,rereduce){
	return sum(values);
}'''

result = db.query(mapFunc, reduceFunc, group_level=1)

print len(result)
