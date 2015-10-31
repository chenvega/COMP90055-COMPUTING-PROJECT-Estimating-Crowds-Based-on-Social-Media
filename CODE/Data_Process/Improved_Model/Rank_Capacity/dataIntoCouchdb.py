# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will upload the final statistics (Tweets number, Capacity & Rank number)to the CouchDB 
import json
import couchdb
import csv

couch = couchdb.Server('http://localhost:5984')
db = couch.create('italydatanew')
db = couch['italydatanew']

with open('./italyfinal.csv','rU') as f:
    f.next()
    reader = csv.reader(f)
    i = 0
    for line in reader:
        csvDict = {}
        csvDict['Home'] = line[0]
        csvDict['Away'] = line[1]
        csvDict['Stadium'] = line[3]
        csvDict['Date'] = line[2]
        csvDict['Capacity'] = line[7]
        csvDict['Attendance'] = line[4]
        csvDict['Popular'] = line[6]
        csvDict['Tweets'] = line[5]

        index = 'Italy' + str(i)

        db[index] = csvDict
        i += 1
dbPop = couch.create('italypop')
dbCap = couch.create('italycap')
dbPop = couch['italypop']
dbCap = couch['italycap']
csvPop = {}
csvCap = {}
with open('./italyTeamList.txt', 'r') as f:
    i = 0
    for line in f.readlines():
        csvPop['Team'] = line.split('\t')[0]

        csvPop['Popular'] = line.split('\t')[1].strip()

        index = 'Italy' + str(i)
        dbPop[index] = csvPop

        i += 1
with open('./italyStadiumList.txt', 'r') as f:
    i = 0
    for line in f.readlines():
        csvCap['Stadium'] = line.split('\t')[0]

        csvCap['Capacity'] = line.split('\t')[1].strip()

        index = 'Italy' + str(i)
        dbCap[index] = csvCap

        i += 1
db = couch.create('afldatanew')
db = couch['afldatanew']



