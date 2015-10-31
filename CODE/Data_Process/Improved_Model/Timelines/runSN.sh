#!/bin/sh
cd ./compareFiles/   
for i in `ls -a *.py`
do
	python $i
done