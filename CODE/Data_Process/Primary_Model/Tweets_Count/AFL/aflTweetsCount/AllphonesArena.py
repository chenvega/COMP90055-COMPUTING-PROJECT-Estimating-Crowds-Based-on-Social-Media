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
db = couch['afl']

# mapFunc = '''function(doc){
# 	emit(doc.user.id, 1);
# }'''

mapFunc = '''function(doc) {
var a = new Date(Date.parse("Sat Aug 15 00:00:00 +0000 2015"));
var b = new Date(Date.parse("Sun Aug 16 00:00:00 +0000 2015"));
var t = new Date(Date.parse(doc.created_at));
if((t>a)&&(t<b)){
	if(doc.coordinates != null){
		var la = doc.coordinates.coordinates[1];
		var lo = doc.coordinates.coordinates[0];
		if((lo>151.0576614841)&&(la>-33.8479761574)&&(lo<151.0666381159)&&(la<-33.8407751595)){
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
