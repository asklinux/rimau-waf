#!/bin/bash

#Projek waf sektor awam , bash script pemasangan server

echo 'Pilih Web Server :'
SERVER="apache nginx"

select opt in $SERVER; do
	if ["$opt" = "nginx"]; then
		echo apache
		exit
	elif ["$opt" = "apache"]; then
	   	echo nginx
	else
	   	clear
	   	echo tiada
	   	exit
	fi
done
