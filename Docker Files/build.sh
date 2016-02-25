docker build -t timothypratama/simpleblog .
docker run --name kpi -d -p 80:80 -p 3306:3306 -p 443:443 timothypratama/simpleblog