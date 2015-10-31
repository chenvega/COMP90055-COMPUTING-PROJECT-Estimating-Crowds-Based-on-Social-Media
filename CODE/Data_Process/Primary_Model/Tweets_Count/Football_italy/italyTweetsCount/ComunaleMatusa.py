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
db = couch['italy']


mapFunc = '''function(doc) {
var a = new Date(Date.parse("Mon Sep 28 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Tue Sep 29 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
var locations = [13.318932,41.622793,13.36755,41.652947]
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>locations[0])&&(la>locations[1])&&(lo<locations[2])&&(la<locations[3])){
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
