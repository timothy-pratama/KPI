docker build -t timothypratama/simpleblog .
docker run --name kpi -d -p 80:80 timothypratama/simpleblog