# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will generate top frequent user in England Premier Leagure 
import glob
import collections
fileList = glob.glob("./*.csv")

userid = []
for i in fileList:
	with open(i,'r') as f:
		for line in f.readlines():
			userid.append(line.split(',')[0])
print len(userid)
print collections.Counter(userid)
screenNames = {}
for i in fileList:
	with open(i,'r') as f:
		for line in f.readlines():
			screenNames[line.split(',')[0]] = line.split(',')[1].strip()
print screenNames["107782177"]
print screenNames["93398111"]
print screenNames["287183612"]
print screenNames["275424947"]
print screenNames["456837227"]