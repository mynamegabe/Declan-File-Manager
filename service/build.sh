#!/bin/sh
docker build -t web-sfm .
docker run --restart always -d -p 13001:80 --name web-sfm web-sfm
docker start web-sfm
