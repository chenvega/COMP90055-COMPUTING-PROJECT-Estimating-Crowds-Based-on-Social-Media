# Author :  Weijia Chen
# Student Number : 616213
# Supervisor : Prof. Richard Sinnott
# Subject: COMP90055 COMPUTING PROJECT
# Project Name : Estimating Crowds Based on Social Media

# This program will generate corresponding linear regression equation based four football leagues.
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
from sklearn import datasets, linear_model

# Function to get data
def get_data(file_name):
	data = pd.read_csv(file_name)
	para_x = []
	para_y = []
	for popularity,capacity,tweetcount,attendance in zip(data['Popular'],data['Capacity'],data['Tweets'],data['Attendance']):
		para_x.append([float(popularity),float(capacity),float(tweetcount)])
		para_y.append(float(attendance))
	return para_x,para_y
x, y = get_data("afl.csv")

def linear_model_main(para_x,para_y,predict_value):

	# Create linear regression object
	lrModel = linear_model.LinearRegression()
	lrModel.fit(para_x, para_y)
	predictResult = lrModel.predict(predict_value)
	predictions = {}
	predictions['intercept'] = lrModel.intercept_
	predictions['coefficient'] = lrModel.coef_
	predictions['predicted_value'] = predictResult
	return predictions

predictvalue = [26,80000,216]
result = linear_model_main(x,y,predictvalue)
print "Intercept value " , result['intercept']
print "coefficient" , result['coefficient']
print "Predicted value: ",result['predicted_value']