# COMP90055-COMPUTING-PROJECT-Estimating-Crowds-Based-on-Social-Media

COMP90055 COMPUTING PROJECT

Author :  Weijia Chen
Student Number : 616213
Supervisor : Prof. Richard Sinnott
Project Name : Estimating Crowds Based on Social Media

Overview 

This repository contains the sources code for COMP90055 final project of Estimating Crowds Based on Social Media

Web Interface: http://115.146.85.185/index.php

Source Code URL: https://github.com/chenvega/COMP90055-COMPUTING-PROJECT-Estimating-Crowds-Based-on-Social-Media

Presentation Slide URL: https://github.com/chenvega/COMP90055-COMPUTING-PROJECT-Estimating-Crowds-Based-on-Social-Media/tree/master/Presentation

Presentation Video Demo: https://www.youtube.com/watch?v=BI3Rykl-wpU&feature=youtu.be


--> Environment Requirements
For installing and launching the system, the following tools/applications are needed:

1. Apache2
2. Python
3. CouchDB
4. Tweepy


--> Directory Structure

System_Install
TwitterHarvester
Data_Process
Web_APP



--> Directory Details

—————————System_Install—————————

--> Boto

This folder contains a python implementation file, which is used to create Cloud Instances and corresponding volumes.

--> Ansible 

This folder is used to deploy applications, edit configuration files and mount volumes. The implemented roles are explained as follows:

    --> appinstall:  Install needed applications in Ubuntu
    --> fonfigurationEdit: Modify application configuration files.
    --> couchdb: Install CouchDB.
    --> directoryCreator: Generate needed directories.
    --> mountVolume: Mount corresponding volumes to instances.
    --> pythonPackage: Install python-related packages.
    --> restart: Restart applications after editing configuration files.
    --> update: Update the Ubuntu system.

—————————TwitterHarvesters—————————

This folder is used to use Twitter API to harvester Tweets data from different crowd events. Different sub-folders indicate different social events as follows:

    --> AFL: Australian Football League
    --> Airport: Melbourne International Airport
    --> Football_england: England Football League
    --> Football_german: German Football League
    --> Football_italy: Italy Football League
    --> Football_spain: Spain Football League
    --> Melbourne_marathon: Medibank Melbourne Marathon Festival
    --> NRL: National Rugby League
    --> USOpen: US Open Tennis Championships


—————————Data_Process—————————

This folder is used to count tweets number, implement improved algorithm and linear regression model.

--> Improved_Model

    --> Rank_Capacity: Contains team rank score and stadium capacity statistics. And add team rank score and capacity of stadium into linear regression model.
    --> Timelines: Extract historical tweets data based on Tweets screen_name.

--> Primary_Model: Used to count the number of Twitter user for different sport events.

--> LR_Model: Implement Linear Regression model based on tweets statistics.

--> Final_Data: All statistics data are formed into CSV files for different football leagues.

—————————Web_APP—————————

This folder contains different files for Web Interface implementation.
